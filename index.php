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
$bannerTag=NULL;
$activeNavbar=1;
include("include/Top.php");
?>

<!-- Content -->

<div class="container-fluid text-center py-4">
    <img src="image/logo.jpg" class="img-fluid f-in" alt="pelangi store" width="40%">
</div>

<?php
include("include/Product.php");
?>

<!-- ContentEnd -->


<?php
include("include/Bottom.php");
?>