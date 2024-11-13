<?php require_once 'layout/header.php'; ?>

<?php require_once 'layout/menu.php'; ?>

<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="promotions.html">Khuyến Mãi</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Danh sách khuyến mãi</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- promotion main wrapper start -->
    <div class="promotion-main-wrapper section-padding">
        <div class="container">
            <div class="section-bg-color">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Promotion Table Area -->
                        <div class="promotion-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="pro-title">Tên khuyến mãi</th>
                                        <th class="pro-description">Mô tả</th>
                                        <th class="pro-value">Giá trị</th>
                                        <th class="pro-status">Trạng thái</th>
                                        <th class="pro-actions">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($khuyenMai)): ?>
                                        <?php foreach ($khuyenMai as $promotion): ?>
                                            <tr>
                                                <td class="pro-title"><a href="#"><?= $promotion['ten_khuyen_mai'] ?></a></td>
                                                <td class="pro-description"><?= $promotion['mo_ta'] ?></td>
                                                <td class="pro-value"><?= formatprice($promotion['gia_tri']) . ' VNĐ' ?></td>
                                                <td class="pro-status"><?= $promotion['trang_thai'] == 'active' ? 'Đang áp dụng' : 'Hết hạn' ?></td>
                                                <td class="pro-actions">
                                                    <a href="edit_promotion.php?id=<?= $promotion['id'] ?>"><i class="fa fa-edit"></i> Sửa</a>
                                                    <a href="delete_promotion.php?id=<?= $promotion['id'] ?>"><i class="fa fa-trash-o"></i> Xóa</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center">Không có khuyến mãi nào</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Add New Promotion Button -->
                <div class="row">
                    <div class="col-lg-12">
                        <a href="add_promotion.php" class="btn btn-sqr">Thêm khuyến mãi mới</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- promotion main wrapper end -->
</main>

<?php require_once 'layout/miniCart.php'; ?>

<?php require_once 'layout/footer.php'; ?>
