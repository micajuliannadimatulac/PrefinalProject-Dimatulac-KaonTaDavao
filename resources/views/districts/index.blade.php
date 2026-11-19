@extends('layouts.app')

@section('title', 'Davao Districts | Kaon Ta! Davao')

@section('content')

<h1 class="mb-6 text-3xl font-bold text-brand-brown">
    Davao Districts
</h1>

<div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
    @foreach ($districts as $district)
        <a
            href="{{ route('districts.show', $district) }}"
            class="rounded-xl bg-white p-6 shadow-sm hover:bg-brand-sage"
        >
            <h2 class="text-xl font-bold text-brand-brown">
                {{ $district->name }}
            </h2>

            <p class="mt-2 text-gray-600">
                {{ $district->eateries_count }}
                {{ $district->eateries_count == 1 ? 'eatery' : 'eateries' }}
            </p>
        </a>
    @endforeach
</div>

@endsection
