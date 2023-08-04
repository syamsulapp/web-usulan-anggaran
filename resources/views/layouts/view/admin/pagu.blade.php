@extends('layouts.app', ['photos' => $photos['photos'], 'nama_lengkap' => $photos['nama_lengkap']])

@section('title', 'Pagu Management')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Nama Akun</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('admin.users') }}">Master Data</a></li>
                        </ol>
                    </div>
                </div>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> Success!</h5>
                        {{ session('success') }}
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
                                <h3 class="card-title">Nama Akun Management</h3>
                                <br>
                                <br>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-outline-primary btn-block" data-toggle="modal"
                                        data-target="#tambahData-lg"><i class="fa fa-edit"></i>
                                        Tambah Data Anggaran
                                    </button>
                                    <button type="button" class="btn btn-outline-primary btn-block" data-toggle="modal"
                                        data-target="#tambahDatapagu-lg"><i class="fa fa-edit"></i>
                                        Tambah Data Akun
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
                                        @foreach ($listpagu->groupBy('jenis_alokasi_anggaran') as $jenisAlokasi => $paguItems)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $jenisAlokasi }}
                                                </td>
                                                <td>
                                                    @foreach ($paguItems as $pagu)
                                                        {{ $pagu->anggaran->keterangan }}<br>
                                                    @endforeach
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
                                                            <a class="dropdown-item editBtn"
                                                                href="#editModal{{ $jenisAlokasi }}"
                                                                data-toggle="modal">Edit</a>
                                                            <form id="delete-pagu-form-{{ $jenisAlokasi }}"
                                                                action="{{ route('delete_pagu', $jenisAlokasi) }}"
                                                                method="POST">
                                                                @method('delete')
                                                                @csrf
                                                                <button
                                                                    onclick="event.preventDefault(); confirmDeletePagu('{{ $jenisAlokasi }}')"class="dropdown-item editBtn"
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
                                            <th>Anggaran</th>
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
        {{-- tambah anggaran --}}
        <div class="modal fade" id="tambahData-lg">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Data Anggaran</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('tambah_anggaran') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" class="form-control" id="keterangan" name="keterangan">
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah Anggaran</button>
                        </form>

                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        {{-- tambah pagu --}}
        <div class="modal fade" id="tambahDatapagu-lg">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Data Pagu</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('tambah_pagu') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="jenis_alokasi_anggaran">Jenis Alokasi Anggaran</label>
                                <input type="text" class="form-control" id="jenis_alokasi_anggaran"
                                    name="jenis_alokasi_anggaran">
                            </div>
                            <div class="form-group">
                                <label for="anggaran_kodeakun">Anggaran Kode Akun</label>
                                <select class="form-control" id="anggaran_kodeakun" name="anggaran_kodeakun">
                                    <option value="">Pilih Anggaran Kode Akun</option>
                                    @foreach ($anggarans as $anggaran)
                                        <option value="{{ $anggaran->id }}">{{ $anggaran->keterangan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Pagu</button>
                        </form>

                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        {{-- edit pagu --}}
        @foreach ($listpagu as $pagu)
            <div class="modal fade" id="editModal{{ $pagu->jenis_alokasi_anggaran }}">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="editModal{{ $pagu->jenis_alokasi_anggaran }}">Edit Data Pagu</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('edit_pagu', $pagu->jenis_alokasi_anggaran) }}" method="POST">
                                @method('put')
                                @csrf
                                <div class="form-group">
                                    <label for="jenis_alokasi_anggaran">Jenis Alokasi Anggaran</label>
                                    <input type="text" class="form-control" id="jenis_alokasi_anggaran"
                                        name="jenis_alokasi_anggaran" value="{{ $pagu->jenis_alokasi_anggaran }}">
                                </div>
                                <div class="form-group">
                                    <label for="anggaran_kodeakun">Anggaran Kode Akun</label>
                                    <select class="form-control" id="anggaran_kodeakun" name="anggaran_kodeakun">
                                        <option value="">Pilih Anggaran Kode Akun</option>
                                        @foreach ($anggarans as $anggaran)
                                            <option value="{{ $anggaran->id }}"
                                                {{ $pagu->anggaran_kodeakun === $anggaran->id ? 'selected' : '' }}>
                                                {{ $anggaran->keterangan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Update Pagu</button>
                            </form>

                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        @endforeach
    </div>

@endsection
