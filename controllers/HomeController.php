<?php

class HomeController
{
    public $modelSanPham;

    public $modelTaiKhoan;
    public $modelGioHang;
    public $modelTinTuc;

    public function __construct()
    {
        $this->modelSanPham = new SanPham();
        // $this->modelTaiKhoan = new TaiKhoan();
        $this->modelGioHang = new GioHang();
        $this->modelTinTuc = new TinTuc();
    }

    public function home()
    {
        // echo 'Đây là home';
        $listSanPham = $this->modelSanPham->getAllSanPham();
        require_once './views/home.php';
    }

    // public function trangchu() {
    //     echo 'Đây là trang chủ của tôi';
    // }


    // public function danhSachSanPham() {
    //     // echo 'Đây là danh sách san phẩm';

    //     $listProduct = $this->modelSanPham->getAllProduct();
    //     // var_dump($listProduct);die();
    //     require_once './views/listProduct.php';
    // }

    public function chiTietSanPham()
    {
        $id = $_GET['id_san_pham'];
        $sanPham =  $this->modelSanPham->getDetailSanPham($id);
        // var_dump($sanPham); die();
        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
        // var_dump($listAnhSanPham); die();
        $listBinhLuan = $this->modelSanPham->getBinhLuanFromSanPham($id);

        $listSanPhamCungDanhMuc = $this->modelSanPham->getListSanPhamDanhMuc($sanPham['danh_muc_id']);
        // var_dump($listSanPhamCungDanhMuc); die;
        if ($sanPham) {
            require_once './views/detailSanPham.php';
        } else {
            header('location: ' . BASE_URL);
            exit();
        }
    }


    // login
    // public function formLogin()
    // {
    //     require_once './views/auth/formLogin.php';
    //     // require_once './base-xuong-thu-cung/views/auth/formLogin.php';

    //     deleteSessionError();
    //     exit();
    // }

    // public function postLogIn()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //         $email = $_POST['email'];
    //         $password = $_POST['password'];
    //         // var_dump($password); die;

    //         // Xử lí kiểm tra thông tin đăng nhập

    //         $user = $this->modelTaiKhoan->checkLogin($email, $password);

    //         if ($user == $email) {

    //             $_SESSION['user_client'] = $user;
    //             // var_dump($_SESSION['user_admin']); die();

    //             header('Location:' . BASE_URL);
    //             exit();
    //         } else {
    //             // Lỗi lưu vào session
    //             $_SESSION['error'] = $user;
    //             // var_dump($_SESSION['error']); die();


    //             $_SESSION['flash'] = true;

    //             header('Location:' . BASE_URL . '?act=login');
    //             exit();
    //         }
    //     }
    // }

    // public function Logout() {
    //     if (isset($_SESSION['user_client'])) {
    //         session_destroy();
            
    //         // Hiển thị thông báo và chuyển hướng bằng JavaScript
    //         echo "<script>
    //                 alert('Đăng xuất thành công');
    //                 window.location.href = '" . BASE_URL . "';
    //               </script>";
    //         exit();
    //     }
    // }
    
    

    public function addGioHang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset(($_SESSION['user_client']))) {
                $mail = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
                // var_dump($mail['id']); die;

                $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);
                if (!$gioHang) {
                    $gioHangId = $this->modelGioHang->addGioHang($mail['id']);
                    $gioHang = ['id' => $gioHangId];
                    $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
                } else {
                    $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
                }

                $san_pham_id = $_POST['san_pham_id'];
                $so_luong = $_POST['so_luong'];

                $checkSanPham = false;

                // Lấy dữ liệu từ giỏ hàng của người dùng

                foreach ($chiTietGioHang as $detail) {
                    if ($detail['san_pham_id'] == $san_pham_id) {
                        $newSoLuong = $detail['so_luong'] + $so_luong;
                        $this->modelGioHang->updateSoLuong($gioHang['id'], $san_pham_id, $newSoLuong);
                        $checkSanPham = true;
                    }
                }
                // Nếu sản phẩm chưa có trong giỏ hàng thì thêm vào
                if (!$checkSanPham) {
                    $this->modelGioHang->addDetailGioHang($gioHang['id'], $san_pham_id, $so_luong);
                }
                header('location:' . BASE_URL . '?act=gio-hang');
                die;
            } else {
                var_dump('Chưa đăng nhập');
                die;
            }
        }
    }

    public function gioHang()
    {
        if (isset(($_SESSION['user_client']))) {
            $mail = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            // var_dump($mail['id']); die;

            $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);
            if (!$gioHang) {
                $gioHangId = $this->modelGioHang->addGioHang($mail['id']);
                $gioHang = ['id' => $gioHangId];
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            } else {
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            }
            // var_dump($chiTietGioHang); 
            require_once './views/gioHang.php';
        } else {
            var_dump('Chưa đăng nhập');
            die;
        }
    }

    public function formAddTinTuc()
    {
        require_once './views/news/formAddTinTuc.php';
    }

    public function postAddTinTuc()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tieu_de = $_POST['tieu_de'];
            $noi_dung = $_POST['noi_dung'];
            $ngay_tao = date('Y-m-d H:i:s'); // Current date and time
            $trang_thai = $_POST['trang_thai'];

            // Add the new article
            $newArticleId = $this->modelTinTuc->addTinTuc($tieu_de, $noi_dung, $ngay_tao, $trang_thai);

            if ($newArticleId) {
                header('Location: ' . BASE_URL . '?act=news'); // Redirect to news list page
                exit();
            } else {
                echo "Lỗi khi thêm tin tức.";
            }
        }
    }
}
