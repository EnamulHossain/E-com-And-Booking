<?php
/*
 * File name: SalonsCriteria.php
 * Last modified: 2022.02.03 at 18:14:47
 * Author: Nefold - https://nefold.com
 * Copyright (c) 2022
 */

namespace App\Criteria\Users;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class SalonsCriteria.
 *
 * @package namespace App\Criteria\Users;
 */
class SalonsCriteria implements CriteriaInterface
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
        return $model->whereHas("roles", function ($q) {
            $q->where("name", "salon owner");
        });
    }
}
