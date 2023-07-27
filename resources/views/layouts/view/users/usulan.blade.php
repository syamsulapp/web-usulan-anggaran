@extends('layouts.app', ['photos' => $photos['photos'], 'nama_lengkap' => $photos['nama_lengkap']])

@section('title', 'Usulan Anggaran')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Usulan Anggaran</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Usulan Anggaran</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-check"></i> Success!</h5>
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-check"></i> Error!</h5>
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="callout callout-info">
                            <h5><i class="fas fa-info"></i> Note:</h5>
                            Pastikan Usulan Yang Anda Lakukan Sesuai Prosedur
                        </div>

                        <!-- Main content -->
                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <i class="nav-icon far fa-share-square"></i> Data Usulan Anggaran.
                                        <small class="float-right">Date: {{ date('d/m/Y') }} </small>
                                    </h4>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    <address>
                                        <strong>Pagu.</strong><br>
                                        795 Folsom Ave, Suite 600<br>
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    <address>
                                        <strong>Uraian</strong><br>
                                        795 Folsom Ave, Suite 600<br>
                                    </address>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    <address>
                                        <strong>Users</strong><br>
                                        {{ Auth::user()->username }}<br>
                                    </address>
                                </div>
                            </div>
                            <!-- /.row -->

                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nama Barang</th>
                                                <th>Volume</th>
                                                <th>Harga Satuan</th>
                                                <th>Satuan Total</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($usulanList as $item)
                                                @if ($item->user_id === Auth::user()->id)
                                                    <tr>
                                                        <td>{{ $item->nama_barang }}</td>
                                                        <td>{{ $item->volume }}</td>
                                                        <td>{{ $item->harga_satuan }}</td>
                                                        <td>{{ $item->satuan }}</td>
                                                        <td>Rp.{{ $item->total }}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <!-- /.col -->
                                <div class="col-6">
                                    <p class="lead">Total Anggaran</p>

                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th style="width:50%">Subtotal:</th>
                                                <td>Rp.500.000</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- this row will not appear when printing -->
                            <div class="row no-print">
                                <div class="col-12">
                                    {{-- <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i
                                            class="fas fa-print"></i> Print</a> --}}
                                    <button type="button" class="btn btn-success float-right"><i
                                            class="far fa-credit-card"></i> Submit Anggaran
                                    </button>
                                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                        <i class="fas fa-plus-circle" data-target="#tambahAnggaran" data-toggle="modal"></i>
                                        Tambah Anggaran
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- /.invoice -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    {{-- forms tambah anggaran --}}
    <div class="modal fade" id="tambahAnggaran">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Anggaran</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.submit_usulan') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <div class="col-sm-14">
                                    <!-- uraian -->
                                    <label>Uraian</label>
                                    <select class="custom-select" name="uraian_id">
                                        @foreach ($uraian as $u)
                                            <option value="{{ $u->id }}">{{ $u->nama_kegiatan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-14">
                                    <!-- pagu -->
                                    <label>pagu</label>
                                    <select class="custom-select" name="pagu_id">
                                        @foreach ($pagu as $p)
                                            <option value="{{ $p->id }}">{{ $p->jenis_alokasi_anggaran }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama_barang">Nama Barang</label>
                                <input type="text"
                                    class="form-control @error('nama_barang')
                                is-invalid
                            @enderror"
                                    name="nama_barang" id="nama_barang" placeholder="Masukan nama barang"
                                    value="{{ old('nama_barang') }}">
                                @error('nama_barang')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="volume">Volume</label>
                                <input type="text"
                                    class="form-control @error('volume')
                                is-invalid
                            @enderror"
                                    name="volume" id="volume" placeholder="Masukan volume" value="{{ old('volume') }}">
                                @error('volume')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="harga_satuan">Harga Satuan</label>
                                <input type="text"
                                    class="form-control @error('harga_satuan')
                                is-invalid
                            @enderror"
                                    name="harga_satuan" id="harga_satuan" placeholder="Masukan harga satuan"
                                    value="{{ old('harga_satuan') }}">
                                @error('harga_satuan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="satuan">Satuan</label>
                                <input type="text"
                                    class="form-control @error('satuan')
                                is-invalid
                            @enderror"
                                    name="satuan" id="satuan" placeholder="Masukan satuan"
                                    value="{{ old('satuan') }}">
                                @error('satuan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="total">Total</label>
                                <input type="text"
                                    class="form-control @error('total')
                                is-invalid
                            @enderror"
                                    name="total" id="total" placeholder="Masukan total"
                                    value="{{ old('total') }}">
                                @error('total')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @yield('scripts')

@endsection
