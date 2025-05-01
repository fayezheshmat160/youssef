@extends('student.layouts.blank')

@section('title', 'الامتحان')

@section('css')
    <style>
        body {
            direction: ltr;
            text-align: left;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 0.5rem;
        }

        .form-check-input {
            position: relative;
        }

        #timer {
            font-size: 20px;
            font-weight: bold;
            color: #dc3545;
            text-align: center;
            margin-bottom: 20px;
        }

        .subject-section {
            margin-bottom: 40px;
        }

        .passage {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .question-block {
            margin-bottom: 25px;
        }
    </style>
@endsection

@section('content')
    <div class="container exam-container mt-5">
        <div class="card shadow-sm mx-auto" style="max-width: 800px;">
            <div class="card-body">
                <h2 class="text-center mb-3">📘 Online Exam</h2>
                <div id="timer">⏳ 01:00:00</div>

                @if(session('success'))
                    <div class="alert alert-success text-center">
                        {{ session('success') }}
                    </div>
                @endif

                <form id="examForm">
                    @csrf
                    <input type="hidden" name="student_id" value="{{ auth()->id() }}">

                    @foreach($structuredQuestions as $subjectData)
                        <div class="subject-section">
                            <h4 class="mb-3 text-primary">🧪 Subject: {{ $subjectData['subject']->name }}</h4>

                            {{-- Questions with passages --}}
                            @foreach($subjectData['passages'] as $passageData)
                                <div class="passage">
                                    <strong>📄 Passage:</strong>
                                    <p>{{ $passageData['passage']->content }}</p>
                                </div>

                                @foreach($passageData['questions'] as $question)
                                    <div class="question-block" data-question-id="{{ $question->id }}" data-correct-answer="{{ $question->correct_answer }}" data-subject-type="{{ $subjectData['subject']->type }}">
                                        @include('student.partials.question', ['question' => $question, 'label' => chr(64 + $loop->iteration)])
                                    </div>
                                @endforeach
                            @endforeach

                            {{-- Standalone questions --}}
                            @foreach($subjectData['standalone_questions'] as $question)
                                <div class="question-block" data-question-id="{{ $question->id }}" data-correct-answer="{{ $question->correct_answer }}" data-subject-type="{{ $subjectData['subject']->type }}">
                                    @include('student.partials.question', ['question' => $question])
                                </div>
                            @endforeach
                        </div>
                    @endforeach

                    <button type="button" class="btn btn-success w-100" onclick="submitExam()">Submit Answers</button>
                </form>

                <div id="verbalResult" class="text-center mt-4 fw-bold fs-5 text-primary"></div>
                <div id="quantitativeResult" class="text-center mt-4 fw-bold fs-5 text-primary"></div>
                <div id="totalResult" class="text-center mt-4 fw-bold fs-5 text-primary"></div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        window.onload = function () {
            const isReloaded = performance.navigation.type === 1;
            if (isReloaded && !localStorage.getItem('examSubmitted')) {
                document.querySelector('.exam-container').innerHTML = `
                <div class="alert alert-danger text-center py-4">
                    <h4>⚠️ تم إلغاء الامتحان!</h4>
                    <p class="mt-3">سيتم توجيهك خلال 5 ثواني...</p>
                </div>
            `;
                setTimeout(() => {
                    window.location.href = "{{ route('student.index') }}";
                }, 5000);
            }
        };

        window.addEventListener('beforeunload', function (e) {
            if (!localStorage.getItem('examSubmitted')) {
                const message = "ممنوع إعادة التحميل أو مغادرة الصفحة!";
                e.returnValue = message;
                return message;
            }
        });

        let isSubmitted = false;

        function submitExam() {
            if (isSubmitted) return;
            isSubmitted = true;

            let verbalScore = 0;
            let quantitativeScore = 0;
            const totalQuestions = document.querySelectorAll('.question-block').length;

            document.querySelectorAll('.question-block').forEach(questionDiv => {
                const correctAnswer = questionDiv.dataset.correctAnswer;
                const questionId = questionDiv.dataset.questionId;
                const subjectType = questionDiv.dataset.subjectType;  // Get subject type instead of question type
                const selectedInput = document.querySelector(`input[name="answers[${questionId}]"]:checked`);

                if (selectedInput && selectedInput.value === correctAnswer) {
                    if (subjectType === 'لفظي') verbalScore++; // Check for subject type
                    else if (subjectType === 'كمي') quantitativeScore++; // Check for subject type
                }
            });

            fetch("{{ route('exam.submit') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    student_id: {{ auth()->id() }},
                    verbal_score: verbalScore,
                    quantitative_score: quantitativeScore,
                    total_score: verbalScore + quantitativeScore,
                    correct_count: verbalScore + quantitativeScore
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        localStorage.setItem('examSubmitted', '1');
                        // إعادة التوجيه إلى صفحة النتيجة مباشرة
                        window.location.href = data.redirect_url; // حدد الرابط الصحيح للنتيجة
                    } else {
                        alert(data.message || 'حدث خطأ!');
                    }
                })
                .catch(error => {
                    console.error(error);
                    alert('فشل الإرسال: ' + error.message);
                });
        }

        // Timer countdown
        let totalSeconds = 60 * 60;
        const timerElement = document.getElementById('timer');
        const countdown = setInterval(() => {
            const hours = String(Math.floor(totalSeconds / 3600)).padStart(2, '0');
            const minutes = String(Math.floor((totalSeconds % 3600) / 60)).padStart(2, '0');
            const seconds = String(totalSeconds % 60).padStart(2, '0');
            timerElement.textContent = `⏳ ${hours}:${minutes}:${seconds}`;
            totalSeconds--;
            if (totalSeconds < 0) {
                clearInterval(countdown);
                alert("⏰ الوقت انتهى! يتم إرسال الامتحان...");
                submitExam();
            }
        }, 1000);
    </script>
@endsection
