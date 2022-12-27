<?php
include("database/Connection.php");
include("database/Function.php");
if(!isset($_GET['invoice'])){
    header("location: view_order.php", true, 301);
}
    $table_name ='pesanan';
    $invoice = $_GET['invoice'];
    $conn->query('DELETE FROM '.$table_name.' WHERE invoice='.$invoice);
    
    echo '<script language="javascript">';
    echo 'alert("Data Pesanan Berhasil Dihapus");';    
    echo 'window.location.replace("view_order.php");';  
    echo '</script>';

?>