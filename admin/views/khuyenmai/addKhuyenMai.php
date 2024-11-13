<!-- <head> -->
<?php include './views/layout/header.php'; ?>
<!-- </head> -->

<!-- navbar -->
<?php include './views/layout/navbar.php'; ?>
<!-- navbar -->

<!-- sidebar -->
<?php include './views/layout/sidebar.php'; ?>
<!-- sidebar -->
 
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý khuyến mãi</h1>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thêm khuyến mãi</h3>
                        </div>

                        <form action="<?= BASE_URL_ADMIN . '?act=them-khuyen-mai' ?>" method="post">
                            <div class="row card-body">
                                <!-- Mã khuyến mãi -->
                                <div class="form-group col-12">
                                    <label for="ma_khuyen_mai">Mã khuyến mãi</label>
                                    <input type="text" class="form-control" id="ma_khuyen_mai" name="ma_khuyen_mai" placeholder="Nhập mã khuyến mãi" value="<?= isset($_POST['ma_khuyen_mai']) ? $_POST['ma_khuyen_mai'] : '' ?>">
                                    <?php if (isset($_SESSION['errors']['ma_khuyen_mai'])) { ?>
                                        <p class="text-danger"><?= $_SESSION['errors']['ma_khuyen_mai']; ?></p>
                                    <?php } ?>
                                </div>

                                <!-- Tên khuyến mãi -->
                                <div class="form-group col-12">
                                    <label for="ten_khuyen_mai">Tên khuyến mãi</label>
                                    <input type="text" class="form-control" id="ten_khuyen_mai" name="ten_khuyen_mai" placeholder="Nhập tên khuyến mãi" value="<?= isset($_POST['ten_khuyen_mai']) ? $_POST['ten_khuyen_mai'] : '' ?>">
                                    <?php if (isset($_SESSION['errors']['ten_khuyen_mai'])) { ?>
                                        <p class="text-danger"><?= $_SESSION['errors']['ten_khuyen_mai']; ?></p>
                                    <?php } ?>
                                </div>

                                <!-- Giá trị khuyến mãi -->
                                <div class="form-group col-12">
                                    <label for="gia_tri">Giá trị khuyến mãi</label>
                                    <input type="number" class="form-control" id="gia_tri" name="gia_tri" placeholder="Nhập giá trị khuyến mãi" value="<?= isset($_POST['gia_tri']) ? $_POST['gia_tri'] : '' ?>">
                                    <?php if (isset($_SESSION['errors']['gia_tri'])) { ?>
                                        <p class="text-danger"><?= $_SESSION['errors']['gia_tri']; ?></p>
                                    <?php } ?>
                                </div>

                                <!-- Ngày bắt đầu -->
                                <div class="form-group col-6">
                                    <label for="ngay_bat_dau">Ngày bắt đầu</label>
                                    <input type="date" class="form-control" id="ngay_bat_dau" name="ngay_bat_dau" value="<?= isset($_POST['ngay_bat_dau']) ? $_POST['ngay_bat_dau'] : '' ?>">
                                </div>

                                <!-- Ngày kết thúc -->
                                <div class="form-group col-6">
                                    <label for="ngay_ket_thuc">Ngày kết thúc</label>
                                    <input type="date" class="form-control" id="ngay_ket_thuc" name="ngay_ket_thuc" value="<?= isset($_POST['ngay_ket_thuc']) ? $_POST['ngay_ket_thuc'] : '' ?>">
                                </div>

                                <!-- Mô tả -->
                                <div class="form-group col-12">
                                    <label for="mo_ta">Mô tả</label>
                                    <textarea class="form-control" id="mo_ta" name="mo_ta" placeholder="Nhập mô tả khuyến mãi"><?= isset($_POST['mo_ta']) ? $_POST['mo_ta'] : '' ?></textarea>
                                </div>

                                <!-- Trạng thái -->
                                <div class="form-group col-12">
                                    <label for="trang_thai">Trạng thái</label>
                                    <select class="form-control" id="trang_thai" name="trang_thai">
                                        <option value="" disabled <?= !isset($_POST['trang_thai']) ? 'selected' : ''; ?>>Chọn trạng thái khuyến mãi</option>
                                        <option value="1" <?= isset($_POST['trang_thai']) && $_POST['trang_thai'] == '1' ? 'selected' : ''; ?>>Đang áp dụng</option>
                                        <option value="2" <?= isset($_POST['trang_thai']) && $_POST['trang_thai'] == '2' ? 'selected' : ''; ?>>Không áp dụng</option>
                                    </select>
                                    <?php if (isset($_SESSION['errors']['trang_thai'])) { ?>
                                        <p class="text-danger"><?= $_SESSION['errors']['trang_thai']; ?></p>
                                    <?php } ?>
                                </div>

                                <!-- Submit button -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Thêm khuyến mãi</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include './views/layout/footer.php'; ?>
</body>
</html>
