<?php
include("database/Connection.php");
include("database/Function.php");
if(!isset($_GET['id'])){
    header("location: view_payment.php", true, 301);
}
$table_name ='payment';

Delete($table_name,$_GET['id']);
echo '<script language="javascript">';
echo 'alert("Data Pembayaran Berhasil Dihapus");';    
echo 'window.location.replace("view_payment.php");';  
echo '</script>';
?>