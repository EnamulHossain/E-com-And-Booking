<?php
/*
 * File name: HotelPayoutController.php
 * Last modified: 2022.02.02 at 21:22:03
 * Author: Nefold - https://nefold.com
 * Copyright (c) 2022
 */

namespace App\Http\Controllers;

use App\Criteria\Hotels\HotelsOfUserCriteria;
use App\DataTables\HotelPayoutDataTable;
use App\Http\Requests\CreateHotelPayoutRequest;
use App\Repositories\CustomFieldRepository;
use App\Repositories\EarningRepository;
use App\Repositories\HotelPayoutRepository;
use App\Repositories\HotelRepository;
use Carbon\Carbon;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;
use Prettus\Repository\Exceptions\RepositoryException;
use Prettus\Validator\Exceptions\ValidatorException;

class HotelPayoutController extends Controller
{
    /** @var  HotelPayoutRepository */
    private $hotelPayoutRepository;

    /**
     * @var CustomFieldRepository
     */
    private $customFieldRepository;

    /**
     * @var HotelRepository
     */
    private $hotelRepository;
    /**
     * @var EarningRepository
     */
    private $earningRepository;

    public function __construct(HotelPayoutRepository $hotelPayoutRepo, CustomFieldRepository $customFieldRepo, HotelRepository $hotelRepo, EarningRepository $earningRepository)
    {
        parent::__construct();
        $this->hotelPayoutRepository = $hotelPayoutRepo;
        $this->customFieldRepository = $customFieldRepo;
        $this->hotelRepository = $hotelRepo;
        $this->earningRepository = $earningRepository;
    }

    /**
     * Display a listing of the HotelPayout.
     *
     * @param HotelPayoutDataTable $hotelPayoutDataTable
     * @return Response
     */
    public function index(HotelPayoutDataTable $hotelPayoutDataTable)
    {
        return $hotelPayoutDataTable->render('hotel_payouts.index');
    }

    /**
     * Show the form for creating a new HotelPayout.
     *
     * @param int $id
     * @return Application|Factory|Response|View
     * @throws RepositoryException
     */
    public function create(int $id)
    {
        $this->hotelRepository->pushCriteria(new HotelsOfUserCriteria(auth()->id()));
        $hotel = $this->hotelRepository->findWithoutFail($id);
        if (empty($hotel)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.hotel')]));
            return redirect(route('hotelPayouts.index'));
        }
        $earning = $this->earningRepository->findByField('hotel_id', $id)->first();
        $totalPayout = $this->hotelPayoutRepository->findByField('hotel_id', $id)->sum("amount");

        $hasCustomField = in_array($this->hotelPayoutRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->hotelPayoutRepository->model());
            $html = generateCustomField($customFields);
        }
        return view('hotel_payouts.create')->with("customFields", isset($html) ? $html : false)->with("hotel", $hotel)->with("amount", $earning->hotel_earning - $totalPayout);
    }

    /**
     * Store a newly created HotelPayout in storage.
     *
     * @param CreateHotelPayoutRequest $request
     *
     * @return Application|RedirectResponse|Redirector|Response
     */
    public function store(CreateHotelPayoutRequest $request)
    {
        $input = $request->all();
        $earning = $this->earningRepository->findByField('hotel_id', $input['hotel_id'])->first();
        $totalPayout = $this->hotelPayoutRepository->findByField('hotel_id', $input['hotel_id'])->sum("amount");
        $input['amount'] = $earning->hotel_earning - $totalPayout;
        if ($input['amount'] <= 0) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.earning')]));
            return redirect(route('hotelPayouts.index'));
        }
        $input['paid_date'] = Carbon::now();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->hotelPayoutRepository->model());
        try {
            $hotelPayout = $this->hotelPayoutRepository->create($input);
            $hotelPayout->customFieldsValues()->createMany(getCustomFieldsValues($customFields, $request));

        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully', ['operator' => __('lang.hotel_payout')]));

        return redirect(route('hotelPayouts.index'));
    }
}
