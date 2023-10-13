<?php
/*
 * File name: HotelPayoutRepository.php
 * Last modified: 2022.02.02 at 21:22:02
 * Author: Nefold - https://nefold.com
 * Copyright (c) 2022
 */

namespace App\Repositories;

use App\Models\HotelPayout;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class HotelPayoutRepository
 * @package App\Repositories
 * @version January 30, 2021, 11:17 am UTC
 *
 * @method HotelPayout findWithoutFail($id, $columns = ['*'])
 * @method HotelPayout find($id, $columns = ['*'])
 * @method HotelPayout first($columns = ['*'])
 */
class HotelPayoutRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'hotel_id',
        'method',
        'amount',
        'paid_date',
        'note'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return HotelPayout::class;
    }
}
