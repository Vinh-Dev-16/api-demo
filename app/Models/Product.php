<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable =
        [
            'name',
            'slug',
            'price',
            'discount',
            'stock',
            'sale',
            'description',
            'brand_id',
            'tags',
            'view',
            'count',
            'weight',
            'sold',
            'rate',
            'is_deleted'
        ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_products', 'id_product', 'id_category')->withTimestamps();
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }



    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getDiscount(): float
    {
        return $this->discount;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function getSale(): int
    {
        return $this->sale;
    }

    public function getDescription(): string
    {
        return $this->description ?? '';
    }

    public function getBrandId(): int
    {
        return $this->brand_id;
    }

    public function getTags(): string
    {
        return $this->tags;
    }

    public function getView(): int
    {
        return $this->view;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }
    public function getSold(): int
    {
        return $this->sold;
    }
    public function getRate(): int
    {
        return $this->rate;
    }

}
