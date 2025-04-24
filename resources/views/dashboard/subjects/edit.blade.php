@extends('dashboard.layouts.master')
@section('title', 'Edit Types')
@section('css')
    <style>
        .row {
            margin-top: 100px;
        }
    </style>
@endsection
@section('content')
    <!-- row -->
    <div class="row mt-10">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{ route('subjects.update', ['subject' => $subject->id]) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">نوع السؤال</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name', $subject->name) }}">
                                    </div>
                                </div>
                                <br>
                                <button class="btn btn-primary btn-sm nextBtn btn-lg pull-right" type="submit">تحديث
                                    البيانات</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection

@section('js')
@endsection
