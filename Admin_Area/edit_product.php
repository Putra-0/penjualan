<?php
if(!isset($_GET['id'])){
    header("location: view_product.php", true, 301);
    exit();
}
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
$title='Edit Product';
$breadcrumb=array('Dashboard','Edit Poduct');
include("include/Top.php");
include("database/Connection.php");
include("database/Function.php");
$id=$_GET['id'];
$product= SelectId('product',$id);

if(isset($_POST['submit'])) {
    $table_name = "product";
    if(!is_null($id)){
        $update_file_name = array();
        for ($i=1; $i <=3 ; $i++) {
            if (file_exists($_FILES['foto_'.$i]['tmp_name']) || is_uploaded_file($_FILES['foto_'.$i]['tmp_name']))
            {
                $file_name = $_FILES['foto_'.$i]['name'];
                $file_tmp = $_FILES['foto_'.$i]['tmp_name'];
                $x = explode('.', $file_name);
                $ekstensi = end($x);
                $new_file_name="img_".$id."_".$i.".".$ekstensi;
                unlink('../image/product_image/'.$product['foto_'.$i]);
                move_uploaded_file($file_tmp, '../image/product_image/'.$new_file_name);
                $update_file_name[$i-1]=$new_file_name;
            }else{
                $update_file_name[$i-1]=$product['foto_'.$i];
            }
        }
        $update="nama='". $_POST['nama_produk'] ."',kategori='". $_POST['kategori'] ."',harga='". $_POST['harga'] ."',berat='". $_POST['berat'] ."',keterangan='". $_POST['keterangan'] ."',jumlah='". $_POST['jumlah'] ."',label='". $_POST['produk_label']."',foto_1='". $update_file_name[0] ."',foto_2='". $update_file_name[1] ."',foto_3='". $update_file_name[2]."'";
        Update($table_name,$update,$id);
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Berhasil!</strong> Data telah diubah.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    $product= SelectId('product',$id);
}
if(!is_null($product)){
?>
<!-- Content -->
<div class="card" style="border-color:#DDDDDD;">
    <div class="card-body" style="background-color:#F5F5F5;">
        <h5 class="card-title"><i class="fa-solid fa-money-bill-1 me-2"></i>Edit Products</h5>
    </div>
    <div class="card-body">
        <div class="container px-5">
            <form method="post" action="edit_product.php?id=<?php echo $_GET['id'];?>"  enctype="multipart/form-data">
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="nama_produk"><b>Nama Product</b></label>
                    </div>                
                    <div class="col-lg-10">
                        <input id="nama_produk" class="form-control" type="text" name="nama_produk" value="<?php echo $product['nama']?>" required>
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
                            <option value="<?php echo $list['id']?>" <?php echo ($product['kategori']==$list['id']) ? ' selected="selected"' : ''; ?>><?php echo $list['kategori']?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row mt-2">
                    <div class="col-lg-2">
                        <label for="foto_1"><b>Gambar Produk 1</b></label>
                    </div>                
                    <div class="col-lg-10">
                        <input type="file" name="foto_1" id="foto_1" class="form-control" accept="image/*">
                    </div>
                </div>

                <div class="form-group row mt-2">
                    <div class="col-lg-2">
                        
                    </div>                
                    <div class="col-lg-10">
                        <img src="../image/product_image/<?php echo $product['foto_1']?>" alt="Foto_1" height="70" width="70">
                    </div>
                </div>

                <div class="form-group row mt-2">
                    <div class="col-lg-2">
                        <label for="foto_2"><b>Gambar Produk 2</b></label>
                    </div>                
                    <div class="col-lg-10">
                        <input type="file" name="foto_2" id="foto_2" class="form-control" accept="image/*">
                    </div>
                </div>

                <div class="form-group row mt-2">
                    <div class="col-lg-2">
                        
                    </div>                
                    <div class="col-lg-10">
                        <img src="../image/product_image/<?php echo $product['foto_2']?>" alt="Foto_2" height="70" width="70">
                    </div>
                </div>

                <div class="form-group row mt-2">
                    <div class="col-lg-2">
                        <label for="foto_3"><b>Gambar Produk 3</b></label>
                    </div>                
                    <div class="col-lg-10">
                        <input type="file" name="foto_3" id="foto_3" class="form-control" accept="image/*">
                    </div>
                </div>

                <div class="form-group row mt-2">
                    <div class="col-lg-2">
                        
                    </div>                
                    <div class="col-lg-10">
                        <img src="../image/product_image/<?php echo $product['foto_3']?>" alt="Foto_3" height="70" width="70">
                    </div>
                </div>

                <div class="form-group row mt-2">
                    <div class="col-lg-2">
                        <label for="harga"><b>Harga Produk</b></label>
                    </div>                
                    <div class="col-lg-10">
                        <input id="harga" class="form-control" type="number" name="harga" value="<?php echo $product['harga']?>" required>
                    </div>
                </div>

                <div class="form-group row mt-2">
                    <div class="col-lg-2">
                        <label for="berat"><b>Berat Produk</b></label>
                    </div>                
                    <div class="col-lg-10">
                        <input id="berat" class="form-control" step=".01" type="number" name="berat" value="<?php echo $product['berat']?>" required>
                    </div>
                </div>

                <div class="form-group row mt-2">
                    <div class="col-lg-2">
                        <label for="keterangan"><b>Keterangan</b></label>
                    </div>                
                    <div class="col-lg-10">
                     <textarea name="keterangan" class="form-control" id="keterangan"><?php echo $product['keterangan']?></textarea>
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
                        <input id="jumlah" class="form-control" type="number" name="jumlah" value="<?php echo $product['jumlah']?>" required>
                    </div>
                </div>

                <div class="form-group row mt-2">
                    <div class="col-lg-2">
                        <label for="produk_label"><b>Label Produk</b></label>
                    </div>                
                    <div class="col-lg-10">
                        <input id="produk_label" class="form-control" type="text" name="produk_label" value="<?php echo $product['label']?>" required>
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
}
include("include/Bottom.php");
?>