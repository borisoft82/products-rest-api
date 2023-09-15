<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    public function __construct(
        private ProductRepository $productRepository
    ){}

    public function index(): JsonResponse
    {
        $products = $this->productRepository->getAll();
        return response()->json(ProductResource::collection($products), Response::HTTP_OK);
    }

    public function show($id): JsonResponse
    {
        try {
            $productId = Product::find($id);
            $result = response()->json([new ProductResource($productId)], Response::HTTP_OK);
        } 
        catch (\Exception $e) {
            \Log::error($e->getMessage());
            $result = response()->json([
                'message' => $e->getMessage(),
                'error' => true,
                'sttus_code' => Response::HTTP_INTERNAL_SERVER_ERROR
            ], Response::HTTP_INTERNAL_SERVER_ERROR);

        }

        return $result;
    }
    
}
