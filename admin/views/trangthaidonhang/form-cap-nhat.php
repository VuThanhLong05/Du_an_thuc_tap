<?php include './views/layout/header.php'; ?>

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
          <h1>Cập nhật trạng thái đơn hàng</h1>
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
              <h3 class="card-title">Cập nhật trạng thái đơn hàng</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form method="POST" action="?act=cap-nhat-trang-thai">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>" />

                <div class="form-group">
                  <label for="ten_trang_thai">Chọn trạng thái</label>
                  <select id="ten_trang_thai" name="ten_trang_thai" class="form-control" required>
                    <option value="">-- Chọn trạng thái --</option>
                    <?php 
                    // Lấy tất cả trạng thái đơn hàng từ cơ sở dữ liệu
                    $trangThaiList = $this->model->getAllTrangThai();
                    foreach ($trangThaiList as $trangThaiItem): ?>
                      <option value="<?php echo htmlspecialchars($trangThaiItem['ten_trang_thai']); ?>" 
                              <?php echo ($trangThaiItem['ten_trang_thai'] == $trangThai['ten_trang_thai']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($trangThaiItem['ten_trang_thai']); ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Cập nhật</button>
                  <a href="<?= BASE_URL_ADMIN . '?act=trang-thai-don-hang' ?>" class="btn btn-secondary">Quay lại</a>
                </div>
              </form>
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

<!-- footer -->
<?php include './views/layout/footer.php'; ?>
<!-- End footer -->

<!-- Page specific script -->
<script>
  $(function() {
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