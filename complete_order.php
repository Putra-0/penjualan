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
$bannerTag="Complete Order";
$title='Complete Order';
$activeNavs=3;
include("database/Connection.php");
include("database/Function.php");

if (!isset($_SESSION['id_user'])) {
    echo '<script type="text/javascript"> window.location="login.php";</script>';die;
}
include("include/Top.php");
$sql="SELECT pesanan.invoice,pesanan.kurir,pesanan.layanan,pesanan.ongkir, CAST(tanggal_pesan AS DATE) as tanggal, sum(harga*jumlah)+ongkir as total, status FROM `pesanan` WHERE id_pembeli=".$_SESSION['id_user']." AND status = 'Complete' GROUP BY invoice";

$orders=SelectRaw($sql);


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
                    <h2 class="card-title">My Orders</h2>
                    <h5 class="card-title">Your orders on one place.</h5>
                    <p class="card-tex">If you have any questions, please feel free to contact us, our customer service center is working for you 24/7.</p>
                    <div class="table-responsive"><!-- table-responsive Starts -->

          <table class="table table-sm table-bordered table-hover table-striped"><!-- table table-bordered table-hover table-striped Starts -->

          <thead><!-- thead Starts -->
          <tr>
          <th>#</th>
          <th>Invoice</th>
          <th>Couriel</th>
          <th>Service</th>
          <th>Shipping</th>
          <th>Order Date</th>
          <th>Total</th>
          <th>Status</th>
          <th>Action</th>


          </tr>

          </thead><!-- thead Ends -->

          <tbody><!-- tbody Starts -->
          <?php
          if(!is_null($orders)){
          foreach($orders as $index => $order){?>
          <tr>
          <td><?php echo $index+1;?></td>
          <td><?php echo $order['invoice']?></td>
          <td><?php echo $order['kurir']?></td>
          <td><?php echo $order['layanan']?></td>
          <td><?php echo $order['ongkir']?></td>
          <td><?php echo $order['tanggal']?></td>
          <td><?php echo $order['total']?></td>
          <td><?php echo $order['status']?></td>
            <td>
                <a href="order_detail.php?invoice=<?php echo $order['invoice']?>" class="btn btn-sm btn-success d-block m-2 text-white" type="button">View Detail</a>
            </td>
          </tr>
          <?php }}else{echo "No Data";} ?>
          </tbody><!-- tbody Ends -->


          </table><!-- table table-bordered table-hover table-striped Ends -->
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