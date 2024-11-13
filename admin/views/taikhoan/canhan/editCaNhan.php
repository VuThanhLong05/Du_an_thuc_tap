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
                    <h1>Quản lý tài khoản cá nhân</h1>
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
            <div class="col-md-12 personal-info">

                <form action="<?= BASE_URL_ADMIN . '?act=sua-thong-tin-ca-nhan-quan-tri' ?>" enctype="multipart/form-data" class="form-horizontal" role="form" method="post">

                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
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
                        </div>
                    </div>
                    

                    <!-- edit form column -->
                    <!-- HTML Form -->

                    <hr>
                    <h3>Thông tin cá nhân</h3>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Họ tên</label>
                        <div class="col-lg-12">
                            <input class="form-control" type="text" name="ho_ten" value="<?= $thongTin['ho_ten'] ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Email:</label>
                        <div class="col-lg-12">
                            <input class="form-control" type="email" name="email" value="<?= $thongTin['email'] ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Ngày sinh:</label>
                        <div class="col-lg-12">
                            <input class="form-control" type="date" name="ngay_sinh" value="<?= $thongTin['ngay_sinh'] ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Số điện thoại:</label>
                        <div class="col-lg-12">
                            <input class="form-control" type="text" name="so_dien_thoai" value="<?= $thongTin['so_dien_thoai'] ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Giới tính:</label>
                        <select id="inputStatus" name="gioi_tinh" class=" custom-select">
                            <option <?= $thongTin['gioi_tinh'] == 1 ? 'selected' : '' ?> value="1">Nam</option>
                            <option <?= $thongTin['gioi_tinh'] == 2 ? 'selected' : '' ?> value="2">Nữ</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Địa chỉ:</label>
                        <div class="col-lg-12">
                            <input class="form-control" type="text" name="dia_chi" value="<?= $thongTin['dia_chi'] ?>">
                        </div>
                    </div>

                    <!-- More fields as needed -->
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-12">
                            <input type="submit" class="btn btn-primary" value="Save Changes">
                        </div>
                    </div>
                </form>


                <hr>
                <h3>Đổi mật khẩu</h3>
                <?php if (isset($_SESSION['success'])) { ?>
                    <div class="alert alert-info alert-dismissable">
                        <a class="panel-close close" data-dismiss="alert">×</a>
                        <i class="fa fa-coffee"></i>
                        <?= $_SESSION['success']; ?>
                    </div>
                <?php } ?>

                <form class="form-horizontal" action="<?= BASE_URL_ADMIN . '?act=sua-mat-khau-ca-nhan-quan-tri' ?>" method="post">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Mật khẩu cũ:</label>
                        <div class="col-md-12">
                            <input class="form-control" type="text" name="old_pass" value="">
                            <?php if (isset($_SESSION['error']['old_pass'])) { ?>
                                <p class="text-danger"><?= $_SESSION['error']['old_pass']; ?></p>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Mật khẩu mới:</label>
                        <div class="col-md-12">
                            <input class="form-control" type="text" name="new_pass" value="">
                            <?php if (isset($_SESSION['error']['new_pass'])) { ?>
                                <p class="text-danger"><?= $_SESSION['error']['new_pass']; ?></p>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nhập lại mật khẩu mới:</label>
                        <div class="col-md-12">
                            <input class="form-control" type="text" name="confirm_pass" value="">
                            <?php if (isset($_SESSION['error']['confirm_pass'])) { ?>
                                <p class="text-danger"><?= $_SESSION['error']['confirm_pass']; ?></p>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-12">
                            <input type="submit" class="btn btn-primary" value="Lưu mật khẩu">
                        </div>
                    </div>
                </form>

            </div>
        </div>

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