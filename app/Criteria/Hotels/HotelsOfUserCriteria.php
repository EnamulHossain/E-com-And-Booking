<?php
/*
 * File name: SalonsOfUserCriteria.php
 * Last modified: 2022.02.02 at 21:26:20
 * Author: Nefold - https://nefold.com
 * Copyright (c) 2022
 */

namespace App\Criteria\Hotels;

use App\Models\User;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class SalonsOfUserCriteria.
 *
 * @package namespace App\Criteria\Salons;
 */
class HotelsOfUserCriteria implements CriteriaInterface
{

    /**
     * @var User
     */
    private $userId;

    /**
     * SalonsOfUserCriteria constructor.
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

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
        if (auth()->user()->hasRole('admin')) {
            return $model;
        } elseif (auth()->user()->hasRole('hotel owner')) {
            return $model->join('hotel_users', 'hotel_users.hotel_id', '=', 'hotels.id')
                ->select('hotels.*')
                ->where('hotel_users.user_id', $this->userId);
        } else {
            return $model;
        }
    }
}
