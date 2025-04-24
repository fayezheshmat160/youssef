@extends('dashboard.layouts.master')
@section('title', 'Edit Question')
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
                    <div class="col-md-12">
                        <form action="{{ route('questions.update', $question->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-row">
                                <div class="col">
                                    <label>السؤال</label>
                                    <textarea name="question" class="form-control" rows="4">{{ old('question', $question->question) }}</textarea>
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <label>صورة السؤال:</label>
                                @if ($question->photo)
                                    <div class="mb-2"><img src="{{ asset('storage/' . $question->photo) }}"
                                            height="100"></div>
                                @endif
                                <input type="file" name="photo">
                            </div>

                            @php
                                $options = json_decode($question->options, true);
                            @endphp

                            @foreach (['a', 'b', 'c', 'd'] as $option)
                                <div class="form-row mt-3">
                                    <div class="col">
                                        <label>الاختيار {{ $loop->iteration }}</label>
                                        <textarea name="option_{{ $option }}" class="form-control" rows="4">{{ old("option_$option", $options[$option] ?? '') }}</textarea>
                                        <input type="radio" name="correct_answer" value="{{ $option }}"
                                            {{ $question->correct_answer == $option ? 'checked' : '' }}> الاجابة الصحيحة
                                    </div>
                                </div>
                            @endforeach

                            <div class="form-row mt-3">
                                <div class="col">
                                    <label>شرح الإجابة</label>
                                    <textarea name="explane_answer" class="form-control">{{ old('explane_answer', $question->explane_answer) }}</textarea>
                                </div>
                            </div>

                            <div class="form-row mt-3">
                                <div class="col">
                                    <label>ملاحظات</label>
                                    <textarea name="notes" class="form-control">{{ old('notes', $question->notes) }}</textarea>
                                </div>
                            </div>

                            <div class="form-row mt-3">
                                <div class="col-6">
                                    <label>اسم الاختبار:</label>
                                    <select name="subject_id" class="custom-select">
                                        <option disabled selected>حدد اسم الاختبار...</option>
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}"
                                                {{ $question->subject_id == $subject->id ? 'selected' : '' }}>
                                                {{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- <div class="col-6">
                                    <label>النوع:</label>
                                    <select name="type" class="custom-select" id="questionType" onchange="toggleOptions()">
                                        <option disabled selected>حدد النوع...</option>
                                        <option value="multiple_choice" selected>Multiple Choice</option>
                                        <!-- Add more types if needed
                                    </select>
                                </div> -->
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">تحديث السؤال</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

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
