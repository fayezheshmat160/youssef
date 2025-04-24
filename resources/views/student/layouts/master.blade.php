<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <title>@yield('title') - {{ env('APP_NAME') }}</title>
    @include('student.layouts.meta.meta')
    @include('student.layouts.styles.styles')
</head>

<body>



    <!-- Start Get Styles -->
    @include('student.layouts.menus.aside')
    @include('student.layouts.menus.navbar')
    <!-- End Get Styles -->



    <div class="container-fluid">


        <!-- Start Page Result Box Components -->
        @include('student.layouts.components.results')
        <!-- End Page Result Box Components -->



        <!-- Start Contact Yield In Container -->
        @yield('content')
        <!-- End Contact Yield In Container -->


    </div><!-- End Container -->




    <!-- Start Body Contact Yield In Container -->
    @yield('body')
    <!-- End Body Contact Yield In Container -->






    <!-- Start Get Scripts -->
    @include('student.layouts.scripts.scripts')
    <!-- End Get Scripts -->


</body>

</html>
