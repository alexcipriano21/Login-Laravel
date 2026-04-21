<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * Columnas alineadas exactamente con BD.sql
     */
    protected $fillable = [
        'nombre',
        'email',
        'password',
        'rol',
        'estado',
        'google_id',
        'reset_token',
        'reset_token_expires',
    ];

    /**
     * Atributos ocultos (por seguridad)
     */
    protected $hidden = [
        'password',
        'remember_token',
        'reset_token',
    ];

    /**
     * Conversión nativa de tipos de datos
     */
    protected function casts(): array
    {
        return [
            'reset_token_expires' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'nombre' => $this->nombre,
            'email' => $this->email,
            'rol' => $this->rol,
            'estado' => $this->estado
        ];
    }
}
