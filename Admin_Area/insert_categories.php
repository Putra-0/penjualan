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
if(isset($_POST['submit'])) {
    $table_name = "categories";
    $column="kategori";
    $values= "'".$_POST['kategori']."'";
    Insert($table_name,$column,$values);
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Berhasil!</strong> Data telah disimpan.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}
?>
<!-- Content -->
<div class="card" style="border-color:#DDDDDD;">
    <div class="card-body" style="background-color:#F5F5F5;">
        <h5 class="card-title"><i class="fa-solid fa-money-bill-1 me-2"></i>Insert Products</h5>
    </div>
    <div class="card-body">
        <div class="container px-1 px-md-2 px-lg-5">
            <form method="post" action="insert_categories.php">
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="kategori"><b>Product Categories</b></label>
                    </div>                
                    <div class="col-lg-10">
                        <input id="kategori" class="form-control" type="text" name="kategori" required>
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

    