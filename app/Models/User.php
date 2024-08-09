<?php

namespace App\Models;

// Outros 'uses' necessários
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    // Defina os campos que podem ser atribuídos em massa
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

        /**
     * Retorna o identificador que será armazenado no token.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Retorna um array de valores personalizados a serem adicionados ao token.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
