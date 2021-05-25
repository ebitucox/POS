<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1 class="ml-3"><b>DATA USER</b>

    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashbord"></i></a></li>


    </ol>
    <div class="content">

        <div class="card">
            <div class="card-header">


                <div class="row">
                    <div class="col-md-6">
                        <h2>Edit User</h2>
                    </div>
                    <div class="col-md-6">
                        <a href="<?= base_url('user') ?>" class="btn btn-info btn-flat mb-2" style="float: right !important;">
                            <i class="fa fa-undo"></i>
                            Back
                        </a>
                    </div>


                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4 offset-md-4 ">

                        <form action="" class="mt-3 ml-3 " method="POST">
                            <div class="form-group ">
                                <label for="">Name</label>
                                <input type="hidden" name="user_id" value="<?= $row->user_id ?>">
                                <input type="text" name="fullname" value="<?= $this->input->post('fullname') ?? $row->name ?>" class="form-control">
                                <strong style="color:red;"><?= form_error('fullname') ?></strong>
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" value="<?= $this->input->post('username') ?? $row->username ?>" class="form-control">
                                <strong style="color:red;"><?= form_error('username') ?></strong>
                            </div>
                            <div class=" form-group">
                                <label for="">Password</label><small> (Biarkan kosong bila tidak ingin mengganti password...)</small>
                                <input type="password" name="password" value="<?= $this->input->post('password') ?>" class="form-control">
                                <strong style="color:red;"><?= form_error('password') ?></strong>
                            </div>
                            <div class=" form-group">
                                <label for="">Password Confirmation</label>
                                <input type="password" name="passconf" value="<?= $this->input->post('passconf') ?>" class="form-control">
                                <strong style="color:red;"><?= form_error('passconf') ?></strong>
                            </div>
                            <div class="form-group">
                                <label for="">Address</label>
                                <textarea name="address" class="form-control"> <?= $this->input->post('address') ?? $row->address ?>
                                </textarea>
                                <strong style="color:red;"><?= form_error('address') ?></strong>

                            </div>
                            <div class="form-group">
                                <label for="">Level</label>
                                <select name="level" class="form-control">
                                    <?php $level = $this->input->post('level') ? $this->input->post('level') : $row->level  ?>
                                    <option value="1">Admin</option>
                                    <option value="2" <?= $level == 2 ? 'selected' : null ?>>User</option>
                                </select>
                                <strong style="color:red;"><?= form_error('level') ?></strong>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-flat">
                                    <i class="fa fa-paper-plane"></i>
                                    Save</button>
                                <button type="reset" class="btn btn-secondary btn-flat">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>


    </div><!-- /.container-fluid -->
</section>