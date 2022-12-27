<?php
function headerTag(){
?>


<?php
}
$head = headerTag();
$title='Insert Products Catagories';
$breadcrumb=array('Dashboard','Insert Poducts Catagories');
include("include/Top.php");
include("database/Connection.php");
include("database/Function.php");

// Check If form submitted, insert form data into users table.
$about = $conn->query("SELECT * FROM about_us")->fetch_assoc();

if(isset($_POST['submit'])) {
    $table_name = "about_us";
    if(is_null($about)){
    $column="Heading,Short_Desc,Long_Desc";
    $values= "'".$_POST['heading']."','".$_POST['short_desc']."','".$_POST['long_desc']."'";
    Insert($table_name,$column,$values);
    }else{
        $update="heading='". $_POST['heading'] ."',short_desc='". $_POST['short_desc'] ."',long_desc='". $_POST['long_desc'] ."'";
        Update($table_name,$update,$about['id']);
    }
    include("database/Connection.php");
    $about = $conn->query("SELECT * FROM about_us")->fetch_assoc();
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
        <h5 class="card-title"><i class="fa-solid fa-money-bill-1 me-2"></i>About Us</h5>
    </div>
    <div class="card-body">
        <div class="container px-5">
            <form method="post" action="about_us.php"  enctype="multipart/form-data">
                <div class="form-group row">
                    <div class="col-xl-2">
                        <label for="header"><b>About Us Heading :</b></label>
                    </div>                
                    <div class="col-xl-10">
                        <textarea name="heading" id="heading" class="form-control" rows="1"><?php echo is_null($about)?'':$about['Heading'] ?></textarea>
                    </div>
                </div>

                <div class="form-group row mt-2">
                    <div class="col-xl-2">
                        <label for="short_desc"><b>About Us Short Description :</b></label>
                    </div>                
                    <div class="col-xl-10">
                        <textarea name="short_desc" id="short_desc" class="form-control" style="min-height: 100px !important;"><?php echo is_null($about)?'':$about['Short_Desc'] ?></textarea>
                    </div>
                </div>

                <div class="form-group row mt-2">
                    <div class="col-xl-2">
                        <label for="long_desc"><b>About Us Description :</b></label>
                    </div>                
                    <div class="col-xl-10">
                        <textarea name="long_desc" id="long_desc" class="form-control" style="min-height: 100px !important;"><?php echo is_null($about)?'':$about['Long_Desc'] ?></textarea>
                    </div>
                </div>

                <div class="form-group row mt-2">
                    <div class="col-xl-2">
                    </div>                
                    <div class="col-xl-10">
                    <input type="submit" class="btn btn-primary form-control" name="submit" value="Update About Us Page">
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

    