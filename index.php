<?php 

// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';

// Require toàn bộ file Models
require_once './models/KhuyenMai.php';

// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Trang chủ
    '/' => (new HomeController())->home(),
    
    'khuyen-mai' => (new HomeController())->danhSachKhuyenMai(), // List all promotions
    // 'chi-tiet-khuyen-mai ' => (new HomeController())->getDetailKhuyenMai(),// View a specific promotion
    'them-khuyen-mai'=>(new HomeController())->formAddKhuyenMai(),// Form for adding a new promotion
    'post-add-khuyen-mai' => (new HomeController())->postAddKhuyenMai(),// Add a new promotion to the database
    'sua-khuyen-mai' => (new HomeController())->formEditKhuyenMai(),// Form for editing a promotion
    'post-edit-khuyen-mai' => (new HomeController())->postEditKhuyenMai(),// Update promotion
    'xoa-khuyen-mai' => (new HomeController())->deleteKhuyenMai(),// Delete promotion
    
};