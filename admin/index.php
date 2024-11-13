<?php 

session_start();

// Require file Common
require_once '../commons/env.php'; // Correct path to env.php
require_once '../commons/function.php'; // Correct path to function.php

// Require toàn bộ file Controllers
require_once './controllers/AdminKhuyenMaiController.php'; 
require_once './controllers/AdminBaoCaoThongKeController.php';
require_once './controllers/AdminDanhMucController.php';
require_once './controllers/AdminBaiVietController.php';
require_once './controllers/AdminTrangThaiDonHangController.php'; 
require_once './controllers/AdminBannerController.php';
require_once './controllers/AdminSanPhamController.php';
require_once './controllers/AdminTaiKhoanController.php';
require_once './controllers/AdminBinhLuanController.php';


// Require toàn bộ file Models
require_once './models/AdminDanhMuc.php';
require_once './models/AdminKhuyenMai.php'; 
require_once './models/AdminTrangThaiDonHang.php'; 
require_once './models/AdminBaiViet.php'; 
require_once './models/AdminBanner.php';
require_once './models/AdminSanPham.php';
require_once './models/AdminTaiKhoan.php';
require_once './models/AdminBinhLuan.php';



// Route
$act = $_GET['act'] ?? '/';

if ($act !== 'check-log-admin' && $act !== 'logout-admin') {
    checkLoginAdmin();
}


match ($act) {
    '/' => (new AdminBaoCaoThongKeController())->home(),

    //danh mục
    
    'danh-muc' => (new AdminDanhMucController())->danhSachDanhMuc(),
    'form-them-danh-muc' => (new AdminDanhMucController())->formAddDanhMuc(),
    'them-danh-muc' => (new AdminDanhMucController())->postAddDanhMuc(),
    'form-sua-danh-muc' => (new AdminDanhMucController())->formEditAddDanhMuc(),
    'sua-danh-muc' => (new AdminDanhMucController())->postEditAddDanhMuc(),
    'xoa-danh-muc' => (new AdminDanhMucController())->deleteDanhMuc(),

    // rou sản phẩm

    'san-pham' => (new AdminSanPhamController())->danhSachSanPham(),
    'form-them-san-pham' => (new AdminSanPhamController())->formAddSanPham(),
    'them-san-pham' => (new AdminSanPhamController())->postAddSanPham(),
    'form-sua-san-pham' => (new AdminSanPhamController())->formEditAddSanPham(),
    'sua-san-pham' => (new AdminSanPhamController())->postEditAddSanPham(),
    'sua-album-san-pham' => (new AdminSanPhamController())->postEditAnhSanPham(),
    'xoa-san-pham' => (new AdminSanPhamController())->deleteSanPham(),
    'chi-tiet-san-pham' => (new AdminSanPhamController())->getDetailSanPham(),

    // khuyến mãi 

    'khuyen-mai' => (new AdminKhuyenMaiController())->danhSachKhuyenMai(),
    'form-them-khuyen-mai' => (new AdminKhuyenMaiController())->formAddKhuyenMai(),
    'them-khuyen-mai' => (new AdminKhuyenMaiController())->postAddKhuyenMai(),
    'chi-tiet-khuyen-mai' => (new AdminKhuyenMaiController)->getDetailKhuyenMai(),
    'form-sua-khuyen-mai' => (new AdminKhuyenMaiController())->formEditKhuyenMai(),
    'sua-khuyen-mai' => (new AdminKhuyenMaiController())->KhuyenMai(),
    'xoa-khuyen-mai' => (new AdminKhuyenMaiController())->xoaKhuyenMai(),

     // Trạng thái Đơn Hàng

     'trang-thai-don-hang' => (new AdminTrangThaiDonHangController())->danhSachTrangThai(),
     'form-cap-nhat-trang-thai' => (new AdminTrangThaiDonHangController())->formSuaTrangThai(),
     'cap-nhat-trang-thai' => (new AdminTrangThaiDonHangController())->postSuaTrangThai(),
     'xoa-trang-thai' => (new AdminTrangThaiDonHangController())->xoaTrangThai(),
     'form-them-trang-thai' => (new AdminTrangThaiDonHangController())->formThemTrangThai(),
     'them-trang-thai' => (new AdminTrangThaiDonHangController())->themTrangThai(), 

     // bai viết

    'danh-sach-bai-viet' => (new AdminBaiVietController)->danhSachBaiViet(),
    'form-them-bai-viet' => (new AdminBaiVietController)->formAddBaiViet(),
    'them-bai-viet' => (new AdminBaiVietController)->postAddBaiViet(),
    'form-sua-bai-viet' => (new AdminBaiVietController)->formSuaBaiViet(),
    'sua-bai-viet' => (new AdminBaiVietController)->postEditAddBaiViet(),
    'xoa-bai-viet' => (new AdminBaiVietController)->xoaBaiViet(),
    'chi-tiet-bai-viet' => (new AdminBaiVietController)->getDetailBaiViet(),

    // banner
    'danh-sach-banner' => (new AdminBannerController)->danhSachBanner(),
    'form-them-banner' => (new AdminBannerController)->formAddBanner(),
    'them-banner' => (new AdminBannerController)->postAddBanner(),
    'form-sua-banner' => (new AdminBannerController)->formSuaBanner(),
    'sua-banner' => (new AdminBannerController)->suaBanner(),
    'chi-tiet-banner' => (new AdminBannerController())->getDetailBanner(),
    'xoa-banner' => (new AdminBannerController)->xoaBanner(),

    // rou Đơn hàng quản lý tài khoản
    // Tài khoản quản trị
    'list-tai-khoan-quan-tri' => (new AdminTaiKhoanController())->danhSachQuanTri(),
    'form-them-quan-tri' => (new AdminTaiKhoanController())->formAddQuanTri(),
    'them-quan-tri' => (new AdminTaiKhoanController())->postAddQuanTri(),
    'form-sua-quan-tri' => (new AdminTaiKhoanController())->formEditQuanTri(),
    'sua-quan-tri' => (new AdminTaiKhoanController())->postEditQuanTri(),

    // reset pass
    'reset-password' => (new AdminTaiKhoanController())->resetPassword(),

    // Quản lý tài khoản khách hàng 
    'list-tai-khoan-khach-hang' => (new AdminTaiKhoanController())->danhSachKhachHang(),
    'form-sua-khach-hang' => (new AdminTaiKhoanController())->formEditKhachHang(),
    'sua-khach-hang' => (new AdminTaiKhoanController())->postEditKhachHang(),
    'chi-tiet-khach-hang' => (new AdminTaiKhoanController())->deltailKhachHang(),

    // QUản lý tài khoản cá nhân(quản trị)
    'form-sua-thong-tin-ca-nhan-quan-tri' => (new AdminTaiKhoanController())->formEditCaNhanQuanTri(),
    'sua-thong-tin-ca-nhan-quan-tri' => (new AdminTaiKhoanController())->postEditCaNhanQuanTri(),
    
    'sua-mat-khau-ca-nhan-quan-tri' => (new AdminTaiKhoanController())->postEditMatKhauCaNhan(),


    // auth
    'login-admin' => (new AdminTaiKhoanController)->formLogin(),
    'check-log-admin' => (new AdminTaiKhoanController)->login(),
    'logout-admin' => (new AdminTaiKhoanController)->logout(),

     // Bình luận
     'update-trang-thai-binh-luan' => (new AdminSanPhamController())->updateTrangThaiBinhLuan(),
     'updata-trang-thai-binh-luan' => (new AdminBinhLuanController())->updataTrangThaiBinhLuan(),
     'binh-luan' => (new AdminBinhLuanController())->danhSachBinhLuan(),
     'delete-binh-luan' => (new AdminBinhLuanController())->xoaBinhLuan(),
 

 
};
