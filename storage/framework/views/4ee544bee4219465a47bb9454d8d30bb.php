<footer class="main-footer">
    <strong>Copyright &copy; <?php echo e(now()->year); ?> <a href="<?php echo e(route('home')); ?>"></a>.</strong>
    <?php echo e(__('SIPP(Sistem Informasi Perencanaan Penganggaran)')); ?> .
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0.0
    </div>
</footer>


<!-- jQuery -->
<script src="<?php echo e(asset('assets/plugins/jquery/jquery.min.js')); ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo e(asset('assets/plugins/jquery-ui/jquery-ui.min.js')); ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo e(asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<!-- ChartJS -->
<script src="<?php echo e(asset('assets/plugins/chart.js/Chart.min.js')); ?>"></script>
<!-- Sparkline -->
<script src="<?php echo e(asset('assets/plugins/sparklines/sparkline.js')); ?>"></script>
<!-- JQVMap -->
<script src="<?php echo e(asset('assets/plugins/jqvmap/jquery.vmap.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')); ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo e(asset('assets/plugins/jquery-knob/jquery.knob.min.js')); ?>"></script>
<!-- daterangepicker -->
<script src="<?php echo e(asset('assets/plugins/moment/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/daterangepicker/daterangepicker.js')); ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo e(asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')); ?>"></script>
<!-- Summernote -->
<script src="<?php echo e(asset('assets/plugins/summernote/summernote-bs4.min.js')); ?>"></script>
<!-- overlayScrollbars -->
<script src="<?php echo e(asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(asset('assets/dist/js/adminlte.js')); ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo e(asset('assets/dist/js/pages/dashboard.js')); ?>"></script>

<script src="<?php echo e(asset('assets/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/jszip/jszip.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/pdfmake/pdfmake.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/pdfmake/vfs_fonts.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/datatables-buttons/js/buttons.print.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')); ?>"></script>
<!-- AdminLTE for demo purposes -->
<!-- Bootstrap Switch -->
<script src="<?php echo e(asset('assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js')); ?>"></script>
<!-- SweetAlert2 -->
<script src="<?php echo e(asset('assets/plugins/sweetalert2/sweetalert2.min.js')); ?>"></script>
<!-- Toastr -->
<script src="<?php echo e(asset('assets/plugins/toastr/toastr.min.js')); ?>"></script>
<!-- input file -->
<script src="<?php echo e(asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')); ?>"></script>

<script>
    $('.your-iframe-element').IFrame({
        autoIframeMode: true,
        autoDarkMode: true
    });
</script>

<script>
    $(function() {
        bsCustomFileInput.init();
    });
    $(".verify-account").each(function() {
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Inisialisasi modal
        $('.editBtn').click(function() {
            var targetModalId = $(this).attr('data-target');
            $(targetModalId).modal('show');
        });
    });
</script>
<script>
    function confirmDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus lembaga ini?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }

    function confirmDeleteUsers(id) {
        if (confirm('Apakah Anda yakin ingin menghapus Users ini?')) {
            document.getElementById('delete-users-form-' + id).submit();
        }
    }

    function confirmDeletePagu(id) {
        if (confirm('Apakah Anda yakin ingin menghapus Pagu ini?')) {
            document.getElementById('delete-pagu-form-' + id).submit();
        }
    }

    function verifyAccount(id) {
        if (confirm('Apakah Anda Ingin Memverifikasi Akun Ini?')) {
            document.getElementById('verify-account-' + id).submit();
        }
    }

    function deleteUsulanAnggaran(id) {
        if (confirm('Apakah anda ingin menghapus list usulan')) {
            document.getElementById('usulan-anggaran-' + id).submit();
        }
    }

    function confirmVerifyUsulan(id) {
        if (confirm('Apakah Anda Ingin Menyetujui Usulan Anggaran ini')) {
            document.getElementById('menyetujui-usulan-' + id).submit();
        }
    }

    function confirmNotVerifyUsulan(id) {
        if (confirm('Apakah Anda Tidak Ingin Menyetujui Usulan Anggaran ini')) {
            document.getElementById('tidak-menyetujui-usulan-' + id).submit();
        }
    }
</script>
<?php /**PATH /home/mjcutter/stagging-sipp.mjcutter.com/resources/views/layouts/footer/footer.blade.php ENDPATH**/ ?>