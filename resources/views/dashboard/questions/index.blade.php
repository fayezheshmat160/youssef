@extends('dashboard.layouts.master')
@section('title', 'قائمة الأسئلة')
@section('css')
<style>
    :root {
        --primary-color: #6c5ce7;
        --secondary-color: #a29bfe;
        --accent-color: #fd79a8;
        --light-bg: #f8f9fa;
        --dark-text: #2d3436;
    }
    
    .card-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
    }
    
    .table-custom {
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .table-custom thead th {
        background-color: rgba(108, 92, 231, 0.05);
        color: var(--primary-color);
        font-weight: 600;
        border: none;
        padding: 12px 15px;
    }
    
    .table-custom tbody td {
        vertical-align: middle;
        padding: 12px 15px;
        border-top: 1px solid #f1f1f1;
    }
    
    .table-custom tbody tr:last-child td {
        border-bottom: none;
    }
    
    .btn-action {
        padding: 5px 10px;
        font-size: 0.8rem;
        border-radius: 6px;
        margin: 0 3px;
    }
    
    .btn-edit {
        background-color: rgba(25, 135, 84, 0.1);
        color: #198754;
    }
    
    .btn-delete {
        background-color: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }
    
    .badge-subject {
        background-color: rgba(253, 121, 168, 0.1);
        color: white;
        padding: 4px 8px;
        border-radius: 20px;
        font-size: 0.8rem;
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="text-primary mb-0">
            <i class="fas fa-question-circle me-2"></i>قائمة الأسئلة
        </h5>
        <a href="{{ route('questions.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i>إضافة سؤال
        </a>
    </div>

    <div class="card-container">
        <div class="table-responsive">
            <table class="table table-custom">
                <thead>
                    <tr>
                        <th>السؤال</th>
                        <th>الإجابة الصحيحة</th>
                        <th>المادة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($questions as $question)
                        @php
                            $options = json_decode($question->options, true);
                        @endphp
                        <tr>
                            <td>{{ \Illuminate\Support\Str::limit($question->question, 50, '...') }}</td>
                            <td>
                                @foreach ($options as $key => $value)
                                    @if ($key == $question->correct_answer)
                                        <span class="fw-semibold">{{ $value }}</span>
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <span class="badge-subject bg-primary">
                                    {{ $question->subject->name }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('questions.edit', $question) }}" class="btn-action btn-edit" title="تعديل">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('questions.destroy', $question) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete" title="حذف" onclick="return confirm('هل أنت متأكد من حذف هذا السؤال؟')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection