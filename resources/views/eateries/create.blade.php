@extends('layouts.app')

@section('title', 'Add Eatery | Kaon Ta! Davao')

@section('content')

<div class="mx-auto max-w-3xl">

    {{-- Page heading --}}
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-brand-brown">
            Add a New Eatery
        </h1>

        <p class="mt-2 text-gray-600">
            Share another Davao food spot with the community.
        </p>
    </div>

    {{-- Create eatery form --}}
    <form
        action="{{ route('eateries.store') }}"
        method="POST"
        class="space-y-5 rounded-xl bg-white p-6 shadow-sm"
    >
        @csrf

        {{-- Shared form fields, validation errors, and buttons --}}
        @include('eateries._form')

    </form>

</div>

@endsection
