<?php
/*
 * File name: HotelRepository.php
 * Last modified: 2022.02.12 at 02:17:42
 * Author: Nefold - https://nefold.com
 * Copyright (c) 2022
 */

namespace App\Repositories;

use App\Models\Hotel;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class HotelRepository
 * @package App\Repositories
 * @version January 13, 2021, 11:11 am UTC
 *
 * @method Hotel findWithoutFail($id, $columns = ['*'])
 * @method Hotel find($id, $columns = ['*'])
 * @method Hotel first($columns = ['*'])
 */
class HotelRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'hotel_level_id',
        'address_id',
        'description',
        'phone_number',
        'mobile_number',
        'availability_range',
        'available',
        'closed',
        'featured'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Hotel::class;
    }
}
