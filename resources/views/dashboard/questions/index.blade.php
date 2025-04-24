@extends('dashboard.layouts.master')
@section('title', 'Questions List')
@section('css')

@endsection
@section('content')
    <div class="container my-5 shadow-lg p-4 bg-white">
        <h3 class="mb-4">Questions List</h3>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="text-center">Question</th>
                    <th class="text-center">Correct Answer</th>
                    <th class="text-center">Type</th>
                    <th class="text-center">Operation</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($questions as $question)
                    @php
                        $options = json_decode($question->options, true);
                    @endphp
                    <tr>

                        <td>{{ \Illuminate\Support\Str::limit($question->question, 50, '...') }}</td>
                        @foreach ($options as $key => $value)
                            @if ($key == $question->correct_answer)
                                <td>{{ $value }}</td>
                            @endif
                        @endforeach

                        <td class="text-center">{{ $question->subject->name }}</td>
                        <td class="text-center">
                            <a href="{{ route('questions.edit', $question) }}" class="btn btn-sm btn-outline-success me-1">
                                <i class="bi bi-pencil-square"></i> Edit</a>

                            <form action="{{ route('questions.destroy', $question) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Are you sure you want to delete this question?')">Delete</button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('js')

@endsection
