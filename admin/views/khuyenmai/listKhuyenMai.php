<!-- <head> -->
<?php include './views/layout/header.php'; ?>
<!-- </head> -->

<!-- navbar -->
<?php include './views/layout/navbar.php'; ?>
<!-- navbar -->

<!-- sidebar -->
<?php include './views/layout/sidebar.php'; ?>
<!-- sidebar -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý danh sách khuyến mãi</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <!-- Add a button for adding promotions -->
                            <a href="<?= BASE_URL_ADMIN . '?act=form-them-khuyen-mai' ?>" class="btn btn-success">Thêm Khuyến Mãi</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã khuyến mãi</th>
                                        <th>Tên khuyến mãi</th>
                                        <th>Giá trị</th>
                                        <th>Ngày bắt đầu</th>
                                        <th>Ngày kết thúc</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($listKhuyenMai as $key => $khuyenMai) : ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $khuyenMai['ma_khuyen_mai'] ?></td>
                                            <td><?= $khuyenMai['ten_khuyen_mai'] ?></td>
                                            <td><?= $khuyenMai['gia_tri'] ?>%</td> <!-- Update to use 'gia_tri' -->
                                            <td><?= formatDate($khuyenMai['ngay_bat_dau']) ?></td>
                                            <td><?= formatDate($khuyenMai['ngay_ket_thuc']) ?></td>
                                            <td>
                                                <?= $khuyenMai['trang_thai'] == 1 ? 'Đang áp dụng' : 'Không áp dụng' ?>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="<?= BASE_URL_ADMIN . '?act=chi-tiet-khuyen-mai&id_khuyen_mai=' . $khuyenMai['id'] ?>">
                                                        <button class="btn btn-primary"><i class="far fa-eye"></i></button>
                                                    </a>

                                                    <a href="<?= BASE_URL_ADMIN . '?act=form-sua-khuyen-mai&id_khuyen_mai=' . $khuyenMai['id'] ?>">
                                                        <button class="btn btn-warning"><i class="fas fa-edit"></i></button>
                                                    </a>
                                                    <a href="<?= BASE_URL_ADMIN . '?act=xoa-khuyen-mai&id_khuyen-mai=' . $khuyenMai['id'] ?>"
                                                    onclick="return confirm('Bạn có chắc muốn xóa khuyến mãi này không?')">
                                                    <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã khuyến mãi</th>
                                        <th>Tên khuyến mãi</th>
                                        <th>Giá trị</th>
                                        <th>Ngày bắt đầu</th>
                                        <th>Ngày kết thúc</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- <footer> -->
<?php include './views/layout/footer.php'; ?>
<!-- End </footer> -->

<!-- Page specific script -->
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
</body>

</html>