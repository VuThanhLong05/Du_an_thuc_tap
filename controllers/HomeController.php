<?php

class HomeController
{
    public $modelSanPham;
    public $modelTaiKhoan;
    public $modelGioHang;

    public function __construct()
    {
        $this->modelSanPham = new SanPham();
        $this->modelTaiKhoan = new TaiKhoan();
        $this->modelGioHang = new GioHang();
    }

    public function home()
    {
        // Lấy danh sách sản phẩm từ cơ sở dữ liệu
        $listSanPham = $this->modelSanPham->getAllSanPham();
        require_once './views/home.php';
    }

    public function danhSachSanPham()
    {

        $listSanPham = $this->modelSanPham->getAllSanPham();

        require_once './views/sanpham/listSanPham.php';
    }

    public function chiTietSanPham()
    {
        $id = $_GET['id_san_pham'];
        $thongTinSanPham = $this->modelSanPham->getDetailSanPham($id);
        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
        $listBinhLuan = $this->modelSanPham->getBinhLuanFromSanPham($id);
        $listSanPhamCungDanhMuc = $this->modelSanPham->getListSanPhamDanhMuc($thongTinSanPham['danh_muc_id']);

        if ($thongTinSanPham) {
            require_once './views/sanpham/detailSanPham.php';
        } else {
            header('location: ' . BASE_URL);
            exit();
        }
    }

    // Form đăng nhập
    public function formLogin()
    {
        require_once './views/auth/formLogin.php';
        deleteSessionError();
        exit();
    }

    // Xử lý đăng nhập
    public function postLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Kiểm tra thông tin đăng nhập
            $user = $this->modelTaiKhoan->checkLogin($email, $password);

            if (is_array($user)) {
                // Kiểm tra mật khẩu
                if (password_verify($password, $user['mat_khau'])) {
                    $_SESSION['user_client'] = $user;

                    if ($user['vai_tro'] == 1) {
                        $_SESSION['user_admin'] = $user;
                        header('Location:' . BASE_URL_ADMIN);
                        exit();
                    } else {
                        header('Location:' . BASE_URL);
                        exit();
                    }
                } else {
                    $_SESSION['error'] = 'Mật khẩu không chính xác';
                    $_SESSION['flash'] = true;
                    header('Location:' . BASE_URL . '?act=login');
                    exit();
                }
            } else {
                $_SESSION['error'] = 'Email không tồn tại';
                $_SESSION['flash'] = true;
                header('Location:' . BASE_URL . '?act=login');
                exit();
            }
        }
    }

    // Form đăng ký
    public function formThemTaiKhoan()
    {
        require_once './views/auth/formDangKy.php';
    }

    // Xử lý đăng ký tài khoản
    public function postThemTaiKhoan()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $mat_khau = $_POST['mat_khau'];
            $trang_thai = $_POST['trang_thai'];

            // Mã hóa mật khẩu
            $hashedPassword = password_hash($mat_khau, PASSWORD_BCRYPT);

            // Thêm tài khoản vào cơ sở dữ liệu
            $this->modelTaiKhoan->insertTaiKhoan($email, $hashedPassword, $trang_thai);

            // Chuyển hướng về danh sách tài khoản
            header('Location: ' . BASE_URL . '?act=danh-sach-tai-khoan');
            exit();
        }
    }

    // Đăng xuất
    public function Logout()
    {
        if (isset($_SESSION['user_client']) || isset($_SESSION['user_admin'])) {
            session_destroy();
            echo "<script>
                    alert('Đăng xuất thành công');
                    window.location.href = '" . BASE_URL . "';
                  </script>";
            exit();
        } else {
            header('Location: ' . BASE_URL . '?act=login');
            exit();
        }
    }

    // Thêm sản phẩm vào giỏ hàng
    public function addGioHang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_SESSION['user_client'])) {
                $mail = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
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

                // Kiểm tra số lượng nhập vào có hợp lệ không
                if (!is_numeric($so_luong) || $so_luong <= 0) {
                    $_SESSION['error'] = 'Số lượng sản phẩm không hợp lệ';
                    header('location:' . BASE_URL . '?act=gio-hang');
                    exit();
                }

                // Kiểm tra số lượng còn lại trong kho
                $sanPham = $this->modelSanPham->getDetailSanPham($san_pham_id);
                if ($so_luong > $sanPham['so_luong_ton_kho']) {
                    $_SESSION['error'] = 'Số lượng sản phẩm trong kho không đủ';
                    header('location:' . BASE_URL . '?act=gio-hang');
                    exit();
                }

                // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
                $checkSanPham = false;
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
                exit();
            } else {
                $_SESSION['error'] = 'Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng';
                header('location:' . BASE_URL . '?act=login');
                exit();
            }
        }
    }

    // Hiển thị giỏ hàng
    public function gioHang()
    {
        if (isset($_SESSION['user_client'])) {
            $mail = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);

            if (!$gioHang) {
                $gioHangId = $this->modelGioHang->addGioHang($mail['id']);
                $gioHang = ['id' => $gioHangId];
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            } else {
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            }

            require_once './views/gioHang.php';
        } else {
            $_SESSION['error'] = 'Bạn cần đăng nhập để xem giỏ hàng';
            header('location:' . BASE_URL . '?act=login');
            exit();
        }
    }
}
