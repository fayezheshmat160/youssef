@extends('dashboard.layouts.master')
@section('title', 'تعديل مادة')
@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-edit me-2"></i>تعديل مادة
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('subjects.update', $subject) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">اسم المادة</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="{{ $subject->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">النوع</label>
                            <select class="form-select" name="type" required>
                                <option value="لفظي" {{ $subject->type == 'لفظي' ? 'selected' : '' }}>لفظي</option>
                                <option value="كمي" {{ $subject->type == 'كمي' ? 'selected' : '' }}>كمي</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-1"></i> تحديث
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection