@extends('layouts.app', ['photos' => $photos['photos'], 'nama_lengkap' => $photos['nama_lengkap']])

@section('title', 'verifikasi usulan')

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
                            <li class="breadcrumb-item active"><a href="{{ route('admin.users') }}">Usulan</a></li>
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
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Danger!</h5>
                        {{ session('error') }}
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
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Status Akun</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($verifikasiUsulan as $item)
                                            @if ($item->id_role == 3)
                                                <tr>
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
                                                            <button type="button" class="btn btn-dark">Usulan</button>
                                                            <button type="button"
                                                                class="btn btn-warning dropdown-toggle dropdown-icon"
                                                                data-toggle="dropdown">
                                                                <span class="sr-only">Toggle Dropdown</span>
                                                            </button>
                                                            <div class="dropdown-menu" role="menu">
                                                                {{-- Verify users --}}
                                                                <a class="dropdown-item"
                                                                    href="{{ route('superadmin.show-usulan', $item->id) }}">Lihat
                                                                    Usulan</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
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
    </div>

    @yield('scripts')
@endsection
