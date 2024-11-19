<?php include './views/layout/header.php'; ?>
<?php include './views/layout/navbar.php'; ?>
<?php include './views/layout/sidebar.php'; ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>Quản lý đánh giá đơn hàng</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="col-12">
            <hr>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên người đánh giá</th>
                        <th>Đơn hàng</th>
                        <th>Nội dung</th>
                        <th>Ngày đánh giá</th>
                        <th>Trạng thái</th>
                        <th>Duyệt/Chưa duyệt</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listDanhGia as $key => $danhGia): ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td>
                            <?= $danhGia['ho_ten'] ?>
                            </td>
                            <td><?= $danhGia['ma_don_hang'] ?></td>
                            <td><?= $danhGia['noi_dung'] ?></td>
                            <td><?= $danhGia['ngay_dang'] ?></td>
                            <td><?= $danhGia['trang_thai'] == 1 ? 'Đã duyệt' : 'Chưa duyệt' ?></td>
                            <td>
                                <form action="<?= BASE_URL_ADMIN . '?act=update-trang-thai-danh-gia' ?>" method="post">
                                    <button onclick="return confirm('Bạn có chắc muốn duyệt đánh giá này không?')" class="btn btn-success">
                                        <?= $danhGia['trang_thai'] == 1 ? 'Duyệt' : 'Chưa duyệt' ?>
                                    </button>
                                </form>
                            </td>
                            
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </section>
</div>

<?php include './views/layout/footer.php'; ?>

<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
</body>
</html>
