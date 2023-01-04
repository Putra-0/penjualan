<?php
if(!isset($_SESSION))
session_start();
function headerTag(){
?>

<link rel="stylesheet" href="Css/style.css">
<?php
}
$head = headerTag();
$banner=false;
$bannerTag="My wish";
$title='My wish';
$activeNavs=2;
include("database/Connection.php");
include("database/Function.php");

if (!isset($_SESSION['id_user'])) {
    echo '<script type="text/javascript"> window.location="login.php";</script>';die;
}
include("include/Top.php");

if(isset($_POST['id_produk'])){
    $count = $conn->query("SELECT * FROM wishlist WHERE id_pembeli=".$_SESSION['id_user']." AND id_produk=".$_POST['id_produk'])->num_rows;
    if($count == 0){
        $conn->query("INSERT INTO wishlist (id_pembeli,id_produk) VALUES (".$_SESSION['id_user'].",".$_POST['id_produk'].")");
    }
    
}
$sql="SELECT wishlist.id, id_produk,product.foto_1, product.nama, product.harga, categories.kategori FROM wishlist INNER JOIN product ON wishlist.id_produk = product.id INNER JOIN categories ON product.kategori = categories.id WHERE id_pembeli=".$_SESSION['id_user'];
$wishlist=SelectRaw($sql);


?>

<!-- Content -->
<div class="container p-3 bg-light">
    <div class="row">
        <div class="col-lg-3">
            <?php include("include/Navs.php")?>
        </div>
        <div class="col-lg-9">
            <div class="card my-md-2">
                <div class="card-body">    
                    <h2 class="card-title">My Wishlist</h2>
                    <h5 class="card-title">Your all Wishlist Products on one place.</h5>
                    <div class="table-responsive"><!-- table-responsive Starts -->

                    <table class="table table-sm table-bwished table-hover table-striped"><!-- table table-bwished table-hover table-striped Starts -->

                    <thead><!-- thead Starts -->
                    <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Kategori</th>
                    <th>Action</th>
                    </tr>

                    </thead><!-- thead Ends -->

                    <tbody><!-- tbody Starts -->
                    <?php
                    if(!is_null($wishlist)){
                    foreach($wishlist as $index => $wish){?>
                    <tr>
                    <td><?php echo $index+1;?></td>
                    <td>
                    <img class="img-thumbnail" src="image/product_image/<?php echo $wish['foto_1']?>" style="object-fit: cover;height: 50px;width: 50px;" alt="gambar produk">
                    <a href="product.php?id=<?php echo $wish['id_produk']?>" class="link-dark"><?php echo $wish['nama']?></a>
                    </td>
                    <td><?php echo $wish['harga']?></td>
                    <td><?php echo $wish['kategori']?></td>
                    <td><a href="delete_wish.php?id=<?php echo $wish['id']?>" onclick="if (confirm('Delete selected item?')){return true;}else{event.stopPropagation(); event.preventDefault();};" class="link-dark"><i class="fa-solid fa-trash-can me-2"></i>Delete</a></td>
                    </tr>
                    <?php }}else{echo "No Data";} ?>
                    </tbody><!-- tbody Ends -->


                    </table><!-- table table-bwished table-hover table-striped Ends -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ContentEnd -->
<?php
include("include/Bottom.php");
?>