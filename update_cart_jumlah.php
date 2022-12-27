<?php
header('Content-Type: application/json; charset=utf-8');

if(isset($_POST['id']) && isset($_POST['jumlah'])){
    include("database/Connection.php");
    include("database/Function.php");
    $table_name="cart";
    $id=$_POST['id'];
    $update="jumlah='". $_POST['jumlah']."'";
    Update($table_name,$update,$id);
    echo json_encode([
        'status' => 200,
    ]);
}else{
    echo '<script type="text/javascript"> window.location="index.php";</script>';die;
}
?>