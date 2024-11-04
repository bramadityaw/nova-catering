<!DOCTYPE html>
<html lang="en">

@include('utama.partials.head')

<body>

@include('utama.partials.preloader')

@include('utama.partials.navbar')

@yield('main')

@include('utama.partials.footer')

@include('utama.partials.scripts')

</body>

</html>
