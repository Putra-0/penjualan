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
$bannerTag="About Us";
$title='About Us';
$activeNavbar=3;
include("include/Top.php");
include("database/Connection.php");
$about = $conn->query("SELECT * FROM about_us")->fetch_assoc();
$conn->close();
include("database/Connection.php");
include("database/Function.php");
?>

<!-- Content -->
<div class="container p-3 bg-light">
<h2><?php echo is_null($about)?'':$about['Heading'] ?></h2>
<h5 style="text-align: justify;"><?php echo is_null($about)?'':$about['Short_Desc'] ?></h5>
<br>
<p style="text-align: justify;"><?php echo is_null($about)?'':$about['Long_Desc'] ?></p>
</div>
<!-- ContentEnd -->


<?php
include("include/Bottom.php");
?>