<?php

class AdminKhuyenMaiController
{
    private $modelKhuyenMai;

    public function __construct()
    {
        $this->modelKhuyenMai = new AdminKhuyenMai();
    }

    public function danhSachKhuyenMai()
    {
        $listKhuyenMai = $this->modelKhuyenMai->getAllKhuyenMai();
        require_once './views/khuyenmai/listKhuyenMai.php';
    }

    public function formAddKhuyenMai()
    {
        $listKhuyenMai = $this->modelKhuyenMai->getAllKhuyenMai();
        require_once './views/khuyenmai/addKhuyenMai.php';
        deleteSessionError();  
    }

    public function postAddKhuyenMai()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Gather input data
            $tenKhuyenMai = $_POST['ten_khuyen_mai'] ?? '';
            $maKhuyenMai = $_POST['ma_khuyen_mai'] ?? '';
            $giaTri = $_POST['gia_tri'] ?? '';
            $moTa = $_POST['mo_ta'] ?? '';
            $ngayBatDau = $_POST['ngay_bat_dau'] ?? '';
            $ngayKetThuc = $_POST['ngay_ket_thuc'] ?? '';
            $trangThai = $_POST['trang_thai'] ?? '';

            // Error checking
            $errors = [];

            if (empty($tenKhuyenMai)) {
                $errors['ten_khuyen_mai'] = 'Tên khuyến mãi không được để trống';
            }
            if (empty($giaTri)) {
                $errors['gia_tri'] = 'Giá trị không được để trống';
            }
            if (empty($ngayBatDau) || !$this->validateDate($ngayBatDau)) {
                $errors['ngay_bat_dau'] = 'Ngày bắt đầu không hợp lệ';
            }
            if (empty($ngayKetThuc) || !$this->validateDate($ngayKetThuc)) {
                $errors['ngay_ket_thuc'] = 'Ngày kết thúc không hợp lệ';
            }
            if (empty($trangThai)) {
                $errors['trang_thai'] = 'Phải chọn trạng thái';
            }

            $_SESSION['errors'] = $errors;
            
           
            if(empty($errors)) {
                $this->modelKhuyenMai->insertKhuyenMai(
                    $maKhuyenMai, $tenKhuyenMai, $giaTri, $moTa, $ngayBatDau, $ngayKetThuc, $trangThai
                );
                header('location:' .BASE_URL_ADMIN . '?act=khuyen-mai');
                exit();
            }else {
                $_SESSION['flash'] = true;
                header('location: ' . BASE_URL_ADMIN . '?act=them-khuyen-mai');
                exit();
            }
        }
    }

    public function getDetailKhuyenMai()
    {
        $id = $_GET['id_khuyen_mai'];
        $khuyenMai = $this->modelKhuyenMai->getDetailKhuyenMai($id);
        // var_dump($khuyenMai); die();

        if ($khuyenMai) {
            require_once './views/khuyenmai/detailKhuyenMai.php';
        } else {
            header('location: ' . BASE_URL_ADMIN . '?act=khuyen-mai');
            exit();
        }
    }

    public function formEditKhuyenMai()
    {
        $id = $_GET['id_khuyen_mai'];
        $khuyenMai = $this->modelKhuyenMai->getDetailKhuyenMai($id);
        // var_dump($id); die();


        if ($khuyenMai) {
            require_once './views/khuyenmai/editKhuyenMai.php';
            deleteSessionError();
        } else {
            header('location: ' . BASE_URL_ADMIN . '?act=khuyen-mai');
            exit();
        }
    }

    public function KhuyenMai()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Gather input data
            $id = $_POST['id'] ?? null;
            $tenKhuyenMai = $_POST['ten_khuyen_mai'] ?? '';
            $maKhuyenMai = $_POST['ma_khuyen_mai'] ?? '';
            $giaTri = $_POST['gia_tri'] ?? 0;
            $moTa = $_POST['mo_ta'] ?? '';
            $ngayBatDau = $_POST['ngay_bat_dau'] ?? '';
            $ngayKetThuc = $_POST['ngay_ket_thuc'] ?? '';
            $trangThai = $_POST['trang_thai'] ?? 0;

            // Error checking
            $errors = [];

            if (empty($tenKhuyenMai)) {
                $errors['ten_khuyen_mai'] = 'Tên khuyến mãi không được để trống';
            }
            if (empty($ngayBatDau) || !$this->validateDate($ngayBatDau)) {
                $errors['ngay_bat_dau'] = 'Ngày bắt đầu không hợp lệ';
            }
            if (empty($ngayKetThuc) || !$this->validateDate($ngayKetThuc)) {
                $errors['ngay_ket_thuc'] = 'Ngày kết thúc không hợp lệ';
            }
            if (empty($trangThai)) {
                $errors['trang_thai'] = 'Phải chọn trạng thái';
            }

            if (count($errors) > 0) {
                $_SESSION['error'] = $errors;
                header('Location: ' . BASE_URL_ADMIN . '?act=sua-khuyen-mai&id=' . $id);
                exit();
            }
            $this->modelKhuyenMai->updateKhuyenMai(
                $id, $tenKhuyenMai, $maKhuyenMai, $giaTri, $moTa, $ngayBatDau, $ngayKetThuc, $trangThai
            );

            header('location: ' . BASE_URL_ADMIN . '?act=khuyen-mai');
            exit();
        }
    }

    public function xoaKhuyenMai()
    {
        $id = $_GET['id'];
        $khuyenMai = $this->modelKhuyenMai->getDetailKhuyenMai($id);

        if ($khuyenMai) {
            $this->modelKhuyenMai->detroyKhuyenMai($id);
        }

        header('location: ' . BASE_URL_ADMIN . '?act=khuyen-mai');
        exit();
    }

    private function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }

        private function redirectWithMessage($url, $message, $type = 'error')
    {
        $_SESSION['flash'] = ['message' => $message, 'type' => $type];
        header('Location: ' . $url);
        exit();
    }
}
