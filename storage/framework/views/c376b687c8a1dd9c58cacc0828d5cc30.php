<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Excel To HTML using codebeautify.org</title>
</head>

<body>
    <b>
        <u>Sheet Name</u> :- Sheet1
    </b>
    <hr>
    <table cellspacing=0 border=1>
        <tr>
            <td style=min-width:50px>Nama Barang</td>
            <td style=min-width:50px>Volume</td>
            <td style=min-width:50px>Harga Satuan</td>
            <td style=min-width:50px>Satuan Total</td>
            <td style=min-width:50px>Subtotal</td>
        </tr>
        <?php $__currentLoopData = $cetakListRincian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td style=min-width:50px><?php echo e($cl->nama_barang); ?></td>
                <td style=min-width:50px><?php echo e($cl->volume); ?></td>
                <td style=min-width:50px><?php echo e($cl->harga_satuan); ?></td>
                <td style=min-width:50px><?php echo e($cl->satuan); ?></td>
                <td style=min-width:50px><?php echo e($cl->total); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <br>
        <tr>
            <td style=min-width:50px>Total Anggaran</td>
            <td style=min-width:50px><?php echo e($sumRincian); ?></td>
        </tr>
    </table>
    <hr>
</body>

</html>
<?php /**PATH /home/mjcutter/stagging-sipp.mjcutter.com/resources/views/layouts/view/users/cetak-usulan.blade.php ENDPATH**/ ?>