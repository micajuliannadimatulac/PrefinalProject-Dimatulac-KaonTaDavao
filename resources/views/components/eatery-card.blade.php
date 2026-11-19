@props(['eatery'])

<article class="flex h-full flex-col rounded-xl border border-amber-100 bg-white p-5 shadow-sm">

    <div class="mb-3 flex items-start justify-between gap-3">
        <h2 class="text-xl font-bold text-brand-brown">
            <a
                href="{{ route('eateries.show', $eatery) }}"
                class="hover:underline"
            >
                {{ $eatery->name }}
            </a>
        </h2>

        @if (!$eatery->is_open)
            <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                Closed
            </span>
        @endif
    </div>

    <a
        href="{{ route('districts.show', $eatery->district) }}"
        class="mb-2 text-sm text-brand-brown underline"
    >
        {{ $eatery->district->name }}
    </a>

    <p class="mb-2 text-sm text-gray-600">
        {{ $eatery->address }}
    </p>

    <p class="mb-2 font-semibold text-brand-brown">
        {{ match ($eatery->price_range) {
            'budget' => '₱',
            'mid' => '₱₱',
            'splurge' => '₱₱₱',
            default => '₱',
        } }}
    </p>

    @if ($eatery->specialty)
        <p class="mb-3 text-sm">
            Specialty: {{ $eatery->specialty }}
        </p>
    @endif

    <div class="mb-4 flex flex-wrap gap-2">
        @foreach ($eatery->features as $feature)
            <a
                href="{{ route('eateries.index', ['feature' => $feature->name]) }}"
                class="rounded-full bg-brand-sage px-3 py-1 text-xs font-medium text-brand-brown"
            >
                {{ $feature->name }}
            </a>
        @endforeach
    </div>

    <div class="mt-auto border-t border-gray-100 pt-3">
        <x-rating
            :average="$eatery->reviews_avg_rating"
            :count="$eatery->reviews_count"
        />
    </div>

</article>
