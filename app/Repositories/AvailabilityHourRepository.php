<?php
/*
 * File name: AvailabilityHourRepository.php
 * Last modified: 2022.02.02 at 21:22:02
 * Author: Nefold - https://nefold.com
 * Copyright (c) 2022
 */

namespace App\Repositories;

use App\Models\AvailabilityHour;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AvailabilityHourRepository
 * @package App\Repositories
 * @version January 16, 2021, 4:08 pm UTC
 *
 * @method AvailabilityHour findWithoutFail($id, $columns = ['*'])
 * @method AvailabilityHour find($id, $columns = ['*'])
 * @method AvailabilityHour first($columns = ['*'])
 */
class AvailabilityHourRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'day',
        'start_at',
        'end_at',
        'data',
        'salon_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return AvailabilityHour::class;
    }
}
