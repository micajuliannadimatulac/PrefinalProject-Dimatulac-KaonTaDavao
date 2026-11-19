@php
    // Reuse the same fields for creating and editing.
    $editing = isset($eatery);

    $inputClass = 'mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 focus:border-brand-brown focus:outline-none';

    $labelClass = 'block text-sm font-semibold text-brand-brown';

    $selectedFeatures = old(
        'features',
        $editing ? $eatery->features->pluck('id')->all() : []
    );

    $selectedFeatures = array_map('strval', $selectedFeatures);
@endphp

{{-- Show all validation errors at the top. --}}
@if ($errors->any())
    <div class="rounded-lg border border-red-300 bg-red-50 p-4 text-red-800"
         role="alert">
        <p class="font-semibold">Please fix these errors:</p>

        <ul class="mt-2 list-inside list-disc text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div>
    <label for="name" class="{{ $labelClass }}">
        Eatery Name
    </label>

    <input
        id="name"
        type="text"
        name="name"
        value="{{ old('name', $editing ? $eatery->name : '') }}"
        class="{{ $inputClass }}"
    >

    @error('name')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="district_id" class="{{ $labelClass }}">
        District
    </label>

    <select
        id="district_id"
        name="district_id"
        class="{{ $inputClass }}"
    >
        <option value="">Choose a district</option>

        @foreach ($districts as $district)
            <option
                value="{{ $district->id }}"
                @selected(
                    old('district_id', $editing ? $eatery->district_id : '')
                    == $district->id
                )
            >
                {{ $district->name }}
            </option>
        @endforeach
    </select>

    @error('district_id')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="address" class="{{ $labelClass }}">
        Address
    </label>

    <input
        id="address"
        type="text"
        name="address"
        value="{{ old('address', $editing ? $eatery->address : '') }}"
        class="{{ $inputClass }}"
    >

    @error('address')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="price_range" class="{{ $labelClass }}">
        Price Range
    </label>

    <select
        id="price_range"
        name="price_range"
        class="{{ $inputClass }}"
    >
        <option value="">Choose a price range</option>

        @foreach ([
            'budget' => 'Budget - ₱',
            'mid' => 'Mid - ₱₱',
            'splurge' => 'Splurge - ₱₱₱'
        ] as $value => $label)
            <option
                value="{{ $value }}"
                @selected(
                    old('price_range', $editing ? $eatery->price_range : '')
                    === $value
                )
            >
                {{ $label }}
            </option>
        @endforeach
    </select>

    @error('price_range')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="specialty" class="{{ $labelClass }}">
        Specialty (Optional)
    </label>

    <input
        id="specialty"
        type="text"
        name="specialty"
        value="{{ old('specialty', $editing ? $eatery->specialty : '') }}"
        class="{{ $inputClass }}"
    >

    @error('specialty')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div>
    <input type="hidden" name="is_open" value="0">

    <label class="flex items-center gap-2 text-sm font-medium">
        <input
            type="checkbox"
            name="is_open"
            value="1"
            @checked(old('is_open', $editing ? $eatery->is_open : true))
            class="h-4 w-4 accent-amber-800"
        >
        Eatery is open
    </label>

    @error('is_open')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<fieldset>
    <legend class="{{ $labelClass }}">
        Eatery Features
    </legend>

    <div class="mt-2 grid gap-3 sm:grid-cols-2">
        @foreach ($features as $feature)
            <label class="flex items-center gap-2 rounded-lg border border-gray-200 bg-white p-3">
                <input
                    type="checkbox"
                    name="features[]"
                    value="{{ $feature->id }}"
                    @checked(in_array((string) $feature->id, $selectedFeatures))
                    class="h-4 w-4 accent-amber-800"
                >
                {{ $feature->name }}
            </label>
        @endforeach
    </div>

    @error('features')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror

    @error('features.*')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</fieldset>

<div>
    <label for="permit_no" class="{{ $labelClass }}">
        Permit Number
    </label>

    <input
        id="permit_no"
        type="text"
        name="permit_no"
        placeholder="DVO-2026-0807"
        value="{{ old('permit_no', $editing ? $eatery->permit?->permit_no : '') }}"
        class="{{ $inputClass }}"
    >

    @error('permit_no')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="expires_on" class="{{ $labelClass }}">
        Permit Expiration Date
    </label>

    <input
        id="expires_on"
        type="date"
        name="expires_on"
        value="{{ old(
            'expires_on',
            $editing ? $eatery->permit?->expires_on?->format('Y-m-d') : ''
        ) }}"
        class="{{ $inputClass }}"
    >

    @error('expires_on')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div class="flex flex-wrap gap-3">
    <button
        type="submit"
        class="rounded-lg bg-brand-brown px-6 py-3 font-semibold text-white hover:opacity-90"
    >
        {{ $editing ? 'Update Eatery' : 'Add Eatery' }}
    </button>

    <a
        href="{{ route('eateries.index') }}"
        class="rounded-lg border border-brand-brown px-6 py-3 font-semibold text-brand-brown"
    >
        Cancel
    </a>
</div>
