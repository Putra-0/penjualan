<?php
include("database/Connection.php");
include("database/Function.php");
if(!isset($_GET['id'])){
    header("location: my_wishlist.php", true, 301);
}
$table_name ='wishlist';

Delete($table_name,$_GET['id']);
echo '<script language="javascript">';
echo 'alert("Data Wishlist Berhasil Dihapus");';    
echo 'window.location.replace("my_wishlist.php");';  
echo '</script>';
?>