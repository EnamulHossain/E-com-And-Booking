<?php
/*
 * File name: HotelReviewController.php
 * Last modified: 2022.02.12 at 02:17:42
 * Author: Nefold - https://nefold.com
 * Copyright (c) 2022
 */

namespace App\Http\Controllers;

use App\Criteria\HotelReviews\HotelReviewsOfUserCriteria;
use App\Criteria\Users\HotelsCriteria;
use App\DataTables\HotelReviewDataTable;
use App\Http\Requests\CreateHotelReviewRequest;
use App\Http\Requests\UpdateHotelReviewRequest;
use App\Repositories\CustomFieldRepository;
use App\Repositories\HotelReviewRepository;
use App\Repositories\UserRepository;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;
use Prettus\Repository\Exceptions\RepositoryException;
use Prettus\Validator\Exceptions\ValidatorException;

class HotelReviewController extends Controller
{
    /** @var  HotelReviewRepository */
    private $hotelReviewRepository;

    /**
     * @var CustomFieldRepository
     */
    private $customFieldRepository;


    public function __construct(HotelReviewRepository $hotelReviewRepo, CustomFieldRepository $customFieldRepo)
    {
        parent::__construct();
        $this->hotelReviewRepository = $hotelReviewRepo;
        $this->customFieldRepository = $customFieldRepo;
    }

    /**
     * Display a listing of the HotelReview.
     *
     * @param HotelReviewDataTable $hotelReviewDataTable
     * @return Response
     */
    public function index(HotelReviewDataTable $hotelReviewDataTable)
    {
        return $hotelReviewDataTable->render('hotel_reviews.index');
    }

    /**
     * Store a newly created HotelReview in storage.
     *
     * @param CreateHotelReviewRequest $request
     *
     * @return Application|Redirector|RedirectResponse
     */
    public function store(CreateHotelReviewRequest $request)
    {
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->hotelReviewRepository->model());
        try {
            $hotelReview = $this->hotelReviewRepository->create($input);
            $hotelReview->customFieldsValues()->createMany(getCustomFieldsValues($customFields, $request));

        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully', ['operator' => __('lang.hotel_review')]));

        return redirect(route('hotelReviews.index'));
    }

    /**
     * Display the specified HotelReview.
     *
     * @param int $id
     *
     * @return Application|Factory|Redirector|RedirectResponse|View
     * @throws RepositoryException
     */
    public function show(int $id)
    {
        $this->hotelReviewRepository->pushCriteria(new HotelReviewsOfUserCriteria(auth()->id()));
        $hotelReview = $this->hotelReviewRepository->findWithoutFail($id);

        if (empty($hotelReview)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.hotel_review')]));
            return redirect(route('hotelReviews.index'));
        }
        return view('hotel_reviews.show')->with('hotelReview', $hotelReview);
    }

    /**
     * Show the form for editing the specified HotelReview.
     *
     * @param int $id
     *
     * @return Application|Factory|Redirector|RedirectResponse|View
     * @throws RepositoryException
     */
    public function edit(int $id)
    {
        $this->hotelReviewRepository->pushCriteria(new HotelReviewsOfUserCriteria(auth()->id()));
        $hotelReview = $this->hotelReviewRepository->findWithoutFail($id);
        if (empty($hotelReview)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.hotel_review')]));
            return redirect(route('hotelReviews.index'));
        }

        $customFieldsValues = $hotelReview->customFieldsValues()->with('customField')->get();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->hotelReviewRepository->model());
        $hasCustomField = in_array($this->hotelReviewRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $html = generateCustomField($customFields, $customFieldsValues);
        }
        return view('hotel_reviews.edit')->with('hotelReview', $hotelReview)->with("customFields", $html ?? false);
    }

    /**
     * Update the specified HotelReview in storage.
     *
     * @param int $id
     * @param UpdateHotelReviewRequest $request
     *
     * @return Application|Redirector|RedirectResponse
     * @throws RepositoryException
     */
    public function update(int $id, UpdateHotelReviewRequest $request)
    {
        $this->hotelReviewRepository->pushCriteria(new HotelReviewsOfUserCriteria(auth()->id()));
        $hotelReview = $this->hotelReviewRepository->findWithoutFail($id);

        if (empty($hotelReview)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.hotel_review')]));
            return redirect(route('hotelReviews.index'));
        }
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->hotelReviewRepository->model());
        try {
            $hotelReview = $this->hotelReviewRepository->update($input, $id);

            foreach (getCustomFieldsValues($customFields, $request) as $value) {
                $hotelReview->customFieldsValues()
                    ->updateOrCreate(['custom_field_id' => $value['custom_field_id']], $value);
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }
        Flash::success(__('lang.updated_successfully', ['operator' => __('lang.hotel_review')]));
        return redirect(route('hotelReviews.index'));
    }

    /**
     * Remove the specified HotelReview from storage.
     *
     * @param int $id
     *
     * @return Application|Redirector|RedirectResponse
     * @throws RepositoryException
     */
    public function destroy(int $id)
    {
        $this->hotelReviewRepository->pushCriteria(new HotelReviewsOfUserCriteria(auth()->id()));
        $hotelReview = $this->hotelReviewRepository->findWithoutFail($id);

        if (empty($hotelReview)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.hotel_review')]));
            return redirect(route('hotelReviews.index'));
        }

        $this->hotelReviewRepository->delete($id);

        Flash::success(__('lang.deleted_successfully', ['operator' => __('lang.hotel_review')]));
        return redirect(route('hotelReviews.index'));
    }

}
