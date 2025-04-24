   {{-- <!--loading -->
   <div class="loading">
       <div class="circle"></div>
   </div>
   <!--/--> --}}



   <!-- Navigation-->
   <nav class="navbar navbar-expand-lg fixed-top">
       <div class="container-fluid">
           <!--logo-->
           <div class="logo">
               <a href="{{ url('') }}">
                   <img src="{{ largeAsset('settings/' . $settings->logo_dark) }}" alt="" class="logo-dark">
                   <img src="{{ largeAsset('settings/' . $settings->logo_white) }}" alt="" class="logo-white">
                   <strong class="brand-name">{{ $settings->website_name }}</strong>
               </a>
           </div><!--/-->

           <!--navbar-collapse-->
           <div class="collapse navbar-collapse" id="main_nav">
               <ul class="navbar-nav ml-auto mr-auto">

                   <li class="nav-item">
                       <a class="nav-link" href="{{ url('') }}">الرئيسية</a>
                   </li><!--  -->


                   <li class="nav-item">
                       <a class="nav-link" href="{{ url('books') }}">مؤلفاتي</a>
                   </li><!--  -->




                   <li class="nav-item">
                       <a class="nav-link" href="{{ url('blog') }}">مقالاتي</a>
                   </li><!--  -->


                   <li class="nav-item">
                    <a class="nav-link" href="{{ url('messages') }}">الرسائل المشرف عليها</a>
                </li><!--  -->

                   <li class="nav-item">
                       <a class="nav-link" href="{{ url('contact') }}">تواصل معي</a>
                   </li><!--  -->



                   <li class="nav-item dropdown">
                       <a class="nav-link  dropdown-toggle" href="#" data-toggle="dropdown">صفحات <i
                               class="fa-solid fa-angle-down"></i></a>
                       <ul class="dropdown-menu fade-up">


                        <li>
                            <a class="dropdown-item" href="{{ url('about') }}">سيرتي الذاتية</a>
                        </li>
                           <li>
                               <a class="dropdown-item" href="{{ url('events') }}">أحداث هامة</a>
                           </li>

                           <li>
                               <a class="dropdown-item" href="{{ url('news') }}">أخبار & صحافة</a>
                           </li>
                           <li>
                               <a class="dropdown-item" href="{{ url('media') }}">ألبوم الصور</a>
                           </li>
                       </ul>
                   </li>




               </ul>
           </div><!--/-->

           <!--navbar-right-->
           <div class="navbar-right ml-auto">
               <div class="theme-switch-wrapper">
                   <label class="theme-switch" for="checkbox">
                       <input type="checkbox" id="checkbox" />
                       <div class="slider round"></div>
                   </label>
               </div>
               <div class="search-icon">
                   <i class="icon_search"></i>
               </div>

               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav"
                   aria-expanded="false" aria-label="Toggle navigation">
                   <span class="navbar-toggler-icon"></span>
               </button>
           </div>
       </div>
   </nav>
   <!--/-->
