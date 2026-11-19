<?php

namespace App\Http\Controllers;

use App\Models\District;

class DistrictController extends Controller
{
    // Display districts with their eatery counts.
    public function index()
    {
        $districts = District::query()
            ->withCount('eateries')
            ->orderBy('name')
            ->get();

        return view('districts.index', compact('districts'));
    }

    // Display eateries and review count for one district.
    public function show(District $district)
    {
        // Count reviews using hasManyThrough.
        $reviewCount = $district->reviews()->count();

        // Load eatery details for reusable cards.
        $eateries = $district->eateries()
            ->with(['district', 'features'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->orderBy('name')
            ->get();

        return view('districts.show', compact(
            'district',
            'eateries',
            'reviewCount'
        ));
    }
}
