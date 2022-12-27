<?php
function headerTag(){
?>

<link rel="stylesheet" href="Css/style.css">
<?php
}
$head = headerTag();
$banner=true;
$bannerTag="Sign In";
$title='Sign In';
include("include/Top.php");
include("database/Connection.php");
include("database/Function.php");
 
if(isset($_POST['email']) && isset($_POST['password'])){
    $stmt = $conn->prepare('SELECT pembeli.id, pembeli.nama FROM pembeli WHERE email = ? and password=?');
    $stmt->bind_param('ss', $_POST['email'],$_POST['password']);
    $stmt->execute();
    $result = $stmt->get_result();
    $user =$result->fetch_assoc();
    if($result->num_rows>0){
        $_SESSION['id_user'] = $user['id'];
        $_SESSION['nama'] = $user['nama'];

    }else{
      $error="email and password do not match.";
    }
}

if (isset($_SESSION['id_user'])) {
  echo '<script type="text/javascript"> window.location="index.php";</script>';
}

?>

<!-- Content -->
<div class="container p-3 bg-light">
<div class="card rounded mx-auto" style="max-width:40rem;">
    <div class="card-body rounded-top text-center text-white" style="background:#6658D3">
        <h3 class="card-title">Login</h3>
        <p class="card-text">Already our Customer</p>
    </div>
    <div class="card-body my-md-2">
    <form method="post" action="login.php">
    <h1 class="h4 mb-3 fw-normal">Please sign in</h1>

    <div class="form-floating my-2">
      <input type="email" name="email" class="form-control" id="floatingInput" value="<?php echo (isset($_POST['email']))? $_POST['email'] : '' ?>" placeholder="name@example.com" required>
      <label for="floatingInput">Email address</label>
      <?php
        if(isset($error)){
        ?>
        <span class="invalid-feedback d-block" role="alert">
        <?php echo $error;?>
        </span>
      <?php }?>
    </div>
    <div class="form-floating my-2">
      <input type="password" name="password" class="form-control" id="floatingPassword" value="<?php echo (isset($_POST['password']))? $_POST['password'] : '' ?>" placeholder="Password" required>
      <label for="floatingPassword">Password</label>
    </div>
    <button class="w-100 btn btn-lg btn-primary mb-3" type="submit">Sign in</button>
    <div class="text-center">
        <a class="link-primary d-block mx-auto" href="register.php"><h1 class="h3">New ? Register Here</h1></a>
    </div>
  </form>
    </div>
</div>
<!-- ContentEnd -->
<?php
include("include/Bottom.php");
?>