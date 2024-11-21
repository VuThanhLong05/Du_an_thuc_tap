<?php
// session_start();

class AdminLienHeController
{
    public $modelLienHe;

    public function __construct()
    {
        $this->modelLienHe = new AdminLienHe();
    }

    public function danhSachLienHe()
    {

        $listLienHe = $this->modelLienHe->getAllLienHe();
        require_once './views/lienhe/listLienHe.php';
    }

    public function getDetailLienHe()
    {
        $id = $_GET['id_lien_he'];
        $lienHe =  $this->modelLienHe->getDetailLienHe($id);
        // var_dump($lienHe); die();

        if ($lienHe) {
            require_once './views/lienhe/chi-tiet-lien-he.php';
        } else {
            header('location: ' . BASE_URL_ADMIN . '?act=danh-sach-lien-he');
            exit();
        }
    }

    // public function formAddBaiViet()
    // {
    //     $listBaiViet = $this->modelBaiViet->getAllBaiViet();


    //     require_once './views/baiviet/addBaiViet.php';

    //     deleteSessionError();
    // }

    // public function postAddBaiViet()
    // {
    //     // var_dump($_POST);

    //     // Kiểm tra xem dữ liệu có submit lên không
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         // Lấy ra dữ liệu
    //         $tieu_de = $_POST['tieu_de'] ?? '';
    //         $noi_dung = $_POST['noi_dung'] ?? '';
    //         $ngay_dang = $_POST['ngay_dang'] ?? '';
    //         $trang_thai = $_POST['trang_thai'] ?? '';

    //         // Tạo 1 mảng trống để chứa dữ liệu
    //         $errors = [];
    //         if (empty($tieu_de)) {
    //             $errors['tieu_de'] = 'Tiêu đề không được để trống';
    //         }

    //         if (empty($noi_dung)) {
    //             $errors['noi_dung'] = 'Nội dung không được để trống';
    //         }

    //         if (empty($ngay_dang)) {
    //             $errors['ngay_dang'] = 'Ngày đăng không được để trống';
    //         }

    //         if (empty($trang_thai)) {
    //             $errors['trang_thai'] = 'Trạng thái không được để trống';
    //         }

    //         $_SESSION['errors'] = $errors;

    //         // var_dump($errors);die();


    //         if (empty($errors)) {

    //             $this->modelBaiViet->insertBaiViet(
    //                 $tieu_de,
    //                 $noi_dung,
    //                 $ngay_dang,
    //                 $trang_thai
    //             );
    //             // var_dump($this);
    //             // die();
    //             header('location: ' . BASE_URL_ADMIN . '?act=danh-sach-bai-viet');
    //             exit();
    //         } else {
    //             $_SESSION['flash'] = true;
    //             // Trả về form và lỗi
    //             require_once './views/baiviet/addBaiViet.php';
    //         }
    //     }
    // }

    // public function formSuaBaiViet()
    // {
    //     $id = $_GET['id_bai_viet'];
    //     $baiViet =  $this->modelBaiViet->getDetailBaiViet($id);
    //     // var_dump($baiViet); die();
    //     if ($baiViet) {
    //         require_once './views/baiviet/editBaiViet.php';
    //         // $this->deleteSessionError();
    //         deleteSessionError();
    //     } else {
    //         header('location: ' . BASE_URL_ADMIN . 'act=danh-sach-bai-viet');
    //         exit();
    //     }
    // }

    // public function postEditAddBaiViet()
    // {
    //     // var_dump($_POST);    
    //     // die();
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         // Lấy dữ liệu
    //         $id = $_POST['id'] ?? '';
    //         $tieu_de = $_POST['tieu_de'] ?? '';
    //         $noi_dung = $_POST['noi_dung'] ?? '';
    //         $ngay_dang = $_POST['ngay_dang'] ?? '';
    //         $trang_thai = $_POST['trang_thai'] ?? '';

    //         // Mảng lưu lỗi
    //         $errors = [];
    //         if (empty($tieu_de)) {
    //             $errors['tieu_de'] = 'Tiêu đề không được để trống';
    //         }

    //         if (empty($noi_dung)) {
    //             $errors['noi_dung'] = 'Nội dung không được để trống';
    //         }

    //         if (empty($ngay_dang)) {
    //             $errors['ngay_dang'] = 'Ngày đăng không được để trống';
    //         }

    //         if (empty($trang_thai)) {
    //             $errors['trang_thai'] = 'Trạng thái không được để trống';
    //         }

    //         $_SESSION['errors'] = $errors;
    //         // var_dump($errors); die();

    //         // Nếu không có lỗi
    //         if (empty($errors)) {
    //             // var_dump('ok'); die();

    //             $this->modelBaiViet->updateBaiViet(
    //                 $id,
    //                 $tieu_de,
    //                 $noi_dung,
    //                 $ngay_dang,
    //                 $trang_thai
    //             );
    //             // var_dump($id);
    //             // die();
    //             header('location: ' . BASE_URL_ADMIN . '?act=danh-sach-bai-viet');
    //             exit();
    //         } else {
    //             $_SESSION['flash'] = true;
    //             // require_once './views/baiviet/editBaiViet.php';
    //             header('location: ' . BASE_URL_ADMIN . '?act=form-sua-bai-viet&id_bai_viet=' .$id);
    //             exit();
    //         }
    //     }
    // }
    public function xoaBaiViet()
    {
        // Lấy ra id danh mục cần xóa
        $id = $_GET['id_lien_he'];
        $lienHe =  $this->modelLienHe->getDetailLienHe($id);

        if ($lienHe) {
            // Xóa danh mục
            $this->modelLienHe->destroyLienHe($id);
        }
        header('location: ' . BASE_URL_ADMIN . '?act=danh-sach-lien-he');
        exit();
    }
}
