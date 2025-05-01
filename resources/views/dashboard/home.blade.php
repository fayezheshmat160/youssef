@extends(pathPrefix() . 'layouts.master')
@section('title', 'لوحة التحكم')
@section('css')
    <link rel="stylesheet" href="{{ asset('dashboard/css/pages/home/home.css') }}">
@endsection
@section('content')





{{-- @foreach ($admins as $admin)
{{$admin->f_name}}
@endforeach --}}

    <section id="welcome" class="my-3">
        
        <h6 class="mb-0">Welcome, {{ $admin->f_name }}!</h6>
        <span class="font-14">Here's what's happening on your site today.</span>
    </section><!-- Welcome Message -->



    <section id="analytics-brief" class="">
        <div class="row">

            <div class="col-md-6">
                <div class="box text-center">
                    <h3 class=" text-uppercase text-secondary  mb-0">جميع الاسئله</h3>
                    <h4 class=" font-22 my-3">{{$questionsCount}}</h4>
                    <a href="/cpanel/questions/getAllQuestions" class=" font-14 text-decoration-underline text-main">رؤيه التفاصيل</a>
                    <div class="icon bg-soft-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                            <path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm0 18a8 8 0 1 1 8-8 8 8 0 0 1-8 8z"></path>
                            <path
                                d="M12 11c-2 0-2-.63-2-1s.7-1 2-1 1.39.64 1.4 1h2A3 3 0 0 0 13 7.12V6h-2v1.09C9 7.42 8 8.71 8 10c0 1.12.52 3 4 3 2 0 2 .68 2 1s-.62 1-2 1c-1.84 0-2-.86-2-1H8c0 .92.66 2.55 3 2.92V18h2v-1.08c2-.34 3-1.63 3-2.92 0-1.12-.52-3-4-3z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div><!-- 4 -->

            <div class="col-md-6 text-center">
                <div class="box text-center">
                    <h3 class=" text-uppercase text-secondary mb-0">جميع الانواع</h3>
                    <h4 class=" font-22 my-3">{{$subjectsCount}}</h4>
                    <a href="/cpanel/subjects/index" class=" font-14 text-decoration-underline text-main">رؤيه التفاصيل </a>
                    <div class="icon bg-soft-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="transform: ;msFilter:;">
                            <path
                                d="M12 2a5 5 0 1 0 5 5 5 5 0 0 0-5-5zm0 8a3 3 0 1 1 3-3 3 3 0 0 1-3 3zm9 11v-1a7 7 0 0 0-7-7h-4a7 7 0 0 0-7 7v1h2v-1a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v1z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div><!-- 1 -->

            <div class="col-md-3">
                <div class="box">
                    <h6 class=" text-uppercase text-secondary font-12 mb-0">Orders</h6>
                    <h4 class=" font-22 my-3">83.20M</h4>
                    <a href="" class=" font-14 text-decoration-underline text-main">View all orders</a>
                    <div class="icon bg-soft-info">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                            <path
                                d="M21.822 7.431A1 1 0 0 0 21 7H7.333L6.179 4.23A1.994 1.994 0 0 0 4.333 3H2v2h2.333l4.744 11.385A1 1 0 0 0 10 17h8c.417 0 .79-.259.937-.648l3-8a1 1 0 0 0-.115-.921zM17.307 15h-6.64l-2.5-6h11.39l-2.25 6z">
                            </path>
                            <circle cx="10.5" cy="19.5" r="1.5"></circle>
                            <circle cx="17.5" cy="19.5" r="1.5"></circle>
                        </svg>
                    </div>
                </div>
            </div><!-- 2 -->

            <div class="col-md-3">
                <div class="box">
                    <h6 class=" text-uppercase text-secondary font-12 mb-0">MY BALANCE</h6>
                    <h4 class=" font-22 my-3">$180.28k</h4>
                    <a href="" class=" font-14 text-decoration-underline text-main">See details</a>
                    <div class="icon bg-soft-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                            <path d="M16 12h2v4h-2z"></path>
                            <path
                                d="M20 7V5c0-1.103-.897-2-2-2H5C3.346 3 2 4.346 2 6v12c0 2.201 1.794 3 3 3h15c1.103 0 2-.897 2-2V9c0-1.103-.897-2-2-2zM5 5h13v2H5a1.001 1.001 0 0 1 0-2zm15 14H5.012C4.55 18.988 4 18.805 4 18V8.815c.314.113.647.185 1 .185h15v10z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div><!-- 3 -->

        </div>
    </section><!-- Analytics Brief -->


@endsection
