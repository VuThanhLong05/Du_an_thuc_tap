<?php
class AdminLienHe
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllLienHe()
    {
        try {
            $sql = 'SELECT * FROM lien_hes';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo 'Lỗi' . $e->getMessage();
        }
    }

    // public function insertBaiViet(
    //     $tieu_de,
    //     $noi_dung,
    //     $ngay_dang,
    //     $trang_thai
    // ) {
    //     try {
    //         $sql = 'INSERT INTO bai_viets (tieu_de, noi_dung, ngay_dang, trang_thai)
    //             VALUES (:tieu_de, :noi_dung, :ngay_dang, :trang_thai)';

    //         $stmt = $this->conn->prepare($sql);

    //         $stmt->execute([
    //             ':tieu_de' => $tieu_de,
    //             ':noi_dung' => $noi_dung,
    //             ':ngay_dang' => $ngay_dang,
    //             ':trang_thai' => $trang_thai,
    //         ]);

    //         return true;
    //     } catch (Exception $e) {
    //         echo 'Lỗi khi thêm bài viết: ' . $e->getMessage();
    //         return false;
    //     }
    // }

    public function getDetailLienHe($id)
    {
        try {
            $sql = 'SELECT * FROM lien_hes WHERE id = :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':id' => $id
            ]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo 'Lỗi' . $e->getMessage();
        }
    }

    // public function updateBaiViet(
    //     $id,
    //     $tieu_de,
    //     $noi_dung,
    //     $ngay_dang,
    //     $trang_thai
    // ) {
    //     try {
    //         $sql = 'UPDATE bai_viets 
    //             SET 
    //                 tieu_de = :tieu_de, 
    //                 noi_dung = :noi_dung,
    //                 ngay_dang = :ngay_dang, 
    //                 trang_thai = :trang_thai  
    //             WHERE id = :id';
    //         // var_dump($sql); die();

    //         $stmt = $this->conn->prepare($sql);

    //         $stmt->execute([
    //             ':tieu_de' => $tieu_de,
    //             ':noi_dung' => $noi_dung,
    //             ':ngay_dang' => $ngay_dang,
    //             ':trang_thai' => $trang_thai,
    //             ':id' => $id

    //         ]);
    //         // var_dump($stmt); die();
    //         return true;
    //     } catch (Exception $e) {
    //         echo 'Lỗi' . $e->getMessage();
    //     }
    // }

    public function destroyLienHe($id)
    {
        try {
            $sql = 'DELETE FROM lien_hes WHERE id = :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':id' => $id
            ]);

            return true;
        } catch (Exception $e) {
            echo 'Lỗi' . $e->getMessage();
        }
    }
}
