@extends('dashboard.layouts.master')
@section('title', 'Create Type')
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
                    <h3 class="mb-4"> اضافه نوع جديد</h3>
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
                            <form action="{{ route('subjects.store') }}" method="post" autocomplete="off">
                                @csrf

                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">نوع السؤال </label>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                </div>
                                <br>
                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">حفظ
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
