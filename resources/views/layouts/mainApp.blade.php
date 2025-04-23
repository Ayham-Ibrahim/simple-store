{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> {{-- Use Laravel's locale --}}
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Use asset() helper for CSS files in public directory --}}
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    {{-- Dynamic page title - Default title if not provided --}}
    <title>@yield('title', 'Azadi Market')</title>

    {{-- Add other meta tags or head elements if needed --}}
    @stack('styles') {{-- Placeholder for page-specific CSS --}}
</head>
<body>

    {{-- Include Header Partial --}}
    @include('partials.header')

    {{-- Main Content Area --}}
    <div class="container">
        @yield('content') {{-- This is where page-specific content will be injected --}}
    </div>

    {{-- Include Footer Partial --}}
    @include('partials.footer')

    {{-- Load main JavaScript file --}}
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- Placeholder for page-specific JavaScript --}}
    @stack('scripts')

</body>
</html>
