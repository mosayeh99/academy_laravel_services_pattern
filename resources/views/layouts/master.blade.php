<!Doctype html>
<html lang="ar" dir="rtl" >
@include('layouts.head')
<body>
<div class="page">
    @include('layouts.header')
    <div class="page-wrapper">
        <!-- Page body -->
        @yield('content')
        <x-notify::notify />
        @include('layouts.footer')
    </div>
</div>

@include('layouts.scripts')
</body>
</html>
