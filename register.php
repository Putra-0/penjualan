<?php
function headerTag(){
?>
<style>
    
/* tick and cross icons styles */


.tick1{
font-size:18px !important;
color:red;
height: 100%;
}

.cross1{
font-size:18px !important;
color:red;
height: 100%;
}

.tick2{
font-size:18px !important;
color:red;
height: 100%;
}

.cross2{
font-size:18px !important;
color:red;
height: 100%;
}

/* Password Strength Checker Styles */

#meter_wrapper{
border:1px solid grey;
width:202px;
height:100%;
margin:0;
border-radius:3px;

}


#meter{
width:0px;
height:100%;
border-radius:2px;
}


#pass_type{
font-size:15px;
margin-top:10px;
position:absolute;
top:0;
right:90px;
margin-bottom:10%;
color:grey;

}


</style>
<link rel="stylesheet" href="Css/style.css">
<?php
}
$head = headerTag();
$banner=true;
$bannerTag="Register";
$title='Register';
include("include/Top.php");
include("database/Connection.php");
include("database/Function.php");
 
if (isset($_SESSION['nama'])) {
    echo '<script type="text/javascript"> window.location="index.php";</script>';
}

$exist_email = FALSE;
$exist_no_hp = FALSE;
$error_confirm = FALSE;
if(isset($_POST['submit'])){
    $table_name = "pembeli";
    $email_count = $conn->query("SELECT email FROM pembeli where email='".$_POST['email']."'")->num_rows;
    $no_hp_count = $conn->query("SELECT nomor_hp FROM pembeli where nomor_hp='".$_POST['no_hp']."'")->num_rows;
    
    if($email_count > 0){
        $exist_email=TRUE;
    }

    if($no_hp_count > 0){
        $exist_no_hp=TRUE;
    }

    if($_POST['password'] != $_POST['con_pass']){
        $error_confirm = TRUE;
    }

    if(!$exist_email && !$exist_no_hp && !$error_confirm){
        $column="nama,email,password,alamat,nomor_hp";
        $values= "'".$_POST['nama']."','".$_POST['email']."','".$_POST['password']."','".$_POST['alamat']."','".$_POST['no_hp']."'";
        $id_user = Insert($table_name,$column,$values);
        $_SESSION['id_user'] = $id_user;
        $_SESSION['nama'] = $_POST['nama'];
        $url="index.php";
        echo '<script type="text/javascript"> window.location="index.php";</script>';       
    }
}
?>

<!-- Content -->
<div class="container p-3 bg-light">
<div class="card mx-auto rounded" style="width: 40rem;">
    <div class="card-body rounded-top text-center text-white" style="background:#6658D3">
        <h5 class="card-title">Register</h5>
    </div>
    <div class="card-body">
        <form action="register.php" method="post" enctype="multipart/form-data" ><!-- form Starts -->

        <div class="form-group" ><!-- form-group Starts -->

        <label>Nama</label>

        <input type="text" class="form-control" name="nama" value="<?php echo (isset($_POST['nama']))? $_POST['nama']:""; ?>" pattern="[a-zA-Z ]+" required>

        </div><!-- form-group Ends -->

        <div class="form-group"><!-- form-group Starts -->

        <label> Email</label>

        <input type="email" class="form-control <?php echo ($exist_email)? 'is-invalid' :'' ?>" name="email" value="<?php echo (isset($_POST['email']))? $_POST['email']:""; ?>" pattern="[a-zA-Z0-9._%+-]{1,}@[a-zA-Z0-9.-]{1,}" required>
        <?php
        if($exist_email){
        ?>
        <span class="invalid-feedback d-block" role="alert">
        email telah digunakan!      
        </span>
        <?php } ?>
        </div><!-- form-group Ends -->

        <div class="form-group"><!-- form-group Starts -->

        <label> Password </label>

        <div class="input-group"><!-- input-group Starts -->

        <span class="input-group-addon"><!-- input-group-addon Starts -->

        <i class="fa fa-check tick1 input-group-text"> </i>

        <i class="fa fa-times cross1 input-group-text"> </i>

        </span><!-- input-group-addon Ends -->

        <input type="password" class="form-control <?php echo ($error_confirm)? 'is-invalid' :'' ?>" id="pass" name="password" value="<?php echo (isset($_POST['password']))? $_POST['password']:""; ?>" required>
        <span class="input-group-addon"><!-- input-group-addon Starts -->
        
        <div id="meter_wrapper"><!-- meter_wrapper Starts -->

        <span id="pass_type"> </span>

        <div id="meter"> </div>

        </div><!-- meter_wrapper Ends -->

        </span><!-- input-group-addon Ends -->

        </div><!-- input-group Ends -->
        <?php
        if($error_confirm){
        ?>
        <span class="invalid-feedback d-block" role="alert">
        Confirm Password do not match.
        </span>
        <?php } ?>
        </div><!-- form-group Ends -->


        <div class="form-group"><!-- form-group Starts -->

        <label> Confirm Password </label>

        <div class="input-group"><!-- input-group Starts -->

        <span class="input-group-addon"><!-- input-group-addon Starts -->

        <i class="fa fa-check tick2 input-group-text"> </i>

        <i class="fa fa-times cross2 input-group-text"> </i>

        </span><!-- input-group-addon Ends -->

        <input type="password" class="form-control confirm <?php echo ($error_confirm)? 'is-invalid' :'' ?>" id="con_pass" name="con_pass" value="<?php echo (isset($_POST['con_pass']))? $_POST['con_pass']:""; ?>" required>

        </div><!-- input-group Ends -->

        </div><!-- form-group Ends -->


        <div class="form-group"><!-- form-group Starts -->

        <label> Alamat </label>

        <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="2" required><?php echo (isset($_POST['alamat']))? $_POST['alamat']:""; ?></textarea>
        
        </div><!-- form-group Ends -->
        

        <div class="form-group"><!-- form-group Starts -->

        <label> Nomer HP </label>

        <input type="tel" class="form-control <?php echo ($exist_no_hp)? 'is-invalid' :'' ?>" name="no_hp" value="<?php echo (isset($_POST['no_hp']))? $_POST['no_hp']:""; ?>" pattern="(08[0-9]{9,10}|[+][0-9]{13})" required>
        <?php
        if($exist_no_hp){
        ?>
        <span class="invalid-feedback d-block" role="alert">
        nomor telah digunakan!      
        </span>
        <?php } ?>
        </div><!-- form-group Ends -->

        <div class="form-group"><!-- form-group Starts -->
        <?php
           $captcha_num1 = rand(1,10);
           $captcha_num2 = rand(1,10);

           $captcha_hasil= $captcha_num1 + $captcha_num2;
        ?>

        <label> Berapakah hasil dari <?php echo $captcha_num1.' + '. $captcha_num2;?> ?</label>

        <input type="text" class="form-control" pattern="<?php echo $captcha_hasil;?>" required>

        </div><!-- form-group Ends -->

        <div class="text-center mt-2"><!-- text-center Starts -->

        <button type="submit" name="submit" class="btn btn-primary">

        <i class="fa fa-user-md"></i> Register

        </button>

        </div><!-- text-center Ends -->

        </form><!-- form Ends -->
    </div>
</div>
</div>
<!-- ContentEnd -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>

$(document).ready(function(){

$('.tick1').hide();
$('.cross1').hide();

$('.tick2').hide();
$('.cross2').hide();


$('.confirm').focusout(function(){
    confirm_pass();
});


});

</script>

<script>

$(document).ready(function(){

$("#pass").keyup(function(){

check_pass();

});
if($('#pass').val().length>0){
check_pass();
confirm_pass();
}

});

function confirm_pass(){


var password = $('#pass').val();

var confirmPassword = $('#con_pass').val();
if(password == confirmPassword && password.length >0 && confirmPassword.length >0){

$('.tick1').show();
$('.cross1').hide();

$('.tick2').show();
$('.cross2').hide();



}
else{

$('.tick1').hide();
$('.cross1').show();

$('.tick2').hide();
$('.cross2').show();


}

}
function check_pass() {
 var val=document.getElementById("pass").value;
 var meter=document.getElementById("meter");
 var no=0;
 if(val!="")
 {
// If the password length is less than or equal to 6
if(val.length<=6)no=1;

 // If the password length is greater than 6 and contain any lowercase alphabet or any number or any special character
  if(val.length>6 && (val.match(/[a-z]/) || val.match(/\d+/) || val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)))no=2;

  // If the password length is greater than 6 and contain alphabet,number,special character respectively
  if(val.length>6 && ((val.match(/[a-z]/) && val.match(/\d+/)) || (val.match(/\d+/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) || (val.match(/[a-z]/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))))no=3;

  // If the password length is greater than 6 and must contain alphabets,numbers and special characters
  if(val.length>6 && val.match(/[a-z]/) && val.match(/\d+/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))no=4;

  if(no==1)
  {
   $("#meter").animate({width:'50px'},300);
   meter.style.backgroundColor="red";
   document.getElementById("pass_type").innerHTML="Very Weak";
  }

  if(no==2)
  {
   $("#meter").animate({width:'100px'},300);
   meter.style.backgroundColor="#F5BCA9";
   document.getElementById("pass_type").innerHTML="Weak";
  }

  if(no==3)
  {
   $("#meter").animate({width:'150px'},300);
   meter.style.backgroundColor="#FF8000";
   document.getElementById("pass_type").innerHTML="Good";
  }

  if(no==4)
  {
   $("#meter").animate({width:'200px'},300);
   meter.style.backgroundColor="#00FF40";
   document.getElementById("pass_type").innerHTML="Strong";
  }
 }

 else
 {
  meter.style.backgroundColor="";
  document.getElementById("pass_type").innerHTML="";
 }
}
</script>

<?php
include("include/Bottom.php");
?>