<?php
function headerTag(){
?>

<script src="https://cdn.ckeditor.com/ckeditor5/35.3.1/classic/ckeditor.js"></script>
<style>
 .ck-editor__editable
 {
    min-height: 400px !important;
 }
</style>
<?php
}
$head = headerTag();
$title='Insert Product Categories';
$breadcrumb=array('Dashboard','Insert Poduct');
include("include/Top.php");
include("database/Connection.php");
include("database/Function.php");

// Check If form submitted, insert form data into users table.
if(isset($_POST['submit'])) {
    $table_name = "product";
    $column="kategori,nama,harga,keterangan,jumlah,berat,label";
    $values= "'".$_POST['kategori']."','".$_POST['nama_produk']."','".$_POST['harga']."','".$_POST['keterangan']."','".$_POST['jumlah']."','".$_POST['berat']."','".$_POST["produk_label"]."'";
    $lastid = Insert($table_name,$column,$values);
    if(!is_null($lastid)){
        $insert_file_name = array();
        for ($i=1; $i <=3 ; $i++) { 
            $file_name = $_FILES['foto_'.$i]['name'];
            $file_tmp = $_FILES['foto_'.$i]['tmp_name'];
            $x = explode('.', $file_name);
            $ekstensi = end($x);
            $new_file_name="img_".$lastid."_".$i.".".$ekstensi;
            move_uploaded_file($file_tmp, '../image/product_image/'.$new_file_name);
            $insert_file_name[$i-1]=$new_file_name;
        }
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql = "UPDATE $table_name SET
        foto_1='".$insert_file_name[0]."',foto_2='".$insert_file_name[1]."',foto_3='".$insert_file_name[2]."' WHERE id=$lastid";
        $conn->query($sql);
        $conn->close();
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Berhasil!</strong> Data telah disimpan.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
}
?>
<!-- Content -->
<div class="card" style="border-color:#DDDDDD;">
    <div class="card-body" style="background-color:#F5F5F5;">
        <h5 class="card-title"><i class="fa-solid fa-money-bill-1 me-2"></i>Insert Products</h5>
    </div>
    <div class="card-body">
        <div class="container px-1 px-md-2 px-lg-5">
            <form method="post" action="insert_product.php"  enctype="multipart/form-data">
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="nama_produk"><b>Nama Product</b></label>
                    </div>                
                    <div class="col-lg-10">
                        <input id="nama_produk" class="form-control" type="text" name="nama_produk" required>
                    </div>
                </div>

                <div class="form-group row mt-2">
                    <div class="col-lg-2">
                        <label for="kategori"><b>Kategori</b></label>
                    </div>                
                    <div class="col-lg-10">
                        <select name="kategori" id="kategori" class="form-select" required>
                            <option value="" disabled selected>Select your option</option>
                            <?php 
                            include("database/Connection.php");
                            $katagori = SelectAll('categories');
                            foreach($katagori as $list){
                            ?>
                            <option value="<?php echo $list['id']?>"><?php echo $list['kategori']?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row mt-2">
                    <div class="col-lg-2">
                        <label for="foto_1"><b>Gambar Produk 1</b></label>
                    </div>                
                    <div class="col-lg-10">
                        <input type="file" name="foto_1" id="foto_1" class="form-control" accept="image/*" required>
                    </div>
                </div>

                <div class="form-group row mt-2">
                    <div class="col-lg-2">
                        <label for="foto_2"><b>Gambar Produk 2</b></label>
                    </div>                
                    <div class="col-lg-10">
                        <input type="file" name="foto_2" id="foto_2" class="form-control" accept="image/*" required>
                    </div>
                </div>

                <div class="form-group row mt-2">
                    <div class="col-lg-2">
                        <label for="foto_3"><b>Gambar Produk 3</b></label>
                    </div>                
                    <div class="col-lg-10">
                        <input type="file" name="foto_3" id="foto_3" class="form-control" accept="image/*" required>
                    </div>
                </div>

                <div class="form-group row mt-2">
                    <div class="col-lg-2">
                        <label for="harga"><b>Harga Produk</b></label>
                    </div>                
                    <div class="col-lg-10">
                        <input id="harga" class="form-control" type="number" name="harga" required>
                    </div>
                </div>

                <div class="form-group row mt-2">
                    <div class="col-lg-2">
                        <label for="berat"><b>Berat Produk</b></label>
                    </div>                
                    <div class="col-lg-10">
                        <input id="berat" class="form-control" step=".01" type="number" name="berat" required>
                    </div>
                </div>

                <div class="form-group row mt-2">
                    <div class="col-lg-2">
                        <label for="keterangan"><b>Keterangan</b></label>
                    </div>                
                    <div class="col-lg-10">
                     <textarea name="keterangan" class="form-control" id="keterangan"></textarea>
                    </div>
                    <script>
                        ClassicEditor.defaultConfig = {
                                toolbar: {
                                    items: [
                                        'heading',
                                        '|',
                                        'bold',
                                        'italic',
                                        'link',
                                        'bulletedList',
                                        'numberedList',
                                        '|',
                                        'outdent',
                                        'indent',
                                        '|',
                                        'blockQuote',
                                        'insertTable',
                                        'mediaEmbed',
                                        'undo',
                                        'redo'
                                    ]
                                },
                                language: 'en',
                                mediaEmbed: {
                                    previewsInData:true
                                },
                                table: {
                                    contentToolbar: [
                                        'tableColumn',
                                        'tableRow',
                                        'mergeTableCells'
                                    ]
                                }
                                
                            };

                        ClassicEditor
                            .create( document.querySelector( '#keterangan' ))
                            .then( editor => {
                                console.log( Array.from( editor.ui.componentFactory.names() ) );
                            } )
                            .catch( error => {
                                console.error( error );
                            } );   
                    </script>
                </div>
     
                <div class="form-group row mt-2">
                    <div class="col-lg-2">
                        <label for="jumlah"><b>Jumlah (Stock)</b></label>
                    </div>                
                    <div class="col-lg-10">
                        <input id="jumlah" class="form-control" type="number" name="jumlah" required>
                    </div>
                </div>

                <div class="form-group row mt-2">
                    <div class="col-lg-2">
                        <label for="produk_label"><b>Label Produk</b></label>
                    </div>                
                    <div class="col-lg-10">
                        <input id="produk_label" class="form-control" type="text" name="produk_label" required>
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

    