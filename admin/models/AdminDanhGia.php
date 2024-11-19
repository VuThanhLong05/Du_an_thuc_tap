<?php
class AdminDanhGia
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy toàn bộ danh sách đánh giá
    public function getAllDanhGia()
    {
        $stmt = $this->conn->prepare("SELECT account.ho_ten, orders.ma_don_hang, danh_gias.noi_dung, danh_gias.ngay_dang, danh_gias.trang_thai FROM `danh_gias`
                                            INNER JOIN don_hangs as orders
                                            on danh_gias.don_hang_id = orders.id
                                            INNER JOIN tai_khoans as account
                                            on account.id = danh_gias.tai_khoan_id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy chi tiết một đánh giá
    public function getDetailDanhGia($id_danh_gia)
    {
        $stmt = $this->conn->prepare("SELECT * FROM danh_gias WHERE id = :id");
        $stmt->bindParam(":id", $id_danh_gia, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cập nhật trạng thái duyệt của một đánh giá
    public function updateTrangThaiDanhGia($id_danh_gia, $trang_thai_moi)
    {
        $stmt = $this->conn->prepare("UPDATE danh_gias SET trang_thai = :trang_thai WHERE id = :id");
        $stmt->bindParam(":trang_thai", $trang_thai_moi, PDO::PARAM_INT);
        $stmt->bindParam(":id", $id_danh_gia, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
