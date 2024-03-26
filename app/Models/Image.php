<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{

    protected $table = 'images';
    protected $primaryKey = 'id';
    protected $fillable = [
        'path',
        'product_id',
    ];

    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function getPath(): string
    {
        return $this->path;
    }
    public function getProductId(): int
    {
        return $this->product_id;
    }
    public function getId(): int
    {
        return $this->id;
    }

}
