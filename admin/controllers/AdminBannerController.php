<?php
class AdminBannerController
{

    public $modelBanner;

    public function __construct()
    {

        $this->modelBanner = new AdminBanner();
    }

    public function danhSachBanner()
    {

        $listBanner = $this->modelBanner->getAllBanner();

        require_once './views/banner/listBanner.php';
    }

    public function formAddBanner()
    {
        $listBanner = $this->modelBanner->getAllBanner();

        require_once './views/banner/addBanner.php';
        // var_dump('Form thêm');
        // die();

        // Xóa Session sau khi load trang;
        deleteSessionError();
    }

    public function postAddBanner()
    {


        // Kiểm tra xem dữ liệu có submit lên không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // code
            // Lấy ra dữ liệu
            // var_dump($_FILES); die();
            $tieu_de = $_POST['tieu_de'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';
            
            // Lưu hình ảnh
            $hinh_anh = $_FILES['hinh_anh']  ?? '';
            $file_thumb = uploadFile($hinh_anh, './uploads/');
            // var_dump($file_thumb); die();
            // Mảng hình ảnh
            $img_array = $_FILES['img_array'];



            // Tạo 1 mảng trống để chứa dữ liệu
            $errors = [];
            if (empty($tieu_de)) {
                $errors['tieu_de'] = 'Tiêu đề banner không được để trống';
            }

            if (empty($trang_thai)) {
                $errors['trang_thai'] = 'Phải chọn trạng thái banner';
            }

            // if ($_FILES['hinh_anh']['errors'] !== 0 ) {
            //     $errors['hinh_anh'] = 'Phải chọn ảnh banner';
            // }

            $_SESSION['errors'] = $errors;

            // Nếu không có lỗi tiến hành thêm sản phẩm
            if (empty($errors)) {
                // Nếu không có lỗi thì tiến hành thêm sản phẩm
                // var_dump('ok');

                $banner_id =  $this->modelBanner->insertBanner(
                    $tieu_de,
                    $trang_thai,
                    $file_thumb
                );


                header('location: ' . BASE_URL_ADMIN . '?act=danh-sach-banner');
                exit();
            } else {
                // Trả về form và lỗi
                // Đặt chỉ thị xóa se
                $_SESSION['flash'] = true;

                header('location: ' . BASE_URL_ADMIN . '?act=form-them-banner');
                exit();
            }
        }
    }

    public function getDetailBanner()
    {
        $id = $_GET['id_banner'];
        $banner =  $this->modelBanner->getDetailBanner($id);
        // var_dump($banner); die();

        if ($banner) {
            require_once './views/banner/detailBanner.php';
        } else {
            header('location: ' . BASE_URL_ADMIN . '?act=danh-sach-banner');
            exit();
        }
    }



    public function formSuaBanner()
    {


        $id = $_GET['id_banner'];
        $banner =  $this->modelBanner->getDetailBanner($id);
        // var_dump($sanPham); die();
        if ($banner) {
            require_once './views/banner/editBanner.php';
            deleteSessionError();
        } else {
            header('location: ' . BASE_URL_ADMIN . '?act=san-pham');
            exit();
        }

        // Lấy ra thông tin của danh mục cần sửa
        // var_dump('Form sủa');
        // die();
    }

    public function suaBanner()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Lấy dữ liệu
        $banner_id = $_POST['banner_id'];
        
        $bannerOld = $this->modelBanner->getDetailBanner($banner_id);
        $old_file = $bannerOld['hinh_anh'];

        // var_dump($_FILES); die();
        $tieu_de = $_POST['tieu_de'] ?? '';
        $trang_thai = $_POST['trang_thai'] ?? '';
        // Kiểm tra xem có file ảnh mới không
        $hinh_anh = $_FILES['hinh_anh'] ?? null;

        // Mảng lưu lỗi
        $errors = [];
            if (empty($tieu_de)) {
                $errors['tieu_de'] = 'Tiêu đề banner không được để trống';
            }

            if (empty($trang_thai)) {
                $errors['trang_thai'] = 'Phải chọn trạng thái banner';
            }

            // if ($hinh_anh['error'] !== 0) {
            //     $errors['hinh_anh'] = 'Phải chọn ảnh banner';
            // }

            $_SESSION['errors'] = $errors;

            if (isset($hinh_anh) && $hinh_anh['error'] == UPLOAD_ERR_OK) {
                // upload ảnh mới lên
                $new_file = uploadFile($hinh_anh, './uploads/');
                if (!empty($old_file)) {
                    deleteFile($old_file);
                }
            } else {
                $new_file = $old_file;
            }

        // Nếu không có lỗi
        if (empty($errors)) {

            // Nếu không có lỗi thì tiến hành thêm sản phẩm
            // var_dump('ok'); die();

            $this->modelBanner->updateBanner(
                $banner_id,
                $tieu_de,
                $trang_thai,
                $new_file
            );

            // var_dump($status);
            // die();

            header('location: ' . BASE_URL_ADMIN . '?act=danh-sach-banner');
            exit();
        } else {
            // Trả về form và lỗi
            // Đặt chỉ thị xóa se
            $_SESSION['flash'] = true;

            header('location: ' . BASE_URL_ADMIN . '?act=form-sua-banner&id_banner=' . $banner_id);
            exit();
        }
    }

}

public function xoaBanner()
    {
        // Lấy ra id danh mục cần xóa
        $id = $_GET['id_banner'];
        $banner =  $this->modelBanner->getDetailBanner($id);

        if ($banner) {
            // Xóa danh mục
            $this->modelBanner->destroyBanner($id);
        }
        header('location: ' . BASE_URL_ADMIN . '?act=danh-sach-banner');
        exit();
    }

}
