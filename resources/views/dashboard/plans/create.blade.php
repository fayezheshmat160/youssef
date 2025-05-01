@extends('dashboard.layouts.master')
@section('title', 'Student List')
@section('css')

@endsection
@section('content')
<div class="container">
    <h2>إضافة باقة جديدة</h2>

    <form action="{{ route('dashboard.plans.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>اسم الباقة</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>سعر الباقة</label>
            <input type="number" step="0.01" name="price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>وصف الباقة</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label>المميزات</label>
            <div id="features-list">
                <input type="text" name="features[]" class="form-control mb-2" placeholder="اكتب ميزة">
            </div>
            <button type="button" onclick="addFeature()" class="btn btn-sm btn-success">إضافة ميزة</button>
        </div>

        <button class="btn btn-primary">حفظ</button>
    </form>
</div>

<script>
    function addFeature() {
        let input = document.createElement('input');
        input.type = 'text';
        input.name = 'features[]';
        input.className = 'form-control mb-2';
        input.placeholder = 'اكتب ميزة جديدة';
        document.getElementById('features-list').appendChild(input);
    }
</script>
@endsection
@section('js')

@endsection


