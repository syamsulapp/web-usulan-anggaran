<?php $__env->startSection('title', 'profile'); ?>

<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
            <?php if(session('alert')): ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Success!</h5>
                <?php echo e(session('alert')); ?>

            </div>
            <?php endif; ?>
            <?php if(session('alertError')): ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Error!</h5>
                <?php echo e(session('alertError')); ?>

            </div>
            <?php endif; ?>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="<?php echo e(url('photo_profile', $data_profile['photos'])); ?>" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center"><?php echo e($data_profile['nama_lengkap']); ?></h3>

                            <p class="text-muted text-center"><?php echo e($data_role['name']); ?></p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Status</b> <a class="float-right">
                                        <?php if(Auth::user()->is_active == 'Y'): ?>
                                        <?php echo e(__('Akun Telah Aktif')); ?>

                                        <?php else: ?>
                                        <?php echo e(__('Akun Tidak Aktif (butuh verifikasi)')); ?>

                                        <?php endif; ?>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <b>Dibuat</b> <a class="float-right"><?php echo e(Auth::user()->created_at); ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Di Update</b> <a class="float-right"><?php echo e(Auth::user()->updated_at); ?></a>
                                </li>
                            </ul>
                            <form action="<?php echo e(route('logout')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <button class="btn btn-primary btn-block"><b>Logout</b></button>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> Education</strong>

                            <p class="text-muted">
                                <?php if($data_profile['education']): ?>
                                <?php echo e($data_profile['education']); ?>

                                <?php else: ?>
                                <?php echo e(__('education belum ada')); ?>

                                <?php endif; ?>
                            </p>

                            <hr>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                            <p class="text-muted">
                                <?php if($data_profile['location']): ?>
                                <?php echo e($data_profile['location']); ?>

                                <?php else: ?>
                                <?php echo e(__('location belum ada')); ?>

                                <?php endif; ?>
                            </p>

                            <hr>

                            <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                            <p class="text-muted">
                                <span class="tag tag-danger">
                                    <?php if($data_profile['skill']): ?>
                                    <?php echo e($data_profile['skill']); ?>

                                    <?php else: ?>
                                    <?php echo e(__('skill belum ada')); ?>

                                    <?php endif; ?>
                                </span>
                            </p>

                            <hr>

                            <strong><i class="far fa-file-alt mr-1"></i> About Me</strong>

                            <p class="text-muted">
                                <?php if($data_profile['about_me']): ?>
                                <?php echo e($data_profile['about_me']); ?>

                                <?php else: ?>
                                <?php echo e(__('about me belum ada')); ?>

                                <?php endif; ?>
                            </p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                                <?php if(Auth::user()->id_role == 3): ?>
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a>
                                    <?php endif; ?>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <!-- Post -->
                                    <?php $__currentLoopData = $activity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="post">
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm" src="<?php echo e(url('photo_profile', $a->photo)); ?>" alt="user image">
                                            <span class="username">
                                                <a href="#"><?php echo e($a->nama); ?></a>
                                            </span>
                                            <span class="description"><?php echo e($a->created_at); ?></span>
                                        </div>
                                        <!-- /.user-block -->
                                        <p>
                                            <?php echo e($a->keterangan); ?>.
                                            <?php if($a->status == 'diterima'): ?>
                                            <span class="badge badge-success right"><?php echo e($a->status); ?></span>
                                            <?php elseif($a->status === 'ditolak'): ?>
                                            <span class="badge badge-danger right"><?php echo e($a->status); ?></span>
                                            <?php else: ?>
                                            <span class="badge badge-info right"><?php echo e($a->status); ?></span>
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                    <!-- /.post -->
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="timeline">
                                    <!-- The timeline -->
                                    <div class="timeline timeline-inverse">
                                        <!-- /.timeline-label -->
                                        <!-- timeline item -->
                                        <?php $__currentLoopData = $timeLineUsulanAnggaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($u->user_id == Auth::user()->id): ?>
                                        <?php if($u->status == 'diterima'): ?>
                                        <div>
                                            <i class="fas fa-envelope bg-success"></i>

                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i>
                                                    <?php echo e($u->created_at); ?></span>

                                                <h3 class="timeline-header"><a href="#"><?php echo e($data_profile['nama_lengkap']); ?></a>
                                                    <?php echo e($u->status); ?>

                                                </h3>

                                                <div class="timeline-body">
                                                    <?php echo e($u->keterangan); ?>

                                                </div>
                                                <div class="timeline-footer">
                                                    <a href="#" class="btn btn-success btn-sm"><?php echo e($u->status); ?></a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php elseif($u->status == 'ditolak'): ?>
                                        <div>
                                            <i class="fas fa-envelope bg-danger"></i>

                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i>
                                                    <?php echo e($u->created_at); ?></span>

                                                <h3 class="timeline-header"><a href="#"><?php echo e($data_profile['nama_lengkap']); ?></a>
                                                    <?php echo e($u->status); ?>

                                                </h3>

                                                <div class="timeline-body">
                                                    <?php echo e($u->keterangan); ?>

                                                </div>
                                                <div class="timeline-footer">
                                                    <a href="#" class="btn btn-danger btn-sm"><?php echo e($u->status); ?></a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php else: ?>
                                        <!-- END timeline item -->
                                        <!-- timeline item -->
                                        <div>
                                            <i class="fas fa-user bg-info"></i>

                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i>
                                                    <?php echo e($u->created_at); ?></span>

                                                <h3 class="timeline-header border-0"><a href="#"><?php echo e($data_profile['nama_lengkap']); ?></a>
                                                    <?php echo e($u->status); ?>

                                                </h3>
                                            </div>
                                        </div>
                                        <!-- END timeline item -->
                                        <div>
                                            <i class="far fa-clock bg-gray"></i>
                                        </div>
                                        <br>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="settings">
                                    <form class="form-horizontal" action="<?php echo e(route('profile.submit')); ?>" method="POST" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Nama
                                                Lengkap</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control <?php $__errorArgs = ['nama_lengkap'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        'is-invalid'
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="inputName" placeholder="Name" name="nama_lengkap" value="<?php echo e($data_profile['nama_lengkap']); ?>">
                                                <?php $__errorArgs = ['nama_lengkap'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Username</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control  <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    'is-invalid'
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="inputEmail" placeholder="Username" name="username" value="<?php echo e(Auth::user()->username); ?>">
                                                <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">education</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control  <?php $__errorArgs = ['education'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    'is-invalid'
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="inputEmail" placeholder="education" name="education" value="<?php echo e($data_profile['education']); ?>">
                                                <?php $__errorArgs = ['education'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">location</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control  <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    'is-invalid'
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="inputEmail" placeholder="location" name="location" value="<?php echo e($data_profile['location']); ?>">
                                                <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">skill</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control  <?php $__errorArgs = ['skill'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    'is-invalid'
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="inputEmail" placeholder="skill" name="skill" value="<?php echo e($data_profile['skill']); ?>">
                                                <?php $__errorArgs = ['skill'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">about me</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control  <?php $__errorArgs = ['about_me'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    'is-invalid'
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="inputEmail" placeholder="about_me" name="about_me" value="<?php echo e($data_profile['about_me']); ?>">
                                                <?php $__errorArgs = ['about_me'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control  <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    'is-invalid'
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="inputName2" name="password" placeholder="Password">
                                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Password
                                                Confirmation</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control  <?php $__errorArgs = ['password-confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    'is-invalid'
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="inputName2" name="password-confirmation" placeholder="Password Confirmation">
                                                <?php $__errorArgs = ['password-confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">photos</label>
                                            <div class="col-sm-10">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input <?php $__errorArgs = ['photos'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="photos" id="exampleInputFile">
                                                    <label class="custom-file-label" for="exampleInputFile">Pilih
                                                        Photos</label>
                                                </div>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Upload</span>
                                                </div>
                                                <?php $__errorArgs = ['photos'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', ['photos' => $data_profile['photos'], 'nama_lengkap' => $data_profile['nama_lengkap']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mjcutter/stagging-sipp.mjcutter.com/resources/views/layouts/view/profile/profile.blade.php ENDPATH**/ ?>