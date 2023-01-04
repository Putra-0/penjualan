<?php
if(!isset($_SESSION))
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo (isset($title)) ? $title : 'Pelangi Accessories'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">    
    <?php echo (isset($head)) ? $head : ''; ?>
</head>

<body>
    <!-- Navbar Start -->
    <div class="bg-light fixed-top">
    <nav class="navbar mt-3 navbar-expand navbar-dark bg-dark py-1">
    <div class="container-fluid">
    <p class="text-white my-auto"><small>Wellcome: <?php echo (isset($_SESSION['nama']))? explode(" ",$_SESSION['nama'])[0] :"Guest"?></small></p>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <?php if(isset($_SESSION['nama'])){?>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="my_order.php">My Account</a>
          </li>
          <li class="nav-item">
            <?php
            include("database/Connection.php");
            $cart_count = $conn->query("SELECT id_produk FROM cart where id_pembeli='".$_SESSION['id_user']."'")->num_rows;
            ?>
            <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i> <?php echo (!is_null($cart_count) ? $cart_count:'0')?> item</a>
          </li>
          <?php }else {?>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="register.php">Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="login.php">Sign In</a>
          </li>
          <?php } ?>
        </ul>
  </div>
</nav>

<nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="container-fluid">
    <img src="image/logo.jpg" class="img-thumbnail rounded-circle d-none d-lg-block d-xl-block" alt="logo" width="100" height="100">
    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mx-md-auto mx-lg-0 ms-lg-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?php if($activeNavbar==1) echo "active"; ?>" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if($activeNavbar==2) echo "active"; ?>" aria-current="page" href="shop.php">Shop</a>
        </li>
        <li class="nav-item">
        <a class="nav-link <?php if($activeNavbar==3) echo "active"; ?>" aria-current="page" href="about_us.php">About Us</a>
        </li>
        <?php if(isset($_SESSION['nama'])){?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            My Account
          </a>
          <ul class="dropdown-menu dropdown-menu-lg-end p-1" aria-labelledby="navbarDropdown" style="width: max-content !important;border:0;border-radius: 0;overflow-y: auto;overflow-x: hidden;max-height: 40vh;">
          <h6 class="dropdown-header">Account Setting</h6>
            <div class="row">
                <div class="col-md-6">
                    <a class="dropdown-item" href="my_wishlist.php">My Wishlist</a>
                    <a class="dropdown-item" href="my_order.php">My Orders</a>
                    <a class="dropdown-item" href="complete_order.php">Complete Orders</a>
                    <a class="dropdown-item" href="pay_offline.php">Pay Offline</a>
                </div>
                <div class="col-md-6">
                    <a class="dropdown-item" href="edit_account.php">Edit Your Account</a>
                    <a class="dropdown-item" href="change_password.php">Change Password</a>
                    <a class="dropdown-item" href="delete_account.php">Delete Account</a>
                    <a class="dropdown-item" href="logout.php">Log Out</a>
                </div>
            </div>
        </ul>
        </li>
        <?php }?>
      </ul>
      <form class="d-flex my-auto" method="get" action="shop.php">
        <input class="form-control me-2" type="text" name="s" value="<?php echo (isset($_GET['s']))?$_GET['s']:'' ?>" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
</div>
    <!-- Navbar End -->
    <div style="width:100%;margin-top: 200px;"></div>
<?php
if($banner==true){
?>

<div class="container-fluid text-center py-4 position-relative">
    <img src="image/banner_ave.jpg" class="img-fluid" alt="background" width="95%">
    <?php
      if(!is_null($bannerTag)){
    ?>  
    <h2 class="text-white" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);"><?php echo $bannerTag; ?></h2>
    <?php
    }
    ?>
</div>

<?php
}
?>

