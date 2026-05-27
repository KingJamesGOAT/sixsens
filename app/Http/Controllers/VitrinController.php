<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VitrinController extends Controller
{
    public function index()
{
    // Données à passer à Vue.js
    $data = [
        // ce dont la vitrine a besoin
    ];

    return view('vitrin.home', ['initialData' => json_encode($data)]);
}
}
