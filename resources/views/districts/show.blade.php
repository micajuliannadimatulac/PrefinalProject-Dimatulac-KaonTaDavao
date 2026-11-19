@extends('layouts.app')

@section('title', $district->name . ' | Kaon Ta! Davao')

@section('content')

<div class="space-y-6">

    {{-- Back to districts --}}
    <a href="{{ route('districts.index') }}"
       class="inline-block text-sm font-semibold text-brand-brown underline">
        Back to Districts
    </a>

    {{-- District heading --}}
    <div class="rounded-xl bg-white p-6 shadow-sm">

        <h1 class="text-3xl font-bold text-brand-brown">
            {{ $district->name }}
        </h1>

        <p class="mt-2 text-gray-600">
            Explore eateries located in {{ $district->name }}.
        </p>

        {{-- Review count from hasManyThrough --}}
        <p class="mt-4 font-semibold text-brand-brown">
            {{ $reviewCount }}
            {{ $reviewCount == 1 ? 'review' : 'reviews' }}
            in {{ $district->name }}
        </p>

    </div>

    {{-- District eateries --}}
    <section>

        <h2 class="mb-5 text-2xl font-bold text-brand-brown">
            Eateries in {{ $district->name }}
        </h2>

        @if($eateries->isEmpty())

            <div class="rounded-xl bg-white p-6 text-center text-gray-600">
                No eateries found in this district.
            </div>

        @else

            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">

                @foreach($eateries as $eatery)
                    <x-eatery-card :eatery="$eatery" />
                @endforeach

            </div>

        @endif

    </section>

</div>

@endsection
