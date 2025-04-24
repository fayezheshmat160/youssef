@extends('dashboard.layouts.master')
@section('title', 'types List')
@section('css')
@endsection
@section('content')
    <div class="container my-5 shadow-lg p-4 bg-white">
        <h3 class="mb-4">types List</h3>
        <a href="{{ route('subjects.create') }}" class="btn btn-success btn-sm" role="button" aria-pressed="true">اضافة نوع
            جديدة</a><br><br>
        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
            data-page-length="50"style="text-align: center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>اسم المادة</th>
                    <th>operation</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subjects as $subject)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $subject->name }}</td>
                        <td>
                            <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-sm btn-info">Edit</a>
                            </form>
                            <form action="{{ route('subjects.destroy', $subject) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Are you sure you want to delete this question?')">Delete</button>
                            </form>
                    </tr>
                @endforeach
        </table>
        </table>
    </div>
@endsection
@section('js')

@endsection
