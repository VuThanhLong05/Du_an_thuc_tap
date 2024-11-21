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
                    <!-- <h1>Quản lý danh sách thú cưng</h1> -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="col-12">
            <hr>
            <h2>Quản lý đánh giá sản phẩm</h2>
            <div>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên người đánh giá</th>
                            <th>Sản phẩm</th>
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
                                    <a
                                        href="<?= BASE_URL_ADMIN . '?act=chi-tiet-khach-hang&id_khach_hang=' . $danhGia['tai_khoan_id']; ?>">
                                        <?= $danhGia['ho_ten'] ?> <!-- Hiển thị họ tên -->
                                    </a>
                                </td>
                                <td>
                                    <?= $danhGia['ten_san_pham'] ?>
                                </td>
                                <td><?= $danhGia['noi_dung'] ?></td>
                                <td><?= $danhGia['ngay_dang'] ?></td>
                                <td><?= $danhGia['trang_thai'] == 1 ? 'Duyệt' : 'Chưa duyệt' ?></td>
                                <td>
                                    <form action="<?= BASE_URL_ADMIN . '?act=updata-trang-thai-danh-gia' ?>" method="post">
                                        <input type="hidden" name="id_danh_gia" value="<?= $danhGia['id'] ?>">
                                        <input type="hidden" name="name_view" value="detail_sanpham">
                                        <button
                                            onclick="return confirm('Bạn có chắc muốn duyệt đánh giá này không?')"
                                            class="btn btn-success">
                                            <?= $danhGia['trang_thai'] == 1 ? 'Duyệt' : 'Chưa duyệt' ?>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- <footer> -->
<?php include './views/layout/footer.php'; ?>
<!-- End</footer> -->

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
<script>
    $(document).ready(function() {
        $('.product-image-thumb').on('click', function() {
            var $image_element = $(this).find('img')
            $('.product-image').prop('src', $image_element.attr('src'))
            $('.product-image-thumb.active').removeClass('active')
            $(this).addClass('active')
        })
    })
</script>

</html>