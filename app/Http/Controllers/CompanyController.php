<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('companies.index', compact('companies'));
    }

    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    public function store(Request $request)
    {
        Company::create($request->all());
        return redirect()->route('companies.index');
    }

    public function update(Request $request, Company $company)
    {
        $company->update($request->all());
        return redirect()->route('companies.show', $company);
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index');
    }
}
