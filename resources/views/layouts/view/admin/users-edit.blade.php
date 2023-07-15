@extends('layouts.app')

@section('title', 'edit data')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Data</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('admin.users') }}">Master Data</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Data</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('admin.users-update', $id->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text"
                                            class="form-control @error('name')
                                            is-invalid
                                        @enderror"
                                            name="name" id="exampleInputEmail1" placeholder="Masukan Name"
                                            value="{{ $id->name }}">
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
                                            value="{{ $id->username }}">
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
                                                    class="custom-file-input @error('skfile')
                                                    is-invalid
                                                @enderror"
                                                    name="skfile" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Pilih File</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                        @error('skfile')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
