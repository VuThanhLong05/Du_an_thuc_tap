<?php
session_start();
// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
// require_once './controllers/TaiKhoanController.php';
require_once './controllers/HomeController.php';
require_once './controllers/TaiKhoanController.php';
require_once './controllers/LienHeController.php';
require_once './controllers/KhuyenMaiController.php';
require_once './controllers/BinhLuanController.php';
require_once './controllers/TinTucController.php';
// require_once '';

// require_once './views/sanpham/search.php';


// Require toàn bộ file Models
require_once './models/SanPham.php';
require_once './models/TaiKhoan.php';
require_once './models/GioHang.php';
require_once './models/LienHe.php';
require_once './models/KhuyenMai.php';
require_once './models/BinhLuan.php';
require_once './models/TinTuc.php';


// Route
$act = $_GET['act'] ?? '/';
// var_dump($_GET['act']);die();

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Trang chủ
    '/' => (new HomeController())->home(),

    // sản phẩm
    'chi-tiet-san-pham' => (new HomeController())->chiTietSanPham(),
    'danh-sach-san-pham' => (new HomeController())->danhSachSanPham(),
    'them-gio-hang' => (new HomeController())->addGioHang(),
    'gio-hang' => (new HomeController())->gioHang(),

    // đăng ký nhập
    'login' => (new HomeController())->formLogin(),
    'check-login' => (new HomeController())->postLogin(),
    'logout' => (new HomeController())->Logout(),
    'list-tai-khoan' => (new TaiKhoanController())->danhSach(),
    'form-them' => (new TaiKhoanController())->formAdd(),
    'them' => (new TaiKhoanController())->postAdd(),

    // Quản lý liên hệ
    // 'lien-he' => (new LienHeController())->danhSach(),
    'form-them-lien-he' => (new LienHeController())->formAdd(), // Hiển thị form thêm liên hệ
    'them-lien-he' => (new LienHeController())->postAdd(),      // Xử lý thêm liên hệ

    // Khuyến mãi
    'danh-sach-khuyen-mai' => (new KhuyenMaiController())->danhSachKhuyenMai(),

    // Bình luận
    'form-them-binh-luan' => (new BinhLuanController())->addBinhLuan(),

    /// quanr lí tin tức 
    'danh-sach-tin-tuc' => (new TinTucController())->danhSachTinTuc(),
    'chi-tiet-tin-tuc' => (new TinTucController())->detailTinTuc(),

    // search
    'tim-kiem' => (new HomeController())->timKiemSanPham(),
};
