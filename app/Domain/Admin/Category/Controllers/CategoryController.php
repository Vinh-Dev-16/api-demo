<?php

namespace App\Domain\Admin\Category\Controllers;

use App\Domain\Admin\Category\Features\ListCategoryFeature;
use App\Domain\Admin\Category\Requests\ListCategoryRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    public function __construct(
        Request $request,
        protected ListCategoryFeature $listCategoryFeature
    ) {
    }

    public function listCategory(ListCategoryRequest $request): JsonResponse
    {
        $dto = $request->getDto();
        $this->listCategoryFeature->setDto($dto);
        $data = $this->listCategoryFeature->handle();
        return response()->json([
            'message' => 'List category',
            'data'    => $data
        ], Response::HTTP_OK);
    }

}