@extends('dashboard.layouts.master')
@section('title', 'Create Question')
@section('css')
@endsection
@section('content')
    <div class="row">
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
                            <form action="{{ route('questions.store') }}" method="post" autocomplete="off"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="col">
                                        <label for="title"> السؤال</label>
                                        <textarea name="question" class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="academic_year">صوره للسؤال : <span class="text-danger">*</span></label>
                                        <input type="file" name="photo" multiple>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">الاختيار الاول</label>
                                        <textarea name="option_a" class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
                                        <input class=""type="radio" name="correct_answer" value="a" required>
                                        الاجابه الصحيحه
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">الاختيار الثاني</label>
                                        <textarea name="option_b" class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
                                        <input class=""type="radio" name="correct_answer" value="b"
                                            required>الاجابه الصحيحه
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">الاختيار الثالث</label>
                                        <textarea name="option_c" class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
                                        <input class=""type="radio" name="correct_answer" value="c"
                                            required>الاجابه الصحيحه
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">الاختيار الرابع</label>
                                        <textarea name="option_d" class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
                                        <input class=""type="radio" name="correct_answer" value="d"
                                            required>الاجابه الصحيحه
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="title"> شرح الاجابه</label>
                                        <textarea name="explane_answer" class="form-control"></textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="title"> ملاحظات </label>
                                        <textarea name="notes" class="form-control"></textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="Grade_id">اسم الاختبار : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="subject_id">
                                                <option selected disabled>حدد اسم الاختبار...</option>
                                                @foreach ($subjects as $subject)
                                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- <div class="col-6">
                                            <div class="form-group">
                                                <label for="Grade_id">النوع : <span class="text-danger">*</span></label>
                                                <select class="custom-select mr-sm-2" name="type" onchange="toggleOptions()">
                                                    <option selected disabled> حدد الدرجة...</option>
                                                    <option value="multiple_choice">Multiple Choice</option>
                                                    <!-- <option value="true_false">True / False</option>
                                                    <option value="short_answer">Short Answer</option>
                                                </select>
                                            </div>
                                        </div> -->
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
    {{-- <script>
        function toggleOptions() {
            const type = document.getElementById('questionType').value;
            const optionsDiv = document.getElementById('optionsContainer');
            optionsDiv.style.display = type === 'multiple_choice' ? 'block' : 'none';
        }
        toggleOptions();
    </script> --}}
@endsection
@section('js')

@endsection
