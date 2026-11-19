@if (session('success'))
    <div class="mb-6 rounded-lg border border-green-300 bg-green-50 p-4 text-green-800"
         role="status">
        {{ session('success') }}
    </div>
@endif
