<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

// Modèle Utilisateur
class User extends Authenticatable
{
    protected $fillable = [
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
}
