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
$bannerTag="Change Password";
$title='Change Password';
$activeNavs=7;
include("database/Connection.php");
include("database/Function.php");
if (!isset($_SESSION['id_user'])) {
    echo '<script type="text/javascript"> window.location="login.php";</script>';die;
}
include("include/Top.php");
$count_transaction = $conn->query("SELECT * FROM pesanan WHERE (status='Paid' OR status='Shipped') AND id_pembeli=".$_SESSION['id_user'])->num_rows;
?>

<!-- Content -->
<div class="container p-3 bg-light">
    <div class="row">
        <div class="col-lg-3">
            <?php include("include/Navs.php")?>
        </div>
        <div class="col-lg-9">
            <?php 
            if($count_transaction == 0) {
                if(isset($_POST['submit'])){
                        $stmt = $conn->prepare('SELECT pembeli.id, pembeli.nama FROM pembeli WHERE password=? AND id=?');
                        $stmt->bind_param('si', $_POST['password'],$_SESSION['id_user']);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if($result->num_rows == 0){
                            $incorect="password incorect";
                        }
                        if($count_transaction == 0 && $result->num_rows >0){
                            $conn->query('DELETE FROM pesanan WHERE status="Unpaid" AND id_pembeli='.$_SESSION['id_user']);
                            $conn->query('DELETE FROM pembeli WHERE id='.$_SESSION['id_user']);
                            echo '<script type="text/javascript"> window.location="logout.php";</script>';
                        }
                }
                $conn->close();  
            ?>
            <div class="card my-md-2">
                <div class="card-body">
                    <h2 class="card-title">Delete Account</h2>
                    <form action="delete_account.php" method="post">
                    <div class="form-group"><!-- form-group Starts -->
                    <label> Enter Your Current Password </label>
                    <input type="password" name="password" class="form-control" required value="<?php echo (isset($incorect))?$_POST['password']:''?>">
                    <?php
                    if(isset($incorect)){
                    ?>
                        <span class="invalid-feedback d-block" role="alert">
                        <?php echo $incorect?>
                        </span>
                    <?php } ?>
                    <div class="form-group mt-2">
                        <input type="submit" onclick="if (confirm('Do You Reaaly Want To Delete Your Account?')){return true;}else{event.stopPropagation(); event.preventDefault();};" class="btn btn-danger d-block mx-auto" name="submit" value="Confirm to Delete">
                    </div>
                    </form>
                </div>
            </div>
            <?php } else {
            $sql="SELECT pesanan.invoice,pesanan.kurir,pesanan.layanan,pesanan.ongkir, CAST(tanggal_pesan AS DATE) as tanggal, sum(harga*jumlah)+ongkir as total, status FROM `pesanan` WHERE id_pembeli=".$_SESSION['id_user']." AND status <> 'Complete' AND status<>'Unpaid' GROUP BY invoice";

            $orders=SelectRaw($sql);
            ?>
                <div class="card my-md-2">
                <div class="card-body">    
                    <h2 class="card-title">You Cannot Delete This Account</h2>
                    <h5 class="card-title">You must Complete your orders</h5>
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
                            <td><?php
                            if($order['status']=='Paid'){
                                echo '<a href="order_detail.php?invoice='.$order['invoice'].'" class="btn btn-sm btn-info d-block m-2 text-white" type="button">View Detail</a>';
                            }else if($order['status']=='Shipped'){
                                echo '<a href="order_detail.php?invoice='.$order['invoice'].'" class="btn btn-sm btn-warning d-block m-2 text-white" type="button">View Resi</a>';
                            }
                            ?>
                            </td>
                        </tr>
                        <?php }}else{echo "No Data";} ?>
                        </tbody><!-- tbody Ends -->


                        </table><!-- table table-bordered table-hover table-striped Ends -->
                    </div>
                </div>
            </div>
        </div>
        <?php }?>
    </div>
</div>
<!-- ContentEnd -->
<?php
include("include/Bottom.php");
?>