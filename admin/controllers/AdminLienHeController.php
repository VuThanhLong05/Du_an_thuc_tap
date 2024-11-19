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
