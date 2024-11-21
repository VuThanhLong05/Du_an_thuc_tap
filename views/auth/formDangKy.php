<?php require_once 'views/layout/header.php'; ?>

<?php require_once 'views/layout/menu.php'; ?>

<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">login-Register</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12
    ">

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Thêm tài khoản</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="<?= BASE_URL . '?act=them' ?>" method="post">

                                <div class=" row card-body">


                                    <div class="form-group col-12">
                                        <label>Id</label>
                                        <input type="id" class="form-control" name="id" placeholder="Nhập email">
                                        <?php if (isset($_SESSION['error']['id'])) { ?>
                                            <p class="text-danger"><?= $_SESSION['error']['id']; ?></p>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Name</label>
                                        <input type="email" class="form-control" name="name" placeholder="Nhập email">
                                        <?php if (isset($_SESSION['error']['ho_ten'])) { ?>
                                            <p class="text-danger"><?= $_SESSION['error']['ho_ten']; ?></p>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="Nhập email">
                                        <?php if (isset($_SESSION['error']['email'])) { ?>
                                            <p class="text-danger"><?= $_SESSION['error']['email']; ?></p>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>PassWord</label>
                                        <input type="text" class="form-control" name="mat_khau"
                                            placeholder="Nhập mật khẩu ">
                                        <?php if (isset($_SESSION['error']['mat_khau'])) { ?>
                                            <p class="text-danger"><?= $_SESSION['error']['mat_khau']; ?></p>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Vai trò</label>
                                        <input type="text" class="form-control" name="vai_tro"
                                            placeholder="Nhập mật khẩu ">
                                        <?php if (isset($_SESSION['error']['vai_tro'])) { ?>
                                            <p class="text-danger"><?= $_SESSION['error']['vai_tro']; ?></p>
                                        <?php } ?>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.card -->

    </div>

    <!-- offcanvas mini cart end -->

    <?php require_once 'views/layout/footer.php'; ?>