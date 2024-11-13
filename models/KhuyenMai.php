<?php
class KhuyenMai
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Get all promotions
    public function getAllKhuyenMai(): array
    {
        try {
            $sql = 'SELECT * FROM khuyen_mais';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Return associative array
        } catch (Exception $e) {
            error_log('Error in getAllKhuyenMai: ' . $e->getMessage());  // Log error
            return [];  // Return an empty array on failure
        }
    }

    public function getKhuyenMaiById(int $id): ?array
    {
        try {
            $sql = 'SELECT * FROM khuyen_mais WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);  // Return the promotion as an associative array
        } catch (Exception $e) {
            error_log('Error in getKhuyenMaiById: ' . $e->getMessage());  // Log error
            return null;  // Return null if the promotion is not found or an error occurs
        }
    }

    // Get promotion details by ID
    public function getDetailKhuyenMai(int $id): ?array
    {
        try {
            $sql = 'SELECT * FROM khuyen_mais WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);  // Return a single row as an associative array
        } catch (Exception $e) {
            error_log('Error in getDetailKhuyenMai: ' . $e->getMessage());  // Log error
            return null;  // Return null if not found
        }
    }

    // Add a new promotion
    public function addKhuyenMai(string $ten_khuyen_mai, float $gia_tri, string $mo_ta, int $trang_thai): int
    {
        try {
            $sql = 'INSERT INTO khuyen_mais (ten_khuyen_mai, gia_tri, mo_ta, trang_thai)
                    VALUES (:ten_khuyen_mai, :gia_tri, :mo_ta, :trang_thai)';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':ten_khuyen_mai' => $ten_khuyen_mai,
                ':gia_tri' => $gia_tri,
                ':mo_ta' => $mo_ta,
                ':trang_thai' => $trang_thai
            ]);

            return (int) $this->conn->lastInsertId();  // Return the last inserted ID
        } catch (Exception $e) {
            error_log('Error in addKhuyenMai: ' . $e->getMessage());  // Log error
            return 0;  // Return 0 if insert fails
        }
    }

    // Update an existing promotion
    public function updateKhuyenMai(int $id, string $ten_khuyen_mai, float $gia_tri, string $mo_ta, int $trang_thai): bool
    {
        try {
            $sql = 'UPDATE khuyen_mais
                    SET ten_khuyen_mai = :ten_khuyen_mai, gia_tri = :gia_tri, mo_ta = :mo_ta, trang_thai = :trang_thai
                    WHERE id = :id';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':ten_khuyen_mai' => $ten_khuyen_mai,
                ':gia_tri' => $gia_tri,
                ':mo_ta' => $mo_ta,
                ':trang_thai' => $trang_thai,
                ':id' => $id
            ]);

            return $stmt->rowCount() > 0;  // Return true if a row was updated
        } catch (Exception $e) {
            error_log('Error in updateKhuyenMai: ' . $e->getMessage());  // Log error
            return false;  // Return false if update fails
        }
    }

    // Delete a promotion by ID
    public function deleteKhuyenMai(int $id): bool
    {
        try {
            $sql = 'DELETE FROM khuyen_mais WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->rowCount() > 0;  // Return true if a row was deleted
        } catch (Exception $e) {
            error_log('Error in deleteKhuyenMai: ' . $e->getMessage());  // Log error
            return false;  // Return false if deletion fails
        }
    }
}
