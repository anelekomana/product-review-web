<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\MassAssignmentException;
use Illuminate\Http\Request;
use App\Product;
use App\Review;
use App\User;

class ReviewController extends Controller
{

    public function store($id, Request $request)
    {
        try {
            $review = new Review();
            $review->rating = $request->input('rating');
            $review->review = $request->input('review');
            $review->product_id = intval($id);
            $review->user_id = auth()->user()->id;
            $review->save();
            return back()->with('success', 'Review added!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function show($id)
    {
        $product = Product::find($id);
        $data = array(
            'product' => $product,
            'reviews' => $product->reviews
        );
        return view('pages.product.reviews')->with($data);
    }
}
