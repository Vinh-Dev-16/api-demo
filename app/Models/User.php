<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function getName()
    {
        return $this->name ?? '';
    }

    public function getEmail()
    {
        return $this->email ?? '';
    }

    public function getPassword()
    {
        return $this->password ?? '';
    }

    public function getEmailVerifiedAt()
    {
        return $this->email_verified_at ?? '';
    }
    public function getId()
    {
        return $this->id ?? 0;
    }
    public function getRole()
    {
        return $this->role ?? collect([]);
    }
    public function getCreatedAt()
    {
        return $this->created_at ?? '';
    }
    public function getUpdatedAt()
    {
        return $this->updated_at ?? '';
    }
    public function getPermissions()
    {
        return $this->permissions ?? collect([]);
    }
}
