<?php include './views/layout/header.php'; ?>

<!-- menu -->
<?php include './views/layout/menu.php'; ?>

<main>
    <!-- breadcrumb area start -->
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
                                <li class="breadcrumb-item active text-dark" aria-current="page">Danh sách sản phẩm</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- shop main wrapper start -->
    <div class="shop-main-wrapper section-padding">
        <div class="container">
            <div class="row">
                <!-- Sidebar for filters -->
                <div class="col-lg-3">
                    <div class="shop-sidebar p-4 bg-white shadow-sm rounded">
                        <h3 class="widget-title mb-3 text-uppercase">Tìm kiếm</h3>
                        <form action="<?= BASE_URL . '?act=danh-sach-san-pham' ?>" method="get">
                            <div class="form-group mb-3">
                                <label for="category" class="form-label">Danh mục:</label>
                                <select name="danh_muc" id="category">
                                    <option value="all">Tất cả</option>
                                    <?php foreach ($listDanhMuc as $danhMuc): ?>
                                        <option value="<?= $danhMuc['id'] ?>"><?= $danhMuc['ten_danh_muc'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="price-range" class="form-label">Mức giá:</label>
                                <select name="muc_gia" id="price-range">
                                    <option value="all">Tất cả</option>
                                    <option value="0-500000">Dưới 500,000 VNĐ</option>
                                    <option value="500000-1000000">500,000 - 1,000,000 VNĐ</option>
                                    <option value="1000000-2000000">1,000,000 - 2,000,000 VNĐ</option>
                                </select>
                            </div>
                            <br>
                            <div class="form-group mb-3">
                                <label for="sort" class="form-label">Sắp xếp:</label>
                                <select name="sap_xep" id="sort">
                                    <option value="asc">Giá tăng dần</option>
                                    <option value="desc">Giá giảm dần</option>
                                </select>
                            </div>
                            <br>
                            <br>
                            <button type="submit" style="height: 40px;" class="btn btn-primary w-100  rounded-pill shadow-lg">Tìm kiếm</button>
                        </form>
                    </div>
                </div>

                <!-- Main content area -->
                <div class="col-lg-9">
                    <div class="shop-product-wrapper">
                        <div class="row g-4">
                            <?php if (count($listSanPham) > 0): ?>
                                <?php foreach ($listSanPham as $sanPham): ?>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="product-item bg-white shadow-sm rounded p-3 position-relative">
                                            <figure class="product-thumb mb-3">
                                                <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>" class="d-block">
                                                    <img class="img-fluid rounded" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="product">
                                                </a>
                                                <div class="cart-hover">
                                                    <button class="btn btn-cart">Chi tiết</button>
                                                </div>
                                            </figure>
                                            <div class="product-caption text-center">
                                                <h6 class="product-name mb-2">
                                                    <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>" class="text-decoration-none text-dark"><?= $sanPham['ten_san_pham'] ?></a>
                                                </h6>

                                                <div class="price-box">
                                                    <?php if ($sanPham['gia_khuyen_mai']): ?>
                                                        <span class="price-regular text-success fw-bold"><?= formatprice($sanPham['gia_khuyen_mai']) . 'đ'; ?></span>
                                                        <span class="price-old text-muted"><del><?= formatprice($sanPham['gia_san_pham']) . 'đ'; ?></del></span>
                                                    <?php else: ?>
                                                        <span class="price-regular text-primary fw-bold"><?= formatprice($sanPham['gia_san_pham']) . 'đ'; ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-center text-muted">Không tìm thấy sản phẩm phù hợp.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- shop main wrapper end -->
</main>

<!-- footer -->
<?php include './views/layout/footer.php'; ?>