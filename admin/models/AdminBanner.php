<?php
class AdminBanner
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllBanner()
    {
        try {
            $sql = 'SELECT * FROM banners';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo 'Lỗi' . $e->getMessage();
        }
    }

    public function insertBanner(
        $tieu_de,
        $trang_thai,
        $hinh_anh



    ) {
        try {
            $sql = 'INSERT INTO banners (tieu_de, trang_thai, hinh_anh)
                    VALUES (:tieu_de, :trang_thai, :hinh_anh)';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':tieu_de' => $tieu_de,
                ':trang_thai' => $trang_thai,
                ':hinh_anh' => $hinh_anh
            ]);

            // Lấy id sản phẩm vừa thêm
            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            echo 'Lỗi' . $e->getMessage();
        }
    }


    public function insertAlbumAnhBanner($banner_id, $hinh_anh)
    {
        try {
            $sql = 'INSERT INTO banners (banner_id, hinh_anh)
                    VALUES (:banner_id, :hinh_anh)';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':banner_id' => $banner_id,
                ':hinh_anh' => $hinh_anh
            ]);

            // Lấy id sản phẩm vừa thêm
            return true;
        } catch (Exception $e) {
            echo 'Lỗi' . $e->getMessage();
        }
    }

    public function getDetailBanner($id)
    {
        $sql = 'SELECT * FROM banners WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);

        $banner = $stmt->fetch();
        if (!$banner) {
            // Nếu không có banner, quay lại trang danh sách
            header('Location: ' . BASE_URL_ADMIN . '?act=danh-sach-banner');
            exit();
        }
        return $banner;
    }


    public function updateBanner(
        $banner_id,
        $tieu_de,
        $trang_thai,
        $hinh_anh
    ) {
        try {
            // var_dump('abc'); die();
            $sql = 'UPDATE banners
                    SET
                        tieu_de = :tieu_de,
                        trang_thai = :trang_thai,
                        hinh_anh = :hinh_anh
                    WHERE id = :id';
            // var_dump($sql); die();

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':tieu_de' => $tieu_de,
                ':trang_thai' => $trang_thai,
                ':hinh_anh' => $hinh_anh,
                ':id' => $banner_id
            ]);

            // Lấy id sản phẩm vừa thêm
            return true;
        } catch (Exception $e) {
            echo 'Lỗi' . $e->getMessage();
        }
    }

    public function destroyBanner($id)
    {
        try {
            $sql = 'DELETE FROM banners WHERE id = :id';

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
