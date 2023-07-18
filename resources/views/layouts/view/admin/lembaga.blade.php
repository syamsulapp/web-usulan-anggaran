@extends('layouts.app')

@section('title', 'Lembaga(Bagian) Management')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Lembaga(Bagian) Management</h1>
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
                            <h3 class="card-title">Lembaga(Bagian) Management</h3>
                            <br>
                            <br>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-outline-primary btn-block" data-toggle="modal"
                                    data-target="#tambahData-lg"><i class="fa fa-edit"></i>
                                    Tambah Data Lembaga(Bagian)
                                </button>
                            </div>


                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Lembaga</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listlembaga as $lembaga)
                                    <tr>

                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $lembaga->nama_lembaga }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info">Detail</button>
                                                <button type="button" class="btn btn-info dropdown-toggle dropdown-icon"
                                                    data-toggle="dropdown">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu" role="menu">
                                                    <a href="#editModal{{ $lembaga->id }}" class="dropdown-item editBtn"
                                                        data-toggle="modal">
                                                        Edit
                                                    </a>



                                                    <form id="delete-form-{{ $lembaga->id }}"
                                                        action="{{ route('lembaga.destroy', $lembaga->id) }}"
                                                        method="POST">
                                                        @method('delete')
                                                        @csrf
                                                        <button
                                                            onclick="event.preventDefault(); confirmDelete('{{ $lembaga->id }}')"
                                                            class="dropdown-item deleteBtn"
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
                                        <th>Nama Lembaga</th>
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

    {{-- MODAL TAMBAH --}}
    <div class="modal fade" id="tambahData-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Lembaga</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('lembaga-store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>Nama Lembaga</label>
                            <input type="text" class="form-control @error('nama_lembaga') is-invalid @enderror"
                                name="nama_lembaga" id="nama_lembaga" placeholder="Masukkan Nama Lembaga"
                                value="{{ old('nama_lembaga') }}">
                            @error('nama_lembaga')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- MODAL TAMBAH --}}

    <!-- Modal Edit -->
    @foreach ($listlembaga as $lembaga)
    <!-- Modal Edit -->
    <div class="modal fade" id="editModal{{ $lembaga->id }}" tabindex="-1" role="dialog"
        aria-labelledby="editModal{{ $lembaga->id }}Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="editModal{{ $lembaga->id }}Label">Edit Lembaga</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('lembaga.update', $lembaga->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="editNamaLembaga{{ $lembaga->id }}">Nama Lembaga</label>
                            <input type="text" class="form-control" id="editNamaLembaga{{ $lembaga->id }}"
                                name="nama_lembaga" value="{{ $lembaga->nama_lembaga }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach


    {{-- MODAL EDIT --}}

</div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
</div>

@endsection