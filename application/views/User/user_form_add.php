<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>DATA
        <small><strong>user</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashbord"></i></a></li>
        <!-- <li class="active">Users</li> -->

    </ol>
    <div class="content">

        <div class="card">
            <div class="card-header">


                <div class="row">
                    <div class="col-md-6">
                        <h2>Add User</h2>
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
                        <?php echo validation_errors(); ?>
                        <form action="" class="mt-3 " method="POST">
                            <div class="form-group">
                                <label for="">Name *</label>
                                <input type="text" name="fullname" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Username *</label>
                                <input type="text" name="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Password *</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Password Confirmation *</label>
                                <input type="password" name="passconf" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Address *</label>
                                <textarea name="address" class="form-control">
                                </textarea>
                                <!-- <input type="password" name="password" class="form-control"> -->
                            </div>
                            <div class="form-group">
                                <label for="">Level *</label>
                                <select name="level" class="form-control">
                                    <option value="">Pilih</option>
                                    <option value="1">Admin</option>
                                    <option value="2">User</option>

                                </select>

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