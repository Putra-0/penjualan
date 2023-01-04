<?php
if(!isset($_SESSION))
session_start();

if (!isset($_SESSION['id_admin'])) {
  echo '<script type="text/javascript"> window.location="login.php";</script>';die;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title><?php echo (isset($title)) ? $title : 'Pelangi Accessories'; ?></title>
    <?php echo (isset($head)) ? $head : ''; ?>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://getbootstrap.com/docs/5.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="css/sidebars.css" rel="stylesheet">
  </head>
  <body>
<script>
    
function checkMediaQuery() {
  // If the inner width of the window is greater then 768px
  if (window.matchMedia('(min-width:992px)').matches) {
    // Then log this message to the console
    openNav();
  }else{
    closeNav();
  }
}

// Add a listener for when the window resizes
window.addEventListener('resize', checkMediaQuery);

let isOpen = false;
function colapse(){
  if (isOpen){
    closeNav();
    isOpen = false;
  }else{
    openNav();
    isOpen = true;
  }
}

function openNav() {
  document.getElementById("mySidebar").style.marginLeft = "0";
}

function closeNav() {
  document.getElementById("mySidebar").style.marginLeft = "-280px";
}
</script>
<nav class="nav nav-expand bg-dark p-2 border-bottom fixed-top">
  <h4 class="text-light">Admin Panel</h4>
<button class="btn btn-dark d-lg-none ms-auto" type="button" onclick="colapse()" style="width:max-content;height:max-content;">
  <span class="navbar-dark"><span class="navbar-toggler-icon"></span>
</button>
</nav>
<main>
  <div id="mySidebar" class="d-flex flex-column flex-shrink-0 p-3 pb-4 text-light bg-dark scrollarea fixed-top" style="width:300px !important; margin-top: 45px !important; height: 95%;">
    <a href="index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-light text-decoration-none">
    <i class="fa-solid fa-rainbow me-2"></i>
      <span class="fs-4">Flazz Accessories</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li>
        <a href="index.php" class="nav-link text-light">
        <i class="fa-solid fa-gauge me-2"></i>
          Dashboard
        </a>
      </li>
      <li>
        <a class="nav-link text-light btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#products-collapse" aria-expanded="false">
        <i class="fa-solid fa-table-cells me-2"></i>
          Products
        </a>
        <div class="collapse" id="products-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="insert_product.php" class="link-light rounded">Insert Products</a></li>
            <li><a href="view_product.php" class="link-light rounded">View Products</a></li>
          </ul>
        </div>
        </a>
      </li>
      <li>
        <a class="nav-link text-light btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#products-categories-collapse" aria-expanded="false">
        <i class="fa-solid fa-pen me-2"></i>
          Products Categories
        </a>
        <div class="collapse" id="products-categories-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="insert_categories.php" class="link-light rounded">Insert Products Categories</a></li>
            <li><a href="view_categories.php" class="link-light rounded">View Products Categories</a></li>
          </ul>
        </div>
        </a>
      </li>
      <li>
        <a href="about_us.php" class="nav-link text-light">
        <i class="fa-solid fa-pen-to-square me-2"></i>
          Edit About Us Page
        </a>
      </li>
      <li>
        <a href="Contact.php" class="nav-link text-light">
        <i class="fa-solid fa-pen-to-square me-2"></i>
          Edit Contacts
        </a>
      </li>
      <li>
        <a href="view_customers.php" class="nav-link text-light">
        <i class="fa-solid fa-pen-to-square me-2"></i>
          View Customers
        </a>
      </li>
      <li>
        <a href="view_order.php" class="nav-link text-light">
        <i class="fa-solid fa-list me-2"></i>
          View Orders
        </a>
      </li>
      <li>
        <a href="view_payment.php" class="nav-link text-light">
        <i class="fa-solid fa-pen me-2"></i>
          View Payment
        </a>
      </li>
    </ul>
    <hr>
    <div class="dropdown mt-auto">
      <a href="#" class="d-flex align-items-center text-light text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
        <h4 class="rounded-circle me-2"><i class="fa-solid fa-user-shield"></i></h4 class="rounded-circle me-2">
        <strong>Admin</strong>
      </a>
      <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
        <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
      </ul>
    </div>
  </div>
  <div class="content-left"></div>
  <div class="b-example-divider">
  </div>
  <div class="p-2 pt-5 pt-md-5 p-md-2 p-lg-5 border scrollarea" style="margin-top: 45px;width:100%;">
  <?php
  if(isset($breadcrumb)){
  ?>
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb p-2 mb-5 bg-body rounded" style="box-shadow: 0 .5em 1.5em rgba(0, 0, 0, .1), 0 .125em .5em rgba(0, 0, 0, .15);">
    <?php
    foreach($breadcrumb as $index => $list){
    ?>
        <li class="breadcrumb-item"><?php if($index==0) {?><i class="fa-solid fa-gauge me-2"></i><?php } ?><?php echo $list;?></li>
    <?php }?>
    <?php } ?>
    </ol>
    </nav>
