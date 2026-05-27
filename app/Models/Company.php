<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'logo',
        'color',
    ];

    // Une company a plusieurs collectes
    public function collectes()
    {
        return $this->hasMany(Collection::class);
    }
}
