<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VerifyEmail extends Model
{
    use HasFactory;
    protected $table = 'verify_emails';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'email',
        'otp',
        'set_up_time',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function getOtp(): string
    {
        return $this->otp;
    }
    public function getSetUpTime(): int
    {
        return $this->set_up_time;
    }

}