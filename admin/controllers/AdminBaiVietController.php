<?php
// session_start();

class AdminBaiVietController
{
    public $modelBaiViet;

    public function __construct()
    {
        $this->modelBaiViet = new AdminBaiViet();
    }

    public function danhSachBaiViet()
    {

        $listBaiViet = $this->modelBaiViet->getAllBaiViet();
        require_once './views/baiviet/listBaiViet.php';
    }

    public function getDetailBaiViet()
    {
        $id = $_GET['id_bai_viet'];
        $baiViet =  $this->modelBaiViet->getDetailBaiViet($id);
        // var_dump($baiViet); die();

        if ($baiViet) {
            require_once './views/baiviet/detailBaiViet.php';
        } else {
            header('location: ' . BASE_URL_ADMIN . '?act=danh-sach-bai-viet');
            exit();
        }
    }

    public function formAddBaiViet()
    {
        $listBaiViet = $this->modelBaiViet->getAllBaiViet();


        require_once './views/baiviet/addBaiViet.php';

        deleteSessionError();
    }

    public function postAddBaiViet()
    {
        // var_dump($_POST);

        // Kiểm tra xem dữ liệu có submit lên không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu
            $tieu_de = $_POST['tieu_de'] ?? '';
            $noi_dung = $_POST['noi_dung'] ?? '';
            $ngay_dang = $_POST['ngay_dang'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';
            $hinh_anh = $_FILES['hinh_anh'] ?? null;
        
            // Kiểm tra lỗi
            $errors = [];
            if (empty($tieu_de)) {
                $errors['tieu_de'] = 'Tiêu đề không được để trống';
            }
            if (empty($noi_dung)) {
                $errors['noi_dung'] = 'Nội dung không được để trống';
            }
            if (empty($ngay_dang)) {
                $errors['ngay_dang'] = 'Ngày đăng không được để trống';
            }
            if (empty($trang_thai)) {
                $errors['trang_thai'] = 'Trạng thái không được để trống';
            }
        
            // Kiểm tra file upload
            if (!empty($hinh_anh['name'])) {
                $file_thumb = uploadFile($hinh_anh, './uploads/');
                if (!$file_thumb) {
                    $errors['hinh_anh'] = 'Lỗi khi tải ảnh lên';
                }
            } else {
                $file_thumb = null; // Cho phép không bắt buộc có ảnh
            }
        
            $_SESSION['errors'] = $errors;
        
            if (empty($errors)) {
                $this->modelBaiViet->insertBaiViet(
                    $tieu_de,
                    $noi_dung,
                    $ngay_dang,
                    $trang_thai,
                    $file_thumb
                );
                header('location: ' . BASE_URL_ADMIN . '?act=danh-sach-bai-viet');
                exit();
            } else {
                require_once './views/baiviet/addBaiViet.php';
            }
        }
    }

    public function formSuaBaiViet()
    {
        $id = $_GET['id_bai_viet'];
        $baiViet =  $this->modelBaiViet->getDetailBaiViet($id);
        // var_dump($baiViet); die();
        if ($baiViet) {
            require_once './views/baiviet/editBaiViet.php';
            // $this->deleteSessionError();
            deleteSessionError();
        } else {
            header('location: ' . BASE_URL_ADMIN . 'act=danh-sach-bai-viet');
            exit();
        }
    }

    public function postEditAddBaiViet()
    {
        // var_dump($_POST);    
        // die();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'] ?? '';
            $tieu_de = $_POST['tieu_de'] ?? '';
            $noi_dung = $_POST['noi_dung'] ?? '';
            $ngay_dang = $_POST['ngay_dang'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';
            $hinh_anh = $_FILES['hinh_anh'] ?? null;
        
            // Lấy thông tin bài viết cũ
            $baiViet = $this->modelBaiViet->getDetailBaiViet($id);
        
            // Kiểm tra lỗi
            $errors = [];
            if (empty($tieu_de)) {
                $errors['tieu_de'] = 'Tiêu đề không được để trống';
            }
            if (empty($noi_dung)) {
                $errors['noi_dung'] = 'Nội dung không được để trống';
            }
            if (empty($ngay_dang)) {
                $errors['ngay_dang'] = 'Ngày đăng không được để trống';
            }
            if (empty($trang_thai)) {
                $errors['trang_thai'] = 'Trạng thái không được để trống';
            }
        
            // Kiểm tra file upload
            if (!empty($hinh_anh['name'])) {
                $file_thumb = uploadFile($hinh_anh, './uploads/');
                if (!$file_thumb) {
                    $errors['hinh_anh'] = 'Lỗi khi tải ảnh lên';
                }
            } else {
                $file_thumb = $baiViet['hinh_anh']; // Giữ nguyên ảnh cũ nếu không upload mới
            }
        
            $_SESSION['errors'] = $errors;
        
            if (empty($errors)) {
                $this->modelBaiViet->updateBaiViet(
                    $id,
                    $tieu_de,
                    $noi_dung,
                    $ngay_dang,
                    $trang_thai,
                    $file_thumb
                );
                header('location: ' . BASE_URL_ADMIN . '?act=danh-sach-bai-viet');
                exit();
            } else {
                header('location: ' . BASE_URL_ADMIN . '?act=form-sua-bai-viet&id_bai_viet=' . $id);
                exit();
            }
        }
        
    }

    public function xoaBaiViet()
    {
        // Lấy ra id danh mục cần xóa
        $id = $_GET['id_bai_viet'];
        $baiViet =  $this->modelBaiViet->getDetailBaiViet($id);

        if ($baiViet) {
            // Xóa danh mục
            $this->modelBaiViet->destroyBaiViet($id);
        }
        header('location: ' . BASE_URL_ADMIN . '?act=danh-sach-bai-viet');
        exit();
    }
}
