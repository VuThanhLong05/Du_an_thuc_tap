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
                    <h1>Quản lý danh sách banner</h1>
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
                            <a href="<?= BASE_URL_ADMIN . '?act=form-them-banner' ?>">
                                <button class="btn btn-success">Thêm banner mới</button>
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tiêu đề</th>
                                        <th>Ảnh banner</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($listBanner as $key => $banner) : ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $banner['tieu_de'] ?></td>
                                            <td>
                                                <!-- <img src="<?= BASE_URL . $banner['hinh_anh'] ?>" style="width: 100px" onerror="this.onerror=null;
                          this.src='https://khoinguonsangtao.vn/wp-content/uploads/2022/11/hinh-anh-thu-cung.jpg'"> -->

                                                <img src="<?= BASE_URL . $banner['hinh_anh'] ?>" style="width: 100px">
                                            </td>
                                            <td><?= $banner['trang_thai'] == 1 ? 'Hiện' : 'Ẩn'; ?></td>
                                            <td>

                                                <a href="<?= BASE_URL_ADMIN . '?act=chi-tiet-banner&id_banner=' . $banner['id'] ?>">
                                                    <button class="btn btn-primary"><i class="far fa-eye"></i></button>
                                                </a>

                                                <a href="<?= BASE_URL_ADMIN . '?act=form-sua-banner&id_banner=' . $banner['id'] ?>">
                                                    <button class="btn btn-warning"><i class="fas fa-user-cog"></i></button>
                                                </a>

                                                <a href="<?= BASE_URL_ADMIN . '?act=xoa-banner&id_banner=' . $banner['id'] ?>"
                                                    onclick="return confirm('Bạn có chắc muốn xóa bài viết này không?')">
                                                    <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tiêu đề</th>
                                        <th>Ảnh banner</th>
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
<!-- End</footer>  -->

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