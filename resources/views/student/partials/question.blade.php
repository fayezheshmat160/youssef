@php
    $options = json_decode($question->options, true);
@endphp

<div class="mb-4" data-correct-answer="{{ $question->correct_answer }}" data-question-id="{{ $question->id }}">
    <label class="form-label fw-bold">
        {{ $label ?? $loop->iteration }}. {{ $question->question }}
    </label><br>

    @if($question->photo)
        <img src="{{ asset('storage/' . $question->photo) }}" alt="Question Photo" class="img-fluid mb-3">
    @endif

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
