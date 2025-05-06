<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>منصة اختبار القدرات</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4a3cc3;
            --secondary-color: #38d39f;
            --primary-light: rgba(74, 60, 195, 0.15);
            --dark-color: #1e272e;
            --light-color: #f9fbfc;
            --accent-color: #ff6b6b;
        }
        
        body {
            font-family: 'Tajawal', sans-serif;
            background-color: var(--light-color);
            color: var(--dark-color);
            line-height: 1.8;
        }
        
        /* Header */
        .navbar {
            background-color: white !important;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            padding: 10px 0;
        }
        
        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color) !important;
            font-size: 1.5rem;
            transition: color 0.3s ease;
        }
        
        .navbar-brand:hover {
            color: var(--secondary-color) !important;
        }
        
        .nav-link {
            font-weight: 500;
            padding: 8px 15px;
            color: var(--dark-color);
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            color: var(--primary-color);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 8px 20px;
            border-radius: 25px;
            font-size: 0.9rem;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            background-color: #3b2e9e;
        }
        
        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 8px 20px;
            border-radius: 25px;
            font-size: 0.9rem;
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-3px);
        }
        
        /* Hero Section */
        .hero-section {
            position: relative;
            position: relative;
            background: linear-gradient(rgb(84 17 17 / 75%), rgba(74, 60, 195, 0.75)), url(/dashboard/images/3.jpg) no-repeat center center;
            background-size: cover;
            background-attachment: fixed;
            color: white;
            padding: 120px 0;
            text-align: center;
            min-height: 50vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .hero-content {
            position: relative;
            z-index: 1;
        }
        
        .hero-title {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            text-shadow: 0 3px 8px rgba(0,0,0,0.4);
        }
        
        .hero-subtitle {
            font-size: 1.5rem;
            margin-bottom: 3rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            opacity: 0.95;
        }
        
        /* Features */
        .feature-card {
            background: white;
            border-radius: 15px;
            padding: 35px;
            text-align: center;
            transition: all 0.4s ease;
            box-shadow: 0 8px 20px rgba(0,0,0,0.06);
            height: 100%;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }
        
        .feature-card:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            opacity: 0;
            transition: opacity 0.4s ease;
        }
        
        .feature-card:hover:before {
            opacity: 1;
        }
        
        .feature-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.12);
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }
        
        .feature-card:hover .feature-icon,
        .feature-card:hover h4 {
            color: white !important;
        }
        
        .feature-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            transition: all 0.4s ease;
        }
        
        /* Test Types */
        .test-type-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0,0,0,0.06);
            transition: all 0.4s ease;
            margin-bottom: 30px;
        }
        
        .test-type-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.12);
        }
        
        .test-type-img {
            height: 220px;
            object-fit: cover;
            width: 100%;
            transition: transform 0.5s ease;
        }
        
        .test-type-card:hover .test-type-img {
            transform: scale(1.1);
        }
        
        .test-type-body {
            padding: 25px;
        }
        
        /* Steps */
        .step-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 8px 20px rgba(0,0,0,0.06);
            height: 100%;
            margin-bottom: 30px;
            transition: all 0.3s ease;
        }
        
        .step-card:hover {
            transform: translateY(-5px);
        }
        
        .step-number {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-weight: bold;
            font-size: 1.5rem;
        }
        
        /* Plans */
        .plan-card {
            background: white;
            border-radius: 15px;
            padding: 35px;
            text-align: center;
            box-shadow: 0 8px 20px rgba(0,0,0,0.06);
            transition: all 0.4s ease;
            margin-bottom: 30px;
            position: relative;
        }
        
        .plan-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.12);
        }
        
        .plan-name {
            font-size: 1.7rem;
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .plan-price {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--secondary-color);
            margin: 20px 0;
            position: relative;
        }
        
        .plan-price:after {
            content: '';
            position: absolute;
            width: 50px;
            height: 3px;
            background-color: var(--accent-color);
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
        }
        
        /* Contact */
        .contact-section {
            background: linear-gradient(135deg, var(--primary-light), var(--light-color));
            padding: 80px 0;
        }
        
        .contact-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .contact-card:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
        }
        
        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.12);
        }
        
        .contact-icon {
            color: var(--primary-color);
            font-size: 1.8rem;
            margin-left: 15px;
            transition: color 0.3s ease, transform 0.3s ease;
        }
        
        .contact-icon:hover {
            color: var(--secondary-color);
            transform: scale(1.2);
        }
        
        .form-control {
            border-radius: 12px;
            border: 1px solid rgba(0,0,0,0.1);
            padding: 15px;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 10px rgba(74, 60, 195, 0.3);
            background: white;
        }
        
        .form-label {
            font-weight: 500;
            color: var(--dark-color);
            margin-bottom: 8px;
        }
        
        .btn-submit {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            padding: 15px;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }
        
        /* Footer */
        footer {
            background: linear-gradient(135deg, var(--dark-color), #2f3640);
            color: white;
            padding: 25px 0;
            text-align: center;
            position: relative;
            font-size: 0.9rem;
        }
        
        footer p {
            opacity: 0.9;
            margin-bottom: 0;
        }
        
        .footer-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 15px;
        }
        
        .footer-links a {
            color: white;
            opacity: 0.8;
            transition: opacity 0.3s ease;
            text-decoration: none;
        }
        
        .footer-links a:hover {
            opacity: 1;
            text-decoration: underline;
        }
        
        /* Utilities */
        .section-title {
            position: relative;
            display: inline-block;
            margin-bottom: 60px;
            font-weight: 800;
            color: var(--dark-color);
            text-align: center;
            width: 100%;
            font-size: 2.5rem;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            width: 100px;
            height: 4px;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            bottom: -20px;
            left: 50%;
            transform: translateX(-50%);
        }
        
        .bg-primary-light {
            background-color: var(--primary-light);
        }
        
        .text-primary {
            color: var(--primary-color) !important;
        }
        
        .text-secondary {
            color: var(--secondary-color) !important;
        }
        
        .btn-secondary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            border-radius: 25px;
            padding: 10px 25px;
        }
        
        .btn-secondary:hover {
            background-color: #2cb189;
            transform: translateY(-3px);
        }
    </style>
</head>

<body>

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">💡 Mohi2</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#features">المميزات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#test-types">الاختبارات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#how-it-works">كيف تعمل</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#plans">الباقات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">تواصل معنا</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a class="btn btn-outline-primary me-2" href="{{ route('Showlogin') }}">تسجيل الدخول</a>
                    <a class="btn btn-primary" href="{{ route('ShowRegister') }}">ابدأ الآن</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container hero-content">
            <h1 class="hero-title animate__animated animate__fadeInDown">اكتشف قدراتك الآن!</h1>
            <p class="hero-subtitle animate__animated animate__fadeInDown animate__delay-1s">منصة متكاملة لاختبارات القدرات والتحصيلي</p>
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg animate__animated animate__fadeInUp animate__delay-2s">سجل مجاناً</a>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="py-5 bg-primary-light">
        <div class="container">
            <h2 class="section-title animate__animated animate__fadeIn">لماذا منصة "مهيأ"؟</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-card animate__animated animate__fadeInUp">
                        <i class="bi bi-patch-check feature-icon"></i>
                        <h4>أسئلة موثوقة</h4>
                        <p>أسئلة معدة من قبل خبراء في اختبارات القدرات</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card animate__animated animate__fadeInUp animate__delay-1s">
                        <i class="bi bi-speedometer2 feature-icon"></i>
                        <h4>نتائج فورية</h4>
                        <p>احصل على نتائجك فور انتهاء الاختبار مع تحليل مفصل</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card animate__animated animate__fadeInUp animate__delay-2s">
                        <i class="bi bi-graph-up feature-icon"></i>
                        <h4>تتبع التقدم</h4>
                        <p>راقب تطور مستواك عبر الزمن مع إحصائيات دقيقة</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Test Types -->
    <section id="test-types" class="py-5">
        <div class="container">
            <h2 class="section-title animate__animated animate__fadeIn">أقسام الاختبارات</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="test-type-card animate__animated animate__fadeInLeft">
                        <img src="/dashboard/images/3.jpg" alt="قدرات لفظي" class="test-type-img">
                        <div class="test-type-body">
                            <h4>قدرات لفظي</h4>
                            <p>اختبارات تقييم مهارات اللغة والفهم والاستيعاب</p>
                            <a href="#" class="btn btn-outline-primary">ابدأ الاختبار</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="test-type-card animate__animated animate__fadeInUp">
                        <img src="/dashboard/images/2.jpg" alt="قدرات كمي" class="test-type-img">
                        <div class="test-type-body">
                            <h4>قدرات كمي</h4>
                            <p>اختبر مهاراتك الرياضية والتحليلية بشكل احترافي</p>
                            <a href="#" class="btn btn-outline-primary">ابدأ الاختبار</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="test-type-card animate__animated animate__fadeInRight">
                        <img src="/dashboard/images/1.jpg" alt="تحصيلي علمي" class="test-type-img">
                        <div class="test-type-body">
                            <h4>تحصيلي علمي</h4>
                            <p>للاسئله التحصليه مراجعة مكثفة لجميع المواد العلمية المهمة</p>
                            <a href="#" class="btn btn-outline-primary">ابدأ الاختبار</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="py-5 bg-primary-light">
        <div class="container">
            <h2 class="section-title animate__animated animate__fadeIn">كيف تعمل المنصة؟</h2>
            <div class="row">
                <div class="col-md-3">
                    <div class="step-card">
                        <div class="step-number">1</div>
                        <h4>سجل حسابك</h4>
                        <p>قم بإنشاء حساب بسهولة كبداية لرحلتك</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="step-card">
                        <div class="step-number">2</div>
                        <h4>اختر اختبار</h4>
                        <p>ادخل إلى الامتحان المخصص لك من بين الاختبارات المتاحة</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="step-card">
                        <div class="step-number">3</div>
                        <h4>ابدأ وركز</h4>
                        <p>أجب على الأسئلة بدقة وداخل الوقت المحدد</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="step-card">
                        <div class="step-number">4</div>
                        <h4>راقب تقدمك</h4>
                        <p>احصل على نتائجك فوراً وتابع تطورك</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Plans -->
    <section id="plans" class="py-5">
        <div class="container">
            <h2 class="section-title animate__animated animate__fadeIn">باقاتنا المتوفرة</h2>
            <div class="row">
                @forelse($plans as $plan)
                <div class="col-md-4">
                    <div class="plan-card animate__animated animate__fadeInUp">
                        <h3 class="plan-name">{{ $plan->name }}</h3>
                        <div class="plan-price">{{ number_format($plan->price, 2) }} جنيه</div>
                        <p>{{ $plan->description }}</p>
                        <ul class="list-unstyled text-start">
                            @foreach($plan->features as $feature)
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-secondary"></i> {{ $feature }}</li>
                            @endforeach
                        </ul>
                        <a href="#" class="btn btn-primary mt-3">اشترك الآن</a>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p>لا توجد باقات متاحة حالياً</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Contact -->
    <section id="contact" class="contact-section">
        <div class="container">
            <h2 class="section-title animate__animated animate__fadeIn">تواصل معنا</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="contact-card h-100 animate__animated animate__fadeInLeft">
                        <h4 class="mb-4 text-primary">معلومات التواصل</h4>
                        <div class="d-flex align-items-center mb-4">
                            <i class="bi bi-geo-alt-fill contact-icon"></i>
                            <span>مصر - أسيوط، شارع الجامعة</span>
                        </div>
                        <div class="d-flex align-items-center mb-4">
                            <i class="bi bi-envelope-fill contact-icon"></i>
                            <span>support@mohi2.com</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-telephone-fill contact-icon"></i>
                            <span>+20 101 234 5678</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contact-card h-100 animate__animated animate__fadeInRight">
                        <h4 class="mb-4 text-primary">أرسل رسالة</h4>
                        @if (session('success'))
                            <div class="alert alert-success animate__animated animate__fadeIn">{{ session('success') }}</div>
                        @endif
                        <form method="POST" action="{{ route('store') }}">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="form-label">الاسم</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="أدخل اسمك" required>
                            </div>
                            <div class="mb-4">
                                <label for="email" class="form-label">البريد الإلكتروني</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="أدخل بريدك الإلكتروني" required>
                            </div>
                            <div class="mb-4">
                                <label for="subject" class="form-label">الموضوع</label>
                                <input type="text" class="form-control" id="subject" name="subject" placeholder="أدخل موضوع الرسالة" required>
                            </div>
                            <div class="mb-4">
                                <label for="message" class="form-label">الرسالة</label>
                                <textarea class="form-control" id="message" name="message" rows="5" placeholder="اكتب رسالتك هنا" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-submit w-100">إرسال الرسالة</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p class="mb-0">جميع الحقوق محفوظة © {{ date('Y') }} - منصة مهيأ</p>
            <div class="footer-links">
                <a href="#">الشروط والأحكام</a>
                <a href="#">سياسة الخصوصية</a>
                <a href="#contact">الدعم الفني</a>
                <a href="#">الأسئلة الشائعة</a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Enhanced Animation on Scroll
        document.addEventListener('DOMContentLoaded', function() {
            const animateElements = document.querySelectorAll('.animate__animated');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate__animated', entry.target.dataset.animate || 'animate__fadeIn');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.2,
                rootMargin: '0px 0px -50px 0px'
            });
            
            animateElements.forEach(element => {
                observer.observe(element);
            });
            
            // Smooth scrolling for navigation links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        targetElement.scrollIntoView({
                            behavior: 'smooth'
                        });
                        
                        // Update URL without page reload
                        history.pushState(null, null, targetId);
                    }
                });
            });
        });
    </script>
</body>
</html>