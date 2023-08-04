<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?php echo e(asset('assets/img/sippCropped.png')); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?php echo e(__('SIPP')); ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo e(url('photo_profile', $photo)); ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="<?php echo e(route('profile')); ?>" class="d-block"><?php echo e($nama_lengkap); ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?php echo e(route('home')); ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <?php if(Auth::user()->is_active == 'Y'): ?>
                <?php if(Auth::user()->id_role == 1): ?>
                <!-- role untuk fitur superadmin -->
                <li class="nav-header"><?php echo e(__('SUPER ADMIN')); ?></li>
                <li class="nav-item">
                    <a href="<?php echo e(route('superadmin.verifikasi_usulan')); ?>" class="nav-link">
                        <i class="nav-icon far fa-check-circle"></i>
                        <p>
                            <?php echo e(__('Verifikasi Usulan')); ?>

                            
                        </p>
                    </a>
                </li>
                <?php elseif(Auth::user()->id_role == 2): ?>
                <!--role untuk fitur admin -->
                <li class="nav-header"><?php echo e(__('ADMIN')); ?></li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            <?php echo e(__('Master Data')); ?>

                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo e(route('pagu.index')); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?php echo e(__('Pagu')); ?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('uraian.index')); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?php echo e(__('Tipe Bagian')); ?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('lembaga.index')); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?php echo e(__('Lembaga(Bagian)')); ?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.users')); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?php echo e(__('Users')); ?></p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.cetak-usulan')); ?>" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            <?php echo e(__('Cetak Dokumen')); ?>

                        </p>
                    </a>
                </li>
                <?php else: ?>
                <!-- role untuk fitur users-->
                <li class="nav-header">USERS</li>
                <li class="nav-item">
                    <a href="<?php echo e(route('users.buat_usulan')); ?>" class="nav-link">
                        <i class="nav-icon far fa-share-square"></i>
                        <p>
                            <?php echo e(__('Kirim Usulan')); ?>

                            
                        </p>
                    </a>
                </li>
                
                <?php endif; ?>
                <?php else: ?>
                <div class="card-body">
                    <div class="alert alert-warning alert-dismissible">
                        <h5><i class="icon fas fa-exclamation-triangle"></i> <?php echo e(__('Alert')); ?>!</h5>
                        <?php echo e(__('Fitur Tidak')); ?>

                        <br>
                        <?php echo e(__('Bisa Digunakan')); ?>

                    </div>
                </div>
                <?php endif; ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside><?php /**PATH /home/mjcutter/stagging-sipp.mjcutter.com/resources/views/layouts/sidebar/sidebar.blade.php ENDPATH**/ ?>