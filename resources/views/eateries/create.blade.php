@extends('layouts.app')

@section('title', 'Add Eatery | Kaon Ta! Davao')

@section('content')

<div class="mx-auto max-w-3xl">
    <h1 class="mb-2 text-3xl font-bold text-brand-brown">
        Add a New Eatery
    </h1>

    <p class="mb-6 text-gray-600">
        Share another Davao food spot with the community.
    </p>

    <form
        action="{{ route('eateries.store') }}"
        method="POST"
        class="space-y-5 rounded-xl bg-white p-6 shadow-sm"
    >
        @csrf

        @include('eateries._form')
    </form>
</div>

@endsection
