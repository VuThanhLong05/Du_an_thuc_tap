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
                    <h1>Quản lý khuyến mãi</h1>
                </div>
                <div class="col-sm-1">
                    <a href="<?= BASE_URL_ADMIN . '?act=khuyen-mai' ?>" class="btn btn-secondary">Quay lại</a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Sửa khuyến mãi</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="<?= BASE_URL_ADMIN . '?act=form-sua-khuyen-mai' ?>" method="post">
                            <input type="text" name="id" id="" value="<?= $khuyenMai['id'] ?>" hidden>
                            <div class="card-body">
                                
                                <div class="form-group">
                                    <label>Tên khuyến mãi</label>
                                    <input type="text" class="form-control" name="ten_khuyen_mai" placeholder="Nhập tên khuyến mãi" value="<?= $khuyenMai['ten_khuyen_mai'] ?>">
                                    <?php if (isset($errors['ten_khuyen_mai'])) { ?>
                                        <p class="text-danger"><?= $errors['ten_khuyen_mai']; ?></p>
                                    <?php } ?>
                                </div>
                                        <!-- Thiếu trường này -->
                                <div class="form-group">
                                    <label>Ngày bắt đầu</label>
                                    <input type="date" class="form-control" name="ngay_bat_dau" value="<?= $khuyenMai['ngay_bat_dau'] ?>">
                                    <?php if (isset($errors['ngay_bat_dau'])) { ?>
                                        <p class="text-danger"><?= $errors['ngay_bat_dau']; ?></p>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label>Ngày kết thúc</label>
                                    <input type="date" class="form-control" name="ngay_ket_thuc" value="<?= $khuyenMai['ngay_ket_thuc'] ?>">
                                    <?php if (isset($errors['ngay_ket_thuc'])) { ?>
                                        <p class="text-danger"><?= $errors['ngay_ket_thuc']; ?></p>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <textarea class="form-control" name="mo_ta" placeholder="Nhập mô tả"><?= $khuyenMai['mo_ta'] ?></textarea>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                </div>
                        </form>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- <footer> -->
<?php include './views/layout/footer.php'; ?>
<!-- End</footer> -->

</body>

</html>
