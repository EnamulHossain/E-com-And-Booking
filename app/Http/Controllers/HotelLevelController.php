<?php
/*
 * File name: HotelLevelController.php
 * Last modified: 2022.02.03 at 10:46:03
 * Author: Nefold - https://nefold.com
 * Copyright (c) 2022
 */

namespace App\Http\Controllers;

use App\DataTables\HotelLevelDataTable;
use App\Http\Requests\CreateHotelLevelRequest;
use App\Http\Requests\UpdateHotelLevelRequest;
use App\Repositories\CustomFieldRepository;
use App\Repositories\HotelLevelRepository;
use Exception;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Exceptions\ValidatorException;

class HotelLevelController extends Controller
{
    /** @var  HotelLevelRepository */
    private $hotelLevelRepository;

    /**
     * @var CustomFieldRepository
     */
    private $customFieldRepository;


    public function __construct(HotelLevelRepository $hotelLevelRepo, CustomFieldRepository $customFieldRepo)
    {
        parent::__construct();
        $this->hotelLevelRepository = $hotelLevelRepo;
        $this->customFieldRepository = $customFieldRepo;

    }

    /**
     * Display a listing of the HotelLevel.
     *
     * @param HotelLevelDataTable $hotelLevelDataTable
     * @return Response
     */
    public function index(HotelLevelDataTable $hotelLevelDataTable)
    {
        return $hotelLevelDataTable->render('hotel_levels.index');
    }

    /**
     * Show the form for creating a new HotelLevel.
     *
     * @return Response
     */
    public function create()
    {


        $hasCustomField = in_array($this->hotelLevelRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->hotelLevelRepository->model());
            $html = generateCustomField($customFields);
        }
        return view('hotel_levels.create')->with("customFields", isset($html) ? $html : false);
    }

    /**
     * Store a newly created HotelLevel in storage.
     *
     * @param CreateHotelLevelRequest $request
     *
     * @return Response
     */
    public function store(CreateHotelLevelRequest $request)
    {
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->hotelLevelRepository->model());
        try {
            $hotelLevel = $this->hotelLevelRepository->create($input);
            $hotelLevel->customFieldsValues()->createMany(getCustomFieldsValues($customFields, $request));

        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully', ['operator' => __('lang.hotel_level')]));

        return redirect(route('hotelLevels.index'));
    }

    /**
     * Display the specified HotelLevel.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $hotelLevel = $this->hotelLevelRepository->findWithoutFail($id);

        if (empty($hotelLevel)) {
            Flash::error('E Provider Type not found');

            return redirect(route('hotelLevels.index'));
        }

        return view('hotel_levels.show')->with('hotelLevel', $hotelLevel);
    }

    /**
     * Show the form for editing the specified HotelLevel.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $hotelLevel = $this->hotelLevelRepository->findWithoutFail($id);


        if (empty($hotelLevel)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.hotel_level')]));

            return redirect(route('hotelLevels.index'));
        }
        $customFieldsValues = $hotelLevel->customFieldsValues()->with('customField')->get();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->hotelLevelRepository->model());
        $hasCustomField = in_array($this->hotelLevelRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $html = generateCustomField($customFields, $customFieldsValues);
        }

        return view('hotel_levels.edit')->with('hotelLevel', $hotelLevel)->with("customFields", isset($html) ? $html : false);
    }

    /**
     * Update the specified HotelLevel in storage.
     *
     * @param int $id
     * @param UpdateHotelLevelRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHotelLevelRequest $request)
    {
        $hotelLevel = $this->hotelLevelRepository->findWithoutFail($id);

        if (empty($hotelLevel)) {
            Flash::error('E Provider Type not found');
            return redirect(route('hotelLevels.index'));
        }
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->hotelLevelRepository->model());
        try {
            $hotelLevel = $this->hotelLevelRepository->update($input, $id);


            foreach (getCustomFieldsValues($customFields, $request) as $value) {
                $hotelLevel->customFieldsValues()
                    ->updateOrCreate(['custom_field_id' => $value['custom_field_id']], $value);
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully', ['operator' => __('lang.hotel_level')]));

        return redirect(route('hotelLevels.index'));
    }

    /**
     * Remove the specified HotelLevel from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $hotelLevel = $this->hotelLevelRepository->findWithoutFail($id);

        if (empty($hotelLevel)) {
            Flash::error('E Provider Type not found');

            return redirect(route('hotelLevels.index'));
        }

        $this->hotelLevelRepository->delete($id);

        Flash::success(__('lang.deleted_successfully', ['operator' => __('lang.hotel_level')]));

        return redirect(route('hotelLevels.index'));
    }

    /**
     * Remove Media of HotelLevel
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        $input = $request->all();
        $hotelLevel = $this->hotelLevelRepository->findWithoutFail($input['id']);
        try {
            if ($hotelLevel->hasMedia($input['collection'])) {
                $hotelLevel->getFirstMedia($input['collection'])->delete();
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
