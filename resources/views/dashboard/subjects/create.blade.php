@extends('dashboard.layouts.master')
@section('title', 'إضافة مادة جديدة')
@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>إضافة مادة جديدة
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('subjects.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">اسم المادة</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">النوع</label>
                            <select class="form-select" name="type" required>
                                <option value="لفظي">لفظي</option>
                                <option value="كمي">كمي</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-1"></i> حفظ
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection