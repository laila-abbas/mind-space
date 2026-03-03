<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Edition;
use App\Models\EditionReview;

class EditionReviewController extends Controller
{
    public function index(Request $request, Edition $edition) {
        $reviews = $edition->reviews()->with('user')->latest()->paginate(2);

        return view('books.partials.list', compact('reviews', 'edition'));
    }
    
    public function store(Request $request, Edition $edition) {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:2000',
        ]);

        $user = $request->user();

        $review = EditionReview::updateOrCreate(
            ['edition_id' => $edition->id, 'user_id' => $user->id],
            ['rating' => $request->rating, 'review' => $request->review]
        );

        return redirect()->back()
            ->with('success', 'Your review has been submitted.')
            ->with('last_edition', $edition->id); // to keep the edition tab open on rating submitting
    }
}
