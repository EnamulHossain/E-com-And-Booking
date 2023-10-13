<?php
/*
 * File name: HotelController.php
 * Last modified: 2022.02.12 at 02:17:42
 * Author: Nefold - https://nefold.com
 * Copyright (c) 2022
 */

namespace App\Http\Controllers;

use App\Criteria\Addresses\AddressesOfUserCriteria;
use App\Criteria\HotelLevels\EnabledCriteria;
use App\Criteria\Hotels\HotelsOfUserCriteria;
use App\Criteria\Users\HotelsCustomersCriteria;
use App\DataTables\RequestedHotelDataTable;
use App\DataTables\HotelDataTable;
use App\Events\HotelChangedEvent;
use App\Http\Requests\CreateHotelRequest;
use App\Http\Requests\UpdateHotelRequest;
use App\Repositories\HotelAddressRepository;
use App\Repositories\CustomFieldRepository;
use App\Repositories\HotelLevelRepository;
use App\Repositories\HotelRepository;
use App\Repositories\TaxRepository;
use App\Repositories\UploadRepository;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;
use Laracasts\Flash\Flash;
use Prettus\Repository\Exceptions\RepositoryException;
use Prettus\Validator\Exceptions\ValidatorException;

class HotelController extends Controller
{
    /** @var  HotelRepository */
    private $hotelRepository;

    /**
     * @var CustomFieldRepository
     */
    private $customFieldRepository;

    /**
     * @var UploadRepository
     */
    private $uploadRepository;
    /**
     * @var HotelLevelRepository
     */
    private $hotelLevelRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var HotelAddressRepository
     */
    private $addressRepository;
    /**
     * @var TaxRepository
     */
    private $taxRepository;

    public function __construct(HotelRepository $hotelRepo, CustomFieldRepository $customFieldRepo, UploadRepository $uploadRepo
        , HotelLevelRepository                  $hotelLevelRepo
        , UserRepository                        $userRepo
        , HotelAddressRepository                     $addressRepo
        , TaxRepository                         $taxRepo)
    {
        parent::__construct();
        $this->hotelRepository = $hotelRepo;
        $this->customFieldRepository = $customFieldRepo;
        $this->uploadRepository = $uploadRepo;
        $this->hotelLevelRepository = $hotelLevelRepo;
        $this->userRepository = $userRepo;
        $this->addressRepository = $addressRepo;
        $this->taxRepository = $taxRepo;
    }

    /**
     * Display a listing of the Hotel.
     *
     * @param HotelDataTable $hotelDataTable
     * @return mixed
     */
    public function index(HotelDataTable $hotelDataTable)
    {
        return $hotelDataTable->render('hotels.index');
    }

    /**
     * Display a listing of the Hotel.
     *
     * @param HotelDataTable $hotelDataTable
     * @return mixed
     */
    public function requestedHotels(RequestedHotelDataTable $requestedHotelDataTable)
    {
        return $requestedHotelDataTable->render('hotels.requested');
    }

    /**
     * Show the form for creating a new Hotel.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        $hotelLevel = $this->hotelLevelRepository->getByCriteria(new EnabledCriteria())->pluck('name', 'id');
        $user = $this->userRepository->getByCriteria(new HotelsCustomersCriteria())->pluck('name', 'id');
        $address = $this->addressRepository->getByCriteria(new AddressesOfUserCriteria(auth()->id()))->pluck('address', 'id');
        $tax = $this->taxRepository->pluck('name', 'id');
        $usersSelected = [];
        $taxesSelected = [];
        $hasCustomField = in_array($this->hotelRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->hotelRepository->model());
            $html = generateCustomField($customFields);
        }
        return view('hotels.create')->with("customFields", isset($html) ? $html : false)->with("hotelLevel", $hotelLevel)->with("user", $user)->with("usersSelected", $usersSelected)->with("address", $address)->with("tax", $tax)->with("taxesSelected", $taxesSelected);
    }

    /**
     * Store a newly created Hotel in storage.
     *
     * @param CreateHotelRequest $request
     *
     * @return Application|RedirectResponse|Redirector|Response
     */
    public function store(CreateHotelRequest $request)
    {
        $input = $request->all();
        if (auth()->user()->hasRole(['provider', 'customer'])) {
            $input['users'] = [auth()->id()];
        }
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->hotelRepository->model());
        try {
            $hotel = $this->hotelRepository->create($input);
            $hotel->customFieldsValues()->createMany(getCustomFieldsValues($customFields, $request));
            if (isset($input['image']) && $input['image'] && is_array($input['image'])) {
                foreach ($input['image'] as $fileUuid) {
                    $cacheUpload = $this->uploadRepository->getByUuid($fileUuid);
                    $mediaItem = $cacheUpload->getMedia('image')->first();
                    $mediaItem->copy($hotel, 'image');
                }
            }
            event(new HotelChangedEvent($hotel, $hotel));
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully', ['operator' => __('lang.hotel')]));

        return redirect(route('hotels.index'));
    }

    /**
     * Display the specified Hotel.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Redirector|Response
     * @throws RepositoryException
     */
    public function show(int $id)
    {
        $this->hotelRepository->pushCriteria(new HotelsOfUserCriteria(auth()->id()));
        $hotel = $this->hotelRepository->findWithoutFail($id);

        if (empty($hotel)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.hotel')]));

            return redirect(route('hotels.index'));
        }

        return view('hotels.show')->with('hotel', $hotel);
    }

    /**
     * Show the form for editing the specified Hotel.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Redirector|Response
     * @throws RepositoryException
     */
    public function edit(int $id)
    {
        $this->hotelRepository->pushCriteria(new HotelsOfUserCriteria(auth()->id()));
        $hotel = $this->hotelRepository->findWithoutFail($id);
        if (empty($hotel)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.hotel')]));
            return redirect(route('hotels.index'));
        }
        $hotelLevel = $this->hotelLevelRepository->getByCriteria(new EnabledCriteria())->pluck('name', 'id');
        $user = $this->userRepository->getByCriteria(new HotelsCustomersCriteria())->pluck('name', 'id');
        $address = $this->addressRepository->getByCriteria(new AddressesOfUserCriteria(auth()->id()))->pluck('address', 'id');
        $tax = $this->taxRepository->pluck('name', 'id');
        $usersSelected = $hotel->users()->pluck('users.id')->toArray();
        $taxesSelected = $hotel->taxes()->pluck('taxes.id')->toArray();

        $customFieldsValues = $hotel->customFieldsValues()->with('customField')->get();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->hotelRepository->model());
        $hasCustomField = in_array($this->hotelRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $html = generateCustomField($customFields, $customFieldsValues);
        }

        return view('hotels.edit')->with('hotel', $hotel)->with("customFields", isset($html) ? $html : false)->with("hotelLevel", $hotelLevel)->with("user", $user)->with("usersSelected", $usersSelected)->with("address", $address)->with("tax", $tax)->with("taxesSelected", $taxesSelected);
    }

    /**
     * Update the specified Hotel in storage.
     *
     * @param int $id
     * @param UpdateHotelRequest $request
     *
     * @return Application|RedirectResponse|Redirector|Response
     * @throws RepositoryException
     */
    public function update(int $id, UpdateHotelRequest $request)
    {
        $this->hotelRepository->pushCriteria(new HotelsOfUserCriteria(auth()->id()));
        $oldHotel = $this->hotelRepository->findWithoutFail($id);

        if (empty($oldHotel)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.hotel')]));
            return redirect(route('hotels.index'));
        }
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->hotelRepository->model());
        try {
            $input['users'] = isset($input['users']) ? $input['users'] : [];
            $input['taxes'] = isset($input['taxes']) ? $input['taxes'] : [];
            $hotel = $this->hotelRepository->update($input, $id);
            if (isset($input['image']) && $input['image'] && is_array($input['image'])) {
                foreach ($input['image'] as $fileUuid) {
                    $cacheUpload = $this->uploadRepository->getByUuid($fileUuid);
                    $mediaItem = $cacheUpload->getMedia('image')->first();
                    $mediaItem->copy($hotel, 'image');
                }
            }
            foreach (getCustomFieldsValues($customFields, $request) as $value) {
                $hotel->customFieldsValues()
                    ->updateOrCreate(['custom_field_id' => $value['custom_field_id']], $value);
            }
            event(new HotelChangedEvent($hotel, $oldHotel));
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully', ['operator' => __('lang.hotel')]));

        return redirect(route('hotels.index'));
    }

    /**
     * Remove the specified Hotel from storage.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Redirector|Response
     * @throws RepositoryException
     */
    public function destroy(int $id)
    {
        if (config('installer.demo_app')) {
            Flash::warning('This is only demo app you can\'t change this section ');
            return redirect(route('hotels.index'));
        }
        $this->hotelRepository->pushCriteria(new HotelsOfUserCriteria(auth()->id()));
        $hotel = $this->hotelRepository->findWithoutFail($id);

        if (empty($hotel)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.hotel')]));

            return redirect(route('hotels.index'));
        }

        $this->hotelRepository->delete($id);

        Flash::success(__('lang.deleted_successfully', ['operator' => __('lang.hotel')]));

        return redirect(route('hotels.index'));
    }

    /**
     * Remove Media of Hotel
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        $input = $request->all();
        $hotel = $this->hotelRepository->findWithoutFail($input['id']);
        try {
            if ($hotel->hasMedia($input['collection'])) {
                $hotel->getFirstMedia($input['collection'])->delete();
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
