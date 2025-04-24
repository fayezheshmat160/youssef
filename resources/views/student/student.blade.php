@extends( 'student.layouts.master')
@section('title', 'لوحة التحكم')
@section('css')
    <link rel="stylesheet" href="{{ asset('dashboard/css/pages/home/home.css') }}">
@endsection
@section('content')
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <a href="{{ route('toExam') }}" class="btn btn-lg btn-primary shadow px-5 py-3 fs-4">
            🚀الي الامتحان
        </a>
    </div>
@endsection
