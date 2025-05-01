<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>اختبارات القدرات</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .section-image {
            height: 300px;
            object-fit: cover;
            width: 100%;
            border-radius: 15px;
        }
        .card-section {
            background-color: #fff;
            padding: 15px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: start;
        }
        .category-box {
            background-color: #fff;
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            cursor: pointer;
            transition: 0.3s;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .category-box:hover {
            background-color: #e9ecef;
            transform: translateY(-5px);
        }
        .sub-options {
            display: none;
            margin-top: 30px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Logo" width="40" height="40">
        </a>

        <div class="ms-auto">
            <a class="nav-link fw-bold" href="#">حسابي</a>
        </div>
    </div>
</nav>

<!-- Sections -->
<div class="container py-5">

    <!-- أول قسمين -->
    <div class="row g-2 mb-5">
        <div class="col-md-6">
            <div class="card-section">
                <img src="https://cdn.pixabay.com/photo/2020/05/23/20/44/study-5215805_1280.jpg" class="section-image" alt="تدريب القدرات">
                <h4 class="mt-3">ابدأ رحلتك نحو التميز</h4>
                <p class="text-muted">اختبارات قدرات شاملة تغطي كل المهارات اللفظية والكمية لتحقيق أعلى الدرجات.</p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card-section">
                <img src="https://cdn.pixabay.com/photo/2017/08/06/00/02/student-2580954_1280.jpg" class="section-image" alt="تحصيلي">
                <h4 class="mt-3">استعد للاختبار التحصيلي</h4>
                <p class="text-muted">مراجعة شاملة للمواد العلمية والأدبية لاجتياز اختبار التحصيلي بثقة وإتقان.</p>
            </div>
        </div>
    </div>

    <!-- القدرات والتحصيلي -->
    <div class="row g-4">
        <div class="col-md-6">
            <div class="category-box" onclick="toggleOptions()">
                <h4 class="fw-bold mb-0">قدرات</h4>
            </div>
        </div>

        <div class="col-md-6">
            <div class="category-box">
                <h4 class="fw-bold mb-0">تحصيلي</h4>
            </div>
        </div>
    </div>

    <!-- اللفظي والكمي -->
    <div id="sub-options" class="sub-options">
        <div class="row g-4 mt-3">
            <div class="col-md-6">
                <div class="category-box">
                    <h4 class="fw-bold mb-0">لفظي</h4>
                </div>
            </div>

            <div class="col-md-6">
                <div class="category-box">
                    <h4 class="fw-bold mb-0">كمي</h4>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- JavaScript -->
<script>
function toggleOptions() {
    const options = document.getElementById('sub-options');
    if (options.style.display === 'none' || options.style.display === '') {
        options.style.display = 'block';
    } else {
        options.style.display = 'none';
    }
}
</script>

</body>
</html>
