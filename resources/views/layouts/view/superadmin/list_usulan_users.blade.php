@extends('layouts.app', ['photos' => $photos['photos'], 'nama_lengkap' => $photos['nama_lengkap']])

@section('title', 'Verifikasi Usulan')

@section('content')
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Verifikasi Usulan</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('admin.users') }}">Verify Usulan</a></li>
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
                            Harap Di verifikasi dengan sebaik mungkin
                        </div>

                        <!-- Main content -->
                        <div class="invoice p-3 mb-3">
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <i class="nav-icon far fa-share-square"></i> Data Usulan Anggaran.
                                    </h4>
                                </div>
                                <!-- /.col -->
                            </div>
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
                                            @foreach ($listUsulanByUsers as $u)
                                                <tr>
                                                    <td>{{ $u->nama_barang }}</td>
                                                    <td>{{ $u->volume }}</td>
                                                    <td>{{ 'Rp.' . number_format($u->harga_satuan, 0, ',', '.') }}
                                                    </td>
                                                    <td>{{ $u->satuan }}</td>
                                                    <td>{{ 'Rp.' . number_format($u->total, 0, ',', '.') }}</td>
                                                </tr>
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
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th style="width:50%">Total:</th>
                                                <td>{{ 'Rp.' . number_format($totalRincianUsulan->total, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- this row will not appear when printing -->
                            {{-- modals usulan verify diterima --}}
                            <div class="row no-print">
                                <div class="col-12">
                                    <!-- verify usulan-->
                                    <form id="menyetujui-usulan-{{ $totalRincianUsulan->user_id }}"
                                        action="{{ route('superadmin.verify-usulan-post', [$totalRincianUsulan->user_id, $photos['nama_lengkap'], $queryProfle->nama_lengkap, $photos['photos']]) }}"
                                        method="GET">
                                        @csrf
                                        <input type="text" name="status" value="diterima" hidden>
                                        <button type="submit" name="status" class="btn btn-success float-right"
                                            onclick="event.preventDefault();confirmVerifyUsulan('{{ $totalRincianUsulan->user_id }}') "
                                            value="disetujui"><i class="far fa-check-circle"></i> Disetujui
                                        </button>
                                    </form>
                                    <a href="#notVerifyUsulan" name="status" style="margin-right: 5px;" data-toggle="modal"
                                        class="btn btn-danger float-right"><i class="far fa-check-circle"></i> Ditolak
                                    </a>
                                </div>
                            </div>

                            {{-- modals usulan not verify --}}
                            <div class="modal fade" id="notVerifyUsulan">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Usulan Di Tolak</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="tidak-menyetujui-usulan-{{ $totalRincianUsulan->user_id }}"
                                                action="{{ route('superadmin.not-verify-usulan-post', [$totalRincianUsulan->user_id, $photos['nama_lengkap'], $queryProfle->nama_lengkap, $photos['photos']]) }}"
                                                method="GET">
                                                @csrf
                                                <div class="card-body">
                                                    <input type="text" name="status" value="ditolak" hidden>
                                                    <textarea class="form-control" rows="3" placeholder="Enter Alasan Di tolak..." name="keterangan"></textarea>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="submit" style="margin-right: 5px;"
                                                        onclick="event.preventDefault(); confirmNotVerifyUsulan('{{ $totalRincianUsulan->user_id }}')"
                                                        class="btn btn-info float-right"><i class="far fa-check-circle"></i>
                                                        Save
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        </div>
                        <!-- /.invoice -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
    @yield('scripts')
@endsection
