<?php require_once 'views/layout/header.php'; ?>
<?php require_once 'views/layout/menu.php'; ?>

<div class="container">
    <h1 class="page-title">Chi tiết đơn hàng</h1>

    <table class="order-summary">
        <tr>
            <th>Mã đơn hàng:</th>
            <td><?php echo $chitietdonhang[0]['ma_don_hang']; ?></td>
        </tr>
        <tr>
            <th>Ngày đặt:</th>
            <td><?php echo $chitietdonhang[0]['ngay_dat']; ?></td>
        </tr>
    </table>

    <h2 class="section-title">Sản phẩm trong đơn hàng</h2>

    <table class="order-items">
        <thead>
            <tr>
                <th>Hình ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($chitietdonhang as $item): ?>
                <tr>
                    <td><img src="<?= htmlspecialchars($item['hinh_anh']) ?>" class="product-image" alt="Hình ảnh sản phẩm">
                    </td>
                    <td><?php echo $item['ten_san_pham']; ?></td>
                    <td><?php echo $item['so_luong']; ?></td>
                    <td><?php echo number_format($item['gia_san_pham'], 0, ',', '.'); ?> VNĐ</td>
                    <td><?php echo number_format($item['thanh_tien'], 0, ',', '.'); ?> VNĐ</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2 class="section-title">Thông tin khách hàng</h2>
    <table class="customer-info">
        <tr>
            <th>Tên khách hàng:</th>
            <td><?php echo $chitietdonhang[0]['ho_ten']; ?></td>
        </tr>
        <tr>
            <th>Địa chỉ:</th>
            <td><?php echo $chitietdonhang[0]['dia_chi']; ?></td>
        </tr>
        <tr>
            <th>Số điện thoại:</th>
            <td><?php echo $chitietdonhang[0]['so_dien_thoai']; ?></td>
        </tr>
        <tr>
            <th>Email người nhận:</th>
            <td><?php echo $chitietdonhang[0]['email_nguoi_nhan']; ?></td>
        </tr>
        <tr>
            <th>Ghi chú:</th>
            <td><?php echo $chitietdonhang[0]['ghi_chu']; ?></td>
        </tr>
        <tr>
            <th>Phương thức thanh toán:</th>
            <td><?php echo $chitietdonhang[0]['phuong_thuc_thanh_toan']; ?></td>
        </tr>
        <tr>
            <th>Trạng thái:</th>
            <td><?php echo $chitietdonhang[0]['trang_thai']; ?></td>
        </tr>
    </table>

    <?php
    $totalAmount = 0; // Khởi tạo biến tổng tiền

    foreach ($chitietdonhang as $item) {
        $totalAmount += $item['thanh_tien']; // Cộng dồn thành tiền cho từng sản phẩm
    }
    ?>

    <div class="total-amount">
        <strong>Tổng thanh toán:</strong> <?php echo number_format($totalAmount, 0, ',', '.'); ?> VNĐ
    </div>
    <div class="back-button">
        <a href="javascript:history.back()" class="btn btn-back">Quay lại</a>
    </div>
</div>

<?php require_once 'views/layout/footer.php'; ?>


<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f7f7f7;
        color: #343a40;
        line-height: 1.6;
        padding: 40px;
    }

    .container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        padding: 40px;
    }

    .page-title {
        text-align: center;
        font-size: 36px;
        font-weight: 600;
        color: black;
        margin-bottom: 40px;
        text-transform: uppercase;
    }

    h2.section-title {
        text-align: center;
        font-size: 28px;
        color: black;
        margin-bottom: 30px;
        border-bottom: 3px solid #e67e22;
        padding-bottom: 5px;
        font-weight: 500;
    }

    table {
        width: 100%;
        margin-bottom: 40px;
        border-collapse: collapse;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    th,
    td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        font-size: 16px;
    }

    th {
        background-color: #CCFFFF;
        color: black;
        font-weight: 600;
    }

    td {
        background-color: #f9f9f9;
        color: black;
    }

    td img.product-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
    }

    .order-summary,
    .customer-info {
        font-size: 16px;
        margin-bottom: 30px;
    }

    .order-summary td,
    .customer-info td {
        font-weight: 600;
        color: #495057;
    }

    .order-summary th,
    .customer-info th {
        width: 30%;
        font-weight: normal;
        color: #888;
    }

    .order-items tbody tr:hover {
        background-color: #f1c40f;
        cursor: pointer;
    }

    .total-amount {
        text-align: center;
        font-size: 24px;
        font-weight: 700;
        color: #e74c3c;
        margin-top: 40px;
        padding-top: 20px;
        border-top: 2px solid #ddd;
        background-color: #f7f7f7;
        border-radius: 10px;
        padding-bottom: 20px;
    }

    @media screen and (max-width: 768px) {
        body {
            padding: 10px;
        }

        .page-title {
            font-size: 28px;
        }

        h2.section-title {
            font-size: 22px;
        }

        th,
        td {
            padding: 10px;
            font-size: 14px;
        }

        td img.product-image {
            width: 60px;
            height: 60px;
        }

        .order-summary td,
        .customer-info td {
            font-size: 14px;
        }

        .total-amount {
            font-size: 20px;
        }

        .back-button {
            text-align: center;
            margin-top: 30px;
        }

        .btn-back {
            padding: 12px 25px;
            background-color: #3498db;
            color: white;
            font-size: 16px;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-back:hover {
            background-color: #2980b9;
            transition: background-color 0.3s ease;
        }
    }
</style>

<?php require_once 'views/layout/footer.php'; ?>