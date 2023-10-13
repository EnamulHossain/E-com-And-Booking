<?php
/*
 * File name: HotelReviewRepository.php
 * Last modified: 2022.02.12 at 02:17:42
 * Author: Nefold - https://nefold.com
 * Copyright (c) 2022
 */

namespace App\Repositories;

use App\Models\HotelReview;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class HotelReviewRepository
 * @package App\Repositories
 * @version January 23, 2021, 7:42 pm UTC
 *
 * @method HotelReview findWithoutFail($id, $columns = ['*'])
 * @method HotelReview find($id, $columns = ['*'])
 * @method HotelReview first($columns = ['*'])
 */
class HotelReviewRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'review',
        'rate',
        'booking_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return HotelReview::class;
    }
}
