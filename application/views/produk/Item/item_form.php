<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1 class="ml-3"><b>DATA Item</b>

    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashbord"></i></a></li>


    </ol>
    <div class="content">
        <div class="card">
            <div class="card-header">


                <div class="row">
                    <div class="col-md-6">
                        <h3><b><?= $page; ?> Item</b></h3>
                    </div>
                    <div class="col-md-6">
                        <a href="<?= base_url('item') ?>" class="btn btn-info btn-flat mb-2" style="float: right !important;">
                            <i class="fa fa-undo"></i>
                            Back
                        </a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4 offset-md-4 ">
                        <form action="<?= base_url('item/process') ?>" class="mt-3 ml-3 " method="POST">

                            <div class="form-group">

                                <label for="">Barcod *</label>
                                <input type="hidden" name="id" value="<?= $row->item_id ?>">

                                <input type="text" name="barcode" value="<?= $row->barcode ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Product Name *</label>
                                <input type="text" name="name" value="<?= $row->name ?>" class="form-control" required>

                            </div>


                            <div class="form-group">
                                <label for="">Price</label>
                                <input type="text" name="price" value="<?= $row->price ?>" class="form-control" required>

                            </div>

                            <div class="form-group">
                                <button type="submit" name="<?= $page; ?>" class="btn btn-primary btn-flat">
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