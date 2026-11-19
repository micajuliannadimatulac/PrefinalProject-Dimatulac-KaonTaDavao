@extends('layouts.app')

@section('title', 'Davao Districts | Kaon Ta! Davao')

@section('content')

<div class="mb-8">
    <h1 class="text-3xl font-bold text-brand-brown">
        Davao Districts
    </h1>

    <p class="mt-2 text-gray-600">
        Explore carinderias and eateries across Davao City.
    </p>
</div>

{{-- Display all districts --}}
<div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">

    @forelse($districts as $district)

        <a
            href="{{ route('districts.show', $district) }}"
            class="rounded-xl bg-white p-6 shadow-sm transition hover:bg-brand-sage"
        >

            <h2 class="text-xl font-bold text-brand-brown">
                {{ $district->name }}
            </h2>

            <p class="mt-2 text-gray-600">
                {{ $district->eateries_count }}
                {{ $district->eateries_count == 1 ? 'eatery' : 'eateries' }}
            </p>

            <p class="mt-4 text-sm font-semibold text-brand-brown">
                View Eateries
            </p>

        </a>

    @empty

        <p class="col-span-full rounded-xl bg-white p-6 text-center text-gray-600">
            No districts available.
        </p>

    @endforelse

</div>

@endsection
