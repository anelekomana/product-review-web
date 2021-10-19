<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\MassAssignmentException;
use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{

    public function index() {
        $products = Product::all();
        return view('pages.home', compact('products'));
    }

    public function create() {
        return view('pages.product.create');
    }

    public function store(Request $request)
    {
        try {
            if (!auth()->user()->hasRole('admin')) {
                return redirect('/home')
                    ->with('error', 'You do not have permission to create a product!');
            }
            $product = new Product();
            $product->name = $request->input('name');
            $product->type =  $request->input('type');
            $product->save();
            return redirect('/home')->with('success', 'Product created!');
        } catch (\Throwable $th) {
            return redirect('/home')->with('error', $th->getMessage());
        }
    }
}
