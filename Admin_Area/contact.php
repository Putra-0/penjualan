<?php
function headerTag(){
?>


<?php
}
$head = headerTag();
$title='Contact';
$breadcrumb=array('Dashboard','Contact');
include("include/Top.php");
include("database/Connection.php");
include("database/Function.php");

$contact = $conn->query("SELECT * FROM contact")->fetch_assoc();

if(isset($_POST['submit'])) {
    $table_name = "contact";
    if(is_null($contact)){
    $column="facebook,twitter,instagram,alamat,email,telepon,whatsapp";
    $values= "'".$_POST['facebook']."','".$_POST['twitter']."','".$_POST['instagram']."','".$_POST['alamat']."','".$_POST['email']."','".$_POST['telepon']."','".$_POST['whatsapp']."'";
    Insert($table_name,$column,$values);
    }else{
        $update="facebook='". $_POST['facebook'] ."',twitter='". $_POST['twitter'] ."',instagram='". $_POST['instagram'] ."',alamat='".$_POST['alamat']."',email='".$_POST['email']."',telepon='".$_POST['telepon']."',whatsapp='".$_POST['whatsapp']."'";
        Update($table_name,$update,$contact['id']);
    }
    include("database/Connection.php");
    $contact = $conn->query("SELECT * FROM contact")->fetch_assoc();
    $conn->close();
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Berhasil!</strong> Data telah diubah.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}
?>
<!-- Content -->
<div class="card" style="border-color:#DDDDDD;">
    <div class="card-body" style="background-color:#F5F5F5;">
        <h5 class="card-title"><i class="fa-solid fa-money-bill-1 me-2"></i>Contact</h5>
    </div>
    <div class="card-body">
        <div class="container px-1 px-md-2 px-lg-5">
            <form method="post" action="contact.php">
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="facebook"><b>Facebook Link</b></label>
                    </div>                
                    <div class="col-lg-10">
                        <input id="facebook" class="form-control" type="text" name="facebook" value="<?php echo $contact['facebook'];?>">
                    </div>
                </div>

                <div class="form-group row mt-2">
                    <div class="col-lg-2">
                        <label for="twitter"><b>Twitter Link</b></label>
                    </div>                
                    <div class="col-lg-10">
                        <input id="twitter" class="form-control" type="text" name="twitter" value="<?php echo $contact['twitter'];?>">
                    </div>
                </div>

                <div class="form-group row mt-2">
                    <div class="col-lg-2">
                        <label for="instagram"><b>Instagram Link</b></label>
                    </div>                
                    <div class="col-lg-10">
                        <input id="instagram" class="form-control" type="text" name="instagram" value="<?php echo $contact['instagram'];?>">
                    </div>
                </div>

                <div class="form-group row mt-2">
                    <div class="col-lg-2">
                        <label for="alamat"><b>Alamat</b></label>
                    </div>                
                    <div class="col-lg-10">
                        <textarea name="alamat" class="form-control" id="alamat" name="alamat" cols="30" rows="2" required><?php echo $contact['alamat'];?></textarea>
                    </div>
                </div>

                <div class="form-group row mt-2">
                    <div class="col-lg-2">
                        <label for="email"><b>Email</b></label>
                    </div>                
                    <div class="col-lg-10">
                        <input id="email" class="form-control" type="text" name="email" value="<?php echo $contact['email'];?>">
                    </div>
                </div>

                <div class="form-group row mt-2">
                    <div class="col-lg-2">
                        <label for="telepon"><b>Telepon</b></label>
                    </div>                
                    <div class="col-lg-10">
                        <input id="telepon" class="form-control" type="text" name="telepon" pattern="(([0-9]|[-]|[(]|[)]){1,20})" value="<?php echo $contact['telepon'];?>">
                    </div>
                </div>

                <div class="form-group row mt-2">
                    <div class="col-lg-2">
                        <label for="whatsapp"><b>WhatApp</b></label>
                    </div>                
                    <div class="col-lg-10">
                        <input id="whatsapp" class="form-control" type="text" name="whatsapp" pattern="(08[0-9]{9,10}|[+][0-9]{13})" value="<?php echo $contact['whatsapp'];?>">
                    </div>
                </div>

                <div class="form-group row mt-2">
                    <div class="col-lg-2">
                    </div>                
                    <div class="col-lg-10">
                    <input type="submit" class="btn btn-primary form-control" name="submit" value="Submit">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ContentEnd -->
<?php
include("include/Bottom.php");
?>

    