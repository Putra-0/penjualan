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
$bannerTag="Change Password";
$title='Change Password';
$activeNavs=6;
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
                if(isset($_POST['submit'])){
                        $stmt = $conn->prepare('SELECT pembeli.id, pembeli.nama FROM pembeli WHERE password=? AND id=?');
                        $stmt->bind_param('si', $_POST['old_password'],$_SESSION['id_user']);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if($result->num_rows == 0){
                            $incorect="password incorect";
                        }
                        
                        if($_POST['new_password'] != $_POST['confirm_password']){
                            $confirm = "Confirm Password do not match.";
                        }

                        if($result->num_rows >0 && $_POST['new_password'] == $_POST['confirm_password']){
                            $conn->query("UPDATE pembeli SET password = '".$_POST['new_password']."' WHERE id=".$_SESSION['id_user']);
                            $conn->close();
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Berhasil!</strong> Password telah diubah.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                        }
                }  
            ?>
            <div class="card my-md-2">
                <div class="card-body">
                    <h2 class="card-title">Edit Your Password</h2>
                    <form action="change_password.php" method="post">
                    <div class="form-group"><!-- form-group Starts -->
                    <label> Enter Your Current Password </label>
                    <input type="password" name="old_password" class="form-control" required value="<?php echo (isset($incorect) || isset($confirm))?$_POST['old_password']:''?>">
                    <?php
                    if(isset($incorect)){
                    ?>
                        <span class="invalid-feedback d-block" role="alert">
                        <?php echo $incorect?>
                        </span>
                    <?php } ?>
                    </div><!-- form-group Ends -->
                    <div class="form-group"><!-- form-group Starts -->
                    <label> Customer New Password: </label>
                    <input type="password" name="new_password" class="form-control" required value="<?php echo (isset($confirm) || isset($confirm))?$_POST['new_password']:''?>">
                    <?php
                    if(isset($confirm)){
                    ?>
                        <span class="invalid-feedback d-block" role="alert">
                        <?php echo $confirm?>
                        </span>
                    <?php } ?>
                    </div><!-- form-group Ends -->
                    <div class="form-group"><!-- form-group Starts -->
                    <label>Confirm Password, Enter Your New Password Again: </label>
                    <input type="password" name="confirm_password" class="form-control" required value="<?php echo (isset($confirm))?$_POST['confirm_password']:''?>">
                    </div><!-- form-group Ends -->
                    <div class="form-group mt-2">
                        <input type="submit" class="btn btn-primary d-block mx-auto" name="submit" value="Change Password">
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