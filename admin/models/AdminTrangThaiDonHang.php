<?php
class AdminTrangThaiDonHang {
    private $db;

    // Kết nối với cơ sở dữ liệu
    public function __construct() {
        $this->db = new PDO("mysql:host=localhost;dbname=du_an_1", "root", "");
    }

    // Lấy tất cả trạng thái đơn hàng
    public function getAllTrangThai() {
        $stmt = $this->db->prepare("SELECT * FROM trang_thai_don_hangs");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm trạng thái đơn hàng mới
    public function addTrangThai($tenTrangThai) {
        $stmt = $this->db->prepare("INSERT INTO trang_thai_don_hangs (ten_trang_thai) VALUES (:tenTrangThai)");
        $stmt->bindParam(':tenTrangThai', $tenTrangThai);
        return $stmt->execute();
    }

    // Lấy trạng thái theo ID
    public function getTrangThaiById($id) {
        $stmt = $this->db->prepare("SELECT * FROM trang_thai_don_hangs WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cập nhật trạng thái đơn hàng
    public function updateTrangThai($id, $tenTrangThai) {
        $stmt = $this->db->prepare("UPDATE trang_thai_don_hangs SET ten_trang_thai = :tenTrangThai WHERE id = :id");
        $stmt->bindParam(':tenTrangThai', $tenTrangThai);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Xóa trạng thái đơn hàng
    public function deleteTrangThai($id)
    {
        try {
            $sql = 'DELETE FROM trang_thai_don_hangs WHERE id = :id';

            $stmt = $this->db->prepare($sql);

            $stmt->execute([
                ':id' => $id
            ]);

            return true;
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }

    // Thêm trạng thái đơn hàng mới (phương thức mới)
    public function themTrangThai($tenTrangThai) {
        try {
            $stmt = $this->db->prepare("INSERT INTO trang_thai_don_hangs (ten_trang_thai) VALUES (:ten_trang_thai)");
            $stmt->bindParam(':ten_trang_thai', $tenTrangThai);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            echo 'Lỗi khi thêm trạng thái: ' . $e->getMessage();
            return false;
        }
    }
}
?>