<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>DATA
        <small>user</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashbord"></i></a></li>
        <!-- <li class="active">Users</li> -->

    </ol>
    <div class="content">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><b>DATA USER</b></h3>
                <div style="float: right !important;">
                    <a href="<?= base_url('user/add') ?>" class="btn btn-primary btn-flat mb-2">
                        <i class="fa fa-user-plus"></i>
                        create
                    </a>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Level</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($row->result() as $key => $value) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value->username ?></td>
                                <td><?= $value->name ?></td>
                                <td><?= $value->address ?></td>
                                <td><?= $value->level == 1 ? "Admin" : "User" ?></td>
                                <td>
                                    <center>
                                        <a href=""><i class="fas fa-edit"></i></a>
                                        <a href=""><i class="fas fa-trash"></i></a>
                                    </center>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>

                </table>
            </div>


        </div>


    </div><!-- /.container-fluid -->
</section>