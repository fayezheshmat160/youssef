   <div class="col-lg-6 col-md-6">
       <article>
           <!--Post-1-->
           <div class="post-card">
               <div class="post-card-image">
                   <a href="{{ url('article/' . $row->slug) }}">
                       @if ($loop != null && $loop->index <= 3)
                           <img src="{{ articleImg($row->image) }}" alt="صورة المقال" title="{{ $row->title }}" />
                       @else
                           <img class="lazy" data-src="{{ articleImg($row->image) }}" alt="صورة المقال"
                               title="{{ $row->title }}" />
                       @endif
                   </a>
               </div>
               <div class="post-card-content">

                   @if ($row->getCategory == null)
                       <a class="categorie mb-0">تصنيف عام</a>
                   @else
                       <a class="categorie mb-0">{{ $row->getCategory->name }}</a>
                   @endif

                   <h5>
                       <a href="{{ url('article/' . $row->slug) }}">{{ Str::limit($row->title, 65) }}</a>
                   </h5>
                   <p>{{ Str::limit($row->meta_description, 85) }} </p>
                   <div class="post-card-info">
                       <ul class="list-inline">

                           <li>
                               @php
                                   $dateOfCreated = strtotime($row->created_at);
                                   $year = date('Y', $dateOfCreated);
                                   $month = date('F', $dateOfCreated);
                                   $day = date('j', $dateOfCreated);
                               @endphp
                               {{ $day . ' ' . convertMonthName($month) . ' ' . $year }}
                           </li>
                       </ul>
                   </div>

               </div>
           </div>
           <!--/-->
       </article>
   </div>
