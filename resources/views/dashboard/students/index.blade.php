@extends('dashboard.layouts.master')
@section('title', 'Student List')
@section('css')

@endsection
@section('content')
    <div class="container my-5 shadow-lg p-4 bg-white">
        <h3 class="mb-4">Student List</h3>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="text-center">Student</th>
                    <th class="text-center">Score</th>
                    {{-- <th class="text-center">Operation</th> --}}
                </tr>
            </thead>
            <tbody>
                <td>اسم الطالب</td>
                <td>الدرجه</td>

                       
                        {{-- <td class="text-center">
                            <a href="{{ route('questions.edit', $question) }}" class="btn btn-sm btn-outline-success me-1">
                                <i class="bi bi-pencil-square"></i> Edit</a>

                            <form action="{{ route('questions.destroy', $question) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Are you sure you want to delete this question?')">Delete</button>
                            </form>
                        </td> --}}

                    </tr>
            </tbody>
        </table>
    </div>
@endsection
@section('js')

@endsection
