<?php

namespace App\Domain\Admin\Product\Transformers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ListProductTransformer
{
    private LengthAwarePaginator $products;

    public function transform(): array
    {
        return [
            'products' => $this->transformProducts($this->products),
            'page'     => $this->products->currentPage(),
            'limit'    => $this->products->perPage(),
        ];
    }

    private function transformProducts(LengthAwarePaginator $products): array
    {
        return $products->map(function (Product $product) {
            return [
                'id'          => $product->getId(),
                'name'        => $product->getName(),
                'description' => $product->getDescription(),
                'price'       => $product->getPrice(),
                'weight'      => $product->getWeight(),
                'discount'    => $product->getDiscount(),
                'stock'       => $product->getStock(),
                'sold'        => $product->getSold(),
                'rate'        => $product->getRate(),
                'views'       => $product->getView(),
                'categories'  => isset($product->categories)
                    ? $this->transformCategories($product->categories) : [],
                'brands'      => isset($product->brand)
                    ? $this->transformBrand($product->brand) : [],
                'images'      => isset($product->images)
                    ? $this->transformImages($product->images) : [],
            ];
        })->toArray();
    }

    private function transformBrand(Brand $brand): array
    {
        return [
            'id'          => $brand->getId(),
            'name'        => $brand->getName(),
            'logo'        => $brand->getLogo(),
            'description' => $brand->getDescription(),
        ];
    }

    private function transformImages(Collection $images): array
    {
        return $images->map(function (Image $image) {
            return [
                'id'  => $image->getId(),
                'url' => $image->getPath(),
            ];
        })->toArray();
    }

    private function transformCategories(Collection $categories): array
    {
        return $categories->map(function (Category $category) {
            return [
                'id'       => $category->getId(),
                'name'     => $category->getName(),
                'parentId' => $category->getParentId(),
            ];
        })->toArray();
    }

    public function setListProduct(LengthAwarePaginator $products): void
    {
        $this->products = $products;
    }
}
