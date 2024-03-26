<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brands';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'slug',
        'logo',
        'description',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
//    public function vouchers()
//    {
//        return $this->belongsToMany(Voucher::class, 'brands_vouchers', 'brand_id', 'voucher_id')->withTimestamps();
//    }

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

    public function getLogo(): string
    {
        return $this->logo;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
