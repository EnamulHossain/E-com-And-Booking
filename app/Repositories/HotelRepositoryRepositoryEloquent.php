<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\HotelRepositoryRepository;
use App\Entities\HotelRepository;
use App\Validators\HotelRepositoryValidator;

/**
 * Class HotelRepositoryRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class HotelRepositoryRepositoryEloquent extends BaseRepository implements HotelRepositoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return HotelRepository::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
