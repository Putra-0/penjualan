<?php
if(!isset($_SESSION))
session_start();
if(!isset($_GET['id'])){
 header("Location: shop.php");
}
function headerTag(){
?>

<link rel="stylesheet" href="Css/style.css">
<?php
}

$head = headerTag();
$banner=false;
$bannerTag="PRODUCT VIEW";
$title='Product';
$activeNavbar=2;
include("include/Top.php");
include("database/Connection.php");
include("database/Function.php");

$id=$_GET['id'];
$product= SelectId('product',$id);
?>

<!-- Content -->
<div class="container p-3 bg-light">
    <?php if(!is_null($product)){?>
    <div class="row">
        
        <!-- carousel -->
        <div class="col-lg-6 card d-flex justify-content-center">
        <div class="card-body">
            <div id="carouselProduct" class="carousel carousel-dark slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselProduct" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselProduct" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselProduct" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="10000">
                <img src="image/product_image/<?php echo $product['foto_1']?>" class="d-block w-100" style="object-fit: cover;height: 400px;" alt="Gambar 1">
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                <img src="image/product_image/<?php echo $product['foto_2']?>" class="d-block w-100" style="object-fit: cover;height: 400px;" alt="Gambar 2">
                </div>
                <div class="carousel-item">
                <img src="image/product_image/<?php echo $product['foto_3']?>" class="d-block w-100" style="object-fit: cover;height: 400px;" alt="Gambar 3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselProduct" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselProduct" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            </div>
            </div>    
        </div>
        <!-- carouselEnd -->

        <div class="col-lg-6 d-flex justify-content-center">
            <div style="width:100%;">
            <div class="row ms-lg-2" style="height:100%;">
            
            <div class="col-12 mt-2 card d-flex justify-content-center order-md-last">
                <div class="card-body d-flex justify-content-center">
                    <button type="button" class="btn m-auto p-0" data-bs-target="#carouselProduct" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"><img src="image/product_image/<?php echo $product['foto_1']?>" class="img-thumbnail" style="object-fit: cover;height: 125px;width:125px;" alt="Gambar 3"></button>
                    <button type="button" class="btn m-auto p-0" data-bs-target="#carouselProduct" data-bs-slide-to="1" aria-label="Slide 2"><img src="image/product_image/<?php echo $product['foto_2']?>" class="img-thumbnail" style="object-fit: cover;height: 125px;width:125px;" alt="Gambar 3"></button>
                    <button type="button" class="btn m-auto p-0" data-bs-target="#carouselProduct" data-bs-slide-to="2" aria-label="Slide 3"><img src="image/product_image/<?php echo $product['foto_3']?>" class="img-thumbnail" style="object-fit: cover;height: 125px;width:125px;" alt="Gambar 3"></button>
                </div>
            </div>

            <div class="col-12 mt-2 mt-lg-0 card text-center">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product['nama']?></h5>
                        <form action="cart.php" method="post">
                            <input type="hidden" name="id_produk" value="<?php echo $product['id']?>">
                            <div class="card-text mx-auto mx-lg-0 ms-lg-auto" style="width:max-content;">
                            <div class="row g-3">
                                <div class="col-auto">
                                    <label for="quantity" class="col-form-label fw-bold">Product Quantity : </label>
                                </div>
                                <div class="col-auto">
                                    <select name="jumlah" class="form-select" required>
                                        <option value="" disabled selected>Select your option</option>
                                        <?php if($product['jumlah']>5) {?>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <?php }else{
                                        for ($i=1; $i <=$product['jumlah'] ; $i++) {
                                        ?>
                                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                        <?php }
                                        }?>
                                    </select>
                                </div>
                            </div>               

                            <div class="row g-3">
                                <div class="col-auto">
                                    <label class="col-form-label fw-bold">Stock :</label>
                                </div>
                                <div class="col-auto">
                                    <label class="col-form-label fw-bold"><?php echo $product['jumlah']?></label>
                                </div>
                            </div>
                            </div>
                            <h4 class="card-text mt-4">Product Price : Rp. <?php echo $product['harga']?></h4>
                            <div class="row">
                                <div class="col-auto ms-auto">
                                <button type="submit" type="submit" class="btn btn-danger"><i class="fa-solid fa-cart-shopping"></i> Add to Cart</button>
                                </form>
                                </div>
                                <div class="col-auto me-auto">                                
                                <form action="my_wishlist.php" method="post">
                                <input type="hidden" name="id_produk" value="<?php echo $product['id']?>">
                                <button type="submit" class="btn btn-warning text-white"><i class="fa-solid fa-heart"></i> Add to Wishlist</button>
                                </form>        
                                </div>
                            </div>
                        
                    </div>
            </div>

            </div>
        </div>
    </div>
    <div class="card mt-2" style="width:100%;">
    <div class="card-body">
            <h5 class="card-title">Deskripsi</h5>
            <hr>
            <p class="card-text"><?php echo $product['keterangan']?></p>
          </div>
    </div>
</div>


<div class="container bg-light mt-2 mt-lg-4">
    <div class="row">
        <div class="col-lg-3 mt-2 mt-lg-0 d-flex justify-content-center">
            <div class="card text-center" style="width: max-content;height:100%;">
            <div class="card-body">
                <h4 class="card-text p-1">You may also like these Products: We provide you top product items.</h4>
            </div>
            </div>
        </div>

    <?php
    include("database/Connection.php");
    $kategori=$conn->query('SELECT kategori FROM categories WHERE id='.$product['kategori'])->fetch_assoc();

    $recomended_product = SelectRaw("SELECT product.id,foto_1, nama, label, harga
    FROM product INNER JOIN categories ON product.kategori=categories.id
    WHERE
        nama LIKE '%".$kategori['kategori']."%' OR
        categories.kategori LIKE '%".$kategori['kategori']."%'  OR
        keterangan LIKE '%".$kategori['kategori']."%'
    ORDER BY CASE
            WHEN nama LIKE '%".$kategori['kategori']."%' THEN 1
            WHEN categories.kategori LIKE '%".$kategori['kategori']."%'  THEN 2
            WHEN keterangan LIKE '%".$kategori['kategori']."%'  THEN 3
    END limit 3");
    $conn->close();
    
    $delay=0;
    foreach($recomended_product as $item) {
    ?>
    <!-- Col -->
    <div class="col-lg-3 mt-2 mt-lg-0 d-flex justify-content-center z-in" style="transform: scale(0, 0);animation-delay:<?php echo $delay."s"; $delay+=0.2;?>;">        
        <div class="card text-center" style="width: 18rem;">
        <a class="label sale" href="#" style="color:black;">

        <div class="thelabel" style="font-size:14px;"><?php echo $item['label'];?></div>

        <div class="label-background"> </div>
        </a>
        <a href="product.php?id=<?php echo $item['id']?>">
          <img class="card-img-top" src="image/product_image/<?php echo $item['foto_1']?>" style="object-fit: cover;height: 200px;width:100%;" alt="Card image cap">
        </a>
          <hr class="mx-2">
          <div class="card-body">
            <h5 class="card-title"><u><?php echo $item['nama'];?></u></h5>
            <p class="card-text">RP. <?php echo $item['harga'];?></p>
          </div>
          <div class="card-body">
            <a href="product.php?id=<?php echo $item['id']?>" type="button" class="btn btn-light btn-sm border">Views Detail</a>
            <a href="product.php" type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-cart-shopping"></i> Add To Chart</a>
          </div>
        </div>
    </div>
    <!-- ColEnd -->
<?php
}
?>
    </div>
    <?php } else{ ?>
        <h1 class="text-center">Product Not Found</h1>
    <?php } ?>
</div>
<!-- ContentEnd -->


<?php
include("include/Bottom.php");
?>