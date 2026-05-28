<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

// Modèle Entreprise
class Company extends Model
{
    protected $fillable = [
        'name',
        'logo',
        'color',
    ];

    // Une company a plusieurs collectes
    public function collections()
    {
        return $this->hasMany(Collection::class);
    }
}
