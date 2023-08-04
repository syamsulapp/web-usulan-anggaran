<?php $__env->startSection('title', 'verifikasi usulan'); ?>

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
                            <li class="breadcrumb-item active"><a href="<?php echo e(route('admin.users')); ?>">Usulan</a></li>
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
                <?php if(session('error')): ?>
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-exclamation-triangle"></i> Warning!</h5>
                        <?php echo e(session('error')); ?>

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
                                        <?php $__currentLoopData = $verifikasiUsulan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($item->id_role == 3): ?>
                                                <tr>
                                                    </td>
                                                    <td><?php echo e($item->username); ?></td>
                                                    <td>
                                                        <?php if($item->is_active === 'Y'): ?>
                                                            <?php echo e(__('Akun Aktif')); ?>

                                                        <?php else: ?>
                                                            <?php echo e(__('Akun Belum Aktif')); ?>

                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php if($item->id_role === 1): ?>
                                                            <?php echo e(__('SuperAdmin')); ?>

                                                        <?php elseif($item->id_role === 2): ?>
                                                            <?php echo e(__('Admin')); ?>

                                                        <?php else: ?>
                                                            <?php echo e(__('User')); ?>

                                                        <?php endif; ?>
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
                                                                
                                                                <a class="dropdown-item"
                                                                    href="<?php echo e(route('superadmin.show-usulan', $item->id)); ?>">Lihat
                                                                    Usulan</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

    <?php echo $__env->yieldContent('scripts'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['photos' => $photos['photos'], 'nama_lengkap' => $photos['nama_lengkap']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mjcutter/stagging-sipp.mjcutter.com/resources/views/layouts/view/superadmin/verifikasi_usulan.blade.php ENDPATH**/ ?>