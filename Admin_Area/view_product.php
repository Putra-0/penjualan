<?php
function headerTag(){
?>


<?php
}
$head = headerTag();
$title='View Product';
$breadcrumb=array('Dashboard','Poduct');
include("include/Top.php");
include("database/Connection.php");
include("database/Function.php");
?>
<!-- Content -->
<div class="card" style="border-color:#DDDDDD">
    <div class="card-body" style="background-color:#F5F5F5">
        <p class="card-title"><i class="fa-solid fa-money-bill-1 me-2"></i>View Products</p>
      </div>

      <div class="card-body">
        <div class="table-responsive"><!-- table-responsive Starts -->

          <table class="table table-sm table-bordered table-hover table-striped"><!-- table table-bordered table-hover table-striped Starts -->

          <thead><!-- thead Starts -->
          <tr>
          <th>#</th>
          <th>Nama</th>
          <th>Gambar</th>
          <th>Kategori</th>
          <th>Harga</th>
          <th>Stock</th>
          <th>Berat <br> (Satuan)</th>
          <th>Delete</th>
          <th>Edit</th>
          </tr>
          </thead><!-- thead Ends -->
          <?php
           $products = SelectRaw('SELECT product.id,nama,foto_1,categories.kategori,harga,jumlah,berat FROM `product` INNER JOIN categories on product.kategori = categories.id');
           if(!is_null($products)){
           foreach($products as $index => $product){
          ?>
          <tr>
            <td><?php echo $index+1; ?></td>
            <td><?php echo $product['nama']; ?></td>
            <td><img src="../image/product_image/<?php echo $product['foto_1']; ?>" alt="Gambar Product <?php echo $product['nama']; ?>" width="60" height="60"></td>
            <td><?php echo $product['kategori']; ?></td>
            <td><?php echo $product['harga']; ?></td>
            <td><?php echo $product['jumlah']; ?></td>
            <td><?php echo $product['berat']; ?></td>
            <td><a class="link-dark" href="delete_product.php?id=<?php echo $product['id']; ?>" onclick="if (confirm('Delete selected item?')){return true;}else{event.stopPropagation(); event.preventDefault();};"><i class="fa-solid fa-trash-can me-2"></i>Delete</a></td>
            <td><a class="link-dark" href="edit_product.php?id=<?php echo $product['id']; ?>"><i class="fa fa-pencil me-2"></i>Edit</a></td>
          </tr>
          <?php }
          } ?>
          <tbody><!-- tbody Starts -->

          </tbody><!-- tbody Ends -->
          </table><!-- table table-bordered table-hover table-striped Ends -->
        </div>
      </div>
    </div>
<!-- ContentEnd -->
<?php
include("include/Bottom.php");
?>