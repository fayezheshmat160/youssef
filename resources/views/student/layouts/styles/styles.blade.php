<!-- bootstrap -->
<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/bootstrap.min.css') }}" />
<!-- fontawesome -->
<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/all.min.css') }}" />


<!-- toastr -->
<link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}" />
<!-- Nice Select -->
<link rel="stylesheet" href="{{ asset('dashboard/plugins/nice-select/nice-select.css') }}" />



<link rel="stylesheet" href="{{ asset('dashboard/css/themes/light.css') }}?v=<?php echo time(); ?>" />


<!-- Webiste DIR  -->
@if (app()->getLocale() == 'ar')
    <link rel="stylesheet" href="{{ asset('dashboard/css/directions/rtl/rtl.css') }}?v=<?php echo time(); ?>" />
    <!-- rtl -->
@else
    <link rel="stylesheet" href="{{ asset('dashboard/css/directions/ltr/ltr.css') }}?v=<?php echo time(); ?>" />
    <!-- ltr -->
@endif


<!-- components -->
<link rel="stylesheet" href="{{ asset('dashboard/css/helpers.css') }}?v=<?php echo time(); ?>" />
<link rel="stylesheet" href="{{ asset('dashboard/css/components/components.css') }}?v=<?php echo time(); ?>" />


<!-- aside & navbar https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css -->
<link rel="stylesheet" href="{{ asset('dashboard/css/layouts/aside.css') }}?v=<?php echo time(); ?>" />
<link rel="stylesheet" href="{{ asset('dashboard/css/layouts/navbar.css') }}?v=<?php echo time(); ?>" /><!-- navbar -->



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css"
    integrity="sha512-hvNR0F/e2J7zPPfLC9auFe3/SE0yG4aJCOd/qxew74NN7eyiSKjr7xJJMu1Jy2wf7FXITpWS1E/RY8yzuXN7VA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<link href="
https://cdn.jsdelivr.net/npm/phosphor-icons@1.4.2/src/css/icons.min.css
" rel="stylesheet">




<!-- global & plugins -->
<link rel="stylesheet" href="{{ asset('dashboard/css/global/global.css') }}?v=<?php echo time(); ?>" /><!-- main -->
<link rel="stylesheet" href="{{ asset('dashboard/css/override/override.css') }}?v=<?php echo time(); ?>" />
<!-- global -->


<!-- Auto Load Css File -->
@yield('css')
