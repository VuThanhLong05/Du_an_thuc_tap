<?php require_once 'layout/header.php'; ?>

<?php require_once 'layout/menu.php'; ?>

<main>
    <!-- hero slider area start -->
    <section class="slider-area">
        <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">
            <!-- single slider item start -->
            <div class="hero-single-slide hero-overlay">
                <div class="hero-slider-item bg-img" data-bg="assets/img/slider/slider1.webp">
                    <div class="container">
                        <div class="row">

                        </div>
                    </div>
                </div>
            </div>
            <!-- single slider item start -->

            <!-- single slider item start -->
            <div class="hero-single-slide hero-overlay">
                <div class="hero-slider-item bg-img" data-bg="assets/img/slider/slider2.webp">
                    <div class="container">
                        <div class="row">

                        </div>
                    </div>
                </div>
            </div>
            <!-- single slider item start -->


        </div>
    </section>
    <!-- hero slider area end -->

    <!-- service policy area start -->
    <div class="service-policy section-padding">
        <div class="container">
            <div class="row mtn-30">
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="pe-7s-plane"></i>
                        </div>
                        <div class="policy-content">
                            <h6>Giao hàng</h6>
                            <p>Miễn phí giao hàng</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="pe-7s-help2"></i>
                        </div>
                        <div class="policy-content">
                            <h6>Hỗ trợ</h6>
                            <p>Hỗ trợ 24/7</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="pe-7s-back"></i>
                        </div>
                        <div class="policy-content">
                            <h6>Hoàn tiền</h6>
                            <p>Hoàn tiền trong 30 ngày khi lỗi</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="pe-7s-credit"></i>
                        </div>
                        <div class="policy-content">
                            <h6>Thanh toán</h6>
                            <p>Bảo mật thanh toán</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- service policy area end -->

    <!-- banner statistics area start -->
    <div class="banner-statistics-area">
        <div class="container">
            <div class="row row-20 mtn-20">
                <div class="col-sm-6">
                    <figure class="banner-statistics mt-20">
                        <a href="#">
                            <img src="assets/img/slider/slider1.png" alt="product banner">
                        </a>
                    </figure>
                </div>
                <div class="col-sm-6">
                    <figure class="banner-statistics mt-20">
                        <a href="#">
                            <img src="assets/img/slider/slider11.jpg" alt="product banner">
                        </a>
                    </figure>
                </div>
            </div>
        </div>
    </div>
    <!-- banner statistics area end -->

    <!-- product area start -->
    <section class="product-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Sản phẩm của shop</h2>
                        <p class="sub-title">Sản phẩm được cập nhật liên tục</p>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-container">

                        <!-- product tab content start -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab1">
                                <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                                    <?php foreach ($listSanPham as $key => $sanPham): ?>
                                        <!-- product item start -->
                                        <div class="product-item">
                                            <figure class="product-thumb">
                                                <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                                                    <img class="pri-img" src="<?= BASE_URL . $sanPham['hinh_anh']; ?>" alt="product">
                                                    <img class="sec-img" src="<?= BASE_URL . $sanPham['hinh_anh']; ?>" alt="product">
                                                </a>
                                                <div class="product-badge">
                                                    <?php
                                                    $ngayNhap = new DateTime($sanPham['ngay_nhap']);
                                                    $ngayHienTai = new DateTime();
                                                    $tinhNgay = $ngayHienTai->diff($ngayNhap);

                                                    if ($tinhNgay->days <= 7) { ?>
                                                        <div class="product-label new">
                                                            <span>Mới</span>
                                                        </div>
                                                    <?php } ?>

                                                    <?php
                                                    if ($sanPham['gia_khuyen_mai']) { ?>
                                                        <div class="product-label discount">
                                                            <span>Giảm giá</span>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="cart-hover">
                                                    <button class="btn btn-cart">Chi tiết</button>
                                                </div>
                                            </figure>
                                            <div class="product-caption text-center">
                                                <h6 class="product-name">
                                                    <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>"><?= $sanPham['ten_san_pham'] ?></a>
                                                </h6>
                                                <div class="price-box">
                                                    <?php
                                                    if ($sanPham['gia_khuyen_mai']) { ?>
                                                        <span class="price-regular"><?= formatprice($sanPham['gia_khuyen_mai']) . 'đ'; ?></span>
                                                        <span class="price-old"><del><?= formatprice($sanPham['gia_san_pham']) . 'đ'; ?></del></span>
                                                    <?php } else { ?>
                                                        <span class="price-old"><del><?= formatprice($sanPham['gia_san_pham']) . 'đ'; ?></del></span>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- product item end -->
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>

                        <!-- product tab content end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product area end -->

    <!-- product area start -->
    <section class="product-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Sản phẩm nổi bật</h2>
                        <p class="sub-title">Sản phẩm được cập nhật liên tục</p>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-container">

                        <!-- product tab content start -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab1">
                                <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                                    <?php foreach ($listSanPham as $sanPham): ?>
                                        <!-- product item start -->
                                        <div class="product-item">
                                            <figure class="product-thumb">
                                                <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                                                    <img class="pri-img" src="<?= BASE_URL . $sanPham['hinh_anh']; ?>" alt="product">
                                                    <img class="sec-img" src="<?= BASE_URL . $sanPham['hinh_anh']; ?>" alt="product">
                                                </a>
                                                <div class="product-badge">
                                                    <?php
                                                    $ngayNhap = new DateTime($sanPham['ngay_nhap']);
                                                    $ngayHienTai = new DateTime();
                                                    $tinhNgay = $ngayHienTai->diff($ngayNhap);

                                                    if ($tinhNgay->days <= 7) { ?>
                                                        <div class="product-label new">
                                                            <span>Mới</span>
                                                        </div>
                                                    <?php } ?>

                                                    <?php
                                                    if ($sanPham['gia_khuyen_mai']) { ?>
                                                        <div class="product-label discount">
                                                            <span>Giảm giá</span>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="cart-hover">
                                                    <button class="btn btn-cart">Chi tiết</button>
                                                </div>
                                            </figure>
                                            <div class="product-caption text-center">
                                                <h6 class="product-name">
                                                    <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>"><?= $sanPham['ten_san_pham'] ?></a>
                                                </h6>
                                                <div class="price-box">
                                                    <?php
                                                    if ($sanPham['gia_khuyen_mai']) { ?>
                                                        <span class="price-regular"><?= formatprice($sanPham['gia_khuyen_mai']) . 'đ'; ?></span>
                                                        <span class="price-old"><del><?= formatprice($sanPham['gia_san_pham']) . 'đ'; ?></del></span>
                                                    <?php } else { ?>
                                                        <span class="price-old"><del><?= formatprice($sanPham['gia_san_pham']) . 'đ'; ?></del></span>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- product item end -->
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>

                        <!-- product tab content end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product area end -->

    <!-- Section to display categories -->
    <section class="category-area">
        <div class="container">
            <div class="section-title text-center">
                <h2 class="title">Danh mục sản phẩm</h2>
                <!-- <p class="sub-title">Sản phẩm được cập nhật liên tục</p> -->
            </div>

            <div class="row">
                <?php foreach ($listDanhMuc as $danhMuc): ?>
                    <div class="col-md-4 mb-4">
                        <div class="category-item card shadow-sm border-light rounded">
                            <a href="<?= BASE_URL . '?act=tim-kiem&danh_muc=' . $danhMuc['id'] ?>" class="category-link">
                                <img class="card-img-top rounded-top" src="<?= $danhMuc['hinh_anh'] ?>" alt="<?= $danhMuc['ten_danh_muc'] ?>">
                                <div class="card-body text-center">
                                    <h3 class="card-title"><?= $danhMuc['ten_danh_muc'] ?></h3>
                                    <p class="card-text"><?= substr($danhMuc['mo_ta'], 0, 100) ?>...</p>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <style>
        .category-item {
            text-align: center;
            margin-bottom: 30px;
            /* Add spacing between items */
        }

        .category-item h3 {
            font-size: 1.5rem;
            font-weight: bold;
            margin-top: 15px;
        }

        .category-item p {
            font-size: 1rem;
            color: #6c757d;
            margin-bottom: 15px;
        }

        .img-container {
            height: 200px;
            /* Set a fixed height for uniformity */
            overflow: hidden;
            /* Hide the excess part of the image */
            position: relative;
        }

        .category-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Keeps the aspect ratio, fills the container */
            transition: transform 0.3s ease-in-out;
        }

        .category-item img:hover {
            transform: scale(1.05);
            /* Slight zoom effect on hover */
        }
    </style>

    <!-- Bài viết -->
    <section class="latest-blog-area section-padding pt-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Section Title -->
                    <div class="section-title text-center">
                        <h2 class="title">Bài Viết Gần Đây</h2>
                        <!-- <p class="sub-title">Có các bài viết gần đây</p> -->
                    </div>
                    <!-- End Section Title -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="blog-carousel-active slick-row-10 slick-arrow-style">
                        <!-- Loop through each news article -->
                        <?php foreach ($news as $new): ?>
                            <div class="row">
                                <div class="blog-post-item card">
                                    <figure class="blog-thumb">
                                        <a href="<?= BASE_URL . '?act=chi-tiet-tin-tuc&id=' . $new['id'] ?>">
                                            <img class="card-img-top" src="<?= $new['anh'] ?>" alt="blog image">
                                        </a>
                                    </figure>
                                    <div class="card-body">
                                        <h4 class="card-text"><?= $new['tieu_de'] ?></h4> <br>
                                        <p class="card-text"><?= substr($new['noi_dung'], 0, 150) ?>...</p>
                                        <a style="padding: 10px;" href="<?= BASE_URL . '?act=chi-tiet-tin-tuc&id=' . $new['id'] ?>" class="btn btn-primary">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- Latest Blog Area End -->

</main>


<!-- Nút mở chatbot hình gấu -->
<button id="toggle-chat" class="chat-toggle">
    🧸
</button>

<!-- Hộp chat AI cute -->
<div id="chatbox" class="chatbox-container-cute">
    <div class="chatbox-header-cute">🧸 Trợ lý Gấu Bông</div>
    <div id="chat-log" class="chatbox-body-cute"></div>
    <form id="chat-form" class="chatbox-footer-cute">
        <input type="text" id="user-input" placeholder="Gấu đang lắng nghe bạn..." required />
        <button type="submit">🎁 Gửi</button>
    </form>
</div>

<style>
    /* Nút mở */
    .chat-toggle {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #ffccdd;
        border: none;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        font-size: 26px;
        cursor: pointer;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        animation: bounce 2s infinite;
        z-index: 9999;
    }

    @keyframes bounce {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-6px);
        }
    }

    /* Khung chat */
    .chatbox-container-cute {
        position: fixed;
        bottom: 90px;
        right: 20px;
        width: 350px;
        background: #fff0f5;
        border-radius: 16px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        display: none;
        flex-direction: column;
        overflow: hidden;
        z-index: 9998;
        font-family: 'Comic Sans MS', cursive;
    }

    /* Header */
    .chatbox-header-cute {
        background: #ff88aa;
        color: white;
        padding: 12px;
        text-align: center;
        font-weight: bold;
        font-size: 18px;
    }

    /* Nội dung chat */
    .chatbox-body-cute {
        padding: 10px;
        height: 280px;
        overflow-y: auto;
        background: #fffafc;
    }

    .chat-message {
        margin-bottom: 10px;
        display: flex;
        align-items: flex-end;
    }

    .chat-message.user {
        justify-content: flex-end;
    }

    .chat-message.bot {
        justify-content: flex-start;
    }

    .bubble {
        max-width: 80%;
        padding: 10px 14px;
        border-radius: 20px;
        font-size: 14px;
        line-height: 1.4;
    }

    .user .bubble {
        background: #ffc0cb;
        color: white;
        border-bottom-right-radius: 0;
    }

    .bot .bubble {
        background: #ffffff;
        color: #555;
        border-bottom-left-radius: 0;
        border: 1px solid #f2f2f2;
    }

    /* Footer */
    .chatbox-footer-cute {
        display: flex;
        border-top: 1px solid #ffd6e0;
        background: #fffafc;
        padding: 10px;
    }

    .chatbox-footer-cute input {
        flex: 1;
        border: none;
        border-radius: 20px;
        padding: 8px 12px;
        margin-right: 8px;
    }

    .chatbox-footer-cute button {
        background: #ff88aa;
        color: white;
        border: none;
        border-radius: 20px;
        padding: 8px 16px;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggleBtn = document.getElementById("toggle-chat");
        const chatBox = document.getElementById("chatbox");
        const form = document.getElementById("chat-form");
        const input = document.getElementById("user-input");
        const chatLog = document.getElementById("chat-log");

        let firstOpen = true; // Cờ kiểm tra lần đầu mở chat

        toggleBtn.addEventListener("click", () => {
            const isHidden = chatBox.style.display === "none" || chatBox.style.display === "";
            chatBox.style.display = isHidden ? "flex" : "none";

            if (isHidden && firstOpen) {
                // Lời chào lần đầu
                chatLog.innerHTML += `
                <div class="chat-message bot">
                    <div class="bubble">🧸 Xin chào! Trợ lý Gấu Bông luôn sẵn sàng giúp bạn 💬. Bạn muốn tìm gì nào?</div>
                </div>`;
                chatLog.scrollTop = chatLog.scrollHeight;
                firstOpen = false;
            }
        });

        form.addEventListener("submit", async function(e) {
            e.preventDefault();
            const message = input.value.trim();
            if (!message) return;

            // Thêm tin nhắn người dùng
            chatLog.innerHTML += `
    <div class="chat-message user">
        <div class="bubble">${message}</div>
    </div>`;
            input.value = "";
            chatLog.scrollTop = chatLog.scrollHeight;

            // Thêm hiệu ứng Gấu đang gõ...
            const loadingId = "loading-msg";
            chatLog.innerHTML += `
    <div class="chat-message bot" id="${loadingId}">
        <div class="bubble">🧸 Gấu đang gõ...</div>
    </div>`;
            chatLog.scrollTop = chatLog.scrollHeight;

            try {
                const res = await fetch("chatbot.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"  
                    },
                    body: JSON.stringify({
                        message
                    })
                });

                const data = await res.json();
                const reply = data.reply || "Xin lỗi, tôi không hiểu yêu cầu.";

                // Xóa dòng "Gấu đang gõ..."
                document.getElementById(loadingId)?.remove();

                // Hiển thị phản hồi thật
                chatLog.innerHTML += `
        <div class="chat-message bot">
            <div class="bubble">${reply}</div>
        </div>`;
                chatLog.scrollTop = chatLog.scrollHeight;
            } catch (error) {
                document.getElementById(loadingId)?.remove();

                chatLog.innerHTML += `
        <div class="chat-message bot">
            <div class="bubble">❌ Lỗi kết nối. Vui lòng thử lại sau.</div>
        </div>`;
                chatLog.scrollTop = chatLog.scrollHeight;
            }
        });
    });
</script>

<?php require_once 'layout/footer.php'; ?>