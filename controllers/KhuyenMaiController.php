<?php
class KhuyenMaiController
{
    private $modelKhuyenMai;

    public function __construct()
    {
        $this->modelKhuyenMai = new KhuyenMai();
    }

    public function danhSachKhuyenMai()
    {

        $listKhuyenMai = $this->modelKhuyenMai->getAllKhuyenMai();

        require_once './views/khuyenmai/listKhuyenMai.php';
    }
}
