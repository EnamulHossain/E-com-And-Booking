<?php
/*
 * File name: EnabledCriteria.php
 * Last modified: 2022.02.02 at 21:19:16
 * Author: Nefold - https://nefold.com
 * Copyright (c) 2022
 */

namespace App\Criteria\HotelLevels;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class EnabledCriteria.
 *
 * @package namespace App\Criteria\SalonLevels;
 */
class EnabledCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param string $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where('hotel_levels.disabled', '0');
    }
}
