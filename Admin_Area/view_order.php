<?php
function headerTag(){
?>


<?php
}
$head = headerTag();
$title='View Order';
$breadcrumb=array('Dashboard','View Order');
include("include/Top.php");
include("database/Connection.php");
include("database/Function.php");

$sql="SELECT pesanan.invoice,IFNULL(pembeli.email,'Deleted Account') as email,tanggal_pesan, status FROM `pesanan` LEFT JOIN pembeli ON pesanan.id_pembeli = pembeli.id GROUP BY invoice ORDER BY tanggal_pesan DESC";

$orders=SelectRaw($sql);

?>
<!-- Content -->
<div class="card" style="border-color:#DDDDDD;">
    <div class="card-body" style="background-color:#F5F5F5;">
        <h5 class="card-title"><i class="fa-solid fa-money-bill-1 me-2"></i>View Orders</h5>
    </div>
    <div class="card-body">
        <div class="container">
        <div class="table-responsive"><!-- table-responsive Starts -->

            <table class="table table-bordered table-hover table-striped"><!-- table table-bordered table-hover table-striped Starts -->

            <thead><!-- thead Starts -->
            <tr>
            <th>#</th>
            <th>Customer</th>
            <th>Invoice No</th>
            <th>Date</th>
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
            <td><?php echo $order['email']?></td>
            <td><?php echo $order['invoice']?></td>
            <td><?php echo $order['tanggal_pesan']?></td>
            <td><?php echo $order['status']?></td>
            <td>
              <a href="detail_order.php?invoice=<?php echo $order['invoice'] ?>" class="text-nowrap link-dark d-inline m-2"><i class="fa-solid fa-info me-2"></i>View Detail</a>
              <a class="text-nowrap link-dark" href="delete_order.php?invoice=<?php echo $order['invoice']; ?>" onclick="if (confirm('Delete selected item?')){return true;}else{event.stopPropagation(); event.preventDefault();};"><i class="fa-solid fa-trash-can me-2"></i>Delete</a>
            </td>
          </tr>
          <?php }}else{echo "No Data";} ?>
            </tbody><!-- tbody Ends -->


            </table><!-- table table-bordered table-hover table-striped Ends -->
            </div>
        </div>
    </div>
</div>
<!-- ContentEnd -->
<?php
include("include/Bottom.php");
?>

    