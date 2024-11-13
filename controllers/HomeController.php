<?php

class HomeController
{
    
    public $modelKhuyenMai;

    public function __construct()
    {
       
        $this->modelKhuyenMai = new KhuyenMai(); 
    }

    public function home()
    {
        // echo 'Đây là home';
        
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

   

    public function danhSachKhuyenMai() {
        $listKhuyenMai = $this->modelKhuyenMai->getAllKhuyenMai();  // Lấy tất cả khuyến mãi
        require_once './views/KhuyenMai/listKhuyenMai.php';  // Hiển thị danh sách khuyến mãi
        }
    
        public function formAddKhuyenMai() {
        require_once './views/KhuyenMai/formAddKhuyenMai.php';  // Hiển thị form thêm khuyến mãi
        }
    
        public function postAddKhuyenMai() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $tenKhuyenMai = $_POST['ten_khuyen_mai'];
                $giaTri = $_POST['gia_tri'];
                $moTa = $_POST['mo_ta'];
                $trangThai = $_POST['trang_thai'];  // 1: Đang áp dụng, 0: Không áp dụng
    
                // Thêm khuyến mãi mới vào cơ sở dữ liệu
                $newKhuyenMaiId = $this->modelKhuyenMai->addKhuyenMai($tenKhuyenMai, $giaTri, $moTa, $trangThai);
    
                if ($newKhuyenMaiId) {
                    header('Location: ' . BASE_URL . '?act=khuyen-mai');  // Chuyển hướng về danh sách khuyến mãi
                    exit();
                } else {
                    echo "Lỗi khi thêm khuyến mãi.";
                }
            }
        }
    
        public function formEditKhuyenMai() {
            $id = $_GET['id'];
            $khuyenMai = $this->modelKhuyenMai->getKhuyenMaiById($id);  // Lấy thông tin khuyến mãi
            require_once './views/KhuyenMai/formEditKhuyenMai.php';  // Hiển thị form chỉnh sửa
        }
    
        public function postEditKhuyenMai() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $id = $_POST['id'];
                $tenKhuyenMai = $_POST['ten_khuyen_mai'];
                $giaTri = $_POST['gia_tri'];
                $moTa = $_POST['mo_ta'];
                $trangThai = $_POST['trang_thai'];  // 1: Đang áp dụng, 0: Không áp dụng
    
                // Cập nhật khuyến mãi
                $result = $this->modelKhuyenMai->updateKhuyenMai($id, $tenKhuyenMai, $giaTri, $moTa, $trangThai);
    
                if ($result) {
                    header('Location: ' . BASE_URL . '?act=khuyen-mai');  // Chuyển hướng về danh sách khuyến mãi
                    exit();
                } else {
                    echo "Lỗi khi cập nhật khuyến mãi.";
                }
            }
        }
    
        public function deleteKhuyenMai() {
            $id = $_GET['id'];
            $result = $this->modelKhuyenMai->deleteKhuyenMai($id);
    
            if ($result) {
                header('Location: ' . BASE_URL . '?act=khuyen-mai');  // Chuyển hướng về danh sách khuyến mãi
                exit();
            } else {
                echo "Lỗi khi xóa khuyến mãi.";
            }
        }
}
