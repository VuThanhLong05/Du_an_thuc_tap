<?php
class AdminThongKeController
{

    public $modelThongKe;

    public function __construct()
    {
        $this->modelThongKe = new AdminThongKe;
    }

    public function home()
    {
        $thongKe = $this->modelThongKe->getAllThongKe();  // Lấy dữ liệu thống kê tổng
        $donHangPhamMoiNhat = $this->modelThongKe->getDonHangMoiNhat();  // Lấy 5 sản phẩm mới nhất
        $baoCaoTrangThai = $this->modelThongKe->getBaoCaoTrangThai(); // Lấy báo cáo trạng thái
        $doanhThuTungNgay = $this->modelThongKe->getDoanhThuTungNgay(); // Lấy doanh thu từng ngày

        // Truyền tất cả dữ liệu vào view
        require_once './views/bao_cao.php';
    }
}
