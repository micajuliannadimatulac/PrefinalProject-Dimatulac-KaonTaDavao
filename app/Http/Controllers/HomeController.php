<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Eatery;
use App\Models\Review;

class HomeController extends Controller
{
    public function __invoke()
    {
        // Count records for the homepage statistics.
        $eateryCount = Eatery::count();
        $districtCount = District::count();
        $reviewCount = Review::count();

        // Get the three highest-rated reviewed eateries.
        $topEateries = Eatery::query()
            ->with(['district', 'features'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->has('reviews')
            ->orderByDesc('reviews_avg_rating')
            ->limit(3)
            ->get();

        return view('home', compact(
            'eateryCount',
            'districtCount',
            'reviewCount',
            'topEateries'
        ));
    }
}
