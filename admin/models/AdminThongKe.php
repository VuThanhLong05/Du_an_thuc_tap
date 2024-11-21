<?php
class AdminThongKe
{

    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllThongKe()
    {
        try {
            $sql = "SELECT COUNT(id) AS tong_so_don_hang, SUM(tong_tien) AS tong_tien FROM don_hangs";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);  // Trả về kết quả truy vấn
        } catch (Exception $e) {
            echo 'Lỗi' . $e->getMessage();
        }
    }

    public function getDonHangMoiNhat()
    {
        try {
            $sql = "SELECT * FROM don_hangs ORDER BY ngay_dat DESC LIMIT 10";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Lấy toàn bộ dữ liệu
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }

    public function getBaoCaoTrangThai()
    {
        $sql = "SELECT t.ten_trang_thai, COUNT(d.id) AS so_luong_don_hang
                FROM don_hangs AS d
                JOIN trang_thai_don_hangs AS t ON d.trang_thai_id = t.id
                GROUP BY t.ten_trang_thai";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDoanhThuTungNgay()
    {
        try {
            $sql = "SELECT DATE(ngay_dat) AS ngay, SUM(tong_tien) AS tong_tien 
                FROM don_hangs 
                GROUP BY DATE(ngay_dat) 
                ORDER BY ngay ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }
}
