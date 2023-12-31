<?php $__env->startSection('title', 'Pagu Management'); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Pagu Management</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
                            <li class="breadcrumb-item active"><a href="<?php echo e(route('admin.users')); ?>">Master Data</a></li>
                        </ol>
                    </div>
                </div>
                <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> Success!</h5>
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>
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
                                        Tambah Data Anggaran
                                    </button>
                                    <button type="button" class="btn btn-outline-primary btn-block" data-toggle="modal"
                                        data-target="#tambahDatapagu-lg"><i class="fa fa-edit"></i>
                                        Tambah Data Pagu
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
                                        <?php $__currentLoopData = $listpagu->groupBy('jenis_alokasi_anggaran'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jenisAlokasi => $paguItems): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><?php echo e($jenisAlokasi); ?>

                                                </td>
                                                <td>
                                                    <?php $__currentLoopData = $paguItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pagu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php echo e($pagu->anggaran->keterangan); ?><br>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                                                href="#editModal<?php echo e($jenisAlokasi); ?>"
                                                                data-toggle="modal">Edit</a>
                                                            <form id="delete-pagu-form-<?php echo e($jenisAlokasi); ?>"
                                                                action="<?php echo e(route('delete_pagu', $jenisAlokasi)); ?>"
                                                                method="POST">
                                                                <?php echo method_field('delete'); ?>
                                                                <?php echo csrf_field(); ?>
                                                                <button
                                                                    onclick="event.preventDefault(); confirmDeletePagu('<?php echo e($jenisAlokasi); ?>')"class="dropdown-item editBtn"
                                                                    type="submit">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                        <form action="<?php echo e(route('tambah_anggaran')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
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
                        <form action="<?php echo e(route('tambah_pagu')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="jenis_alokasi_anggaran">Jenis Alokasi Anggaran</label>
                                <input type="text" class="form-control" id="jenis_alokasi_anggaran"
                                    name="jenis_alokasi_anggaran">
                            </div>
                            <div class="form-group">
                                <label for="anggaran_kodeakun">Anggaran Kode Akun</label>
                                <select class="form-control" id="anggaran_kodeakun" name="anggaran_kodeakun">
                                    <option value="">Pilih Anggaran Kode Akun</option>
                                    <?php $__currentLoopData = $anggarans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $anggaran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($anggaran->id); ?>"><?php echo e($anggaran->keterangan); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
        
        <?php $__currentLoopData = $listpagu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pagu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="modal fade" id="editModal<?php echo e($pagu->jenis_alokasi_anggaran); ?>">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="editModal<?php echo e($pagu->jenis_alokasi_anggaran); ?>">Edit Data Pagu</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo e(route('edit_pagu', $pagu->jenis_alokasi_anggaran)); ?>" method="POST">
                                <?php echo method_field('put'); ?>
                                <?php echo csrf_field(); ?>
                                <div class="form-group">
                                    <label for="jenis_alokasi_anggaran">Jenis Alokasi Anggaran</label>
                                    <input type="text" class="form-control" id="jenis_alokasi_anggaran"
                                        name="jenis_alokasi_anggaran" value="<?php echo e($pagu->jenis_alokasi_anggaran); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="anggaran_kodeakun">Anggaran Kode Akun</label>
                                    <select class="form-control" id="anggaran_kodeakun" name="anggaran_kodeakun">
                                        <option value="">Pilih Anggaran Kode Akun</option>
                                        <?php $__currentLoopData = $anggarans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $anggaran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($anggaran->id); ?>"
                                                <?php echo e($pagu->anggaran_kodeakun === $anggaran->id ? 'selected' : ''); ?>>
                                                <?php echo e($anggaran->keterangan); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['photos' => $photos['photos'], 'nama_lengkap' => $photos['nama_lengkap']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mjcutter/stagging-sipp.mjcutter.com/resources/views/layouts/view/admin/pagu.blade.php ENDPATH**/ ?>