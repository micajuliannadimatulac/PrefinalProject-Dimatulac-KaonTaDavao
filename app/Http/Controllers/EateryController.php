<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEateryRequest;
use App\Http\Requests\UpdateEateryRequest;
use App\Models\District;
use App\Models\Eatery;
use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EateryController extends Controller
{
    // Display eateries with search, filters, and pagination.
    public function index(Request $request)
    {
        $query = Eatery::query()
            ->with(['district', 'features'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews');

        // Search by eatery name or specialty.
        if ($request->filled('q')) {
            $search = $request->query('q');

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('specialty', 'like', "%{$search}%");
            });
        }

        // Filter by district ID.
        if ($request->filled('district')) {
            $query->where(
                'district_id',
                $request->query('district')
            );
        }

        // Filter by feature name.
        if ($request->filled('feature')) {
            $feature = $request->query('feature');

            $query->whereHas('features', function ($q) use ($feature) {
                $q->where('name', $feature);
            });
        }

        // Sort alphabetically and display six per page.
        $eateries = $query
            ->orderBy('name')
            ->paginate(6)
            ->withQueryString();

        $districts = District::orderBy('name')->get();
        $features = Feature::orderBy('name')->get();

        return view('eateries.index', compact(
            'eateries',
            'districts',
            'features'
        ));
    }

    // Show the form for adding an eatery.
    public function create()
    {
        $districts = District::orderBy('name')->get();
        $features = Feature::orderBy('name')->get();

        return view('eateries.create', compact(
            'districts',
            'features'
        ));
    }

    // Save a new eatery using validated form data.
    
    public function store(StoreEateryRequest $request)
    {
        $data = $request->validated();

        // Save the eatery, permit, and features together.
        $eatery = DB::transaction(function () use ($data) {
            $eatery = Eatery::create([
                'district_id' => $data['district_id'],
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
                'address' => $data['address'],
                'price_range' => $data['price_range'],
                'specialty' => $data['specialty'] ?? null,
                'is_open' => $data['is_open'] ?? false,
            ]);

            $eatery->permit()->create([
                'permit_no' => $data['permit_no'],
                'expires_on' => $data['expires_on'],
            ]);

            $eatery->features()->sync($data['features']);

            return $eatery;
        });

        return redirect()
            ->route('eateries.show', $eatery)
            ->with('success', 'Eatery added.');
    }


    // Display one eatery and its related records.
    public function show(Eatery $eatery)
    {
        $eatery->load([
            'district',
            'permit',
            'dishes',
            'features',
            'reviews' => fn ($q) => $q
                ->with('user')
                ->latest(),
        ]);

        $eatery->loadAvg('reviews', 'rating');
        $eatery->loadCount('reviews');

        // Reviewer dropdown uses seeded users.
        $reviewers = \App\Models\User::orderBy('name')->get();

        return view('eateries.show', compact(
            'eatery',
            'reviewers'
        ));
    }

    // Show the form for editing an eatery.
    public function edit(Eatery $eatery)
    {
        $eatery->load(['permit', 'features']);

        $districts = District::orderBy('name')->get();
        $features = Feature::orderBy('name')->get();

        return view('eateries.edit', compact(
            'eatery',
            'districts',
            'features'
        ));
    }

    // Update an eatery using validated form data.
    public function update(
        UpdateEateryRequest $request,
        Eatery $eatery
    ) {
        $data = $request->validated();

        DB::transaction(function () use ($eatery, $data) {
            $eatery->update([
                'district_id' => $data['district_id'],
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
                'address' => $data['address'],
                'price_range' => $data['price_range'],
                'specialty' => $data['specialty'] ?? null,
                'is_open' => $data['is_open'] ?? false,
            ]);

            // Update or create the eatery permit.
            $eatery->permit()->updateOrCreate(
                ['eatery_id' => $eatery->id],
                [
                    'permit_no' => $data['permit_no'],
                    'expires_on' => $data['expires_on'],
                ]
            );

            // Replace the previous feature selections.
            $eatery->features()->sync($data['features']);
        });

        return redirect()
            ->route('eateries.show', $eatery)
            ->with('success', 'Eatery updated.');
    }

    // Delete an eatery and its related records.
    public function destroy(Eatery $eatery)
    {
        DB::transaction(function () use ($eatery) {
            // Remove many-to-many pivot records.
            $eatery->features()->detach();

            // Remove child records through relationships.
            $eatery->reviews()->delete();
            $eatery->dishes()->delete();
            $eatery->permit()->delete();

            // Finally remove the eatery.
            $eatery->delete();
        });

        return redirect()
            ->route('eateries.index')
            ->with('success', 'Eatery deleted.');
    }
}
