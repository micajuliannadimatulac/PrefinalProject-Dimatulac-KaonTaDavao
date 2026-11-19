<?php

namespace App\Http\Controllers;

use App\Models\User;

class ReviewerController extends Controller
{
    // Show all reviews written by one seeded user.
    public function show(User $user)
    {
        $reviews = $user->reviews()
            ->with('eatery')
            ->latest()
            ->get();

        $reviewCount = $user->reviews()->count();

        return view('reviewers.show', compact(
            'user',
            'reviews',
            'reviewCount'
        ));
    }
}
