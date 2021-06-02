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
                        <h3>Barcode generator</h3>
                    </div>
                    <div class="col-md-6">
                        <a href="<?= base_url('item') ?>" class="btn btn-primary btn-flat btn-sm mb-2" style="float: right !important;">
                            <i class="fa fa-undo"></i>
                            Back
                        </a>
                    </div>
                </div>

                <div class="card-body mt-5">
                    <center>
                        <?php
                        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
                        echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($row->barcode, $generator::TYPE_CODE_128)) . '" width="350px">';
                        ?> <br>
                        <small> <?= $row->barcode ?></small>
                        <br><br>

                        <a href="<?= base_url('item/barcode_print/' . $row->item_id) ?>" target="_blank" class="btn btn-default btn-sm">
                            <i class="fa fa-print"></i>print
                        </a>


                    </center>
                </div>


            </div>


        </div><!-- /.container-fluid -->

        <div class="card">
            <div class="card-header">

                <div class="row">
                    <div class="col-md-6">
                        <h3>Qrcode generator <i class="fa fa-qrcode"></i></h3>
                    </div>

                </div>

                <div class="card-body mt-5">
                    <center>
                        <?php
                        $qrcode = "pt.ebit-" . $row->item_id . "-" . $row->name . "";
                        if (isset($qrcode)) {

                            //file path for store images
                            $SERVERFILEPATH = $_SERVER['DOCUMENT_ROOT'] . '/POS/uploads/qr-code/';

                            $folder = $SERVERFILEPATH;
                            $file_name = $qrcode . ".png";
                            $folder_file = $folder . $file_name;
                            QRcode::png($qrcode, $folder_file);
                            echo "<img src=" . '../../uploads/qr-code/' . $file_name . " width='180px'><br>";
                            echo "<small> $qrcode </small>";
                        } else {
                            echo 'Tidak ada kode qrcode';
                        }
                        ?>
                    </center>
                </div>


            </div>


        </div>
        < </section>