@extends('student.layouts.master')
@section('title', 'الإعدادات العامة')
@section('css')
    <link rel="stylesheet" href="{{ asset('dashboard/css/pages/settings/settings.css') }}">
@endsection
@section('content')

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
                                <form action="#" method="POST">
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
                                </form>
                            </div>

                            {{-- Change Password Tab --}}
                            <div class="tab-pane fade" id="password" role="tabpanel">
                                <form action="#" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Current Password</label>
                                        <input type="password" class="form-control" name="current_password">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">New Password</label>
                                        <input type="password" class="form-control" name="new_password">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Confirm New Password</label>
                                        <input type="password" class="form-control" name="new_password_confirmation">
                                    </div>
                                    <button type="submit" class="btn btn-warning">Change Password</button>
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

