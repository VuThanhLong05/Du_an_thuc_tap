<!DOCTYPE html>
<html lang="en">

<head>
  <?php include './views/layout/header.php'; ?>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/css/bootstrap.min.css">
  <!-- Morris.js styles -->
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

  <style>
    .content-header h1 {
      font-size: 2rem;
      font-weight: bold;
      text-align: center;
      margin-bottom: 20px;
      color: #283762;
    }

    .card-header {
      background-color: #007bff;
      color: white;
      font-weight: bold;
      text-align: center;
    }

    .table th {
      background-color: #41486e;
      color: white;
    }

    /* .table tbody tr:hover {
      background-color: #f9f9f9;
    } */
  </style>
</head>

<body>
  <!-- Navbar -->
  <?php include './views/layout/navbar.php'; ?>
  <!-- Sidebar -->
  <?php include './views/layout/sidebar.php'; ?>

  <div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
      <h1>Thống kê cửa hàng</h1>
    </section>

    <!-- Main Content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Tổng quan -->
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">Tổng số đơn hàng</div>
              <div class="card-body text-center">
                <h3 id="totalOrders" class="text-primary">0</h3>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">Tổng doanh thu</div>
              <div class="card-body text-center">
                <h3 id="totalRevenue" class="text-success">0 VND</h3>
              </div>
            </div>
          </div>
        </div>

        <!-- Biểu đồ -->
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">Biểu đồ thống kê</div>
              <div class="card-body">
                <div id="myfirstchart" style="height: 250px;"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">Biểu đồ doanh thu từng ngày</div>
              <div class="card-body">
                <div id="revenueChart" style="height: 300px;"></div>
              </div>
            </div>
          </div>
        </div>

        <!-- Biểu đồ -->
        <div class="row mt-4">
          <div class="col-lg-8">
            <div class="card">
              <div class="card-header">Biểu đồ tỷ lệ đơn hàng theo trạng thái</div>
              <div class="card-body">
                <div id="piechart" style="height: 300px;"></div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card">
              <div class="card-header">Chi tiết đơn hàng theo trạng thái</div>
              <div class="card-body">
                <table class="table  table-hover">
                  <thead>
                    <tr>
                      <th>Trạng thái</th>
                      <th>Số lượng</th>
                      <th>Tỷ lệ (%)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $tongSoDonHang = array_sum(array_column($baoCaoTrangThai, 'so_luong_don_hang'));
                    foreach ($baoCaoTrangThai as $trangThai) :
                      $tiLePhanTram = round(($trangThai['so_luong_don_hang'] / $tongSoDonHang) * 100, 2);
                    ?>
                      <tr>
                        <td><?= $trangThai['ten_trang_thai']; ?></td>
                        <td><?= $trangThai['so_luong_don_hang']; ?></td>
                        <td><?= $tiLePhanTram; ?>%</td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!-- Danh sách đơn hàng mới nhất -->
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">Danh sách đơn hàng mới nhất</div>
              <div class="card-body table-responsive">
                <table class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Mã đơn hàng</th>
                      <th>Người nhận</th>
                      <th>Email</th>
                      <!-- <th>SĐT</th> -->
                      <th>Ngày đặt</th>
                      <th>Tổng tiền</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($donHangPhamMoiNhat as $donHang) : ?>
                      <tr>
                        <td><?= $donHang['ma_don_hang']; ?></td>
                        <td><?= $donHang['ten_nguoi_nhan']; ?></td>
                        <td><?= $donHang['email_nguoi_nhan']; ?></td>
                        <!-- <td><?= $donHang['sdt_nguoi_nhan']; ?></td> -->
                        <td><?= $donHang['ngay_dat']; ?></td>
                        <td><?= formatprice($donHang['tong_tien']); ?> VND</td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!-- Top 10 đơn hàng có danh thu cao nhất -->
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">Top đơn hàng có danh thu cao nhất</div>
              <div class="card-body table-responsive">
                <table class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Mã đơn hàng</th>
                      <th>Người nhận</th>
                      <th>Email</th>
                      <!-- <th>SĐT</th> -->
                      <th>Ngày đặt</th>
                      <th>Tổng tiền</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($topDonHangTheoDanhThu as $donHangTop) : ?>
                      <tr>
                        <td><?= $donHangTop['ma_don_hang']; ?></td>
                        <td><?= $donHangTop['ten_nguoi_nhan']; ?></td>
                        <td><?= $donHangTop['email_nguoi_nhan']; ?></td>
                        <!-- <td><?= $donHangTop['sdt_nguoi_nhan']; ?></td> -->
                        <td><?= $donHangTop['ngay_dat']; ?></td>
                        <td><?= formatprice($donHangTop['tong_tien']); ?> VND</td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
  </div>

  <!-- Footer -->
  <?php include './views/layout/footer.php'; ?>

  <!-- Scripts -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="dist/js/adminlte.min.js"></script>

  <!-- Morris.js -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

  <script>
    // Truyền dữ liệu từ PHP sang JavaScript
    const doHang = <?= $thongKe['tong_so_don_hang'] ?>;
    const tongTien = <?= formatprice($thongKe['tong_tien']) ?>;

    // Hiển thị dữ liệu trên biểu đồ
    new Morris.Bar({
      element: 'myfirstchart',
      data: [{
          label: 'Tổng đơn hàng',
          value: doHang
        },
        {
          label: 'Tổng doanh thu (VNĐ)',
          value: tongTien
        }
      ],
      xkey: 'label',
      ykeys: ['value'],
      labels: ['Số liệu'],
      resize: true
    });

    // 

    // Truyền dữ liệu từ PHP sang JavaScript
    const baoCaoTrangThai = <?= json_encode($baoCaoTrangThai); ?>;
    const tongSoDonHang = <?= $tongSoDonHang; ?>;

    // Chuyển dữ liệu thành định dạng cho biểu đồ tròn
    const dataPieChart = baoCaoTrangThai.map(trangThai => {
      return {
        label: trangThai.ten_trang_thai,
        value: Math.round((trangThai.so_luong_don_hang / tongSoDonHang) * 100)
      };
    });

    // Hiển thị biểu đồ tròn với Morris.js
    new Morris.Donut({
      element: 'piechart',
      data: dataPieChart,
      formatter: function(value) {
        return value + '%';
      }
    });


    // Dữ liệu doanh thu từng ngày
    const doanhThuTungNgay = <?= json_encode($doanhThuTungNgay); ?>;

    // Chuyển đổi dữ liệu thành định dạng cho Morris.js
    const dataRevenueChart = doanhThuTungNgay.map(item => ({
      ngay: item.ngay,
      tong_tien: parseFloat(item.tong_tien)
    }));

    // Hiển thị biểu đồ doanh thu từng ngày
    new Morris.Line({
      element: 'revenueChart',
      data: dataRevenueChart,
      xkey: 'ngay',
      ykeys: ['tong_tien'],
      labels: ['Doanh thu (VNĐ)'],
      parseTime: false,
      resize: true,
      lineColors: ['green'],
      xLabelAngle: 45
    });


    // Hàm định dạng tiền, không thêm đơn vị tiền tệ
    function formatPrice(value) {
      return value.toLocaleString('vi-VN'); // Chỉ định dạng số với dấu phẩy
    }

    // Hàm tạo hiệu ứng tăng số
    function animateNumber(id, start, end, duration, appendText = '') {
      const element = document.getElementById(id);
      const range = end - start;
      let current = start;
      const increment = range / (duration / 50);

      const timer = setInterval(() => {
        current += increment;
        if ((increment > 0 && current >= end) || (increment < 0 && current <= end)) {
          current = end;
          clearInterval(timer);
        }
        // Hiển thị giá trị định dạng và thêm text (nếu có)
        element.textContent = formatPrice(Math.round(current)) + appendText;
      }, 50);
    }

    // Lấy dữ liệu từ PHP
    const totalOrders = <?= $thongKe['tong_so_don_hang']; ?>;
    const totalRevenue = <?= $thongKe['tong_tien']; ?>;

    // Hiển thị hiệu ứng tăng số
    animateNumber('totalOrders', 0, totalOrders, 2500); // 2.5 giây
    animateNumber('totalRevenue', 0, totalRevenue, 2500, ' VND'); // Thêm "VND" ở cuối
  </script>
</body>

</html>