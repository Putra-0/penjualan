<?php
include("database/Connection.php");
include("database/Function.php");
if(!isset($_GET['id'])){
    header("location: view_categories.php", true, 301);
}
$table_name ='categories';

Delete($table_name,$_GET['id']);
echo '<script language="javascript">';
echo 'alert("Data Kategori Berhasil Dihapus");';    
echo 'window.location.replace("view_categories.php");';  
echo '</script>';
?>