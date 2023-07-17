@extends('layouts.app')

@section('title', 'Pagu Management')

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
                            <h3 class="card-title">Pagu Management</h3>
                            <br>
                            <br>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-outline-primary btn-block" data-toggle="modal"
                                    data-target="#tambahData-lg"><i class="fa fa-edit"></i>
                                    Tambah Pagu
                                </button>
                            </div>


                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Alokasi Anggaran</th>
                                        <th>Anggaran</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->jenis_alokasi_anggaran }}
                                        </td>
                                        <td>{{ $item->anggaran }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info">Detail</button>
                                                <button type="button" class="btn btn-info dropdown-toggle dropdown-icon"
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
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Alokasi Anggaran</th>
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
                    <h4 class="modal-title">Tambah Data Pagu</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.users-stores') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jenis Alokasi Anggaran</label>
                                <input type="text" class="form-control @error('name')
                                        is-invalid
                                    @enderror" name="jenis_alokasi_anggaran" id="exampleInputEmail1"
                                    placeholder="Masukan Jenis Alokasi Anggaran"
                                    value="{{ old('jenis_alokasi_anggaran') }}">
                                @error('jenis_alokasi_anggaran')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="col-sm-14">
                                    <!-- select -->
                                    <label>Anggaran</label>
                                    <select class="custom-select" name="bagian">
                                        <option>Bagian 1</option>
                                        <option>Bagian 2</option>
                                    </select>
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

@endsection