@extends('dashboard.layouts.master')
@section('title', 'تعديل سؤال')
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
    
    .form-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
    }
    
    .option-container {
        position: relative;
        margin-bottom: 1.5rem;
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
    
    .file-upload {
        border: 1px dashed #e0e0e0;
        border-radius: 8px;
        padding: 1rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .file-upload:hover {
        border-color: var(--primary-color);
        background-color: rgba(108, 92, 231, 0.05);
    }
    
    .radio-correct {
        display: flex;
        align-items: center;
        margin-top: 0.5rem;
    }
    
    .radio-correct input {
        margin-left: 0.5rem;
    }
    
    .preview-image {
        max-width: 150px;
        max-height: 150px;
        border-radius: 8px;
        border: 1px solid #eee;
        padding: 5px;
        margin-bottom: 10px;
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
    
    .alert-danger {
        background-color: rgba(214, 48, 49, 0.1);
        border-left: 4px solid #d63031;
        border-radius: 8px;
        padding: 1rem;
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="text-primary mb-0">
            <i class="fas fa-edit me-2"></i>تعديل سؤال
        </h5>
    </div>

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session()->get('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="form-card">
        <form action="{{ route('questions.update', $question->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group mb-4">
                <label class="form-label">السؤال</label>
                <textarea name="question" class="form-control" rows="4" required>{{ old('question', $question->question) }}</textarea>
            </div>
            
            <div class="form-group mb-4">
                <label class="form-label">صورة السؤال</label>
                @if ($question->photo)
                    <div>
                        <img src="{{ asset('storage/' . $question->photo) }}" class="preview-image">
                    </div>
                @endif
                <div class="file-upload">
                    <i class="fas fa-cloud-upload-alt fa-2x text-muted mb-2"></i>
                    <p class="mb-1">انقر لتغيير الصورة</p>
                    <small class="text-muted">JPG, PNG (الحجم الأقصى 2MB)</small>
                    <input type="file" name="photo" class="d-none" id="fileUpload">
                </div>
                <div id="fileName" class="small text-muted mt-1"></div>
            </div>
            
            @php
                $options = json_decode($question->options, true);
            @endphp
            
            @foreach (['a', 'b', 'c', 'd'] as $option)
                <div class="option-container">
                    <span class="option-label">الاختيار {{ strtoupper($option) }}</span>
                    <textarea name="option_{{ $option }}" class="form-control" rows="2" required>{{ old("option_$option", $options[$option] ?? '') }}</textarea>
                    <div class="radio-correct">
                        <input type="radio" name="correct_answer" value="{{ $option }}" 
                            {{ old('correct_answer', $question->correct_answer) == $option ? 'checked' : '' }}>
                        <span>الإجابة الصحيحة</span>
                    </div>
                </div>
            @endforeach
            
            <div class="form-group mb-4">
                <label class="form-label">شرح الإجابة</label>
                <textarea name="explane_answer" class="form-control" rows="3">{{ old('explane_answer', $question->explane_answer) }}</textarea>
            </div>
            
            <div class="form-group mb-4">
                <label class="form-label">ملاحظات (اختياري)</label>
                <textarea name="notes" class="form-control" rows="2">{{ old('notes', $question->notes) }}</textarea>
            </div>
            
            <div class="form-group mb-4">
                <label class="form-label">المادة <span class="text-danger">*</span></label>
                <select name="subject_id" class="form-select" required>
                    <option value="" disabled>اختر المادة...</option>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}" 
                            {{ old('subject_id', $question->subject_id) == $subject->id ? 'selected' : '' }}>
                            {{ $subject->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-save me-2"></i>حفظ التعديلات
                </button>
            </div>
        </form>
    </div>
</div>

@section('js')
<script>
    // File upload display
    document.getElementById('fileUpload').addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name || 'لم يتم اختيار ملف';
        document.getElementById('fileName').textContent = fileName;
    });
    
    // Click file upload area
    document.querySelector('.file-upload').addEventListener('click', function() {
        document.getElementById('fileUpload').click();
    });
</script>
@endsection