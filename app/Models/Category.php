<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'slug',
        'name',
        'parent_id'
    ];
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class,'category_products','id_category','id_product');
    }

    public function parentCategories(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getSlug(): string
    {
        return $this->slug;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getParentId(): int
    {
        return $this->parent_id;
    }
}
