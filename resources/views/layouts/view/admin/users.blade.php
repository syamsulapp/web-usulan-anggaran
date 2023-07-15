@extends('layouts.app')

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
                                            <th>Name</th>
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
                                                <td>{{ $item->name }}
                                                </td>
                                                <td>{{ $item->username }}</td>
                                                <td>
                                                    @if ($item->is_active === 'Y')
                                                        {{ __('Akun Aktif') }}
                                                    @else
                                                        {{ __('Akun Belum Aktif') }}
                                                    @endif
                                                </td>
                                                <td>{{ $item->role }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info">Detail</button>
                                                        <button type="button"
                                                            class="btn btn-info dropdown-toggle dropdown-icon"
                                                            data-toggle="dropdown">
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <div class="dropdown-menu" role="menu">
                                                            <a class="dropdown-item editBtn"
                                                                href="{{ route('admin.users-edit', $item->id) }}">Edit</a>
                                                            <form action="{{ route('admin.users-delete', $item->id) }}"
                                                                method="POST">
                                                                @method('delete')
                                                                @csrf
                                                                <button class="dropdown-item editBtn"
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
                                                            <form action="{{ route('admin.users-activate', $item->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <button class="dropdown-item">Active</button>
                                                            </form>
                                                            <form action="{{ route('admin.users-inactive', $item->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <button class="dropdown-item">Inactive</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
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
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text"
                                        class="form-control @error('name')
                                        is-invalid
                                    @enderror"
                                        name="name" id="exampleInputEmail1" placeholder="Masukan Name"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Username</label>
                                    <input type="text"
                                        class="form-control @error('username')
                                    is-invalid
                                @enderror"
                                        name="username" id="exampleInputEmail1" placeholder="Masukan Username"
                                        value="{{ old('name') }}">
                                    @error('username')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password"
                                        class="form-control @error('password')
                                        is-invalid
                                    @enderror"
                                        name="password" id="exampleInputPassword1" placeholder="Password"
                                        value="{{ old('name') }}">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-14">
                                        <!-- select -->
                                        <label>Pilih Tipe</label>
                                        <select class="custom-select" name="tipe">
                                            <option>Tipe 1</option>
                                            <option>Tipe 2</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-14">
                                        <!-- select -->
                                        <label>Pilih Bagian</label>
                                        <select class="custom-select" name="bagian">
                                            <option>Bagian 1</option>
                                            <option>Bagian 2</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-14">
                                        <!-- select -->
                                        <label>Pilih Role</label>
                                        <select class="custom-select" name="role">
                                            <option>suepradmin</option>
                                            <option>admin</option>
                                            <option>user</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-14">
                                        <!-- select -->
                                        <label>status</label>
                                        <select class="custom-select" name="is_active">
                                            <option value="Y">aktif</option>
                                            <option value="N">non-aktif</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Surat Keterangan</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file"
                                                class="custom-file-input @error('surat_keterangan')
                                                is-invalid
                                            @enderror"
                                                name="surat_keterangan" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Pilih File</label>
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
    </div>

    @yield('scripts')

@endsection
