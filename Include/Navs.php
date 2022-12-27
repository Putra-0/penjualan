<div class="card d-none d-md-block my-md-2">
  <div class="card-body text-center d-none d-lg-block">
  <img class="card-img-top" src="image/people.jpg" style="object-fit: cover;height: 150px;width:150px;" alt="Card image cap">
  <p class="card-text">Nama : <?php echo explode(" ",$_SESSION['nama'])[0]?></p>
  </div>
  <div class="card-body">
    <nav class="nav nav-pills flex-lg-column">
      <a class="nav-link <?php if($activeNavs==1) echo "active"; ?>" href="my_order.php">My Orders</a>
      <a class="nav-link <?php if($activeNavs==2) echo "active"; ?>" href="my_wishlist.php">My WishList</a>
      <a class="nav-link <?php if($activeNavs==3) echo "active"; ?>" href="complete_order.php">Complete Order</a>
      <a class="nav-link <?php if($activeNavs==4) echo "active"; ?>" href="pay_offline.php">Pay Offline</a>
      <a class="nav-link <?php if($activeNavs==5) echo "active"; ?>" href="edit_account.php">Edit Account</a>
      <a class="nav-link <?php if($activeNavs==6) echo "active"; ?>" href="change_password.php">Change Password</a>
      <a class="nav-link <?php if($activeNavs==7) echo "active"; ?>" href="delete_account.php">Delete Account</a>
      <a class="nav-link" href="logout.php">Logout</a>
    </nav>
  </div>
</div>