<?php

namespace App\Domain\Admin\Product\Controllers;

use App\Domain\Admin\Product\Features\DetailProductFeature;
use App\Domain\Admin\Product\Features\ListProductFeature;
use App\Domain\Admin\Product\Requests\DetailProductRequest;
use App\Domain\Admin\Product\Requests\ListProductRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function __construct(
        Request                        $request,
        protected ListProductFeature   $listProductFeature,
        protected DetailProductFeature $detailProductFeature
    ) {
    }

    public function listProduct(ListProductRequest $request): JsonResponse
    {
        $dto = $request->getDto();
        $this->listProductFeature->setDto($dto);
        $data = $this->listProductFeature->handle();
        return response()->json([
            'message' => 'List product',
            'data'    => $data
        ], Response::HTTP_OK);
    }

    public function detailProduct(DetailProductRequest $request): JsonResponse
    {
        $dto = $request->getDto();
        $this->detailProductFeature->setDto($dto);
        $data = $this->detailProductFeature->handle();
        return response()->json([
            'message' => 'Detail product',
            'data'    => $data
        ], Response::HTTP_OK);
    }

    public function create(CreateProductRequest $request) : JsonResponse
    {

    }

}