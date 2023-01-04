<?php
include("database/Connection.php");
$about = $conn->query("SELECT * FROM about_us")->fetch_assoc();
$contact = $conn->query("SELECT * FROM contact")->fetch_assoc();
$conn->close();
?>
<!-- Footer -->
<footer class="text-center text-lg-start bg-light text-muted">
  <!-- Section: Social media -->
  <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
    <!-- Left -->
    <div class="me-5 d-none d-lg-block">
      <span>Get connected with us on social networks:</span>
    </div>
    <!-- Left -->

    <!-- Right -->
    <div>
      <?php
      echo (!is_null($contact['facebook']) && $contact['facebook'] !="")? '<a href="'.$contact['facebook'].'" target="_blank" class="me-4 text-reset"><i class="fab fa-facebook-f fa-lg"></i></a>':'';
      echo (!is_null($contact['twitter']) && $contact['twitter'] !="")? '<a href="'.$contact['twitter'].'" target="_blank" class="me-4 text-reset"><i class="fab fa-twitter fa-lg"></i></a>':'';
      echo (!is_null($contact['instagram']) && $contact['instagram'] !="")? '<a href="'.$contact['instagram'].'" target="_blank" class="me-4 text-reset"><i class="fab fa-instagram fa-lg"></i></a>':'';
      ?>
      
    </div>
    <!-- Right -->
  </section>
  <!-- Section: Social media -->

  <!-- Section: Links  -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4">
            <i class="fas fa-gem me-3"></i><?php echo is_null($about)?'':$about['Heading']; ?>
          </h6>
          <p style="text-align: justify;">
          <?php echo is_null($about)?'':$about['Short_Desc']; ?>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Products
          </h6>
          <?php 
          include("database/Connection.php");
          $katagori = SelectAll('categories');
          foreach($katagori as $list){
          ?>
          <p>
            <a href="shop.php?s=<?php echo $list['kategori']?>" class="text-reset"><?php echo $list['kategori']?></a>
          </p>
          <?php } ?>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Useful links
          </h6>
          <p>
            <a href="my_order.php" class="text-reset">My Order</a>
          </p7
          <p>
            <a href="cart.php" class="text-reset">Cart</a>
          </p>
          <p>
            <a href="my_wishlist.php" class="text-reset">Wishlist</a>
          </p>
          <p>
            <a href="shop.php" class="text-reset">Shop</a>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">Contact Us</h6>
          <?php echo (!is_null($contact['alamat']) && $contact['alamat'] !="")? '<p><i class="fas fa-home me-3"></i>'.$contact['alamat'].'</p>':""?>
          <?php echo (!is_null($contact['email']) && $contact['email'] !="")? '<p><i class="fas fa-envelope me-3"></i>'.$contact['email'].'</p>':""?>
          <?php echo (!is_null($contact['telepon']) && $contact['telepon'] !="")? '<p><i class="fas fa-phone me-3"></i>'.$contact['telepon'].'</p>':""?>
          <?php echo (!is_null($contact['whatsapp']) && $contact['whatsapp'] !="")? '<p><i class="fa-brands fa-whatsapp me-3"></i>'.$contact['whatsapp'].'</p>':""?>
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

  <!-- Copyright -->
  <div class="text-center p-4 bg-dark">
    © 2022 Design by:
    <a class="text-reset fw-bold" href="#"> KELOMPOK X</a>
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->
</footer>

</body>
</html>