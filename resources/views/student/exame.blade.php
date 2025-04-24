@extends('student.layouts.blank')

@section('title', 'الامتحان')
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

@section('css')
    <style>
        body {
            direction: ltr; /* يجعل كل الصفحة من اليسار */
            text-align: left;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 0.5rem;
        }

        .form-check-input {
            margin-left: 0;
            margin-right: 0;
            margin-top: 0;
            position: relative;
        }

        .form-check-label {
            margin-bottom: 0;
        }
    </style>
@endsection

@section('content')
    <div class="container exam-container mt-5">
        <div class="card shadow-sm mx-auto" style="max-width: 700px;">
            <div class="card-body">
                <h2 class="text-center mb-4">📘 Online Exam</h2>

                <form id="examForm">
                    @foreach($questions as $index => $question)
                        @php
                            $options = json_decode($question->options, true);
                            dd($options);
                        @endphp

                        <div class="mb-4">
                            <label class="form-label fw-bold">
                                {{ $loop->iteration }}. {{ $question->question }}
                            </label>

                            @foreach($options as $key => $value)
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="answers[{{ $question->id }}]"
                                        value="{{ $key }}"
                                        id="q{{ $question->id }}{{ $key }}"
                                    >
                                    <label class="form-check-label" for="q{{ $question->id }}{{ $key }}">
                                        {{ $value }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach

                    <button type="button" class="btn btn-success w-100" onclick="calculateScore()">Submit Answers</button>
                </form>

                <div id="result" class="result text-center mt-4 fw-bold fs-5 text-primary"></div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        const correctAnswers = @json($questions->pluck('correct_answer', 'id'));

        function calculateScore() {
            let score = 0;
            const total = Object.keys(correctAnswers).length;

            for (let id in correctAnswers) {
                const selected = document.querySelector(`input[name="answers[${id}]"]:checked`);
                if (selected && selected.value === correctAnswers[id]) {
                    score++;
                }
            }

            const resultDiv = document.getElementById('result');
            resultDiv.innerHTML = `✅ You scored <strong>${score}</strong> out of <strong>${total}</strong>`;
            resultDiv.classList.add('alert', 'alert-info');
        }
    </script>
@endsection
