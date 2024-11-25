<?php
class KhuyenMai
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllKhuyenMai()
    {
        try {
            $sql = 'SELECT * FROM khuyen_mais WHERE trang_thai = 1 ORDER BY ngay_bat_dau DESC';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            error_log('Lỗi: ' . $e->getMessage());
            return false;
        }
    }
}
