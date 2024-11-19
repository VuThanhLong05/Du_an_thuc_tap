<?php
class AdminDanhGiaController
{
    public $conn;

    public function __construct()
    {
        $this->conn = new AdminDanhGia(); // Khởi tạo model AdminDanhGia
    }

    // Phương thức hiển thị danh sách đánh giá
    public function danhSachDanhGia()
    {
        // Lấy toàn bộ danh sách bình luận
        $listDanhGia = $this->conn->getAllDanhGia();

        require_once './views/danhgia/danh_sach.php';
    }
    // Phương thức cập nhật trạng thái duyệt của đánh giá
    public function updateTrangThaiDanhGia()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_danh_gia = isset($_POST['id']) ? intval($_POST['id']) : 0;
            $name_view = $_POST['name_view'] ?? '';
            $danhGia = $this->conn->getDetailDanhGia($id_danh_gia);

            if ($danhGia) {
                $trang_thai_moi = ($danhGia['trang_thai'] == 1) ? 0 : 1; // 1 là duyệt, 0 là chưa duyệt
                $status = $this->conn->updateTrangThaiDanhGia($id_danh_gia, $trang_thai_moi);

                if ($status) {
                    $redirectUrl = ($name_view == 'detail_khach')
                        ? BASE_URL_ADMIN . '?act=chi-tiet-khach-hang&id_khach_hang=' . $danhGia['tai_khoan_id']
                        : BASE_URL_ADMIN . '?act=danh-gia&id_don_hang=' . $danhGia['don_hang_id'];

                    header('location: ' . $redirectUrl);
                    exit();
                }
                //  K hiểu ThuThao code gì
            }
        }
    }
}
