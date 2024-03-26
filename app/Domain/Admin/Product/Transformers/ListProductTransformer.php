<?php

namespace App\Domain\Admin\Product\Transformers;

use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class ListProductTransformer
{
    private LengthAwarePaginator $products;

    public function transform(): array
    {
        return [
            'products' => $this->transformProducts($this->products),
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
            ];
        })->toArray();
    }

    public function setListProduct(LengthAwarePaginator $products): void
    {
        $this->products = $products;
    }
}