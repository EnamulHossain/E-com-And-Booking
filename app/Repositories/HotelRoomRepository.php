<?php
/*
 * File name: HotelLevelRepository.php
 * Last modified: 2022.02.03 at 14:23:26
 * Author: Nefold - https://nefold.com
 * Copyright (c) 2022
 */

namespace App\Repositories;

use App\Models\HotelLevel;
use App\Models\HotelRoom;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class HotelLevelRepository
 * @package App\Repositories
 * @version January 13, 2021, 10:56 am UTC
 *
 * @method HotelLevel findWithoutFail($id, $columns = ['*'])
 * @method HotelLevel find($id, $columns = ['*'])
 * @method HotelLevel first($columns = ['*'])
 */
class HotelRoomRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'hotel_id',
        'room_no',
        'price',
        'note'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return HotelRoom::class;
    }
}
