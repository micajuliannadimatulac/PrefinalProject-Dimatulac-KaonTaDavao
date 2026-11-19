@extends('layouts.app')

@section('title', $district->name . ' | Kaon Ta! Davao')

@section('content')

<a
    href="{{ route('districts.index') }}"
    class="text-brand-brown underline"
>
    All Districts
</a>

<h1 class="mt-4 text-3xl font-bold text-brand-brown">
    {{ $district->name }}
</h1>

<p class="mb-8 mt-2 text-gray-600">
    {{ $reviewCount }} reviews in {{ $district->name }}
</p>

@if ($eateries->isEmpty())
    <p class="rounded-xl bg-white p-6 text-gray-600">
        No eateries listed in this district yet.
    </p>
@else
    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($eateries as $eatery)
            <x-eatery-card :eatery="$eatery" />
        @endforeach
    </div>
@endif

@endsection
