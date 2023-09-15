<?php

namespace App\Http\Controllers\Api\V1\Admin;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    public function __construct(
        private ProductRepository $productRepository
    ){}
    
    public function store(ProductRequest $request): JsonResponse
    {
        $product = $this->productRepository->createProduct($request); 
        return response()->json([new ProductResource($product)], Response::HTTP_CREATED);

    }

    public function update($id, ProductRequest $request): JsonResponse
    {
        $productId = $this->productRepository->updateProduct($id, $request);
        return response()->json([new ProductResource($productId)], Response::HTTP_OK);
    }

    public function destroy($id): JsonResponse
    {
        $this->productRepository->deleteProduct($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
