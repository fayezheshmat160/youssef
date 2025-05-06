@extends('dashboard.layouts.master')
@section('title', 'قائمة المواد')
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="text-primary">
            <i class="fas fa-book me-2"></i>قائمة المواد
        </h5>
        <a href="{{ route('subjects.create') }}" class="btn btn-success">
            <i class="fas fa-plus me-1"></i>إضافة مادة جديدة
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="bg-light">
                <tr>
                    <th>#</th>
                    <th>اسم المادة</th>
                    <th>النوع</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subjects as $subject)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $subject->name }}</td>
                    <td>
                        <span class="badge {{ $subject->type == 'لفظي' ? 'bg-primary' : 'bg-info' }}">
                            {{ $subject->type }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i> تعديل
                        </a>
                        <form action="{{ route('subjects.destroy', $subject) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" 
                                onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                <i class="fas fa-trash"></i> حذف
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection