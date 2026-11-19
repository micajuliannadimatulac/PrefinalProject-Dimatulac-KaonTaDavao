@extends('layouts.app')

@section('title', "Kaon Ta! Davao – Dimatulac's Food Guide")

@section('content')

<section class="rounded-2xl bg-brand-sage px-6 py-12 text-center">
    <h1 class="text-4xl font-bold text-brand-brown">
        Kaon Ta! Davao
    </h1>

    <p class="mt-3 text-lg text-brand-brown">
        Dimatulac's Food Guide
    </p>

    <p class="mx-auto mt-4 max-w-xl text-gray-700">
        Discover local carinderias, delicious dishes,
        and favorite food spots across Davao City.
    </p>

    <a
        href="{{ route('eateries.index') }}"
        class="mt-6 inline-block rounded-lg bg-brand-brown px-6 py-3 font-semibold text-white"
    >
        Explore Eateries
    </a>
</section>

<section class="my-10 grid gap-4 sm:grid-cols-3">
    <div class="rounded-xl bg-white p-6 text-center shadow-sm">
        <p class="text-3xl font-bold text-brand-brown">
            {{ $eateryCount }}
        </p>
        <p class="text-gray-600">Eateries</p>
    </div>

    <div class="rounded-xl bg-white p-6 text-center shadow-sm">
        <p class="text-3xl font-bold text-brand-brown">
            {{ $districtCount }}
        </p>
        <p class="text-gray-600">Districts</p>
    </div>

    <div class="rounded-xl bg-white p-6 text-center shadow-sm">
        <p class="text-3xl font-bold text-brand-brown">
            {{ $reviewCount }}
        </p>
        <p class="text-gray-600">Reviews</p>
    </div>
</section>

<section>
    <h2 class="mb-5 text-2xl font-bold text-brand-brown">
        Top 3 Rated Eateries
    </h2>

    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($topEateries as $eatery)
            <x-eatery-card :eatery="$eatery" />
        @empty
            <p class="text-gray-600">
                No rated eateries yet.
            </p>
        @endforelse
    </div>
</section>

@endsection
