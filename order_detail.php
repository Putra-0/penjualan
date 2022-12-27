<?php
if(!isset($_SESSION))
session_start();
function headerTag(){
?>
<link rel="stylesheet" href="Css/style.css">
<style>
    .table-col-fit{
    white-space: nowrap;
    width: 1%;
    }
</style>
<?php
}
$head = headerTag();
$banner=true;
$bannerTag="Your Payment";
$title='Your Payment';
include("database/Connection.php");
include("database/Function.php");
if(isset($_POST['complete'])){
    $conn->query("UPDATE pesanan SET status='Complete' where invoice='".$_POST['invoice']."'");
    echo '<script type="text/javascript"> window.location="complete_order.php";</script>';
}
$sql="SELECT pesanan.invoice,pesanan.nama_produk,harga,jumlah,kurir,layanan,ongkir, harga*jumlah as sub_total, resi,status,keterangan  FROM `pesanan` WHERE id_pembeli='".$_SESSION['id_user']."' AND pesanan.invoice='".$_GET['invoice']."' AND status <> 'Unpaid'";
$sum=$conn->query("SELECT sum(harga*jumlah)+ongkir as total, status FROM `pesanan` WHERE invoice='".$_GET['invoice']."' AND status<>'Unpaid'")->fetch_assoc();
$payment=$conn->query("SELECT * FROM payment WHERE invoice='".$_GET['invoice']."'")->fetch_assoc();
$orders=SelectRaw($sql);

if (!isset($_SESSION['id_user']) || is_null($orders)) {
    echo '<script type="text/javascript"> window.location="my_order.php";</script>';die;
}
include("include/Top.php");
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
                    <div class="row">
                        <div class="col-lg-6">
                            <h2 class="card-title">Details</h2>
                            <h5 class="card-title">Your orders on one place.</h5>
                            <p class="card-tex">If you have any questions, please feel free to contact us, our customer service center is working for you 24/7.</p>
                        </div>
                        <div class="col-lg-6">
                            <?php $data = $orders->fetch_assoc(); ?>
                            <h5 class="card-title"> Invoice : <?php echo (!is_null($orders))? $data['invoice'] :"0"?></h5>
                            <div class="row my-2 my-lg-0">
                                <div class="col-lg-6">
                                    <p class="card-text">Couriel: <?php echo (!is_null($orders))? $data['kurir'] :""?></p>
                                </div>
                                <div class="col-lg-6">
                                    <p class="card-text">Service: <?php echo (!is_null($orders))? $data['layanan'] :""?></p>
                                </div>
                                <div class="col-lg-6">
                                    <p class="card-text">Shipping: Rp. <?php echo (!is_null($orders))? $data['ongkir'] :"0"?></p>
                                </div>
                                <div class="col-lg-6">
                                    <p class="card-text">
                                    <?php
                                    if(!is_null($orders)){
                                        if($data['status']=='Shipped'){
                                    ?>
                                    <form action="order_detail.php?invoice=<?php echo (!is_null($orders))? $data['invoice'] :"0"?>" onsubmit="return confirm('Do you really want to Complete Orders?');" method="post">
                                        Resi: <?php if(!is_null($orders)) { echo ($data['resi'] !='' && !is_null($data['resi']))? '<span id="resi">'.$data['resi'].'</span> <button id="btn_resi" class="btn btn-sm btn-primary d-lg-block float-lg-end" onClick="copyResi()" type="button"><i class="fa-solid fa-copy me-1"></i>Copy Resi</button>' :"-"; } ?>
                                        <input class="btn btn-sm btn-success d-lg-block" type="submit" value="Complete" name="complete">
                                        <input type="hidden" name="invoice" value="<?php echo (!is_null($orders))? $data['invoice'] :"0"?>">
                                    </form>
                                    <?php }else{ ?>
                                        Resi: <?php if(!is_null($orders)) { echo ($data['resi'] !='' && !is_null($data['resi']))? '<span id="resi">'.$data['resi'].'</span> <button id="btn_resi" class="btn btn-sm btn-primary d-lg-block float-lg-end" onClick="copyResi()" type="button"><i class="fa-solid fa-copy me-1"></i>Copy Resi</button>' :"-"; } ?>
                                    <?php }} ?>
                                    </p>

                                    <script>
                                        function copyResi(){
                                            // Get the text field
                                            var copyText = document.getElementById("resi").innerText;
                                            // Copy the text inside the text field
                                            navigator.clipboard.writeText(copyText);

                                            //button change
                                            var button = document.getElementById("btn_resi");

                                            button.innerHTML = '<i class="fa-solid fa-check me-1"></i>Copied';
                                            setTimeout(function() {
                                                button.innerHTML = '<i class="fa-solid fa-copy me-1"></i>Copy Resi';
                                            }, 600);

                                        }
                                    </script>
                                </div>
                                <div class="col-12 mb-3">
                                    <p class="card-text">Keterangan Penjual :
                                    <?php echo (!is_null($data['keterangan']) && $data['keterangan']!='')? '<br>'.$data['keterangan'] :"-" ?>
                                    </p>
                                </div>
                            </div>
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
            <?php 
            if(!is_null($payment)){
            ?>
            <div class="card mt-2">
                <div class="card-body">
                <h1 align="center">Your Payment </h1>
                <div class="table-responsive"><!-- table-responsive Starts -->

                    <table class="table table-sm table-bordered table-hover table-striped"><!-- table table-bordered table-hover table-striped Starts -->

                    <tr>
                    <td class="table-col-fit p-2">Invoice</td>
                    <td class="table-col-fit p-2">:</td>
                    <th class="p-2"><?php echo $payment['invoice']?></th>
                    </tr>

                    <tr>
                    <td class="table-col-fit p-2">Amount Sent</td>
                    <td class="table-col-fit p-2">:</td>
                    <th class="p-2"><?php echo $payment['nominal_kirim']?></th>
                    </tr>

                    <tr>
                    <td class="table-col-fit p-2">Payment Mode</td>
                    <td class="table-col-fit p-2">:</td>
                    <th class="p-2"><?php echo $payment['payment_mode']?></th>
                    </tr>

                    <tr>
                    <td class="table-col-fit p-2">Transaction/Reference Id</td>
                    <td class="table-col-fit p-2">:</td>
                    <th class="p-2"><?php echo $payment['id_reference']?></th>
                    </tr>

                    <tr>
                    <th class="p-2 text-center" colspan="3">Proof</th>
                    </tr>
                    <tr>
                    <td class="p-2 text-center" colspan="3">
                        <img class="img-fluid" src="image/transaction/<?php echo $payment['bukti_transaksi']?>" alt="payment">
                    </td>
                    </tr>

                    </table><!-- table table-bordered table-hover table-striped Ends -->
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
    </div>
</div>
<!-- ContentEnd -->
<?php
include("include/Bottom.php");
?>