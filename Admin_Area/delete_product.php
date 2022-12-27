<?php
include("database/Connection.php");
include("database/Function.php");
if(!isset($_GET['id'])){
    header("location: view_product.php", true, 301);
}
$product = SelectId('product',$_GET['id']);
$table_name ='product';

if(Delete($table_name,$_GET['id'])){
    for ($i=1; $i <=3 ; $i++) { 
        unlink('../image/product_image/'.$product['foto_'.$i]);
    }
    echo '<script language="javascript">';
    echo 'alert("Data Produk Berhasil Dihapus");';    
    echo 'window.location.replace("view_product.php");';  
    echo '</script>';
}

?>