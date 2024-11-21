<?php
class AdminDanhGiaController
{
    public $conn;

    public function __construct()
    {
        $this->conn = new AdminDanhGia(); // Khởi tạo model AdminDanhGia
    }

    public function danhSachDanhGia()
    {
        // Lấy toàn bộ danh sách bình luận
        $listDanhGia = $this->conn->getAllDanhGia();

        require_once './views/danhgia/danh_sach.php';
    }
    // Phương thức hiển thị danh sách đánh giá
    public function updateTrangThaiDanhGia()
    {
        $id_danh_gia = $_POST['id_danh_gia'];
        $name_view = $_POST['name_view'];
        $danhGia = $this->conn->getDetailDanhGia($id_danh_gia);

        if ($danhGia) {
            $trang_thai_update = '';
            if ($danhGia['trang_thai'] == 1) {
                $trang_thai_update = 2;
            } else {
                $trang_thai_update = 1;
            }
            $status = $this->conn->updateTrangThaiDanhGia($id_danh_gia, $trang_thai_update);
            if ($status) {
                if ($name_view == 'detail_khach') {
                    header('location: ' . BASE_URL_ADMIN . '?act=chi-tiet-khach-hang&id_khach_hang=' . $danhGia['tai_khoan_id']);
                    exit();
                } else {
                    header('location: ' . BASE_URL_ADMIN . '?act=binh-luan&id_san_pham=' . $danhGia['san_pham_id']);
                    exit();
                }
            }
        }
    }
}
