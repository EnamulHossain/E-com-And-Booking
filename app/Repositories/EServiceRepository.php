<?php
/*
 * File name: EServiceRepository.php
 * Last modified: 2022.03.11 at 22:26:16
 * Author: Nefold - https://nefold.com
 * Copyright (c) 2022
 */

namespace App\Repositories;

use App\Models\EService;
use InfyOm\Generator\Common\BaseRepository;
use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * Class EServiceRepository
 * @package App\Repositories
 * @version January 19, 2021, 1:59 pm UTC
 *
 * @method EService findWithoutFail($id, $columns = ['*'])
 * @method EService find($id, $columns = ['*'])
 * @method EService first($columns = ['*'])
 */
class EServiceRepository extends BaseRepository implements CacheableInterface
{

    use CacheableRepository;

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'price',
        'discount_price',
        'duration',
        'description',
        'featured',
        'available',
        'enable_booking',
        'enable_at_salon',
        'enable_at_customer_address',
        'salon_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return EService::class;
    }

    /**
     * @return array
     */
    public function groupedBySalons(): array
    {
        $eServices = [];
        foreach ($this->all() as $model) {
            if (!empty($model->salon)) {
                $eServices[$model->salon->name][$model->id] = $model->name;
            }
        }
        return $eServices;
    }
}
