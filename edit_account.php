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
$bannerTag="Edit Account";
$title='Edit Account';
$activeNavs=5;
include("database/Connection.php");
include("database/Function.php");
if (!isset($_SESSION['id_user'])) {
    echo '<script type="text/javascript"> window.location="login.php";</script>';die;
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
            <?php 
            $exist_email = FALSE;
            $exist_no_hp = FALSE;
                if(isset($_POST['submit'])){
                    $email_count = $conn->query("SELECT email FROM pembeli where email='".$_POST['email']."' AND id <>".$_SESSION['id_user'])->num_rows;
                    $no_hp_count = $conn->query("SELECT nomor_hp FROM pembeli where nomor_hp='".$_POST['nomor_hp']."' AND id <>".$_SESSION['id_user'])->num_rows;
                    
                    if($email_count !== 0){
                        $exist_email=TRUE;
                    }

                    if($no_hp_count !== 0){
                        $exist_no_hp=TRUE;
                    }
                    if($no_hp_count == 0 && $email_count ==0){
                        $conn->query("UPDATE pembeli SET nama='".$_POST['nama']."', email='".$_POST['email']."',alamat='".$_POST['alamat']."', nomor_hp='".$_POST['nomor_hp']."' WHERE id=".$_SESSION['id_user']);   
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Berhasil!</strong> Data telah diubah.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }
                }
                $account = SelectId('pembeli',$_SESSION['id_user']);   
            ?>
            <div class="card my-md-2">
                <div class="card-body">    
                    <h2 class="card-title">Edit Your Account</h2>
                    <form action="edit_account.php" method="post">
                    <div class="form-group"><!-- form-group Starts -->
                    <label> Customer Name: </label>
                    <input type="text" name="nama" class="form-control" required value="<?php echo (isset($_POST['nama']))? $_POST['nama'] : $account['nama']?>" pattern="[a-zA-Z ]+">
                    </div><!-- form-group Ends -->
                    <div class="form-group"><!-- form-group Starts -->
                    <label> Customer Email: </label>
                    <input type="text" name="email" class="form-control <?php echo ($exist_email)? 'is-invalid' :'' ?>" pattern="[a-zA-Z0-9._%+-]{1,}@[a-zA-Z0-9.-]{1,}" required value="<?php echo (isset($_POST['email']))? $_POST['email'] : $account['email']?>">
                    <?php
                    if($exist_email){
                    ?>
                        <span class="invalid-feedback d-block" role="alert">
                        email telah digunakan!      
                        </span>
                    <?php } ?>
                    </div><!-- form-group Ends -->
                    <div class="form-group"><!-- form-group Starts -->
                    <label> Customer Address: </label>
                    <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="2"><?php echo (isset($_POST['alamat']))? $_POST['alamat'] : $account['alamat']?></textarea>
                    </div><!-- form-group Ends -->
                    <div class="form-group"><!-- form-group Starts -->
                    <label> Customer Contact: </label>
                    <input type="tel" name="nomor_hp" class="form-control <?php echo ($exist_no_hp)? 'is-invalid' :'' ?>" pattern="(08[0-9]{9,10}|[+][0-9]{13})" required value="<?php echo  (isset($_POST['nomor_hp']))? $_POST['nomor_hp'] :$account['nomor_hp']?>">
                    <?php
                    if($exist_no_hp){
                    ?>
                        <span class="invalid-feedback d-block" role="alert">
                        nomor telah digunakan!      
                        </span>
                    <?php } ?>
                    </div><!-- form-group Ends -->
                    <div class="form-group mt-2">
                        <input type="submit" class="btn btn-primary d-block mx-auto" name="submit" value="Update Now">
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ContentEnd -->
<?php
include("include/Bottom.php");
?>