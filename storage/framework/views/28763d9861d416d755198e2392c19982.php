<?php $__env->startSection('title', 'Verifikasi Usulan'); ?>

<?php $__env->startSection('content'); ?>
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
                            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
                            <li class="breadcrumb-item active"><a href="<?php echo e(route('admin.users')); ?>">Verify Usulan</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <?php if(session('success')): ?>
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-check"></i> Success!</h5>
                                <?php echo e(session('success')); ?>

                            </div>
                        <?php endif; ?>
                        <?php if(session('error')): ?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-check"></i> Error!</h5>
                                <?php echo e(session('error')); ?>

                            </div>
                        <?php endif; ?>
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
                                            <?php $__currentLoopData = $listUsulanByUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($u->nama_barang); ?></td>
                                                    <td><?php echo e($u->volume); ?></td>
                                                    <td><?php echo e('Rp.' . number_format($u->harga_satuan, 0, ',', '.')); ?>

                                                    </td>
                                                    <td><?php echo e($u->satuan); ?></td>
                                                    <td><?php echo e('Rp.' . number_format($u->total, 0, ',', '.')); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                                <td><?php echo e('Rp.' . number_format($totalRincianUsulan->total, 0, ',', '.')); ?>

                                                </td>
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
                                    <!-- verify usulan-->
                                    <form id="menyetujui-usulan-<?php echo e($totalRincianUsulan->user_id); ?>"
                                        action="<?php echo e(route('superadmin.verify-usulan-post')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <input type="text" name="status" value="diterima" hidden>
                                        <input type="text" name="user_id" value="<?php echo e($totalRincianUsulan->user_id); ?>"
                                            hidden>
                                        <input type="text" name="nama_users" value="<?php echo e($queryProfle->nama_lengkap); ?>"
                                            hidden>
                                        <input type="text" name="nama_approve" value="<?php echo e($photos['nama_lengkap']); ?>"
                                            hidden>
                                        <input type="text" name="photo" value="<?php echo e($photos['photos']); ?>" hidden>
                                        <button type="submit" name="status" class="btn btn-success float-right"
                                            onclick="event.preventDefault();confirmVerifyUsulan('<?php echo e($totalRincianUsulan->user_id); ?>') "
                                            value="disetujui"><i class="far fa-check-circle"></i> Disetujui
                                        </button>
                                    </form>
                                    <a href="#notVerifyUsulan" name="status" style="margin-right: 5px;" data-toggle="modal"
                                        class="btn btn-danger float-right"><i class="far fa-check-circle"></i> Ditolak
                                    </a>
                                </div>
                            </div>

                            
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
                                            <form id="tidak-menyetujui-usulan-<?php echo e($totalRincianUsulan->user_id); ?>"
                                                action="<?php echo e(route('superadmin.not-verify-usulan-post')); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <div class="card-body">
                                                    <input type="text" name="status" value="ditolak" hidden>
                                                    <input type="text" name="user_id"
                                                        value="<?php echo e($totalRincianUsulan->user_id); ?>" hidden>
                                                    <input type="text" name="nama_users"
                                                        value="<?php echo e($queryProfle->nama_lengkap); ?>" hidden>
                                                    <input type="text" name="nama_approve"
                                                        value="<?php echo e($photos['nama_lengkap']); ?>" hidden>
                                                    <input type="text" name="photo" value="<?php echo e($photos['photos']); ?>"
                                                        hidden>
                                                    <textarea class="form-control" rows="3" placeholder="Enter Alasan Di tolak..." name="keterangan"></textarea>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="submit" style="margin-right: 5px;"
                                                        onclick="event.preventDefault(); confirmNotVerifyUsulan('<?php echo e($totalRincianUsulan->user_id); ?>')"
                                                        class="btn btn-info float-right"><i
                                                            class="far fa-check-circle"></i>
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
    <?php echo $__env->yieldContent('scripts'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['photos' => $photos['photos'], 'nama_lengkap' => $photos['nama_lengkap']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mjcutter/stagging-sipp.mjcutter.com/resources/views/layouts/view/superadmin/list_usulan_users.blade.php ENDPATH**/ ?>