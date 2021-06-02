<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><b>DATA PRODUK</b>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashbord"></i></a></li>
        <!-- <li class="active">Users</li> -->

    </ol>
    <div class="content">
        <?php $this->load->view('message') ?>

        <div class="card">
            <div class="card-header">
                <div style="float: left !important;">
                    <h3 class="card-title"><b>DATA Product Item</b></h3>
                </div>

                <div style="float: right !important;">
                    <a href="<?= base_url('item/add') ?>" class="btn btn-primary btn-flat mb-2">
                        <i class="fa fa-user-plus"></i>
                        Create Product Item
                    </a>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped text-center" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Barcode</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Unit</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Image</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($row->result() as $key => $value) : ?>
                            <tr>
                                <td style="width:5%;"><?= $no++ ?></td>
                                <td>

                                    <?= $value->barcode ?><br>
                                    <a href="<?= base_url('item/barcode_qrcode/') . $value->item_id ?>" class="btn btn-default btn-xs">
                                        Generate <i class="fas fa-barcode"></i>
                                    </a>


                                </td>
                                <td><?= $value->name ?></td>
                                <td><?= $value->category_name ?></td>
                                <td><?= $value->unit_name ?></td>
                                <td><?= $value->price ?></td>
                                <td><?= $value->stock ?></td>
                                <td>
                                    <?php if ($value->image != null) { ?>
                                        <img src="<?= base_url('uploads/product/' . $value->image) ?>" alt="" style="width: 100px; height: 120px">
                                    <?php } ?>

                                </td>

                                <td class="text-center" width="160px">


                                    <a href="<?= base_url('item/edit/') . $value->item_id ?>" class="btn btn-info btn-xs">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a href="<?= base_url('item/hapus/') . $value->item_id ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda Yakin?')">
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