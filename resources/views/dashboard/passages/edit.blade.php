@extends('dashboard.layouts.master')
@section('title', 'تعديل قطعة')
@section('css')
<style>
    :root {
        --primary-color: #6c5ce7;
        --secondary-color: #a29bfe;
        --accent-color: #fd79a8;
        --light-bg: #f8f9fa;
        --dark-text: #2d3436;
    }
    
    body {
        font-family: 'Tajawal', sans-serif;
        background-color: #f5f7fa;
    }
    
    .form-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        padding: 2rem;
    }
    
    .form-title {
        color: var(--primary-color);
        border-bottom: 2px solid rgba(108, 92, 231, 0.2);
        padding-bottom: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .form-label {
        font-weight: 600;
        color: var(--dark-text);
        margin-bottom: 0.5rem;
    }
    
    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(108, 92, 231, 0.25);
    }
    
    .btn-primary {
        background-color: var(--primary-color);
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        box-shadow: 0 4px 15px rgba(108, 92, 231, 0.3);
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        background-color: #5649d1;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(108, 92, 231, 0.4);
    }
    
    .question-box {
        background-color: white;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
    }
    
    .option-container {
        position: relative;
        margin-bottom: 1rem;
    }
    
    .option-label {
        position: absolute;
        right: 15px;
        top: -10px;
        background-color: var(--primary-color);
        color: white;
        padding: 2px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    
    .divider {
        border-top: 2px dashed #e0e0e0;
        margin: 1.5rem 0;
    }
    
    .error-alert {
        background-color: rgba(214, 48, 49, 0.1);
        border-left: 4px solid #d63031;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .error-list {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }
    
    .error-list li {
        padding: 0.25rem 0;
        color: #d63031;
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <div class="form-container">
        <h2 class="form-title">
            <i class="fas fa-edit me-2"></i>تعديل قطعة
        </h2>

        @if ($errors->any())
            <div class="error-alert">
                <ul class="error-list">
                    @foreach ($errors->all() as $error)
                        <li><i class="fas fa-exclamation-circle me-2"></i>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('passages.update', $passage->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-12 mb-4">
                    <label for="title" class="form-label">عنوان القطعة</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $passage->title) }}" class="form-control" required>
                </div>
                
                <div class="col-md-12 mb-4">
                    <label for="content" class="form-label">نص القطعة</label>
                    <textarea name="content" id="content" rows="5" class="form-control" required>{{ old('content', $passage->content) }}</textarea>
                </div>
                
                <div class="col-md-6 mb-4">
                    <label for="type" class="form-label">النوع</label>
                    <select name="type" id="type" class="form-select">
                        <option value="لفظي" {{ old('type', $passage->type) == 'لفظي' ? 'selected' : '' }}>لفظي</option>
                        <option value="كمي" {{ old('type', $passage->type) == 'كمي' ? 'selected' : '' }}>كمي</option>
                    </select>
                </div>
                
                <div class="col-md-6 mb-4">
                    <label for="subject_id" class="form-label">المادة</label>
                    <select name="subject_id" id="subject_id" class="form-select">
                        <option value="">-- اختر مادة --</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ old('subject_id', $passage->subject_id) == $subject->id ? 'selected' : '' }}>
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="divider"></div>

            <h3 class="form-title">
                <i class="fas fa-question-circle me-2"></i>الأسئلة المرتبطة بالقطعة
            </h3>

            <div id="questions-wrapper">
                @foreach ($passage->questions as $index => $question)
                    @php
                        $options = json_decode($question->options, true);
                    @endphp
                    <div class="question-box">
                        <h4 class="font-semibold mb-3">سؤال رقم {{ $index + 1 }}</h4>

                        <input type="hidden" name="questions[{{ $index }}][id]" value="{{ $question->id }}">

                        <div class="form-group mb-4">
                            <label class="form-label">نص السؤال</label>
                            <input type="text" name="questions[{{ $index }}][question]" value="{{ old('questions.'.$index.'.question', $question->question) }}" class="form-control" required>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <div class="option-container">
                                    <span class="option-label">أ</span>
                                    <input type="text" name="questions[{{ $index }}][options][A]" value="{{ old('questions.'.$index.'.options.A', $options['A'] ?? '') }}" class="form-control ps-5" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="option-container">
                                    <span class="option-label">ب</span>
                                    <input type="text" name="questions[{{ $index }}][options][B]" value="{{ old('questions.'.$index.'.options.B', $options['B'] ?? '') }}" class="form-control ps-5" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="option-container">
                                    <span class="option-label">ج</span>
                                    <input type="text" name="questions[{{ $index }}][options][C]" value="{{ old('questions.'.$index.'.options.C', $options['C'] ?? '') }}" class="form-control ps-5" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="option-container">
                                    <span class="option-label">د</span>
                                    <input type="text" name="questions[{{ $index }}][options][D]" value="{{ old('questions.'.$index.'.options.D', $options['D'] ?? '') }}" class="form-control ps-5" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label class="form-label">الإجابة الصحيحة</label>
                            <select name="questions[{{ $index }}][correct_answer]" class="form-select" required>
                                <option value="A" {{ old('questions.'.$index.'.correct_answer', $question->correct_answer) == 'A' ? 'selected' : '' }}>أ</option>
                                <option value="B" {{ old('questions.'.$index.'.correct_answer', $question->correct_answer) == 'B' ? 'selected' : '' }}>ب</option>
                                <option value="C" {{ old('questions.'.$index.'.correct_answer', $question->correct_answer) == 'C' ? 'selected' : '' }}>ج</option>
                                <option value="D" {{ old('questions.'.$index.'.correct_answer', $question->correct_answer) == 'D' ? 'selected' : '' }}>د</option>
                            </select>
                        </div>

                        <div class="form-group mb-4">
                            <label class="form-label">شرح الإجابة</label>
                            <textarea name="questions[{{ $index }}][explane_answer]" class="form-control">{{ old('questions.'.$index.'.explane_answer', $question->explane_answer) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">ملاحظات</label>
                            <input type="text" name="questions[{{ $index }}][notes]" value="{{ old('questions.'.$index.'.notes', $question->notes) }}" class="form-control">
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary px-5">
                    <i class="fas fa-save me-2"></i>تحديث القطعة
                </button>
            </div>
        </form>
    </div>
</div>
@endsection