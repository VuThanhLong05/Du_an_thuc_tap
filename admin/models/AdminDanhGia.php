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
        try {
            $sql = 'SELECT danh_gias.*, tai_khoans.ho_ten, san_phams.ten_san_pham 
                    FROM danh_gias 
                    LEFT JOIN tai_khoans ON danh_gias.tai_khoan_id = tai_khoans.id
                    LEFT JOIN san_phams ON danh_gias.san_pham_id = san_phams.id';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }

    // Lấy chi tiết một đánh giá
    public function getDetailDanhGia($id)
    {
        try {
            $sql = 'SELECT * FROM danh_gias WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }

    // Cập nhật trạng thái duyệt của một đánh giá
    public function updateDanhGia($id, $noi_dung, $trang_thai)
    {
        try {
            $sql = 'UPDATE danh_gias SET noi_dung = :noi_dung, trang_thai = :trang_thai  WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':noi_dung' => $noi_dung,
                ':trang_thai' => $trang_thai,
                ':id' => $id
            ]);

            return true;
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }

    public function updateTrangThaiDanhGia($id, $trang_thai)
    {
        try {
            $sql = 'UPDATE danh_gias
                        SET
                            trang_thai = :trang_thai
                        WHERE id = :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':trang_thai' => $trang_thai,
                ':id' => $id
            ]);
            // lấy id sản phẩm vừa thêm
            return true;
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }
}
