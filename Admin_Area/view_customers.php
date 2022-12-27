<?php
function headerTag(){
?>


<?php
}
$head = headerTag();
$title='View Product';
$breadcrumb=array('Dashboard','Customers');
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
          <th>Email</th>
          <th>Alamat</th>
          <th>Nomor HP</th>
          <th>Delete</th>
          </tr>
          </thead><!-- thead Ends -->
          <?php
           $customers = SelectAll('pembeli');
           if(!is_null($customers)){
           foreach($customers as $index => $customer){
          ?>
          <tr>
            <td><?php echo $index+1; ?></td>
            <td><?php echo $customer['nama']; ?></td>
            <td><?php echo $customer['email']; ?></td>
            <td><?php echo $customer['alamat']; ?></td>
            <td><?php echo $customer['nomor_hp']; ?></td>
            <td><a class="link-dark" href="delete_customers.php?id=<?php echo $customer['id']; ?>" onclick="if (confirm('Delete selected item?')){return true;}else{event.stopPropagation(); event.preventDefault();};"><i class="fa-solid fa-trash-can me-2"></i>Delete</a></td>
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