{{-- resources/views/home.blade.php --}}
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <title>منصة اختبار القدرات</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        body {
            background: #f0f4f8;
            direction: rtl;
            font-family: 'Cairo', sans-serif;
        }

        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1581093588401-12c6431fbf7b?auto=format&fit=crop&w=1600&q=80') no-repeat center center;
            background-size: cover;
            color: white;
            padding: 100px 0;
        }

        .feature-icon {
            font-size: 2.5rem;
            color: #0d6efd;
        }


        .contact-container {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .contact-info {
            background-color: #0d6efd;
            color: white;
            padding: 40px;
        }

        .contact-info h2 {
            font-weight: bold;
        }

        .contact-info p {
            opacity: 0.9;
        }

        .contact-form {
            padding: 40px;
        }

        .contact-form input,
        .contact-form textarea {
            border-radius: 12px;
        }

        .icon-box {
            background: rgba(255, 255, 255, 0.1);
            padding: 10px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .icon-box i {
            font-size: 1.4rem;
            margin-left: 10px;
        }

        .btn-send {
            border-radius: 12px;
            padding: 10px 25px;
        }
    </style>
</head>

<body class="text-end bg-light">

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">💡 قدراتك</a>
            <div>
                <a class="btn btn-outline-light me-2" href="{{ route('login') }}">تسجيل الدخول</a>
                <a class="btn btn-primary" href="{{ route('register') }}">ابدأ الآن</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero text-center text-white">
        <div class="container">
            <h1 class="display-4 fw-bold">اختبر قدراتك وكن جاهزاً لمستقبلك!</h1>
            <p class="lead mt-3">منصة متكاملة لاختبارات القدرات للطلاب مع واجهة سهلة وتجربة مميزة.</p>
            <a href="{{ route('register') }}" class="btn btn-lg btn-success mt-4">ابدأ الآن مجاناً</a>
        </div>
    </section>

    <!-- Features -->
    <section class="py-5 bg-white">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">لماذا منصة "قدراتك"؟</h2>
            <div class="row g-4 text-center">
                <div class="col-md-4">
                    <i class="bi bi-patch-check feature-icon"></i>
                    <h5 class="fw-bold mt-3">أسئلة موثوقة</h5>
                    <p>جميع الأسئلة يتم إنشاؤها من قبل مسؤولين متخصصين في إعداد اختبارات القدرات.</p>
                </div>
                <div class="col-md-4">
                    <i class="bi bi-speedometer2 feature-icon"></i>
                    <h5 class="fw-bold mt-3">نظام تقييم ذكي</h5>
                    <p>تحصل على نتائجك فوراً مع تحليل أدائك لتطوير مستواك.</p>
                </div>
                <div class="col-md-4">
                    <i class="bi bi-person-lines-fill feature-icon"></i>
                    <h5 class="fw-bold mt-3">واجهة مريحة للطالب</h5>
                    <p>تجربة مستخدم رائعة تساعدك على التركيز في الامتحان فقط.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Steps -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">كيف تعمل المنصة؟</h2>
            <div class="row text-center">
                <div class="col-md-3">
                    <div class="card p-3 shadow-sm">
                        <span class="fs-1 text-primary"><i class="bi bi-person-plus"></i></span>
                        <h5 class="mt-3 fw-bold">1. سجل حسابك</h5>
                        <p>قم بإنشاء حساب بسهولة كبداية لرحلتك.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3 shadow-sm">
                        <span class="fs-1 text-success"><i class="bi bi-journal-text"></i></span>
                        <h5 class="mt-3 fw-bold">2. اختر اختبار</h5>
                        <p>ادخل إلى الامتحان المخصص لك من بين الاختبارات المتاحة.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3 shadow-sm">
                        <span class="fs-1 text-warning"><i class="bi bi-alarm"></i></span>
                        <h5 class="mt-3 fw-bold">3. ابدأ وركز</h5>
                        <p>أجب على الأسئلة بدقة وداخل الوقت المحدد.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3 shadow-sm">
                        <span class="fs-1 text-danger"><i class="bi bi-bar-chart-line"></i></span>
                        <h5 class="mt-3 fw-bold">4. راقب تقدمك</h5>
                        <p>احصل على نتائجك فوراً وتابع تطورك.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section -->
    <section class="py-5 bg-white">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">من نحن؟</h2>
            <p class="lead mx-auto" style="max-width: 800px;">
                نحن فريق متخصص في إعداد وتقديم اختبارات القدرات للطلاب، نهدف إلى تبسيط تجربة التقييم من خلال منصة سهلة،
                دقيقة، وفعالة.
            </p>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center fw-bold mb-4">الأسئلة الشائعة</h2>
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faq1">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse1" aria-expanded="true">
                            هل يمكنني دخول أكثر من اختبار؟
                        </button>
                    </h2>
                    <div id="collapse1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            نعم، يمكنك دخول أي اختبار متاح لك حسب الجدول الزمني الذي يحدده المسؤول.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faq2">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse2">
                            هل الأسئلة تتغير في كل مرة؟
                        </button>
                    </h2>
                    <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            نعم، الأسئلة يتم تدويرها بشكل عشوائي لضمان التقييم العادل لكل طالب.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faq3">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse3">
                            كيف أحصل على نتيجتي بعد الامتحان؟
                        </button>
                    </h2>
                    <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            تظهر النتيجة مباشرة بعد انتهاء الاختبار، مع عرض تفاصيل أدائك في كل قسم.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- plans section --}}
    <div class="container py-5">
        <h2 class="text-center mb-5 fw-bold">💎 باقاتنا المتوفرة</h2>
    
        <div class="row g-4">
            @forelse($plans as $plan)
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4 p-3 plan-card animate__animated animate__fadeInUp" style="transition: transform 0.3s, box-shadow 0.3s;">
                        <div class="card-body d-flex flex-column justify-content-between text-center">
                            <div class="mb-4">
                                <h4 class="fw-bold">{{ $plan->name }}</h4>
                                <h5 class="text-primary">{{ number_format($plan->price, 2) }} جنيه</h5>
                            </div>
    
                            <p class="text-muted small">{{ $plan->description }}</p>
    
                            <ul class="list-unstyled my-3 text-start">
                                @foreach($plan->features as $feature)
                                    <li class="mb-2">
                                        <i class="bi bi-check2-circle text-success"></i> {{ $feature }}
                                    </li>
                                @endforeach
                            </ul>
    
                            <div class="d-grid">
                                <a href="#" class="btn btn-outline-primary rounded-pill">اشترك الآن</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">لا توجد باقات متاحة حالياً.</p>
                </div>
            @endforelse
        </div>
    </div>
    
    <style>
        /* Animation when hovering over the plan */
        .plan-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 0 20px rgba(0, 123, 255, 0.2);
        }
    </style>
    
    <!-- مكتبة Animation -->
   

    <!-- Contact Section -->
    <h2 class="fw-bold mb-2 text-center">أرسل لنا رسالة</h2>
    <div class="container py-5">
        <div class="contact-container row">
            <!-- Info Section -->
            <div class="col-md-5 contact-info d-flex flex-column justify-content-center">
                <h2 class="mb-4">هل تحتاج إلى المساعدة؟</h2>
                <p class="mb-4">نحن هنا لمساعدتك في أي وقت. فقط أرسل لنا رسالتك وسنقوم بالرد في أقرب فرصة.</p>

                <div class="icon-box">
                    <i class="bi bi-geo-alt-fill"></i>
                    <span>مصر - أسيوط، شارع الجامعة</span>
                </div>
                <div class="icon-box">
                    <i class="bi bi-envelope-fill"></i>
                    <span>support@mansatak.com</span>
                </div>
                <div class="icon-box">
                    <i class="bi bi-telephone-fill"></i>
                    <span>+20 101 234 5678</span>
                </div>
            </div>

          <!-- Form Section -->
<div class="col-md-7 contact-form">

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('store') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">الاسم</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="اكتب اسمك هنا" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">البريد الإلكتروني</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="email@example.com" required>
        </div>

        <div class="mb-3">
            <label for="subject" class="form-label">الموضوع</label>
            <input type="text" class="form-control" id="subject" name="subject" placeholder="موضوع الرسالة" required>
        </div>

        <div class="mb-3">
            <label for="message" class="form-label">الرسالة</label>
            <textarea class="form-control" id="message" name="message" rows="5" placeholder="اكتب رسالتك هنا..." required></textarea>
        </div>

        <button type="submit" class="btn btn-primary btn-send w-100">إرسال الرسالة</button>
    </form>

</div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4">
        <p class="mb-1">جميع الحقوق محفوظة &copy; {{ date('Y') }} - منصة قدراتك</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
