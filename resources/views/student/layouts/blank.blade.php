<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <title>@yield('title')</title>
    @include('dashboard.layouts.meta.meta')
    @include('dashboard.layouts.styles.blank-style')
    <!-- Auto Load Css File -->
    @yield('css')
</head>

<body>

    @include('student.layouts.components.results')


    @yield('content')


    @include('dashboard.layouts.scripts.blank-script')

    @yield('js')

</body>

</html>
