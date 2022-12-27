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
$bannerTag="Confirm Payment";
$title='Confirm Payment';
include("database/Connection.php");
include("database/Function.php");
$sql="SELECT pesanan.invoice,pesanan.nama_produk,harga,jumlah,kurir,layanan,ongkir, harga*jumlah as sub_total  FROM `pesanan` WHERE id_pembeli='".$_SESSION['id_user']."' AND pesanan.invoice='".$_GET['invoice']."' AND status='Unpaid'";
$sum=$conn->query("SELECT sum(harga*jumlah)+ongkir as total, status FROM `pesanan` WHERE invoice='".$_GET['invoice']."' AND status='Unpaid'")->fetch_assoc();
$orders=SelectRaw($sql);

if (!isset($_SESSION['id_user']) || is_null($orders)) {
    echo '<script type="text/javascript"> window.location="my_order.php";</script>';die;
}
include("include/Top.php");

if(isset($_POST['confirm_payment'])){
    include("database/Connection.php");
    $table_name = "payment";
    $column="id_pembeli,invoice,nominal_kirim,payment_mode,id_reference";
    $values= "'".$_SESSION['id_user']."','".$_GET['invoice']."','".$_POST['nominal']."','".$_POST['payment_mode']."','".$_POST['ref_no']."'";
    $lastid = Insert($table_name,$column,$values);
    if(!is_null($lastid)){
        $file_name = $_FILES['bukti']['name'];
        $file_tmp = $_FILES['bukti']['tmp_name'];
        $x = explode('.', $file_name);
        $ekstensi = end($x);
        $new_file_name="transaksi_".$_GET['invoice'].".".$ekstensi;
        move_uploaded_file($file_tmp, 'image/transaction/'.$new_file_name);
        $new_file_name;
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        $conn->query("UPDATE $table_name SET bukti_transaksi='".$new_file_name."' WHERE id=$lastid");
        $conn->query("UPDATE pesanan SET status='Paid' WHERE invoice='".$_GET['invoice']."'");
        $conn->close();
        echo '<script type="text/javascript"> window.location="my_order.php";</script>';
    }
}
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
                    <div class="row my-md-2">
                        <div class="col-lg-8">
                            <h2 class="card-title">Details</h2>
                            <h5 class="card-title">Your orders on one place.</h5>
                            <p class="card-tex">If you have any questions, please feel free to contact us, our customer service center is working for you 24/7.</p>
                        </div>
                        <div class="col-lg-4">
                            <?php $data = $orders->fetch_assoc(); ?>
                            <h5 class="card-title"> Invoice : <?php echo (!is_null($orders))? $data['invoice'] :"0"?></h5>
                            <p class="card-text">Couriel: <?php echo (!is_null($orders))? $data['kurir'] :""?></p>
                            <p class="card-text">Service: <?php echo (!is_null($orders))? $data['layanan'] :""?></p>
                            <p class="card-text">Shipping: Rp. <?php echo (!is_null($orders))? $data['ongkir'] :"0"?></p>
                        </div>
                    </div>
                    <div class="table-responsive"><!-- table-responsive Starts -->

                        <table class="table table-sm table-bordered table-hover table-striped"><!-- table table-bordered table-hover table-striped Starts -->

                        <thead><!-- thead Starts -->
                        <tr>
                        <th>#</th>
                        <th>Produk</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Sub Total</th>

                        </tr>

                        </thead><!-- thead Ends -->

                        <tbody><!-- tbody Starts -->
                        <?php
                        if(!is_null($orders)){
                        foreach($orders as $index => $order){?>
                        <tr>
                        <td><?php echo $index+1;?></td>
                        <td><?php echo $order['nama_produk']?></td>
                        <td>Rp. <?php echo $order['harga']?></td>
                        <td><?php echo $order['jumlah']?></td>
                        <td>Rp.<?php echo $order['sub_total']?></td>
                        </tr>
                        <?php }}else{echo "No Data";} ?>
                        </tbody><!-- tbody Ends -->


                        </table><!-- table table-bordered table-hover table-striped Ends -->
                        </div>
                        <h3 class="card-title text-end">Total: Rp. <?php echo (!is_null($sum))? $sum['total'] :"0"?></h3>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-body">
                <h1 align="center"> Please Confirm Your Payment </h1>
                <p class="card-text text-center"><a href="pay_offline.php" class="link-dark">How to pay</a></p>

                <form action="pesanan_confirm.php?invoice=<?php echo (!is_null($orders))? $data['invoice']:""; ?>" onsubmit="return confirm('Do you really want to submit the form?');" method="post" enctype="multipart/form-data"><!--- form Starts -->

                <div class="form-group"><!-- form-group Starts -->

                <label>Invoice No:</label>

                <input type="text" class="form-control" name="invoice_no" value="<?php echo (!is_null($orders))? $data['invoice']:"" ?>" readonly>

                </div><!-- form-group Ends -->


                <div class="form-group"><!-- form-group Starts -->

                <label>Amount Sent:</label>

                <input type="text" class="form-control" name="nominal" value="<?php echo (!is_null($sum))? $sum['total']:""?>" readonly>

                </div><!-- form-group Ends -->

                <div class="form-group"><!-- form-group Starts -->

                <label>Select Payment Mode:</label>

                <select name="payment_mode" id="payment_mode" class="form-select" required><!-- select Starts -->
                <option value="" disabled selected>Select Payment Mode</option>
                <option value="BNI">BNI</option>
                <option value="Mandiri">Mandiri</option>
                <option value="BRI">BRI</option>
                </select><!-- select Ends -->
                <script>
                    document.getElementById('payment_mode').addEventListener('change', function() {
                     const value = this.value;
                     const ref_no =document.getElementById('ref_no');
                     ref_no.removeAttribute("disabled");
                     if(value=="BNI"){
                        ref_no.setAttribute("pattern","[0-9]{10,10}");
                     }else if(value=="Mandiri"){
                        ref_no.setAttribute("pattern","[0-9]{13,13}");
                     }else if(value=="BRI"){
                        ref_no.setAttribute("pattern","[0-9]{15,15}");
                     }
                    });
                </script>
                </div><!-- form-group Ends -->

                <div class="form-group"><!-- form-group Starts -->

                <label>Transaction/Reference Id:</label>

                <input type="text" class="form-control" id="ref_no" name="ref_no" pattern="[a-zA-Z0-9]{10,10}" disabled required>

                </div><!-- form-group Ends -->

                <label> Proof </label>

                <input type="file" class="form-control" name="bukti" accept="image/*"  required>

                </div><!-- form-group Ends -->

                <br>

                <div class="text-center"><!-- text-center Starts -->

                <button type="submit" name="confirm_payment" class="btn btn-primary btn-lg">

                <i class="fa fa-user-md"></i> Confirm Payment

                </button>

                </div><!-- text-center Ends -->

                </form><!--- form Ends -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ContentEnd -->
<?php
include("include/Bottom.php");
?>