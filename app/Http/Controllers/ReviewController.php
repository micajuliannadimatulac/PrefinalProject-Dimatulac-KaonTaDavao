<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Eatery;
use App\Models\Review;

class ReviewController extends Controller
{
    // Post a review for an open eatery.
    public function store(
        StoreReviewRequest $request,
        Eatery $eatery
    ) {
        // Validation and closed-eatery authorization
        // are handled by StoreReviewRequest.
        $data = $request->validated();

        // Create the review through the eatery relationship.
        $eatery->reviews()->create([
            'user_id' => $data['user_id'],
            'rating' => $data['rating'],
            'body' => $data['body'],
        ]);

        return redirect()
            ->route('eateries.show', $eatery)
            ->with('success', 'Salamat! Review posted.');
    }

    // Delete a review from an eatery.
    public function destroy(Review $review)
    {
        // Load the related eatery before deleting.
        $eatery = $review->eatery;

        $review->delete();

        return redirect()
            ->route('eateries.show', $eatery)
            ->with('success', 'Review deleted.');
    }
}
