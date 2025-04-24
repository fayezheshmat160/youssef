<aside id="aside">


    <!--
        |
        | Brand Logo ( Light + Dark ) Logo For The Themes
        |
    -->
    <a href="" class="aside-brand d-block ">
        @if (getAuth('admin', 'color') == 'dark')
            <img src="{{ asset('dashboard/images/aside/IMG1168.png') }}" alt="">
        @else
            <img src="{{ asset('dashboard/images/aside/IMG1168.png') }}" alt="">
        @endif
    </a>



    <ul class="side-menu">




        <!--
         |
         | Start System Tabs
         |
        -->
        <li class="side-item-category">النظام</li>

        {{-- <x-dashboard.aside :details="[
            'name' => trans('aside.Roles'),
            'icon' => '<i class=\'fa-solid fa-unlock\'></i>',
            'link' => 'roles',
        ]" /><!-- End roles --> --}}



        <x-dashboard.studentAside :details="[
            'name' => 'الإعدادات العامة',
            'icon' => '<i class=\'fa-solid fa-gear\'></i>',
            'link' => 'settings',
        ]" />
        <!-- End setting -->



        <li class="side-item mb-5">
            <form action="{{ route('userLogout') }}" method="Get">
                @csrf
                <button type="submit" class=" w-100 d-block">
                    <a class=" w-100 d-block">
                        <span class="side-icon"><i class="fa-solid fa-arrow-right-to-bracket"></i></span>
                        <span class="side-name-lable">{{ trans('aside.Logout') }}</span>
                    </a>
                </button>
            </form>
        </li><!-- End Logout -->

















    </ul><!-- End side-menu  -->

</aside><!-- End Aside Bar  -->

<div class="aside-overlay"></div>
<!-- This OverLay We Will Display in Mobile Screen -->
