<?php
include '../conf/config.php';

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    $plu = $_POST['plu'];
    $barcode = $_POST['barcode'];
    $descp = $_POST['descp'];
    $tag = $_POST['tag'];
    $conv1 = $_POST['conv1'];
    $conv2 = $_POST['conv2'];
    $planogram = $_POST['planogram'];
    $retur_day = $_POST['retur_day'];
    $min_disp = $_POST['min_disp'];
    $sub_category = $_POST['sub_category'];
    $category = $_POST['category'];

    $query = "UPDATE tb_produk p
              LEFT JOIN tb_category c ON p.sub_category = c.sub_category
              SET p.plu='$plu', p.barcode='$barcode', p.descp='$descp', p.tag='$tag', p.conv1='$conv1', p.conv2='$conv2', p.planogram='$planogram', p.retur_day='$retur_day', p.min_disp='$min_disp', p.sub_category='$sub_category', c.category='$category'
              WHERE p.id='$id'";
              
    $result = $koneksi->query($query);

    if($result) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
