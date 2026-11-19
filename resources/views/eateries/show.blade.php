@extends('layouts.app')

@section('title', $eatery->name . ' | Kaon Ta! Davao')

@section('content')

<div class="space-y-8">

    {{-- Eatery information --}}
    <section class="rounded-xl bg-white p-6 shadow-sm">

        <div class="flex flex-wrap items-start justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-brand-brown">
                    {{ $eatery->name }}
                </h1>

                <p class="mt-2 text-gray-600">
                    {{ $eatery->address }}
                </p>

                <a
                    href="{{ route('districts.show', $eatery->district) }}"
                    class="mt-2 inline-block text-brand-brown underline"
                >
                    {{ $eatery->district->name }}
                </a>
            </div>

            @if (!$eatery->is_open)
                <span class="rounded-full bg-red-100 px-4 py-2 font-semibold text-red-700">
                    Closed
                </span>
            @endif
        </div>

        <div class="mt-5 space-y-2">
            <p>
                <strong>Price:</strong>
                {{ match ($eatery->price_range) {
                    'budget' => '₱',
                    'mid' => '₱₱',
                    'splurge' => '₱₱₱',
                    default => '₱',
                } }}
            </p>

            <p>
                <strong>Specialty:</strong>
                {{ $eatery->specialty ?? 'Not specified' }}
            </p>

            <x-rating
                :average="$eatery->reviews_avg_rating"
                :count="$eatery->reviews_count"
            />
        </div>

        <div class="mt-4 flex flex-wrap gap-2">
            @foreach ($eatery->features as $feature)
                <a
                    href="{{ route('eateries.index', ['feature' => $feature->name]) }}"
                    class="rounded-full bg-brand-sage px-3 py-1 text-sm text-brand-brown"
                >
                    {{ $feature->name }}
                </a>
            @endforeach
        </div>

        {{-- Public edit and delete controls --}}
        <div class="mt-6 flex flex-wrap gap-3">
            <a
                href="{{ route('eateries.edit', $eatery) }}"
                class="rounded-lg bg-brand-brown px-4 py-2 font-medium text-white"
            >
                Edit Eatery
            </a>

            <form
                action="{{ route('eateries.destroy', $eatery) }}"
                method="POST"
                onsubmit="return confirm('Delete this eatery?')"
            >
                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="rounded-lg bg-red-700 px-4 py-2 font-medium text-white"
                >
                    Delete Eatery
                </button>
            </form>
        </div>

    </section>

    {{-- Business permit --}}
    <section class="rounded-xl bg-white p-6 shadow-sm">
        <h2 class="mb-4 text-2xl font-bold text-brand-brown">
            Business Permit
        </h2>

        @if ($eatery->permit)
            <p>
                <strong>Permit Number:</strong>
                {{ $eatery->permit->permit_no }}
            </p>

            <p class="mt-2">
                <strong>Expires:</strong>
                {{ $eatery->permit->expires_on->format('F j, Y') }}
            </p>

            @if ($eatery->permit->expires_on->isPast())
                <p class="mt-3 font-bold text-red-600">
                    Permit expired
                </p>
            @endif
        @else
            <p class="text-gray-500">No permit recorded.</p>
        @endif
    </section>

    {{-- Menu --}}
    <section class="rounded-xl bg-white p-6 shadow-sm">
        <h2 class="mb-4 text-2xl font-bold text-brand-brown">
            Dishes
        </h2>

        <div class="space-y-3">
            @forelse ($eatery->dishes as $dish)
                <div class="flex items-center justify-between gap-4 border-b border-gray-100 pb-3">
                    <div>
                        <p class="font-semibold">
                            {{ $dish->name }}
                        </p>

                        @if ($dish->is_bestseller)
                            <span class="text-sm font-semibold text-brand-brown">
                                Bestseller
                            </span>
                        @endif
                    </div>

                    <span class="font-semibold">
                        ₱{{ number_format((float) $dish->price, 2) }}
                    </span>
                </div>
            @empty
                <p class="text-gray-500">No dishes listed.</p>
            @endforelse
        </div>
    </section>

    {{-- Reviews --}}
    <section class="rounded-xl bg-white p-6 shadow-sm">
        <h2 class="mb-4 text-2xl font-bold text-brand-brown">
            Reviews
        </h2>

        <div class="space-y-5">
            @forelse ($eatery->reviews as $review)
                <article class="border-b border-gray-100 pb-4">

                    <div class="flex flex-wrap items-start justify-between gap-3">
                        <div>
                            <a
                                href="{{ route('reviewers.show', $review->user) }}"
                                class="font-semibold text-brand-brown underline"
                            >
                                {{ $review->user->name }}
                            </a>

                            <p class="mt-1 text-brand-brown">
                                {{ $review->rating }} ★
                            </p>

                            <p class="mt-2">
                                {{ $review->body }}
                            </p>

                            <p class="mt-2 text-xs text-gray-500">
                                {{ $review->created_at->format('M j, Y') }}
                            </p>
                        </div>

                        <form
                            action="{{ route('reviews.destroy', $review) }}"
                            method="POST"
                            onsubmit="return confirm('Delete this review?')"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="rounded-lg border border-red-600 px-3 py-2 text-sm text-red-700"
                            >
                                Delete Review
                            </button>
                        </form>
                    </div>

                </article>
            @empty
                <p class="text-gray-500">
                    No reviews yet
                </p>
            @endforelse
        </div>
    </section>

    {{-- Only open eateries can receive reviews --}}
    <section class="rounded-xl bg-white p-6 shadow-sm">

        @if (!$eatery->is_open)

            <p class="font-semibold text-red-700">
                This eatery is closed. Reviews are paused.
            </p>

        @else

            <h2 class="mb-5 text-2xl font-bold text-brand-brown">
                Write a Review
            </h2>

            @if ($errors->any())
                <div class="mb-5 rounded-lg border border-red-300 bg-red-50 p-4 text-red-800"
                     role="alert">
                    <p class="font-semibold">Please fix these errors:</p>

                    <ul class="mt-2 list-inside list-disc text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form
                action="{{ route('eateries.reviews.store', $eatery) }}"
                method="POST"
                class="space-y-5"
            >
                @csrf

                <div>
                    <label for="user_id" class="block font-semibold">
                        Reviewer
                    </label>

                    <select
                        id="user_id"
                        name="user_id"
                        class="mt-1 w-full rounded-lg border border-gray-300 bg-white p-3"
                    >
                        <option value="">Choose a reviewer</option>

                        @foreach ($reviewers as $reviewer)
                            <option
                                value="{{ $reviewer->id }}"
                                @selected(old('user_id') == $reviewer->id)
                            >
                                {{ $reviewer->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('user_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="rating" class="block font-semibold">
                        Rating
                    </label>

                    <select
                        id="rating"
                        name="rating"
                        class="mt-1 w-full rounded-lg border border-gray-300 bg-white p-3"
                    >
                        <option value="">Choose a rating</option>

                        @foreach (range(1, 5) as $rating)
                            <option
                                value="{{ $rating }}"
                                @selected(old('rating') == $rating)
                            >
                                {{ $rating }} Star{{ $rating > 1 ? 's' : '' }}
                            </option>
                        @endforeach
                    </select>

                    @error('rating')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="body" class="block font-semibold">
                        Your Review
                    </label>

                    <textarea
                        id="body"
                        name="body"
                        rows="5"
                        class="mt-1 w-full rounded-lg border border-gray-300 bg-white p-3"
                    >{{ old('body') }}</textarea>

                    @error('body')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button
                    type="submit"
                    class="rounded-lg bg-brand-brown px-6 py-3 font-semibold text-white"
                >
                    Post Review
                </button>
            </form>

        @endif

    </section>

</div>

@endsection
