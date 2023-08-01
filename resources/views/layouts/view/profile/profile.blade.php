@extends('layouts.app', ['photos' => $data_profile['photos'], 'nama_lengkap' => $data_profile['nama_lengkap']])

@section('title', 'profile')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">User Profile</li>
                        </ol>
                    </div>
                </div>
                @if (session('alert'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> Success!</h5>
                        {{ session('alert') }}
                    </div>
                @endif
                @if (session('alertError'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> Error!</h5>
                        {{ session('alertError') }}
                    </div>
                @endif
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ url('photo_profile', $data_profile['photos']) }}"
                                        alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center">{{ $data_profile['nama_lengkap'] }}</h3>

                                <p class="text-muted text-center">{{ $data_role['name'] }}</p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Status</b> <a class="float-right">
                                            @if (Auth::user()->is_active === 'Y')
                                                {{ __('Akun Telah Aktif') }}
                                            @else
                                                {{ __('Akun Tidak Aktif (butuh verifikasi)') }}
                                            @endif
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Dibuat</b> <a class="float-right">{{ Auth::user()->created_at }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Di Update</b> <a class="float-right">{{ Auth::user()->updated_at }}</a>
                                    </li>
                                </ul>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="btn btn-primary btn-block"><b>Logout</b></button>
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- About Me Box -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">About Me</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong><i class="fas fa-book mr-1"></i> Education</strong>

                                <p class="text-muted">
                                    @if ($data_profile['education'])
                                        {{ $data_profile['education'] }}
                                    @else
                                        {{ __('education belum ada') }}
                                    @endif
                                </p>

                                <hr>

                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                                <p class="text-muted">
                                    @if ($data_profile['location'])
                                        {{ $data_profile['location'] }}
                                    @else
                                        {{ __('location belum ada') }}
                                    @endif
                                </p>

                                <hr>

                                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                                <p class="text-muted">
                                    <span class="tag tag-danger">
                                        @if ($data_profile['skill'])
                                            {{ $data_profile['skill'] }}
                                        @else
                                            {{ __('skill belum ada') }}
                                        @endif
                                    </span>
                                </p>

                                <hr>

                                <strong><i class="far fa-file-alt mr-1"></i> About Me</strong>

                                <p class="text-muted">
                                    @if ($data_profile['about_me'])
                                        {{ $data_profile['about_me'] }}
                                    @else
                                        {{ __('about me belum ada') }}
                                    @endif
                                </p>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#activity"
                                            data-toggle="tab">Activity</a></li>
                                    @if (Auth::user()->id_role === 3)
                                        <li class="nav-item"><a class="nav-link" href="#timeline"
                                                data-toggle="tab">Timeline</a>
                                    @endif
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
                                    </li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="activity">
                                        <!-- Post -->
                                        @foreach ($activity as $a)
                                            <div class="post">
                                                <div class="user-block">
                                                    <img class="img-circle img-bordered-sm"
                                                        src="{{ url('photo_profile', $a->photo) }}" alt="user image">
                                                    <span class="username">
                                                        <a href="#">{{ $a->nama }}</a>
                                                    </span>
                                                    <span class="description">{{ $a->created_at }}</span>
                                                </div>
                                                <!-- /.user-block -->
                                                <p>
                                                    {{ $a->keterangan }}.
                                                    @if ($a->status === 'diterima')
                                                        <span class="badge badge-success right">{{ $a->status }}</span>
                                                    @elseif($a->status === 'ditolak')
                                                        <span class="badge badge-danger right">{{ $a->status }}</span>
                                                    @else
                                                        <span class="badge badge-info right">{{ $a->status }}</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <!-- /.post -->
                                        @endforeach

                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="timeline">
                                        <!-- The timeline -->
                                        <div class="timeline timeline-inverse">
                                            <!-- /.timeline-label -->
                                            <!-- timeline item -->
                                            @foreach ($timeLineUsulanAnggaran as $u)
                                                @if ($u->user_id === Auth::user()->id)
                                                    @if ($u->status === 'diterima')
                                                        <div>
                                                            <i class="fas fa-envelope bg-success"></i>

                                                            <div class="timeline-item">
                                                                <span class="time"><i class="far fa-clock"></i>
                                                                    {{ $u->created_at }}</span>

                                                                <h3 class="timeline-header"><a
                                                                        href="#">{{ $data_profile['nama_lengkap'] }}</a>
                                                                    {{ $u->status }}</h3>

                                                                <div class="timeline-body">
                                                                  {{ $u->keterangan }}
                                                                </div>
                                                                <div class="timeline-footer">
                                                                    <a href="#"
                                                                        class="btn btn-success btn-sm">{{ $u->status }}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @elseif($u->status === 'ditolak')
                                                        <div>
                                                            <i class="fas fa-envelope bg-danger"></i>

                                                            <div class="timeline-item">
                                                                <span class="time"><i class="far fa-clock"></i>
                                                                    12:05</span>

                                                                <h3 class="timeline-header"><a
                                                                        href="#">{{ $data_profile['nama_lengkap'] }}</a>
                                                                    {{ $u->status }}</h3>

                                                                <div class="timeline-body">
                                                                    {{ $u->keterangan }}
                                                                </div>
                                                                <div class="timeline-footer">
                                                                    <a href="#"
                                                                        class="btn btn-danger btn-sm">{{ $u->status }}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <!-- END timeline item -->
                                                        <!-- timeline item -->
                                                        <div>
                                                            <i class="fas fa-user bg-info"></i>

                                                            <div class="timeline-item">
                                                                <span class="time"><i class="far fa-clock"></i>
                                                                    {{ $u->created_at }}</span>

                                                                <h3 class="timeline-header border-0"><a
                                                                        href="#">{{ $data_profile['nama_lengkap'] }}</a>
                                                                    {{ $u->status }}
                                                                </h3>
                                                            </div>
                                                        </div>
                                                        <!-- END timeline item -->
                                                        <div>
                                                            <i class="far fa-clock bg-gray"></i>
                                                        </div>
                                                        <br>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->

                                    <div class="tab-pane" id="settings">
                                        <form class="form-horizontal" action="{{ route('profile.submit') }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-2 col-form-label">Nama
                                                    Lengkap</label>
                                                <div class="col-sm-10">
                                                    <input type="text"
                                                        class="form-control @error('nama_lengkap')
                                                        'is-invalid'
                                                    @enderror"
                                                        id="inputName" placeholder="Name" name="nama_lengkap"
                                                        value="{{ $data_profile['nama_lengkap'] }}">
                                                    @error('nama_lengkap')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail" class="col-sm-2 col-form-label">Username</label>
                                                <div class="col-sm-10">
                                                    <input type="text"
                                                        class="form-control  @error('username')
                                                    'is-invalid'
                                                @enderror"
                                                        id="inputEmail" placeholder="Username" name="username"
                                                        value="{{ Auth::user()->username }}">
                                                    @error('username')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail" class="col-sm-2 col-form-label">education</label>
                                                <div class="col-sm-10">
                                                    <input type="text"
                                                        class="form-control  @error('education')
                                                    'is-invalid'
                                                @enderror"
                                                        id="inputEmail" placeholder="education" name="education"
                                                        value="{{ $data_profile['education'] }}">
                                                    @error('education')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail" class="col-sm-2 col-form-label">location</label>
                                                <div class="col-sm-10">
                                                    <input type="text"
                                                        class="form-control  @error('location')
                                                    'is-invalid'
                                                @enderror"
                                                        id="inputEmail" placeholder="location" name="location"
                                                        value="{{ $data_profile['location'] }}">
                                                    @error('location')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail" class="col-sm-2 col-form-label">skill</label>
                                                <div class="col-sm-10">
                                                    <input type="text"
                                                        class="form-control  @error('skill')
                                                    'is-invalid'
                                                @enderror"
                                                        id="inputEmail" placeholder="skill" name="skill"
                                                        value="{{ $data_profile['skill'] }}">
                                                    @error('skill')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail" class="col-sm-2 col-form-label">about me</label>
                                                <div class="col-sm-10">
                                                    <input type="text"
                                                        class="form-control  @error('about_me')
                                                    'is-invalid'
                                                @enderror"
                                                        id="inputEmail" placeholder="about_me" name="about_me"
                                                        value="{{ $data_profile['about_me'] }}">
                                                    @error('about_me')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName2" class="col-sm-2 col-form-label">Password</label>
                                                <div class="col-sm-10">
                                                    <input type="password"
                                                        class="form-control  @error('password')
                                                    'is-invalid'
                                                @enderror"
                                                        id="inputName2" name="password" placeholder="Password">
                                                    @error('password')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName2" class="col-sm-2 col-form-label">Password
                                                    Confirmation</label>
                                                <div class="col-sm-10">
                                                    <input type="password"
                                                        class="form-control  @error('password-confirmation')
                                                    'is-invalid'
                                                @enderror"
                                                        id="inputName2" name="password-confirmation"
                                                        placeholder="Password Confirmation">
                                                    @error('password-confirmation')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName2" class="col-sm-2 col-form-label">photos</label>
                                                <div class="col-sm-10">
                                                    <div class="custom-file">
                                                        <input type="file"
                                                            class="custom-file-input @error('photos') is-invalid @enderror"
                                                            name="photos" id="exampleInputFile">
                                                        <label class="custom-file-label" for="exampleInputFile">Pilih
                                                            Photos</label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Upload</span>
                                                    </div>
                                                    @error('photos')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button type="submit" class="btn btn-danger">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
