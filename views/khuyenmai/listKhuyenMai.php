<?php include './views/layout/header.php'; ?>
<?php include './views/layout/menu.php'; ?>

<main>
    <!-- Khu vực breadcrumb -->
    <div class="breadcrumb-area py-4 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="<?= BASE_URL ?>" class="text-decoration-none text-primary">
                                        <i class="fa fa-home"></i> Trang chủ
                                    </a>
                                </li>
                                <li class="breadcrumb-item active text-dark" aria-current="page">Danh sách khuyến mãi</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Khu vực chính -->
    <div class="shop-main-wrapper section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop-product-wrapper">
                        <!-- Hiển thị thông báo -->
                        <?php if (isset($_POST['copied_code'])): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Thành công!</strong> Bạn đã sao chép mã khuyến mãi:
                                <strong><?= htmlspecialchars($_POST['copied_code']) ?></strong>.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <!-- Danh sách khuyến mãi -->
                        <div class="row g-4">
                            <?php if (count($listKhuyenMai) > 0): ?>
                                <?php foreach ($listKhuyenMai as $km): ?>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="promo-item bg-white shadow-lg rounded p-4" data-aos="fade-up" data-aos-duration="1000">
                                            <div class="promo-details mb-3">
                                                <h6 class="promo-name mb-2 text-truncate fw-bold text-primary">
                                                    <?= htmlspecialchars($km['ten_khuyen_mai']) ?>
                                                </h6>
                                                <p class="promo-desc text-muted small">
                                                    <?= htmlspecialchars($km['mo_ta']) ?>
                                                </p>
                                                <p>
                                                    <strong>Thời gian:</strong>
                                                    <span class="text-muted"><?= htmlspecialchars($km['ngay_bat_dau']) ?> - <?= htmlspecialchars($km['ngay_ket_thuc']) ?></span>
                                                </p>
                                                <p class="text-success fw-bold fs-5">
                                                    Giá trị: <?= htmlspecialchars($km['gia_tri']) ?>%
                                                </p>
                                            </div>
                                            <form method="POST" class="mt-auto">
                                                <input type="hidden" name="copied_code" value="<?= htmlspecialchars($km['ma_khuyen_mai']) ?>">
                                                <button type="submit" class="btn btn-outline-primary w-100">
                                                    Sao chép mã
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="col-12">
                                    <p class="text-center text-muted">Không tìm thấy khuyến mãi phù hợp.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include './views/layout/footer.php'; ?>

<!-- Thư viện JS nâng cao -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script>
    // Khởi tạo AOS
    AOS.init();
</script>