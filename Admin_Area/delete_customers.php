<?php
include("database/Connection.php");
include("database/Function.php");
if(!isset($_GET['id'])){
    header("location: view_customers.php", true, 301);
}
$table_name ='pembeli';

Delete($table_name,$_GET['id']);
echo '<script language="javascript">';
echo 'alert("Data Pembeli Berhasil Dihapus");';    
echo 'window.location.replace("view_customers.php");';  
echo '</script>';
?>