<!-- <head> -->
<?php include './views/layout/header.php'; ?>
<!-- </head> -->

<!-- navbar -->
<?php include './views/layout/navbar.php'; ?>
<!-- navbar -->

<!-- sidebar -->
<?php include './views/layout/sidebar.php'; ?>
<!-- sidebar -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-11">
                    <h1>Chi tiết liên hệ</h1>
                </div>
                <!-- <div class="col-sm-1">
                    <a href="<?= BASE_URL_ADMIN . '?act=list-tai-khoan-khach-hang' ?>" class="btn btn-secondary">Quay lại</a>
                </div> -->
            </div>
        </div>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <hr>
            <!-- <div class="col-md-12 personal-info">

                <form action="<?= BASE_URL_ADMIN . '?act=sua-thong-tin-ca-nhan-quan-tri' ?>" enctype="multipart/form-data" class="form-horizontal" role="form" method="post">

                    <!-- <div class="row">
                        <!-- left column -->
            <!-- <div class="col-md-12">
                            <div class="text-center">
                                <img src="<?= BASE_URL_ADMIN . $thongTin['anh_dai_dien']; ?>" class="avatar img-circle" alt="avatar" onerror="this.onerror=null; this.src='https://tse1.mm.bing.net/th?id=OIP.f3DM2upCo-p_NPRwBAwbKQHaHa&pid=Api&P=0&h=220'">
                                <h6 class="mt-2">Họ và tên: <?= $thongTin['ho_ten'] ?></h6>
                                <h6 class="mt-2">Chức vụ:
                                    <?php
                                    if ($thongTin['chuc_vu_id'] == 1) {
                                        echo 'Quản trị viên';
                                    } elseif ($thongTin['chuc_vu_id'] !== 1) {
                                        echo 'Khách hàng';
                                    } ?>
                                </h6>
                                <div class="form-group">
                                    <label for="hinh_anh">Sửa ảnh đại diện</label>
                                    <input style="width:25%; margin-left: 38%;" type="file" id="hinh_anh" name="hinh_anh" class="form-control">
                                </div>
                            </div>
                        </div> -->
            <!-- </div> -->


            <!-- edit form column -->
            <!-- HTML Form -->

            <!-- <hr> -->
            <!-- <h3>Thông tin cá nhân</h3> -->

            <div class="form-group">
                <label class="col-lg-3 control-label">Email</label>
                <div class="col-lg-12">
                    <input class="form-control" type="text" name="lien_he" value="<?= $lienHe['email'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">Số điện thoại:</label>
                <div class="col-lg-12">
                    <input class="form-control" type="email" name="email" value="<?= $lienHe['so_dien_thoai'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">Ngày tạo:</label>
                <div class="col-lg-12">
                    <input class="form-control" name="ngay_sinh" value="<?= $lienHe['ngay_tao'] ?>">
                </div>
            </div>
            <!-- <div class="form-group">
                <label class="col-lg-3 control-label">Số điện thoại:</label>
                <div class="col-lg-12">
                    <input class="form-control" type="text" name="so_dien_thoai" value="<?= $thongTin['so_dien_thoai'] ?>">
                </div>
            </div> -->

            <div class="form-group">
                <label class="col-lg-3 control-label">Nội dung:</label>
                <div class="col-lg-12">
                    <textarea class="form-control" style="width: 100%;" name="" id=""><?= $lienHe['noi_dung'] ?></textarea>
                </div>
            </div>

            <div class="form-group">
                <label>Trạng thái:</label>
                <div class="col-lg-12">
                    <select id="inputStatus" name="trang_thai" class="custom-select form-control">
                        <option <?= $lienHe['trang_thai'] == 1 ? 'selected' : '' ?> value="1">Hiện</option>
                        <option <?= $lienHe['trang_thai'] == 2 ? 'selected' : '' ?> value="2">Ẩn</option>

                    </select>
                </div>
            </div>

            <!-- More fields as needed -->
            <!-- <div class="form-group">
                <label class="col-md-3 control-label"></label>
                <div class="col-md-12">
                    <input type="submit" class="btn btn-primary" value="Save Changes">
                </div>
            </div> -->
            <!-- </form> -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- <footer> -->
<?php include './views/layout/footer.php'; ?>
<!-- End</footer>  -->

</body>

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
        });
    });
</script>

</html>