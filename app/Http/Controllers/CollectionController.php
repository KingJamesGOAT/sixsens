<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Company;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index()
    {
        $collection = Collection::with('company')->get();
        return view('collections.index', compact('collection'));
    }

    public function show(Collection $Collection)
    {
        return view('collections.show', compact('collection'));
    }

    public function store(Request $request)
    {
        Collection::create($request->all());
        return redirect()->route('collections.index');
    }

    public function update(Request $request, Collection $Collection)
    {
        $Collection->update($request->all());
        return redirect()->route('collections.show', $Collection);
    }

    public function destroy(Collection $Collection)
    {
        $Collection->delete();
        return redirect()->route('collections.index');
    }
}
