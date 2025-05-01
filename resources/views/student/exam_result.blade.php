@extends('student.layouts.blank')

@section('title', 'نتيجة الامتحان')

@section('css')
    <style>
        .result-container {
            max-width: 600px;
            margin: 80px auto;
            padding: 30px;
            border-radius: 15px;
            background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            font-family: 'Cairo', sans-serif;
        }

        .result-container h2 {
            font-size: 28px;
            margin-bottom: 25px;
            color: #2c3e50;
        }

        .result-container p {
            font-size: 20px;
            margin-bottom: 10px;
            color: #34495e;
        }

        .result-container p strong {
            color: #2980b9;
        }

        .btn-primary {
            background-color: #3498db;
            border-color: #3498db;
            font-size: 18px;
            padding: 10px 25px;
            border-radius: 8px;
            transition: 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }
    </style>
@endsection

@section('content')
    <div class="result-container">
        <h2>🌟 نتيجتك في الامتحان</h2>

        <!-- عرض الدرجات اللفظية والكمي بالنسبة المئوية -->
        <p><strong>الدرجة اللفظية:</strong> {{ session('verbal_score') }}%</p>
        <p><strong>الدرجة الكمية:</strong> {{ session('quantitative_score') }}%</p>
        <p><strong>الدرجة الكلية:</strong> {{ session('total_score') }}%</p>

        <!-- عرض عدد الإجابات الصحيحة من 120 -->
        <p><strong>عدد الإجابات الصحيحة:</strong> {{ session('correct_count') }} / 120</p>

        <!-- عرض الرسالة -->
        <p>{{ session('message') }}</p>

        <button onclick='window.location.href = "{{ route('student.index') }}"' class="btn btn-primary mt-4">🔙 عودة إلى الصفحة الرئيسية</button>
    </div>
@endsection
