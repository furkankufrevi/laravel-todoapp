<!doctype html>
<html lang="en">
@include('layouts.head')
<body>
<main>
    @include('layouts.header')
    @yield('content')
</main>
@include('layouts.scripts')
@yield('scripts')
</body>
</html>
