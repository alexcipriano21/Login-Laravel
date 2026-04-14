<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios'; // Nombre de tu tabla en MySQL
    protected $fillable = ['usuario', 'correo', 'password_hash', 'rol_id'];
    public $timestamps = false; // Como usas procedimientos, desactivamos los timestamps automáticos de Laravel
}
