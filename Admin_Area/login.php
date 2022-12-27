<?php
if(!isset($_SESSION))
session_start();
include("database/Connection.php");
if(isset($_POST['submit'])){
    $stmt = $conn->prepare('SELECT id FROM admins WHERE email = ? and password=?');
    $stmt->bind_param('ss', $_POST['email'],$_POST['password']);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin =$result->fetch_assoc();
    if($result->num_rows>0){
        $_SESSION['id_admin'] = $admin['id'];
    }else{
      $error="email and password do not match.";
    }
}
if (isset($_SESSION['id_admin'])) {
    echo '<script type="text/javascript"> window.location="index.php";</script>';
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Area</title>
    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-image: url('../image/background.png');">
<nav class="nav nav-fill bg-dark p-4">
<div class="d-block mx-auto text-white" style="width:300px">
    <marquee><h5 class="text-white">Admin Area Panel</h5></marquee>
</div>
</nav>
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <h3 class="mb-5">Sign in</h3>
            <form action="login.php" method="post">
            <div class="form-outline mb-4">
                <label class="form-label" for="email">Email</label>
              <input type="email" id="email" name="email" value="<?php echo(isset($_POST['email']))?$_POST['email']:''?>" class="form-control form-control-lg" />
            </div>
              <?php
                if(isset($error)){
                ?>
                <span class="invalid-feedback d-block" role="alert">
                <?php echo $error;?>
                </span>
            <?php }?>

            <div class="form-outline mb-4">
                <label class="form-label" for="password">Password</label>
              <input type="password" id="password" name="password" class="form-control form-control-lg" />
            </div>

            <button class="btn btn-primary btn-lg btn-block" name="submit" type="submit">Login</button>
            <hr class="my-4">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>