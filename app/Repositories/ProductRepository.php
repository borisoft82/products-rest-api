<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ProductRepository extends BaseRepository
{
    protected $model;

    public function __construct(Product $model)
    {
        parent::__construct($model);
    }


    public function createProduct(Request $request): Model
    {
        return $this->create($request->validated());
    }


    public function getAll(): Collection
    {
        return $this->fetchAll();
    }


    public function find(int $id): Model
    {
        return $this->findById($id);
    }


    public function updateProduct(int $id, Request $request): Model
    {
        return $this->update($request->validated(), $id);
    }


    public function deleteProduct(int $id): bool
    {
        return $this->delete($id);
    }

}
