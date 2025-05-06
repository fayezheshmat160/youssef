@extends('dashboard.layouts.master')
@section('title', 'Create Question')
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
        color: var(--dark-text);
    }
    
    .form-container {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        padding: 2rem;
    }
    
    .form-title {
        color: var(--primary-color);
        border-bottom: 2px solid rgba(108, 92, 231, 0.2);
        padding-bottom: 1rem;
        margin-bottom: 2rem;
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
    
    .btn-add {
        background-color: #00b894;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        box-shadow: 0 4px 15px rgba(0, 184, 148, 0.3);
        transition: all 0.3s ease;
        color: white;
        margin-bottom: 1.5rem;
    }
    
    .btn-add:hover {
        background-color: #00a884;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 184, 148, 0.4);
    }
    
    .question-block {
        background-color: white;
        border-radius: 12px;
        border: 1px solid #e0e0e0;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.02);
        transition: all 0.3s ease;
    }
    
    .question-block:hover {
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
    }
    
    .section-title {
        color: var(--primary-color);
        font-weight: 700;
        margin-bottom: 1.5rem;
        position: relative;
        padding-bottom: 0.5rem;
    }
    
    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        right: 0;
        width: 50px;
        height: 3px;
        background-color: var(--primary-color);
        border-radius: 3px;
    }
    
    .divider {
        border-top: 2px dashed #e0e0e0;
        margin: 2rem 0;
    }
    
    .option-input {
        position: relative;
    }
    
    .option-input::before {
        content: attr(placeholder);
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        background: white;
        padding: 0 0.5rem;
        color: var(--primary-color);
        font-weight: bold;
    }
</style>
@endsection

@section('content')
<div class="container py-5">
    <div class="form-container">
        <h2 class="form-title">
            <i class="fas fa-book-open me-2"></i>إضافة قطعة وأسئلتها
        </h2>

        <form method="POST" action="{{ route('passages.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Passage Information Section -->
            <div class="mb-5">
                <h3 class="section-title">معلومات القطعة</h3>
                
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <label class="form-label">عنوان القطعة</label>
                        <input name="title" type="text" class="form-control" required>
                    </div>
                    
                    <div class="col-md-12 mb-4">
                        <label class="form-label">نص القطعة</label>
                        <textarea name="content" rows="5" class="form-control" required></textarea>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <label class="form-label">نوع القطعة</label>
                        <select name="type" class="form-select">
                            <option value="لفظي">لفظي</option>
                            <option value="كمي">كمي</option>
                        </select>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <label class="form-label">المادة</label>
                        <select name="subject_id" class="form-select">
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }} - {{ $subject->type }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="divider"></div>

            <!-- Questions Section -->
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="section-title mb-0">الأسئلة</h3>
                    <button type="button" onclick="addQuestion()" class="btn-add">
                        <i class="fas fa-plus-circle me-2"></i>إضافة سؤال جديد
                    </button>
                </div>

                <div id="questions-section">
                    <!-- First Question Block -->
                    <div class="question-block">
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label class="form-label">نص السؤال</label>
                                <textarea name="questions[0][question]" class="form-control" rows="3" required></textarea>
                            </div>
                            
                            <div class="col-md-12 mb-4">
                                <label class="form-label">الصورة (اختياري)</label>
                                <input type="file" name="questions[0][photo]" class="form-control">
                            </div>
                            
                            <div class="col-md-12 mb-4">
                                <label class="form-label">الاختيارات</label>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="option-input">
                                            <input type="text" name="questions[0][options][A]" class="form-control ps-5" placeholder="A" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="option-input">
                                            <input type="text" name="questions[0][options][B]" class="form-control ps-5" placeholder="B" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="option-input">
                                            <input type="text" name="questions[0][options][C]" class="form-control ps-5" placeholder="C" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="option-input">
                                            <input type="text" name="questions[0][options][D]" class="form-control ps-5" placeholder="D" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <label class="form-label">الإجابة الصحيحة</label>
                                <select name="questions[0][correct_answer]" class="form-select" required>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                </select>
                            </div>
                            
                            <div class="col-md-12 mb-4">
                                <label class="form-label">شرح الإجابة</label>
                                <textarea name="questions[0][explane_answer]" class="form-control" rows="2"></textarea>
                            </div>
                            
                            <div class="col-md-12">
                                <label class="form-label">ملاحظات (اختياري)</label>
                                <textarea name="questions[0][notes]" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <button type="submit" class="btn btn-primary px-5 py-3">
                    <i class="fas fa-save me-2"></i>حفظ القطعة والأسئلة
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
    let questionIndex = 1;

    function addQuestion() {
        const container = document.getElementById('questions-section');

        const html = `
        <div class="question-block">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <label class="form-label">نص السؤال</label>
                    <textarea name="questions[${questionIndex}][question]" class="form-control" rows="3" required></textarea>
                </div>
                
                <div class="col-md-12 mb-4">
                    <label class="form-label">الصورة (اختياري)</label>
                    <input type="file" name="questions[${questionIndex}][photo]" class="form-control">
                </div>
                
                <div class="col-md-12 mb-4">
                    <label class="form-label">الاختيارات</label>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="option-input">
                                <input type="text" name="questions[${questionIndex}][options][A]" class="form-control ps-5" placeholder="A" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="option-input">
                                <input type="text" name="questions[${questionIndex}][options][B]" class="form-control ps-5" placeholder="B" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="option-input">
                                <input type="text" name="questions[${questionIndex}][options][C]" class="form-control ps-5" placeholder="C" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="option-input">
                                <input type="text" name="questions[${questionIndex}][options][D]" class="form-control ps-5" placeholder="D" required>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 mb-4">
                    <label class="form-label">الإجابة الصحيحة</label>
                    <select name="questions[${questionIndex}][correct_answer]" class="form-select" required>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                </div>
                
                <div class="col-md-12 mb-4">
                    <label class="form-label">شرح الإجابة</label>
                    <textarea name="questions[${questionIndex}][explane_answer]" class="form-control" rows="2"></textarea>
                </div>
                
                <div class="col-md-12">
                    <label class="form-label">ملاحظات (اختياري)</label>
                    <textarea name="questions[${questionIndex}][notes]" class="form-control" rows="2"></textarea>
                </div>
            </div>
        </div>`;

        container.insertAdjacentHTML('beforeend', html);
        questionIndex++;
    }
</script>
@endsection