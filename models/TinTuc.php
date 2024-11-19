<?php
class TinTuc
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Method to get all news articles
    public function getAllTinTuc()
    {
        try {
            $sql = 'SELECT * FROM tin_tucs ORDER BY ngay_tao DESC';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }

    // Method to get details of a specific news article by its ID
    public function getDetailTinTuc($id)
    {
        try {
            $sql = 'SELECT * FROM tin_tucs WHERE id = :id';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }

    // Method to add a new news article
    public function addTinTuc($tieu_de, $noi_dung, $ngay_tao, $trang_thai)
    {
        try {
            $sql = 'INSERT INTO tin_tucs (tieu_de, noi_dung, ngay_tao, trang_thai)
                    VALUES (:tieu_de, :noi_dung, :ngay_tao, :trang_thai)';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':tieu_de' => $tieu_de,
                ':noi_dung' => $noi_dung,
                ':ngay_tao' => $ngay_tao,
                ':trang_thai' => $trang_thai
            ]);

            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }

    // Method to update an existing news article
    public function updateTinTuc($id, $tieu_de, $noi_dung, $trang_thai)
    {
        try {
            $sql = 'UPDATE tin_tucs
                    SET tieu_de = :tieu_de, noi_dung = :noi_dung, trang_thai = :trang_thai
                    WHERE id = :id';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':tieu_de' => $tieu_de,
                ':noi_dung' => $noi_dung,
                ':trang_thai' => $trang_thai,
                ':id' => $id
            ]);

            return $stmt->rowCount();
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }

    // Method to delete a news article by its ID
    public function deleteTinTuc($id)
    {
        try {
            $sql = 'DELETE FROM tin_tucs WHERE id = :id';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);

            return $stmt->rowCount();
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }
}
