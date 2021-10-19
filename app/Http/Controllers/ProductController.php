<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\MassAssignmentException;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;

class ProductController extends Controller
{

    public function index() {
        $products = Product::with('company')->get();
        return view('pages.home', compact('products'));
    }

    public function create() {
        $companies = Company::all();
        return view('pages.product.create', compact('companies'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->hasRole('admin')) {
            return redirect('/')
                ->with('error', 'You do not have permission to create a product!');
        }
        try {
            $product = new Product();
            $product->name = $request->input('name');
            $product->type = $request->input('type');
            $product->company_id = $request->input('company');
            $product->save();
        } catch (\Throwable $th) {
            return redirect('/')->with('error', $th->getMessage());
        }

        return redirect('/')->with('success', 'Product created!');
    }
}
