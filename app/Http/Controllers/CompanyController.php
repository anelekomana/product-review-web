<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Product;

class CompanyController extends Controller
{
    public function index() {
        $companies = Company::all();
        return view('pages.company.index', compact('companies'));
    }

    public function show($id) {
        $company = Company::find($id);
        $products = Product::where('company_id', $id)->get();
        $data = array(
            'company' => $company ,
            'products' => $products
        );
        return view('pages.company.view')->with($data);
    }

    public function create() {
        return view('pages.company.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->hasRole('admin')) {
            return back()
                ->with('error', 'You do not have permission to create a company!');
        }
        try {
            $company = new Company();
            $company->name = $request->input('name');
            $company->save();
        } catch (\Throwable $th) {
            return redirect('/companies')->with('error', $th->getMessage());
        }

        return redirect('/companies')->with('success', 'Company created!');
    }
}
