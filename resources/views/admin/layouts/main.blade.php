<!DOCTYPE html>
<html lang="en">
    @if (Request::is('admin/edit/naskot') || Request::is('admin/edit/prasmanan'))
        @include('admin.partials.headform')
    @else
        @include('admin.partials.head')
    @endif

    <body>
        @include('admin.partials.sidebar')
        @yield('main')
        @include('admin.partials.adminAccountServe')
    </body>
</html>