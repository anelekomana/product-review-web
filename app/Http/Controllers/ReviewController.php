<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\MassAssignmentException;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;
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
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }

        return back()->with('success', 'Review added!');
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

    public function delete($id) {
        try {
            $review = Review::find($id);
            $user = auth()->user();

            if ($user->hasRole('admin') || $review->user_id == $user->id) {
                $review->delete();
            } else {
                return back()->with('error', 'You do not have permission to delete this review!');
            }
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }

        return back()->with('success', 'Review delete!');
    }
}
