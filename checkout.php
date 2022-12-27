<?php
if(!isset($_SESSION))
session_start();
function headerTag(){
?>

<link rel="stylesheet" href="Css/style.css">
<?php
}
$head = headerTag();
$banner=true;
$bannerTag="Check Out";
$title='Check Out';
include("database/Connection.php");
include("database/Function.php");

if (!isset($_SESSION['id_user'])) {
    echo '<script type="text/javascript"> window.location="login.php";</script>';die;
}else if(is_null($_POST['kurir']) && is_null($_POST['tipe']) && is_null($_POST['harga'])){
    echo '<script type="text/javascript"> window.location="index.php";</script>';die;
}
include("include/Top.php");

$id_user = (int) $_SESSION['id_user'];

if($id_user>9 && $id_user<99){
$invoice = "0".$id_user."".time();
}else if($id_user<10){
$invoice = "00".$id_user."".time();
}else{
    $invoice = $id_user."".time();
}
if(isset($_POST['pay_ofline'])){

$carts = $conn->query("SELECT cart.id,id_produk, product.nama, product.harga, product.berat,product.jumlah as stok, cart.jumlah FROM `cart` INNER JOIN product ON cart.id_produk = product.id WHERE id_pembeli ='".$_SESSION['id_user']."'");

foreach($carts as $cart){
    $value =
    "'".$invoice."',".
    "'".$_SESSION['id_user']."',".
    "'".$cart['nama']."',".
    "'".$cart['harga']."',".
    "'".$cart['jumlah']."',".
    "'".$_POST['kurir']."',".
    "'".$_POST['tipe']."',".
    "'".$_POST['harga']."'";
    $conn->query("UPDATE product SET jumlah=jumlah-".$cart['jumlah']." WHERE id=".$cart['id_produk']);
    
    $conn->query("INSERT INTO pesanan (invoice,id_pembeli,nama_produk,harga,jumlah,kurir,layanan,ongkir) VALUES ($value)");

    $conn->query("DELETE FROM cart WHERE id=".$cart['id']);
}
echo '<script type="text/javascript"> window.location="my_order.php";</script>';
}

?>

<!-- Content -->
<div class="container p-3 bg-light">
    <h2 class="d-block text-center">Payment Options For You</h2>
    <form action="checkout.php" class="d-block" method="post">
        <input type="hidden" name="kurir" value="<?php echo $_POST['kurir']?>">
        <input type="hidden" name="tipe" value="<?php echo $_POST['tipe']?>">
        <input type="hidden" name="harga" value="<?php echo $_POST['harga']?>">
        <input type="submit" value="Pay Ofline" name="pay_ofline" class="btn btn-link btn-lg d-block mx-auto">
    </form>
    <img src="image/bank.jpg" class="img-fluid d-block mx-auto" alt="Responsive image">
</div>
<!-- ContentEnd -->
<?php
include("include/Bottom.php");
?>