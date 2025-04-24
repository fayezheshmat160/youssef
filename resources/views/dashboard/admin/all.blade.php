@extends('dashboard.layouts.master')
@section('title', dbTrans('admin.Admins page title'))

<x-dashboard.css link="admin/admins" />


@section('content')

    @php
        $addBtn = null;
    @endphp
    @can('create admin')
        @php
            $addBtn = [
                'name' => dbTrans('admin.Add New'),
                'class' => 'btn-main',
                'options' => [
                    'data-toggle' => 'modal',
                    'data-target' => '#createModel',
                    'type' => 'button',
                ],
            ];
        @endphp
    @endcan

    <x-dashboard.links-bar :links="[
        [
            'link' => adminUrl('admins'),
        ],
    ]" :buttons="[
        $addBtn,
        [
            'name' => __('search'),
            'class' => 'btn btn-soft-main',
            'options' => [
                'data-toggle' => 'modal',
                'data-target' => '.bd-example-modal-lg',
                'type' => 'button',
            ],
        ],
    ]" />


    <section id="admins">
        <div class="row">

            @foreach ($admins as $row)
                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-4">
                    <div class="box admin-card p-0">

                        <div class="cover">
                            @if ($row->cover == null || !file_exists(smallPath($coverPath . '/' . $row->cover)))
                                <img class="w-100 object-cover"
                                    src="{{ asset('dashboard/images/admin/covers/small/' . rand(1, 7) . '.jpg') }}"
                                    alt="">
                            @else
                                <img class="w-100 object-cover" src="{{ smallAsset($coverPath . '/' . $row->cover) }}"
                                    alt="">
                            @endif
                        </div><!-- cover -->

                        <div class="p-4">

                            <div class="avatar p-1 rounded-circle text-center">

                                @if ($row->avatar == null || !file_exists(smallPath($avatarPath . '/' . $row->avatar)))
                                    <span
                                        class=" font-28">{{ mb_substr($row->f_name, 0, 1) . mb_substr($row->l_name, 0, 1) }}</span>
                                @else
                                    <img class="rounded-circle  object-cover w-100 h-100"
                                        src="{{ smallAsset($avatarPath . '/' . $row->avatar) }}" alt="">
                                @endif
                            </div><!-- avatar -->

                            <div class="info text-center mt-5">
                                <a href="{{ adminUrl('profile/show/' . $row->id) }}">
                                    <h6 class="admin-name font-18 text-center d-inline text-main">
                                        {{ $row->f_name . ' ' . $row->l_name }}</h6>
                                    @if ($row->status == 0)
                                        <small class=" badge badge-soft-danger font-11 status-badge">Closed</small>
                                    @endif
                                </a>

                                <small class=" text-second d-block">
                                    @if ($row->job == null)
                                        {{ dbTrans('admin.Job has not been entered') }}
                                    @else
                                        {{ $row->job }}
                                    @endif
                                </small>

                            </div><!-- info -->

                            <a href="{{ adminUrl("profile/show/$row->id") }}"
                                class="btn btn-soft-main btn-block btn-sm mt-4">
                                {{ dbTrans('admin.View Profile') }}
                            </a>

                        </div><!-- padding -->

                        <div class="controls">
                            <div class="btn-group">
                                <button class="dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                    @role(owner())
                                        <a class="dropdown-item font-14 text-second"
                                            href="{{ adminUrl('admins/edit/' . $row->id) }}">{{ __('edit') }}</a>
                                    @endrole


                                    @if ($row->status > 0)
                                        @can(getPermissions('admin')[2])
                                            <form class="form-status" action="{{ route('closed-admin-account') }}"
                                                method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="id" value="{{ $row->id }}">
                                                <button type="submit"
                                                    class="btn-change-status dropdown-item font-14 text-second">{{ dbTrans('admin.DeActivate') }}</button>
                                            </form>
                                        @endcan
                                    @else
                                        @can(getPermissions('admin')[3])
                                            <form class="form-status" action="{{ route('active-admin-account') }}"
                                                method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="id" value="{{ $row->id }}">
                                                <button type="submit"
                                                    class="btn-change-status dropdown-item font-14 text-second">{{ dbTrans('admin.Activate') }}</button>
                                            </form>
                                        @endcan
                                    @endif

                                </div><!-- End Menu -->

                            </div>
                        </div><!-- controls -->

                    </div><!-- box -->
                </div><!-- admin card -->
            @endforeach

        </div><!-- row -->
    </section><!-- admins -->


    <!-- Search Modal -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">{{ __('search') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <form id="form-search" action="{{ route('admin-search') }}" method="POST">

                        <div class="row">
                            <div class="col-9 pr-remove pl-remove">
                                <x-form-group :properties="[
                                    'input' => [
                                        'name' => 'name',
                                        'options' => [
                                            'placeholder' => __('name'),
                                            'class' => 'input-search',
                                        ],
                                    ],
                                ]" />
                            </div>
                            <div class="col-3">
                                <button type="submit" class="btn btn-search btn-main btn-block"><i
                                        class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </div>

                    </form>

                    <div id="response-data">

                    </div><!-- response from js -->

                </div>

            </div>
        </div>
    </div>

    <!-- Create Model -->
    <div class="modal fade" id="createModel" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ dbTrans('admin.Add Admin') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="ajax-post" action="{{ route('create-admin') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="row">

                            <div class="col-6">
                                <x-form-group :properties="[
                                    'input' => [
                                        'name' => 'f_name',
                                        'options' => ['required'],
                                    ],
                                    'label' => [
                                        'text' => dbTrans('admin.First Name'),
                                        'options' => [
                                            'class' => 'required',
                                        ],
                                    ],
                                ]" /><!-- f_name -->

                            </div>

                            <div class="col-6">
                                <x-form-group :properties="[
                                    'input' => [
                                        'name' => 'l_name',
                                        'options' => ['required'],
                                    ],
                                    'label' => [
                                        'text' => dbTrans('admin.Last Name'),
                                        'options' => [
                                            'class' => 'required',
                                        ],
                                    ],
                                ]" /><!-- f_name -->
                            </div>

                            <div class="col-12">

                                <x-form-group :properties="[
                                    'input' => [
                                        'name' => 'email',
                                        'type' => 'email',
                                        'options' => ['required'],
                                    ],
                                    'label' => [
                                        'text' => dbTrans('admin.email'),
                                        'options' => [
                                            'class' => 'required',
                                        ],
                                    ],
                                ]" /><!-- email -->
                            </div>

                            <div class="col-9">
                                <x-form-group :properties="[
                                    'input' => [
                                        'name' => 'password',
                                        'options' => ['required', 'class' => 'accept-random'],
                                    ],
                                    'label' => [
                                        'text' => dbTrans('admin.Password'),
                                        'options' => [
                                            'class' => 'required',
                                        ],
                                    ],
                                ]" /><!-- password -->
                            </div>

                            <div class="col-3 mt-2">
                                <button type="button"
                                    class="generate-random btn btn-soft-info mt-4">عشوائية</button>
                            </div>

                        </div> <!-- row -->


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block">{{ dbTrans('admin.Add New') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
<x-dashboard.js :links="[
    [
        'link' => 'admin/admins.js',
        'from' => 'pages',
        'type' => 'module',
    ],
    [
        'link' => 'generate-random-characters.js',
        'from' => 'components',
    ],
]" />
