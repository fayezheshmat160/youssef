<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="url" content="{{ url('') }}">
<link rel="icon" href="{{ asset('assets/images/favicon.png') }}" sizes="16x16">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-----////////// Main Meta  ///////////------>
<meta name="title" content="@yield('title', 'Default Tilte')" />
<meta name="description" content="@yield('description', 'اكتشف الموقع الرسمي والحصري للدكتور عطية حسين أفندي، حيث يقدم لك معلومات قيّمة وموثوقة في مجالات متعددة، استنادًا إلى خبرته العميقة والتزامه بالجودة والاحترافية.')">

<meta name="keywords"
    content="كتب، مؤلفات، مقالات، أحداث هامة، خبرات، تحليلات، معلومات موثوقة، خبرة أكاديمية، أبحاث، تاريخ، تراث ثقافي، توجيهات، معرفة علمية">
<meta name="application-name" content="{{ env('APP_NAME') }}">
<!-----////////// OG Meta  ///////////------>
<meta property="og:title" content="@yield('title', 'Default Tilte')">
<meta property="og:site_name" content="{{ env('APP_NAME') }}">
<meta property="og:url" content="@yield('url', urldecode(Request::url()))">
<meta property="og:locale" content="ar_AR">
<meta property="og:locale:alternate" content="ar_AR">
<meta property="og:description" content="@yield('description', 'اكتشف الموقع الرسمي والحصري للدكتور عطية حسين أفندي، حيث يقدم لك معلومات قيّمة وموثوقة في مجالات متعددة، استنادًا إلى خبرته العميقة والتزامه بالجودة والاحترافية.')">
<meta property="og:type" content="@yield('type', 'website')">
<meta property="og:image" content="@yield('image', asset('assets/images/meta-image-defualt.jpg'))">
<meta property="og:image:alt" content="@yield('title', 'Default Tilte')" />
<!-----//////////| Twetter Meta Tags |///////////------>
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:data1" content="{{ env('APP_NAME') }}" />
<meta property="twitter:image" content="@yield('image', asset('assets/images/meta-image-defualt.jpg'))" />
@yield('meta')
