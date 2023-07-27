@extends('layouts.app', ['photos' => $photos['photos'], 'nama_lengkap' => $photos['nama_lengkap']])

@section('title', 'Users Management')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Users Management</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('admin.users') }}">Master Data</a></li>
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
                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                        {{ session('alertError') }}
                    </div>
                @endif
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Users Management</h3>
                                <br>
                                <br>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-outline-primary btn-block" data-toggle="modal"
                                        data-target="#tambahData-lg"><i class="fa fa-edit"></i>
                                        tambah users
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Username</th>
                                            <th>Status Akun</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                </td>
                                                <td>{{ $item->username }}</td>
                                                <td>
                                                    @if ($item->is_active === 'Y')
                                                        {{ __('Akun Aktif') }}
                                                    @else
                                                        {{ __('Akun Belum Aktif') }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->id_role === 1)
                                                        {{ __('SuperAdmin') }}
                                                    @elseif($item->id_role === 2)
                                                        {{ __('Admin') }}
                                                    @else
                                                        {{ __('User') }}
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info">Detail</button>
                                                        <button type="button"
                                                            class="btn btn-info dropdown-toggle dropdown-icon"
                                                            data-toggle="dropdown">
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <div class="dropdown-menu" role="menu">
                                                            {{-- edit users --}}
                                                            <a class="dropdown-item editBtn"
                                                                href="#editModal{{ $item->id }}"
                                                                data-toggle="modal">Edit</a>
                                                            {{-- delete users --}}
                                                            <form id="delete-users-form-{{ $item->id }}"
                                                                action="{{ route('admin.users-delete', $item->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('delete')
                                                                <button
                                                                    onclick="event.preventDefault(); confirmDeleteUsers('{{ $item->id }}')"
                                                                    class="dropdown-item activeBtn"
                                                                    type="submit">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-dark">Account</button>
                                                        <button type="button"
                                                            class="btn btn-warning dropdown-toggle dropdown-icon"
                                                            data-toggle="dropdown">
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <div class="dropdown-menu" role="menu">
                                                            {{-- Verify users --}}
                                                            <a class="dropdown-item editBtn"
                                                                href="#verifyModal{{ $item->id }}"
                                                                data-toggle="modal">Verify</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Username</th>
                                            <th>Status Akun</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        {{-- modals tambah --}}
        <div class="modal fade" id="tambahData-lg">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Data Users</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.users-stores') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text"
                                        class="form-control @error('username')
                                    is-invalid
                                @enderror"
                                        name="username" id="username" placeholder="Masukan Username"
                                        value="{{ old('username') }}">
                                    @error('username')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password"
                                        class="form-control @error('password')
                                        is-invalid
                                    @enderror"
                                        name="password" id="password" placeholder="Password"
                                        value="{{ old('password') }}">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-14">
                                        <!-- lembaga -->
                                        <label>Lembaga</label>
                                        <select class="custom-select" name="id_lembaga">
                                            @foreach ($lembaga as $l)
                                                <option value="{{ $l->id }}">{{ $l->nama_lembaga }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-14">
                                        <!-- lembaga -->
                                        <label>Role</label>
                                        <select class="custom-select" name="id_role">
                                            @foreach ($role as $r)
                                                <option value="{{ $r->id }}">{{ $r->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="surat_keterangan">Surat Keterangan</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file"
                                                class="custom-file-input @error('surat_keterangan')
                                                is-invalid
                                            @enderror"
                                                name="surat_keterangan" id="surat_keterangan">
                                            <label class="custom-file-label" for="surat_keterangan">Pilih File</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                    @error('surat_keterangan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        {{-- modals edit data --}}
        @foreach ($users as $item)
            <div class="modal fade" id="editModal{{ $item->id }}">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="editModal{{ $item->id }}">Edit Users</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.users-update', $item->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text"
                                            class="form-control @error('username')
                                    is-invalid
                                @enderror"
                                            name="username" id="username" placeholder="Masukan Username"
                                            value="{{ $item->username }}">
                                        @error('username')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password"
                                            class="form-control @error('password')
                                        is-invalid
                                    @enderror"
                                            name="password" id="password" placeholder="Password"
                                            value="{{ old('password') }}">
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-14">
                                            <!-- lembaga -->
                                            <label>Lembaga</label>
                                            <select class="custom-select" name="id_lembaga">
                                                @foreach ($lembaga as $l)
                                                    <option
                                                        value="{{ $l->id }}"{{ $item->id_lembaga === $l->id ? 'selected' : '' }}>
                                                        {{ $l->nama_lembaga }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-14">
                                            <!-- lembaga -->
                                            <label>Role</label>
                                            <select class="custom-select" name="id_role">
                                                @foreach ($role as $r)
                                                    <option value="{{ $r->id }}"
                                                        {{ $item->id_role === $r->id ? 'selected' : '' }}>
                                                        {{ $r->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="surat_keterangan">Surat Keterangan</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input @error('surat_keterangan')
                                                is-invalid
                                            @enderror"
                                                    name="surat_keterangan" id="surat_keterangan">
                                                <label class="custom-file-label" for="surat_keterangan">Pilih File</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                        @error('surat_keterangan')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        @endforeach


        {{-- modals verify data --}}
        @foreach ($users as $item)
            <div class="modal fade" id="verifyModal{{ $item->id }}">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="verifyModal{{ $item->id }}">Verify Users</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-outline card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Surat Keterangan</h3>

                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                            <!-- /.card-tools -->
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            @if ($item->surat_keterangan)
                                                <p><b>Suket</b>: <a
                                                        href="{{ url('surat_keterangan', $item->surat_keterangan) }}"
                                                        target="_blank">Lihat File</a></p>
                                            @else
                                                <p><b>Suket</b>: Belum Ada</p>
                                            @endif
                                        </div>
                                        <!-- /.card-body -->
                                        <form id="verify-account-{{ $item->id }}"
                                            action="{{ route('admin.users-verify', $item->id) }}" method="POST">
                                            @csrf
                                            <div class="card-body">
                                                <input type="checkbox" id="verify" name="verify"
                                                    data-bootstrap-switch data-off-color="danger" data-on-color="success"
                                                    data-id="{{ $item->id }}" class="verify-account"
                                                    {{ $item->is_active === 'Y' ? 'checked' : '' }}>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button
                                                    onclick="event.preventDefault(); verifyAccount('{{ $item->id }}')"
                                                    type="submit" class="btn btn-primary">Verify</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.card -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        @endforeach
    </div>

    @yield('scripts')

@endsection
