    <!--newslettre-->
    <section class="newslettre">
        <div class="container-fluid">
            <div class="newslettre-width text-center">
                <div class="newslettre-info b">
                    <h5>اشترك في نشرتنا الإخبارية</h5>
                    <p> قم بالتسجيل مجانًا وكن أول من يتم إعلامك بالمنشورات الجديدة. </p>
                </div>
                <form method="POST" action="{{ route('subscribe') }}" class="newslettre-form form">
                    @csrf
                    <div class="form-flex">

                        <div class="form-group">
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="بريدك الالكتروني" required="required">
                        </div>

                        <button class="submit-btn" type="submit">اشترك</button>
                    </div>
                </form>
                <div class="social-icones">
                    <ul class="list-inline">

                        @foreach (mainViewSocialMedia() as $key => $val)
                            @php
                                $valName = $val['name_en'];
                            @endphp
                            @if (!empty($settings->$valName))
                                <li>
                                    <a class="icon" href="{{ $settings->$valName }}"
                                        target="_blank">{!! $val['icon'] !!} <span
                                            class="mr-1">{{ $val['name_ar'] }}</span> </a>
                                </li>
                            @endif
                        @endforeach

                    </ul>
                </div>



            </div>
        </div>
    </section>


    <!--footer-->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright">

                        <div class="row">
                            <div class="col-md-6">
                                <p class=" text-center text-md-right">
                                    جميع حقوق الطبع والنشر محفوظة <a
                                        href="{{ url('') }}">{{ $settings->website_name }}</a> ©{{ date('Y') }}
                                </p>
                            </div>

                            <div class="col-md-6">
                                <p class=" text-center text-md-left">سنة صدور الموقع 2024</p>

                            </div>
                        </div>




                    </div>
                    <div class="back">
                        <a href="#" class="back-top">
                            <i class="arrow_up"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!--Search-->
    <div class="search">
        <div class="container-fluid">
            <div class="search-width text-center">
                <button type="button" class="close">
                    <i class="icon_close"></i>
                </button>
                <form class="search-form " action="{{ url('search') }}">
                    <input type="search" name="q" placeholder="ما الذي تبحث عنه؟">
                    <button type="submit" class="search-btn">بحت</button>
                </form>
            </div>
        </div>
    </div>
    <!--/-->
