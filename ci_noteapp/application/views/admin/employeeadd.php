<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>

    <div class="row">
        <?php if (validation_errors()) : ?>
            <div class="alert alert-danger" role="alert">
                <?= validation_errors(); ?>
            </div>
        <?php endif; ?>
        <?= $this->session->flashdata('message'); ?>
        <!-- Earnings (Monthly) Card Example -->

        <div class="col-lg-12 card border-left-primary shadow h-100 py-2">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <div class="card-body">
                <div class="text-left">
                    <form action="<?= base_url('admin/employeeadd'); ?>" method="post">
                        <div class="form-group row">
                            <label for="nm_user" class="col-sm-2 col-form-label">Full Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nm_user" name="nm_user">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="username" name="username">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="image" name="image">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-4">
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <label for="inputEmail3" class="col-sm-2 col-form-label"> Retype Password</label>
                            <div class="col-sm-4">
                                <input type="password" class="form-control" id="date" name="date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lv_user" class="col-sm-2 col-form-label">Access Type</label>
                            <div class="col-sm-10">
                                <select name="lv_user" id="lv_user" class="form-control">
                                    <option value="">Select Role</option>
                                    <?php foreach ($arole as $a) : ?>
                                        <option value="<?= $a['id_role']; ?>"><?= $a['ty_role']; ?></option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    </hr>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->