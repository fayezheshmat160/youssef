@extends('student.layouts.master')
@section('title', 'الإعدادات العامة')
@section('css')
    <link rel="stylesheet" href="{{ asset('dashboard/css/pages/settings/settings.css') }}">
@endsection
@section('content')
    @php
        $student = \Illuminate\Support\Facades\Auth::user();
    @endphp

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Student Profile & Settings</h5>
                    </div>
                    <div class="card-body">
                        {{-- Tabs --}}
                        <ul class="nav nav-tabs mb-4" id="settingsTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                        type="button" role="tab">Profile Info</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#password"
                                        type="button" role="tab">Change Password</button>
                            </li>
                        </ul>

                        {{-- Tab Content --}}
                        <div class="tab-content" id="settingsTabsContent">
                            {{-- Profile Info Tab --}}
                            <div class="tab-pane fade show active" id="profile" role="tabpanel">
                                <form action="{{ route('student.updateProfile') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ old('name', $student->name ?? '') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" class="form-control" name="email" value="{{ old('email', $student->email ?? '') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Phone</label>
                                        <input type="text" class="form-control" name="phone" value="{{ old('phone', $student->phone ?? '') }}">
                                    </div>
                                    <button type="submit" class="btn btn-success">Update Profile</button>
                                    {{-- Success/Error Messages for Profile Update --}}
                                    @if (session('profile_success'))
                                        <div class="alert alert-success mt-2">
                                            {{ session('profile_success') }}
                                        </div>
                                    @endif
                                    @if ($errors->has('profile'))
                                        <div class="alert alert-danger mt-2">
                                            @foreach ($errors->get('profile') as $error)
                                                <p>{{ $error }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </form>
                            </div>

                            {{-- Change Password Tab --}}
                            <div class="tab-pane fade" id="password" role="tabpanel">
                                <form action="{{ route('student.changePassword') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Current Password</label>
                                        <input type="password" class="form-control" name="current_password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">New Password</label>
                                        <input type="password" class="form-control" name="new_password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Confirm New Password</label>
                                        <input type="password" class="form-control" name="new_password_confirmation" required>
                                    </div>
                                    <button type="submit" class="btn btn-warning">Change Password</button>

                                    {{-- Success/Error Messages for Password Change --}}
                                    @if (session('password_success'))
                                        <div class="alert alert-success mt-2">
                                            {{ session('password_success') }}
                                        </div>
                                    @endif
                                    @if ($errors->any())
                                        <div class="alert alert-danger mt-2">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div> {{-- card-body --}}
                </div> {{-- card --}}
            </div> {{-- col --}}
        </div> {{-- row --}}
    </div> {{-- container --}}
@endsection
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
