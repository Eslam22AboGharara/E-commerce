<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function show()
    {
        $reviews = Review::all();
        return view('reviews', ['rev' => $reviews]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'message' => 'required|string'
        ]);
        Review::create([
            'name' => $request->name,
            'review' => $request->message
        ]);
        return redirect()->route('reviews.show');
    }
}
