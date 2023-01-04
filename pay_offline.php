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
$banner=false;
$bannerTag="Pay Ofline";
$activeNavs=4;
$title='Pay Ofline';
include("database/Connection.php");
include("database/Function.php");

if (!isset($_SESSION['id_user'])) {
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
                    <h2 class="card-title">Pay OffLine Using Method</h2>
                    <h5 class="card-title">Your orders on one place.</h5>
                    <p class="card-tex">If you have any questions, please feel free to contact us, our customer service center is working for you 24/7.</p>
                        
                    <hr>
                    <div class="table-responsive" ><!-- table-responsive Starts -->

                    <table class="table table-bordered table-hover table-striped" ><!-- table table-bordered table-hover table-striped Starts -->

                    <thead><!-- thead Starts -->

                    <tr>

                    <th> BNI </th>

                    <th> Mandiri </th>

                    <th> BRI </th>

                    </tr>

                    </thead><!-- thead Ends -->

                    <tbody><!-- tbody Starts -->

                    <tr>

                    <td> (009) 62756892103 AN: Pelangi Accessories	 </td>

                    <td> (008) 11209865783 AN: Pelangi Accessories   </td>

                    <td> (002) 94532591011 AN: Pelangi Accessories
                    </td>


                    </tr>

                    </tbody><!-- tbody Ends -->


                    </table><!-- table table-bordered table-hover table-striped Ends -->

                    </div><!-- table-responsive Ends -->
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-body">
                    <img class="img-fluid d-block mx-auto" src="image/bank.jpg" alt="bank">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ContentEnd -->
<?php
include("include/Bottom.php");
?>