<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', "Kaon Ta! Davao – Dimatulac's Food Guide")
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-brand-cream text-gray-800">

    @include('partials.nav')

    <main class="mx-auto max-w-6xl px-4 py-8">
        @include('partials.flash')

        @yield('content')
    </main>

    <footer class="mt-12 border-t border-amber-200 py-6 text-center text-sm text-brand-brown">
        Kaon Ta! Davao – Dimatulac's Food Guide
    </footer>

</body>
</html>
