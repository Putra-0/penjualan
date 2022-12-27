
<!-- Product -->
<div class="container p-3 bg-light">
<div class="row">
<?php
$batas = 6;
$halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	

$previous = $halaman - 1;
$next = $halaman + 1;
include("database/Connection.php");
include("database/Function.php");
$table_name='product';
$data = SelectAll($table_name);
$jumlah_data = $data->num_rows;
$total_halaman = ceil($jumlah_data / $batas);

include("database/Connection.php");
if(isset($_GET['s']) && !is_null($_GET['s'])){
  $data_product =SelectRaw("SELECT *
  FROM product INNER JOIN categories ON product.kategori=categories.id
  WHERE
      nama LIKE '%".$_GET['s']."%' OR
      categories.kategori LIKE '%".$_GET['s']."%'  OR
      keterangan LIKE '%".$_GET['s']."%'
  ORDER BY CASE
          WHEN nama LIKE '%".$_GET['s']."%' THEN 1
          WHEN categories.kategori LIKE '%".$_GET['s']."%'  THEN 2
          WHEN keterangan LIKE '%".$_GET['s']."%'  THEN 3
  END limit 3");  
}else{
  $data_product = SelectRaw("select * from product limit $halaman_awal, $batas");
}
$nomor = $halaman_awal+1;
if(!is_null($data_product)){
$delay=0;
foreach($data_product as $product) {
    ?>
    <!-- Col -->
    <div class="col-md-6 col-lg-4 my-3 d-flex justify-content-center z-in" style="transform: scale(0, 0);animation-delay:<?php echo $delay."s"; $delay+=0.2;?>;">        
        <div class="card text-center" style="width: 20rem;">
        <a class="label sale" href="#" style="color:black;">

        <div class="thelabel" style="font-size:14px;"><?php echo $product['label']?></div>

        <div class="label-background"> </div>
        </a>
          <a href="product.php">
            <img class="card-img-top" src="image/product_image/<?php echo $product['foto_1']?>" style="object-fit: cover;height: 200px;width:100%;" alt="Card image cap">
          </a>
          <hr class="mx-2">
          <div class="card-body">
            <h5 class="card-title"><u><?php echo $product['nama']?></u></h5>
            <p class="card-text">RP. <?php echo $product['harga']?></p>
          </div>
          <div class="card-body">
            <a href="product.php?id=<?php echo $product['id']?>" type="button" class="btn btn-light btn-sm border">Views Detail</a>
            <a href="product.php?id=<?php echo $product['id']?>" type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-cart-shopping"></i> Add To Chart</a>
          </div>
        </div>
    </div>
    <!-- ColEnd -->
<?php
}
}
?>
</div>

<!-- Paggination -->
<nav aria-label="Page navigation">
  <ul class="pagination justify-content-center">
    <li class="page-item">
      <a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$previous'"; } ?>>Previous</a>
    </li>
    <?php 
				for($x=1;$x<=$total_halaman;$x++){
					?> 
					<li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
					<?php
				}
				?>	
      <a class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next'"; } ?>>Next</a>
    </li>
  </ul>
</nav>
<!-- PagginationEnd -->

</div>
<!-- ProductEnd -->