@props([
    'average' => null,
    'count' => 0,
])

@if ($count > 0 && $average !== null)
    <span class="font-medium text-brand-brown">
        {{ number_format((float) $average, 1) }} ★
        ({{ $count }} {{ $count == 1 ? 'review' : 'reviews' }})
    </span>
@else
    <span class="text-gray-500">
        No reviews yet
    </span>
@endif
