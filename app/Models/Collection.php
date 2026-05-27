<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
        protected $fillable = [
        'id_company',
        'start',
        'end',
        'nb_employee',
        'nb_registered',
        'nb_blood_pouch',
        'onedoc_link',
    ];

    protected $casts = [
        'start' => 'datetime',
        'end'   => 'datetime',
    ];

    // Une collecte appartient à une company
    public function company()
    {
        return $this->belongsTo(Company::class, 'id_company');
    }
}
