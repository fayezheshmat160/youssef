<!-- bootstrap -->
<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/bootstrap.min.css') }}" />
<!-- fontawesome -->
<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/all.min.css') }}" />

<!-- toastr -->
<link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}" />
<!--
    | Themes Color
    | Check If Choose Theme Exist In public\dashboard\themes\theme-name.css
    | Default If Not Exist Theme File => light
-->
@if (getAuth('admin', 'id') != null)
    @if (file_exists(public_path('assets/dashboard/themes/' . getAuth('admin', 'theme') . '.css')))
        <link rel="stylesheet"
            href="{{ asset('dashboard/css/themes/' . getAuth('admin', 'theme') . '.css') }}?v=<?php echo time(); ?>" />
    @else
        <link rel="stylesheet" href="{{ asset('dashboard/css/themes/'.getAuth('admin', 'theme').'.css') }}?v=<?php echo time(); ?>" />
    @endif
@else
    <link rel="stylesheet" href="{{ asset('dashboard/themes/light.css') }}?v=<?php echo time(); ?>" />
@endif

<!-- components -->
<link rel="stylesheet" href="{{ asset('dashboard/css/helpers.css') }}?v=<?php echo time(); ?>" />
<link rel="stylesheet" href="{{ asset('dashboard/css/components/components.css') }}?v=<?php echo time(); ?>" />


<!-- global & plugins -->
<link rel="stylesheet" href="{{ asset('dashboard/css/global/global.css') }}?v=<?php echo time(); ?>" /><!-- main -->
<link rel="stylesheet" href="{{ asset('dashboard/css/plugins/plugins.css') }}?v=<?php echo time(); ?>" /><!-- global -->




<!-- Auto Load Css File -->
@yield('css')
