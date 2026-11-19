@extends('layouts.app')

@section('title', 'Explore Eateries | Kaon Ta! Davao')

@section('content')

<div class="mb-6 flex flex-wrap items-center justify-between gap-4">
    <div>
        <h1 class="text-3xl font-bold text-brand-brown">
            Explore Davao Eateries
        </h1>

        <p class="mt-2 text-gray-600">
            Find your next favorite carinderia.
        </p>
    </div>

    <a
        href="{{ route('eateries.create') }}"
        class="rounded-lg bg-brand-brown px-5 py-3 font-semibold text-white"
    >
        Add Eatery
    </a>
</div>

{{-- Filters use GET so they remain in the URL. --}}
<form
    action="{{ route('eateries.index') }}"
    method="GET"
    class="mb-8 grid gap-4 rounded-xl bg-white p-5 shadow-sm md:grid-cols-4"
>
    <div>
        <label for="q" class="block text-sm font-semibold">
            Search
        </label>

        <input
            id="q"
            type="search"
            name="q"
            value="{{ request('q') }}"
            placeholder="Name or specialty"
            class="mt-1 w-full rounded-lg border border-gray-300 p-2"
        >
    </div>

    <div>
        <label for="district" class="block text-sm font-semibold">
            District
        </label>

        <select
            id="district"
            name="district"
            class="mt-1 w-full rounded-lg border border-gray-300 p-2"
        >
            <option value="">All districts</option>

            @foreach ($districts as $district)
                <option
                    value="{{ $district->id }}"
                    @selected(request('district') == $district->id)
                >
                    {{ $district->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="feature" class="block text-sm font-semibold">
            Feature
        </label>

        <select
            id="feature"
            name="feature"
            class="mt-1 w-full rounded-lg border border-gray-300 p-2"
        >
            <option value="">All features</option>

            @foreach ($features as $feature)
                <option
                    value="{{ $feature->name }}"
                    @selected(request('feature') === $feature->name)
                >
                    {{ $feature->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="flex flex-wrap items-end gap-2">
        <button
            type="submit"
            class="rounded-lg bg-brand-brown px-4 py-2 font-semibold text-white"
        >
            Filter
        </button>

        <a
            href="{{ route('eateries.index') }}"
            class="rounded-lg border border-gray-300 px-4 py-2"
        >
            Reset
        </a>
    </div>
</form>

@if ($eateries->isEmpty())
    <p class="rounded-xl bg-white p-6 text-center text-gray-600">
        No eateries match your filters.
    </p>
@else
    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($eateries as $eatery)
            <x-eatery-card :eatery="$eatery" />
        @endforeach
    </div>

    <div class="mt-8">
        {{ $eateries->links() }}
    </div>
@endif

@endsection
