@extends('layouts.app')

@section('title', 'Edit Eatery | Kaon Ta! Davao – Dimatulac's Food Guide')

@section('content')

<div class="mx-auto max-w-3xl">
    <h1 class="mb-2 text-3xl font-bold text-brand-brown">
        Edit {{ $eatery->name }}
    </h1>

    <p class="mb-6 text-gray-600">
        Update the eatery's information and permit.
    </p>

    <form
        action="{{ route('eateries.update', $eatery) }}"
        method="POST"
        class="space-y-5 rounded-xl bg-white p-6 shadow-sm"
    >
        @csrf
        @method('PUT')

        @include('eateries._form')
    </form>
</div>

@endsection
