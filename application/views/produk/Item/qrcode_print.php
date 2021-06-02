<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>qrcode Product <?= $row->qrcode ?></title>
</head>

<body>

    <?php
    $qrcode = $row->barcode;
    $SERVERFILEPATH = $_SERVER['DOCUMENT_ROOT'] . '/POS/uploads/qr-code/';
    $folder = $SERVERFILEPATH;
    $file_name = $qrcode . ".png";
    $folder_file = $folder . $file_name;
    QRcode::png($qrcode, $folder_file);
    echo "<img src=" . base_url('uploads/qr-code/') . $file_name . " width='180px'><br>";
    echo "<small> $qrcode </small>";
    ?>
</body>

</html>