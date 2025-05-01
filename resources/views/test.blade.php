<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>منصة اختبارات - تقدر</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
  <style>
    :root {
      --primary-color: #6f42c1; /* بنفسجي */
      --secondary-color: #ffca2c; /* أصفر */
    }
    body {
      background-color: #f8f9fa;
    }
    .navbar {
      background-color: #fff;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    .hero-section {
      min-height: 450px;
      background-color: var(--primary-color);
      color: white;
      display: flex;
      align-items: center;
    }
    .feature-card {
      background-color: #fff;
      border-radius: 20px;
      padding: 20px;
      text-align: center;
      transition: 0.4s;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      height: 100%;
    }
    .feature-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 6px 20px rgba(0,0,0,0.2);
      background-color: var(--secondary-color);
    }
    .feature-image {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 15px;
    }
    .section-title {
      margin-bottom: 30px;
      font-weight: bold;
      color: var(--primary-color);
    }
    footer {
      background-color: var(--primary-color);
      color: white;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" width="50" alt="Logo">
    </a>
    <div class="ms-auto">
      <a class="nav-link fw-bold" href="#">حسابي</a>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<div class="container-fluid p-0">
  <div class="row align-items-center g-0 hero-section">
    <div class="col-md-6">
      <img src="https://dummyimage.com/650x450/000/fff.png alt="اختبارات القدرات" class="img-fluid w-100" style="height: 100%; object-fit: cover;">
    </div>
    <div class="col-md-6 text-center text-md-end p-5 animate__animated animate__fadeInRight">
      <h1 class="display-4 fw-bold mb-3 text-center">اكتشف قدراتك الآن!</h1>
      <p class="lead mb-4 text-center">ابدأ رحلتك في التميز مع اختبارات القدرات والتحصيلي المصممة خصيصاً لنجاحك.</p>
      <div class="text-center"><a href="#" class="btn btn-light btn-lg">ابدأ الآن</a></div>
    </div>
  </div>
</div>
<!-- Hero Section -->
<div class="container mt-4 text-center">
  <div class="hero">
    <h1 class="display-4 fw-bold">ابدأ اختبار قدراتك الآن!</h1>
  </div>
</div>
<!-- Features Section -->
<div class="container my-5">
  <h2 class="text-center section-title animate__animated animate__fadeInUp">أقسام الاختبارات</h2>
  <div class="row g-4">
    <div class="col-md-4 col-sm-6">
      <a href="#" class="text-decoration-none">
        <div class="feature-card animate__animated animate__zoomIn">
          <img src="https://dummyimage.com/100x50/000/fff.png" alt="قدرات لفظي" class="feature-image">
          <h4 class="mt-3">قدرات لفظي</h4>
          <p class="text-muted">اختبارات تقييم مهارات اللغة والفهم والاستيعاب.</p>
        </div>
      </a>
    </div>

    <div class="col-md-4 col-sm-6">
      <a href="#" class="text-decoration-none">
        <div class="feature-card animate__animated animate__zoomIn animate__delay-1s">
          <img src="https://dummyimage.com/100x50/000/fff.png" alt="قدرات كمي" class="feature-image">
          <h4 class="mt-3">قدرات كمي</h4>
          <p class="text-muted">اختبر مهاراتك الرياضية والتحليلية بشكل احترافي.</p>
        </div>
      </a>
    </div>

    <div class="col-md-4 col-sm-12">
      <a href="#" class="text-decoration-none">
        <div class="feature-card animate__animated animate__zoomIn animate__delay-2s">
          <img src="https://dummyimage.com/100x50/000/fff.png" alt="تحصيلي علمي" class="feature-image">
          <h4 class="mt-3">تحصيلي علمي</h4>
          <p class="text-muted">مراجعة مكثفة لجميع المواد العلمية المهمة.</p>
        </div>
      </a>
    </div>
  </div>
</div>

<!-- Footer -->
<footer class="text-center p-4">
  جميع الحقوق محفوظة © 2025
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
