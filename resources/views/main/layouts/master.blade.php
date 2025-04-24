@php
    // // Setting Website Row
    $settings = fetchRow('settings');
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    @include('main.layouts.master.meta')
    <title>@yield('title')</title>
    @include('main.layouts.master.styles')

</head>

<body class="rtl">
    @include('main.layouts.master.navbar')


    @yield('content')

    @include('main.layouts.master.footer')

    @include('main.layouts.master.scripts')
</body>

</html>
