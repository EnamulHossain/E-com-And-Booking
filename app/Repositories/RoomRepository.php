<?php
/*
 * File name: HotelRepository.php
 * Last modified: 2022.02.12 at 02:17:42
 * Author: Nefold - https://nefold.com
 * Copyright (c) 2022
 */

namespace App\Repositories;


use App\Models\Room;
use InfyOm\Generator\Common\BaseRepository;


class RoomRepository extends BaseRepository
{
//    public function create(array $payload): ?Room;
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'room_number',
        'hotel_id',
        'amount',
        'description',
        'available',
        'floor',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Room::class;
    }
}
