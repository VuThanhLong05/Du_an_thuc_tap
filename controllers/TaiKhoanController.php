<?php

class TaiKhoanController
{
    public $modelTaiKhoan;

    public function __construct()
    {
        $this->modelTaiKhoan = new TaiKhoan();
    }

    public function danhSach()
    {
        $listQuanTri = $this->modelTaiKhoan->getAllTaiKhoan(1);
        // Hiển thị danh sách quản trị viên hoặc thực hiện logic khác
        // require_once './views/taikhoan/quantri/listQuanTri.php';
    }

    public function formAdd()
    {
        require_once './views/auth/formDangKy.php';
        deleteSessionError();
    }

    // public function postAdd()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         $ho_ten = $_POST['ho_ten'] ?? '';
    //         $email = $_POST['email'] ?? '';
    //         $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
    //         $mat_khau = $_POST['mat_khau'] ?? '';
    //         $vai_tro = $_POST['vai_tro'] ?? 2; // Mặc định vai trò là 2 (khách hàng)

    //         $errors = [];

    //         // Kiểm tra các trường
    //         if (empty($ho_ten)) {
    //             $errors['ho_ten'] = 'Tên không được để trống';
    //         }

    //         if (empty($email)) {
    //             $errors['email'] = 'Email không được để trống';
    //         } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //             $errors['email'] = 'Email không hợp lệ';
    //         }

    //         if (empty($so_dien_thoai)) {
    //             $errors['so_dien_thoai'] = 'Số điện thoại không được để trống';
    //         }

    //         if (empty($mat_khau)) {
    //             $errors['mat_khau'] = 'Mật khẩu không được để trống';
    //         }

    //         // Kiểm tra email và số điện thoại đã tồn tại
    //         if ($this->modelTaiKhoan->checkExists($email, $so_dien_thoai)) {
    //             $errors['email'] = 'Email hoặc số điện thoại đã tồn tại';
    //         }

    //         // Nếu không có lỗi
    //         if (empty($errors)) {
    //             $password = password_hash($mat_khau, PASSWORD_BCRYPT); // Mã hóa mật khẩu

    //             // Thêm tài khoản vào cơ sở dữ liệu
    //             $this->modelTaiKhoan->insertTaiKhoan($ho_ten, $email, $so_dien_thoai, $password, $vai_tro);

    //             // Chuyển hướng sau khi thêm thành công
    //             header('Location: ' . BASE_URL);
    //             exit();
    //         } else {
    //             // Lưu lỗi vào session để hiển thị lại
    //             $_SESSION['errors'] = $errors;
    //             $_SESSION['old_data'] = $_POST; // Lưu dữ liệu cũ để hiện lại trên form
    //             header('Location: ' . BASE_URL . '?act=form-them');
    //             exit();
    //         }
    //     }
    // }


    //////////


    public function postAdd()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ho_ten = $_POST['ho_ten'];
            $email = $_POST['email'];
            $so_dien_thoai = $_POST['so_dien_thoai'];
            $mat_khau = $_POST['mat_khau'];

            $errors = [];

            // Kiểm tra email tồn tại
            if ($this->modelTaiKhoan->isEmailExists($email)) {
                $errors['email'] = 'Email đã tồn tại, vui lòng chọn email khác.';
            }

            // Kiểm tra số điện thoại tồn tại
            if ($this->modelTaiKhoan->isPhoneExists($so_dien_thoai)) {
                $errors['so_dien_thoai'] = 'Số điện thoại đã tồn tại, vui lòng chọn số khác.';
            }

            // Các kiểm tra khác
            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Tên không được để trống';
            }
            if (empty($mat_khau)) {
                $errors['mat_khau'] = 'Mật khẩu không được để trống';
            }

            if (empty($errors)) {
                // Mã hóa mật khẩu
                $password = password_hash($mat_khau, PASSWORD_BCRYPT);

                // Thêm tài khoản
                $this->modelTaiKhoan->insertTaiKhoan($ho_ten, $email, $so_dien_thoai, $password, 2);
                header('Location: ' . BASE_URL);
                exit();
            } else {
                // Lưu lỗi vào session
                $_SESSION['error'] = $errors;
                header('Location: ' . BASE_URL . '?act=form-them');
                exit();
            }
        }
    }

    ////////// 



    // public function detailTaiKhoan()
    // {
    //     // Lấy email từ session thay vì từ URL
    //     $id = $_SESSION['user']['id'] ?? null;  // Lấy id từ session người dùng

    //     if ($id) {
    //         // Lấy thông tin tài khoản từ model
    //         $thongTin = $this->modelTaiKhoan->getDetailTaiKhoan($id);

    //         if ($thongTin) {
    //             // Hiển thị trang chi tiết tài khoản
    //             require_once './views/taikhoan/detail.php';
    //         } else {
    //             // Nếu không tìm thấy tài khoản
    //             $_SESSION['error'] = "Tài khoản không tồn tại";
    //             header('Location: ' . BASE_URL);
    //             exit();
    //         }
    //     } else {
    //         // Nếu không có email trong session
    //         $_SESSION['error'] = "Không tìm thấy thông tin người dùng trong session";
    //         header('Location: ' . BASE_URL);
    //         exit();
    //     }
    // }








    // public function detailTaiKhoan()
    // {
    //     $id = $_SESSION['user']['id'] ?? null;

    //     if ($id) {
    //         // Kiểm tra nếu có POST request từ form
    //         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //             // Lấy dữ liệu từ form
    //             $ho_ten = $_POST['ho_ten'] ?? '';
    //             $anh_dai_dien = $_FILES['anh_dai_dien'] ?? null;
    //             $email = $_POST['email'] ?? '';
    //             $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
    //             $gioi_tinh = $_POST['gioi_tinh'] ?? '';
    //             $dia_chi = $_POST['dia_chi'] ?? '';
    //             $ngay_sinh = $_POST['ngay_sinh'] ?? '';
    //             $thongTin = $this->modelTaiKhoan->getDetailTaiKhoan($id);

    //             // Kiểm tra ảnh đại diện nếu có thay đổi
    //             if ($anh_dai_dien && $anh_dai_dien['error'] == 0) {
    //                 // Di chuyển ảnh tải lên (có thể cần điều chỉnh đường dẫn)
    //                 $image_path = 'uploads/' . basename($anh_dai_dien['name']);
    //                 move_uploaded_file($anh_dai_dien['tmp_name'], $image_path);
    //             } else {
    //                 // Nếu không có ảnh mới, giữ nguyên ảnh cũ
    //                 $image_path = $thongTin['anh_dai_dien'];
    //             }

    //             // Cập nhật thông tin tài khoản vào cơ sở dữ liệu
    //             $this->modelTaiKhoan->updateTaiKhoan($id, $ho_ten, $image_path, $email, $so_dien_thoai, $gioi_tinh, $dia_chi, $ngay_sinh);

    //             // Hiển thị thông báo thành công và quay lại trang chi tiết
    //             $_SESSION['success'] = "Cập nhật thông tin thành công!";
    //             // var_dump("success");
    //             // die();
    //             require_once './views/taikhoan/detail.php';
    //             exit();
    //         } else {
    //             // Lấy thông tin tài khoản từ model nếu không có POST request
    //             $thongTin = $this->modelTaiKhoan->getDetailTaiKhoan($id);

    //             if ($thongTin) {
    //                 // Hiển thị trang chi tiết tài khoản
    //                 require_once './views/taikhoan/detail.php';
    //             } else {
    //                 $_SESSION['error'] = "Không tìm thấy tài khoản";
    //                 header('Location: ' . BASE_URL);
    //                 exit();
    //             }
    //         }
    //     } else {
    //         $_SESSION['error'] = "Không tìm thấy thông tin người dùng trong session";
    //         header('Location: ' . BASE_URL);
    //         exit();
    //     }
    // }

    // ////////////
    // public function postEditMatKhauCaNhan()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         $old_pass = $_POST['old_pass'];
    //         $new_pass = $_POST['new_pass'];
    //         $confirm_pass = $_POST['confirm_pass'];

    //         // Lấy thông tin từ user vào session
    //         $user = $this->modelTaiKhoan->getTaiKhoanFormEmail($_SESSION['user_admin']);

    //         // Kiểm tra mật khẩu cũ
    //         $checkPass = password_verify($old_pass, $user['mat_khau']);
    //         $errors = [];
    //         if (!$checkPass) {
    //             $errors['old_pass'] = 'Mật khẩu người dùng không đúng';
    //         }
    //         if ($new_pass !== $confirm_pass) {
    //             $errors['confirm_pass'] = 'Mật khẩu nhập lại không đúng';
    //         }
    //         if (empty($old_pass)) {
    //             $errors['old_pass'] = 'Vui lòng điền vào đây.';
    //         }
    //         if (empty($new_pass)) {
    //             $errors['new_pass'] = 'Vui lòng điền vào đây.';
    //         }
    //         if (empty($confirm_pass)) {
    //             $errors['confirm_pass'] = 'Vui lòng điền vào đây.';
    //         }
    //         $_SESSION['error'] = $errors;
    //         if (!$errors) {
    //             // thực hiện đổi mật khẩu
    //             $hashPass = password_hash($new_pass, PASSWORD_BCRYPT);
    //             $status = $this->modelTaiKhoan->resetPassword($user['id'], $hashPass);
    //             if ($status) {
    //                 $_SESSION['success'] = "Đã đổi mật khẩu thành công";
    //                 $_SESSION['flash'] = true;
    //                 // header("Location:" . BASE_URL . '?act=form-sua-thong-tin-ca-nhan-quan-tri');
    //                 require_once './views/taikhoan/detail.php';
    //                 exit();
    //             }
    //         } else {
    //             $_SESSION['flash'] = true;
    //             // header("Location:" . BASE_URL_ADMIN . '?act=form-sua-thong-tin-ca-nhan-quan-tri');
    //             require_once './views/taikhoan/detail.php';
    //             exit();
    //         }
    //     }
    // }


    public function detailTaiKhoan()
    {
        $id = $_SESSION['user']['id'] ?? null;

        if ($id) {
            // Lấy thông tin tài khoản từ model
            $thongTin = $this->modelTaiKhoan->getDetailTaiKhoan($id);

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $errors = [];

                // Kiểm tra loại form được gửi (sửa thông tin hoặc đổi mật khẩu)
                if (isset($_POST['update_info'])) {
                    // Dữ liệu từ form sửa thông tin
                    $ho_ten = $_POST['ho_ten'] ?? '';
                    $anh_dai_dien = $_FILES['anh_dai_dien'] ?? null;
                    $email = $_POST['email'] ?? '';
                    $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
                    $gioi_tinh = $_POST['gioi_tinh'] ?? '';
                    $dia_chi = $_POST['dia_chi'] ?? '';
                    $ngay_sinh = $_POST['ngay_sinh'] ?? '';

                    // Kiểm tra và xử lý ảnh đại diện nếu có
                    if ($anh_dai_dien && $anh_dai_dien['error'] == 0) {
                        $image_path = 'uploads/' . basename($anh_dai_dien['name']);
                        move_uploaded_file($anh_dai_dien['tmp_name'], $image_path);
                    } else {
                        $image_path = $thongTin['anh_dai_dien'];
                    }

                    // Cập nhật thông tin cá nhân
                    $this->modelTaiKhoan->updateTaiKhoan($id, $ho_ten, $image_path, $email, $so_dien_thoai, $gioi_tinh, $dia_chi, $ngay_sinh);
                    $_SESSION['success'] = "Cập nhật thông tin cá nhân thành công!";
                }

                if (isset($_POST['update_password'])) {
                    // Dữ liệu từ form đổi mật khẩu
                    $old_pass = $_POST['old_pass'] ?? '';
                    $new_pass = $_POST['new_pass'] ?? '';
                    $confirm_pass = $_POST['confirm_pass'] ?? '';

                    // Kiểm tra mật khẩu cũ
                    if (!password_verify($old_pass, $thongTin['mat_khau'])) {
                        $errors['old_pass'] = 'Mật khẩu cũ không chính xác.';
                    }
                    if ($new_pass !== $confirm_pass) {
                        $errors['confirm_pass'] = 'Mật khẩu xác nhận không khớp.';
                    }
                    if (!$errors) {
                        // Hash mật khẩu mới và cập nhật
                        $hashPass = password_hash($new_pass, PASSWORD_BCRYPT);
                        $this->modelTaiKhoan->resetPassword($id, $hashPass);
                        $_SESSION['success'] = "Đổi mật khẩu thành công!";
                    } else {
                        $_SESSION['error'] = $errors;
                    }
                }

                // Refresh trang sau khi xử lý
                header('Location: ' . BASE_URL . '?act=detail-tai-khoan');
                exit();
            }

            // Hiển thị trang chi tiết tài khoản
            require_once './views/taikhoan/detail.php';
        } else {
            $_SESSION['error'] = "Không tìm thấy thông tin người dùng trong session.";
            header('Location: ' . BASE_URL);
            exit();
        }
    }
}
