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
$bannerTag="SHOP AT PELANGI ACCESSORIES";
$title='Shop';
$activeNavbar=2;
include("include/Top.php");
?>

<!-- Content -->
<?php
include("include/Product.php");
?>

<script type="text/javascript">
  window.scrollTo(0, 320);
</script>
<!-- ContentEnd -->


<?php
include("include/Bottom.php");
?>