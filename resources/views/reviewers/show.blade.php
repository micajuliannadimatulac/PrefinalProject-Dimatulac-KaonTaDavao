@extends('layouts.app')

@section('title', $user->name . ' | Kaon Ta! Davao – Dimatulac's Food Guide')

@section('content')

<h1 class="text-3xl font-bold text-brand-brown">
    {{ $user->name }}
</h1>

<p class="mb-8 mt-2 text-gray-600">
    {{ $reviewCount }} reviews written
</p>

<div class="space-y-5">
    @forelse ($reviews as $review)
        <article class="rounded-xl bg-white p-6 shadow-sm">
            <a
                href="{{ route('eateries.show', $review->eatery) }}"
                class="text-xl font-bold text-brand-brown underline"
            >
                {{ $review->eatery->name }}
            </a>

            <p class="mt-2 font-semibold text-brand-brown">
                {{ $review->rating }} ★
            </p>

            <p class="mt-3">
                {{ $review->body }}
            </p>

            <p class="mt-3 text-xs text-gray-500">
                {{ $review->created_at->format('M j, Y') }}
            </p>
        </article>
    @empty
        <p class="rounded-xl bg-white p-6 text-gray-600">
            This reviewer has not written any reviews yet.
        </p>
    @endforelse
</div>

@endsection
