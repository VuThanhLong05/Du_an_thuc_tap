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
                <div class="col-sm-10">
                    <!-- Kiểm tra xem biến $khuyenMai có tồn tại không -->
                    <?php if (isset($khuyenMai)): ?>
                        <h1>Quản lý khuyến mãi - Khuyến mãi: <?= $khuyenMai['ten_khuyen_mai'] ?> </h1>
                    <?php else: ?>
                        <h1>Không tìm thấy khuyến mãi</h1>
                    <?php endif; ?>
                </div>
                <div class="col-sm-2">
                    <form action="" method="post">
                        <select name="trang_thai" id="status" onchange="this.form.submit()">
                            <?php foreach ($listTrangThaiKhuyenMai as $key => $trangThai) : ?>
                                <option
                                    <?= isset($khuyenMai) && $trangThai['id'] == $khuyenMai['trang_thai'] ? 'selected' : '' ?>
                                    <?= isset($khuyenMai) && $trangThai['id'] < $khuyenMai['trang_thai'] ? 'disabled' : '' ?>
                                    value="<?= $trangThai['id'] ?>">
                                    <?= $trangThai['ten_trang_thai'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </form>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <?php
                    // Kiểm tra trạng thái khuyến mãi và thay đổi màu sắc thông báo
                    $colorAlerts = '';
                    if (isset($khuyenMai)) {
                        switch ($khuyenMai['trang_thai']) {
                            case 1:
                                $colorAlerts = 'primary';
                                break;
                            case 2:
                            case 3:
                            case 4:
                                $colorAlerts = 'warning';
                                break;
                            case 10:
                                $colorAlerts = 'success';
                                break;
                            default:
                                $colorAlerts = 'danger';
                                break;
                        }
                    }
                    ?>
                    <!-- Kiểm tra sự tồn tại của $khuyenMai để hiển thị thông báo -->
                    <?php if (isset($khuyenMai)): ?>
                        <div class="alert alert-<?= $colorAlerts; ?>" role="alert">
                            Khuyến mãi: <?= $khuyenMai['ten_khuyen_mai']; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-gift"></i> Shop gấu bông AHTL - Khuyến mãi
                                    <small class="float-right">Ngày bắt đầu: <?= isset($khuyenMai) ? formatDate($khuyenMai['ngay_bat_dau']) : '' ?></small>
                                </h4>
                            </div>
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                Thông tin khuyến mãi
                                <address>
                                    <strong><?= isset($khuyenMai) ? $khuyenMai['ten_khuyen_mai'] : '' ?></strong><br>
                                    Giá trị khuyến mãi: <?= isset($khuyenMai) ? formatprice($khuyenMai['gia_tri']) : '' ?><br>
                                    Mô tả: <?= isset($khuyenMai) ? $khuyenMai['mo_ta'] : '' ?><br>
                                </address>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                Thông tin trạng thái
                                <address>
                                    <strong>Trạng thái: <?= isset($khuyenMai) ? $khuyenMai['trang_thai'] : '' ?></strong><br>
                                    Ngày bắt đầu: <?= isset($khuyenMai) ? formatDate($khuyenMai['ngay_bat_dau']) : '' ?><br>
                                    Ngày kết thúc: <?= isset($khuyenMai) ? formatDate($khuyenMai['ngay_ket_thuc']) : '' ?><br>
                                </address>
                            </div>

                            <div class="col-sm-4 invoice-col">
                                Thông tin khuyến mãi
                                <address>
                                    <strong>Mã khuyến mãi: <?= isset($khuyenMai) ? $khuyenMai['ma_khuyen_mai'] : '' ?></strong><br>
                                    Tổng giá trị khuyến mãi: <?= isset($khuyenMai)   ? formatprice($khuyenMai['gia_tri_tong']) : '' ?><br>
                                    Ghi chú: <?= isset($khuyenMai) ? $khuyenMai['ghi_chu'] : '' ?><br>
                                    Phương thức áp dụng: <?= isset($khuyenMai) ? $khuyenMai['phuong_thuc_ap_dung'] : '' ?><br>
                                </address>
                            </div>
                        </div>

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Đơn giá</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $tong_tien = 0; ?>
                                        <?php if (isset($sanPhamKhuyenMai)) : ?>
                                            <?php foreach ($sanPhamKhuyenMai as $key => $sanPham) : ?>
                                                <tr>
                                                    <td><?= $key + 1 ?></td>
                                                    <td><?= $sanPham['ten_san_pham'] ?></td>
                                                    <td><?= formatprice($sanPham['don_gia']) ?></td>
                                                    <td><?= $sanPham['so_luong'] ?></td>
                                                    <td><?= formatprice($sanPham['thanh_tien']) ?></td>
                                                </tr>
                                                <?php $tong_tien += $sanPham['thanh_tien']; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <p class="lead">Ngày bắt đầu: <?= isset($khuyenMai) ? formatDate($khuyenMai['ngay_bat_dau']) : '' ?></p>

                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">Thành tiền:</th>
                                            <td><?= isset($tong_tien) ? formatprice($tong_tien) : '' ?></td>
                                        </tr>

                                        <tr>
                                            <th>Tiền vận chuyển:</th>
                                            <td>50.000</td>
                                        </tr>
                                        <tr>
                                            <th>Tổng tiền:</th>
                                            <td><?= isset($tong_tien) ? formatprice($tong_tien + 50000) : '' ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->