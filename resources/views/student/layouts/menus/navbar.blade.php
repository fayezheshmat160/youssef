@php

    $messages = DB::table('mailbox')
        ->limit(5)
        ->orderByDesc('id')
        ->get(['id', 'name', 'subject', 'created_at', 'read'])
        ->toArray();

    // Get Total UnRead
    $messagesUnRead = DB::table('mailbox')->where('read', '0')->count('id');

@endphp
<nav id="navbar" class="navbar-fixed navbar-main-width">

    <section id="start-of-navbar" class=" d-inline-block">
        <div id="btn-aside-toggle"><i class="fas fa-bars"></i></div>
    </section><!-- start of navbar -->

    <section id="end-of-navbar" class="d-inline-block">


        <div id="messages" class=" d-inline-block">

            <div class="dropdown-box dropdown open">

                <button class="btn-toggle dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <span class="icon">
                        <i class="fa-regular fa-envelope"></i>
                    </span>
                    <span
                        class="count @if ($messagesUnRead == 0) {{ 'display-none' }} @endif">{{ $messagesUnRead }}</span>
                </button><!-- Button -->

                <div class="data dropdown-menu scroll" aria-labelledby="triggerId">
                    <ul class="ul-items">

                        @foreach ($messages as $msg)
                            <li class="li-item">
                                <a href="{{ adminUrl('mail/read/' . $msg->id) }}">
                                    <h6
                                        class="name @if ($msg->read == '1') {{ 'text-main' }} @endif mb-0 font-weight-600">
                                        {{ $msg->name }}

                                        @if ($msg->read == '0')
                                            <span style="font-size: 8px"
                                                class="  text-white bg-primary px-2 py-1 radius float-left ">
                                                غير مقروء</span>
                                        @endif
                                    </h6>
                                    <span class="title">{{ Str::limit($msg->subject, 85) }}</span>

                                </a>
                                <br>
                                <span class="time">
                                    <i class="fa-regular fa-clock"></i>
                                    <span class="mx-1">{{ parseTime($msg->created_at) }}</span>
                                </span>
                            </li>
                        @endforeach

                    </ul>
                    <a class="read-more text-center d-block" href="">عرض المزيد</a>

                </div><!-- data -->

            </div>


        </div><!-- notifications -->

    </section><!-- end of navbar -->

</nav><!-- NavBar -->
