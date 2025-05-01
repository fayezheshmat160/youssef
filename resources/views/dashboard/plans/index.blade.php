@extends('dashboard.layouts.master')
@section('title', 'Student List')
@section('css')

@endsection

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">إدارة الباقات</h2>

    <div class="text-end mb-4">
        <a href="{{ route('dashboard.plans.create') }}" class="btn btn-success">➕ إضافة باقة جديدة</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="row">
        @forelse($plans as $plan)
            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-body text-center">
                        <h4 class="card-title">{{ $plan->name }}</h4>
                        <h5 class="text-primary">{{ number_format($plan->price, 2) }} جنيه</h5>
                        <p class="text-muted">{{ $plan->description }}</p>
                        <hr>
                        <ul class="list-unstyled text-start">
                            @foreach($plan->features as $feature)
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> {{ $feature }}</li>
                            @endforeach
                        </ul>
                        <div class="mt-3 d-flex justify-content-center gap-2">
                            <a href="{{ route('dashboard.plans.edit', $plan) }}" class="btn btn-warning btn-sm">✏️ تعديل</a>
                            <form action="{{ route('dashboard.plans.destroy', $plan) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">🗑️ حذف</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">لا توجد باقات مضافة حتى الآن.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection

@section('js')

@endsection
