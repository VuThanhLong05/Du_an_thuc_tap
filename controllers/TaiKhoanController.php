<?php
class TaiKhoanController
{
    public $modelTaiKhoan;
    // public $modelDonHang;
    // public $modelSanPham;

    public function __construct()
    {
        $this->modelTaiKhoan = new TaiKhoan();
        // $this->modelDonHang = new AdminDonHang();
        // $this->modelSanPham = new AdminSanPham();
    }

    public function danhSach()
    {
        $listQuanTri = $this->modelTaiKhoan->getAllTaiKhoan(1);
        // var_dump($listQuanTri); die();

        // require_once './views/taikhoan/quantri/listQuanTri.php';
    }

    public function formAdd()
    {
        require_once './views/auth/formDangKy.php';

        deleteSessionError();
    }

    public function postAdd()
    {
        // var_dump($_POST);

        // Kiểm tra xem dữ liệu có submit lên không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // code
            // Lấy ra dữ liệu
            // var_dump($_POST); die();

            $email = $_POST['email'];
            $mat_khau = $_POST['mat_khau'];
            // Tạo 1 mảng trống để chứa dữ liệu
            $errors = [];
            // var_dump('ok'); die();

            if (empty($email)) {
                $errors['email'] = 'Email không được để trống';
            }
            if (empty($mat_khau)) {
                $errors['mat_khau'] = 'Tên không được để trống';
            }

            $_SESSION['error'] = $errors;


            // Nếu không có lỗi tiến hành thêm tài khoản
            if (empty($errors)) {

                // var_dump('ok');
                // Đặt paasword mặc định-123456abc
                $password = password_hash('123456abc', PASSWORD_BCRYPT);
                $vai_tro = 2;

                // var_dump($password); die();
                $this->modelTaiKhoan->insertTaiKhoan($email, $password, $vai_tro);

                header('location: ' . BASE_URL);
                exit();
            } else {
                // Trả về form và lỗi
                // require_once './views/danhmuc/addDanhMuc.php';
                $_SESSION['flash'] = true;

                header('location: ' . BASE_URL . '?act=form-them');
                exit();
            }
        }
    }
}
