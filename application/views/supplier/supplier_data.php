<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><b>DATA SUPPLIER</b>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashbord"></i></a></li>
        <!-- <li class="active">Users</li> -->

    </ol>
    <div class="content">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><b>DATA SUPPLIER</b></h3>
                <div style="float: right !important;">
                    <a href="<?= base_url('supplier/add') ?>" class="btn btn-primary btn-flat mb-2">
                        <i class="fa fa-user-plus"></i>
                        create
                    </a>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Description</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($row->result() as $key => $value) : ?>
                            <tr>
                                <td style="width:5%;"><?= $no++ ?></td>
                                <td><?= $value->name ?></td>
                                <td><?= $value->phone ?></td>
                                <td><?= $value->address ?></td>
                                <td><?= $value->description ?></td>
                                <td class="text-center" width="160px">


                                    <a href="<?= base_url('supplier/edit/') . $value->supplier_id ?>" class="btn btn-info btn-xs">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a href="<?= base_url('supplier/hapus/') . $value->supplier_id ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda Yakin?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>

                </table>
            </div>


        </div>


    </div>


</section>