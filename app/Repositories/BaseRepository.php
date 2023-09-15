<?php

namespace App\Repositories;

use App\Interfaces\RepoInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class BaseRepository implements RepoInterface {

    protected $model;
    
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }


    public function fetchAll(): Collection
    {
        return $this->model->all();
    }


    public function findById(int $id): Model
    {
        return $this->model->where('id', $id)->first();
    }


    public function update(array $params, int $id): Model
    {
        $model = $this->model->where('id', $id)->first();
        $model->update($params);
        return $model;
    }
   

   public function delete(int $id): bool
   {
       $model = $this->model->where('id', $id)->first();       
       return $model->delete();
   }

}

