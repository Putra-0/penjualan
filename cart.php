<?php
if(!isset($_SESSION))
session_start();
function headerTag(){
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<link rel="stylesheet" href="asset/select2-4.0.6-rc.1/dist/css/select2.min.css">
<script src="asset/select2-4.0.6-rc.1/dist/js/select2.min.js"></script>   
<script src="asset/select2-4.0.6-rc.1/dist/js/i18n/id.js"></script>   
<script src="asset/js/app.js"></script>
<style>
   .btn-default{
        background-color:white;
    }
    .btn-default:hover{
        background-color:#d7d8d9;
    }
</style>
<link rel="stylesheet" href="Css/style.css">
<?php
}



$head = headerTag();
$banner=false;
$bannerTag="Cart";
$title='Cart';
include("database/Connection.php");
if (!isset($_SESSION['id_user'])) {
    echo '<script type="text/javascript"> window.location="login.php";</script>';die;
}
include("database/Function.php");
if(isset($_POST['id_produk'])){
    $table_name = "cart";
    $product_count = $conn->query("SELECT id_produk FROM cart where id_produk='".$_POST['id_produk']."'")->num_rows;
    if($product_count === 0){
        $column="id_pembeli,id_produk,jumlah";
        $values= "'".$_SESSION['id_user']."','".$_POST['id_produk']."','".$_POST['jumlah']."'";
        Insert($table_name,$column,$values);
    }else{
        $alert='<div class="alert alert-success alert-dismissible fade show" role="alert">
        Produk sudah ada didalam keranjang
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
}else if(isset($_POST['cart_id'])){
    for ($i=0; $i < count($_POST['cart_id']); $i++) { 
        $conn->query("UPDATE cart SET jumlah=". $_POST['jumlah'][$i] ." where id=".$_POST['cart_id'][$i]);
    }
    if(isset($_POST['delete'])){
        for ($i=0; $i < count($_POST['delete']); $i++) { 
            $conn->query("DELETE FROM cart WHERE id=".$_POST['delete'][$i]);
        }
    }
    $conn->close();
}
include("database/Connection.php");
$carts = SelectRaw("SELECT cart.id,product.foto_1, product.nama, product.harga, product.berat,product.jumlah as stok, cart.jumlah FROM `cart` INNER JOIN product ON cart.id_produk = product.id WHERE id_pembeli ='".$_SESSION['id_user']."'");
include("include/Top.php");
?>

<!-- Content -->
<div class="container p-3 bg-light">
    <?php
     echo (isset($alert))? $alert:''?>
    <div class="row p-2">
        <div class="col-lg-9 order-first">
            <div class="row">
                <div class="col-12 card p-3">
                    <h5 class="card-title">Shopping Cart</h5>
                    
                    <p class="card-text">You currently have <?php echo (!is_null($carts))? $carts->num_rows:'0'?> item(s) in your cart.</p>
                    <div class="table-responsive">
                        <table class="table" id="table-cart">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Produk</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Berat (KG)</th>
                                <th scope="col">Delete</th>
                                <th scope="col">Sub Berat (KG)</th>
                                <th scope="col">Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            <form method="post">
                                <?php
                                if(!is_null($carts)){
                                foreach($carts as $index => $cart){ ?>
                                    <input type="hidden" name="cart_id[]" value="<?php echo $cart['id']?>">
                                <tr>
                                <th scope="row"><?php echo $index+1?></th>
                                <td class="align-middle">
                                    <img class="img-thumbnail" src="image/product_image/<?php echo $cart['foto_1']?>" style="object-fit: cover;height: 50px;width: 50px;" alt="gambar produk">
                                    <?php echo $cart['nama']?>
                                </td>
                                <td class="align-middle"><input type="number" class="form-control" name="jumlah[]" onchange="updateInput(<?php echo $cart['id']?>,this.value,<?php echo $cart['berat']?>,<?php echo $cart['harga']?>)" style="height: 30px;width: 60px;" value="<?php echo $cart['jumlah']?>" min="1" max="<?php echo $cart['stok']?>"></td>
                                <td class="align-middle"><?php echo $cart['harga']?></td>
                                <td class="align-middle"><?php echo $cart['berat']?></td>
                                <td class="align-middle"><input type="checkbox" class="form-check-input" name="delete[]" value="<?php echo $cart['id']?>"></td>
                                <td class="align-middle" id="sub_berat_<?php echo $cart['id']?>"><?php echo $cart['berat']*$cart['jumlah']?></td>
                                <td class="align-middle" id="sub_harga_<?php echo $cart['id']?>"><?php echo $cart['harga']*$cart['jumlah']?></td>
                                </tr>
                                <?php }}?>
                                <script>
                                    window.onload = function() {
                                    total();
                                    };
                                    function updateInput(id,jumlah,berat,harga){
                                        
                                        const sub_berat = document.getElementById('sub_berat_'+id);
                                        const sub_harga = document.getElementById('sub_harga_'+id);

                                        sub_berat.innerHTML = (jumlah*berat).toFixed(2);
                                        sub_harga.innerHTML = (jumlah*harga).toFixed(0);
                                        total();

                                        $.ajax({ 
                                            url: 'update_cart_jumlah.php',
                                            data: {
                                                'id': id,
                                                'jumlah': jumlah
                                             },
                                            type: 'post'
                                        }).done(function(responseData) {
                                            
                                        }).fail(function() {
                                            console.log('Failed');
                                        });
                                    }
                                    function total(){
                                        const sub_harga = document.querySelectorAll('[id^="sub_harga_"]');
                                        const sub_berat = document.querySelectorAll('[id^="sub_berat"]');
                                        const ship = parseInt(document.getElementById('ship').innerHTML.replace("Rp. ", ""));
                                        let harga_sub_total =0;
                                        let berat_sub_total =0.0;
                                        for (let i = 0; i < sub_harga.length; i++) {
                                            harga_sub_total+= parseInt(sub_harga[i].innerHTML);
                                            berat_sub_total+= parseFloat(sub_berat[i].innerHTML);
                                        }
                                        document.getElementById('berat').value = berat_sub_total.toFixed(2);
                                        document.querySelectorAll('#total_sub_harga').forEach(el=>{
                                            el.innerHTML = "Rp. "+harga_sub_total;
                                        });
                                        document.getElementById('total').innerHTML = ship+harga_sub_total;
                                    }
                                </script>
                            </tbody>
                        </table>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 text-end">
                                   <h5>Total</h5> 
                                </div>
                                <div class="col-6 text-end">
                                    <h5 id="total_sub_harga">Rp. 0</h5>
                                </div>
                            </div>
                        </div>
                        </div>
                </div>
                <div class="col-12 mt-2">
                    <button class="btn d-block d-md-inline btn-default border float-none float-lg-start mx-auto" type="button"><i class="fa fa-chevron-left me-2"></i>Continue Shopping</button>
                    <div class="float-none d-md-inline float-lg-end">
                        <button class="btn d-block d-md-inline btn-info text-white mx-auto mt-2 mt-md-0" type="submit"><i class="fa fa-refresh me-2"></i>Update Cart</button>
                        </form>
                        <form action="checkout.php" method="post" class="d-md-inline mt-2 mt-md-0">
                        <input type="hidden" name="kurir" id="input_kurir" value="nodata">
                        <input type="hidden" name="tipe" id="input_tipe" value="nodata">
                        <input type="hidden" name="harga" id="input_harga" value="nodata">
                        <button class="btn d-block btn-success d-md-inline mx-auto disabled" id="proses" type="submit">Proceed to Checkout<i class="fa fa-chevron-right ms-2"></i></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 order-last order-lg-2">
        <div class="card mt-2 mt-lg-0">
                <div class="card-body bg-light">
                <h5 class="card-title">Order Summary</h5>
                    <p class="card-text">Shipping and additional costs are calculated based on the values you have entered.</p>
                </div>
                <div class="card-body">
                    <table class="table">
                            <tr>
                                <td>Order Subtotal</td>
                                <th id="total_sub_harga">Rp. 0</th>
                            </tr>
                            <tr>
                                <td>Shipping and handling</td>
                                <th id="ship">Rp. 0</th>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <th id="total">Rp. 0</th>
                            </tr>
                    </table>
                    <script type="text/javascript">
                    function setOngkir(tipe,value){
                        document.getElementById('ship').innerHTML='Rp. '+value;
                        total();
                        const proces = document.getElementById('proses');
                        var select = document.getElementById('kurir');
                        var kurir = select.options[select.selectedIndex].text;
                        document.getElementById('input_kurir').value = kurir;
                        document.getElementById('input_tipe').value = tipe;
                        document.getElementById('input_harga').value = value;
                        proces.classList.remove("disabled");
                        window.scrollTo(0, 400);
                    }
                    </script>
                </div>
            </div>
        </div>
        <div class="col-12 order-lg-3 order-2">
        <nav class="navbar navbar-inverse navbar-dark bg-dark my-2">
        <div class="container-fluid">
            <div class="navbar-header">
            <a class="navbar-brand" href="#">Pilih Metode Pengiriman</a>
            </div>   
        </div>
        </nav>  
        <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5 mt-2">
            <div class="card">
                <div class="card-body">
                <form class="form-horizontal" id="ongkir" method="POST">
                    <div class="form-group">
                    <label class="control-label col-sm-3">Dikirim dari :</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="Palangka Raya" readonly>
                        <input type="hidden" name="kota_asal" id="kota_asal" value="326" readonly>
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-sm-3">Kota Tujuan</label>
                    <div class="col-sm-9">          
                        <select class="form-control" id="kota_tujuan" name="kota_tujuan" required="">
                        <option></option>
                        </select>
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-sm-3">Kurir</label>
                    <div class="col-sm-9">          
                        <select class="form-control" id="kurir" name="kurir" required="">
                        <option value="jne">JNE</option>
                        <option value="tiki">TIKI</option>
                        <option value="pos">POS INDONESIA</option>
                        </select>
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-sm-3">Berat (Kg)</label>
                    <div class="col-sm-9">          
                        <input type="text" class="form-control" id="berat" name="berat" readonly>
                    </div>
                    </div>
                    <div class="form-group">        
                    <div class="col-sm-offset-3 col-sm-8">
                        <button type="submit" class="btn btn-success <?php if(is_null($carts)) echo 'disabled'?> mt-2" onclick="scroll_to_response_ongkir()">Next</button>
                        <script>
                            function scroll_to_response_ongkir(){
                                setTimeout(() => {
                                    const element = document.getElementById("response_ongkir");
                                    element.scrollIntoView();
                                }, 1000);
                            }
                        </script>
                    </div>
                    </div>
                </form>
                </div>
            </div>
            </div>
            <div class="col-lg-7 mt-2" id="response_ongkir">      
            </div>
        </div>
        </div>
        </div>
    </div>
</div>
<!-- ContentEnd -->


<?php
include("database/Connection.php");
include("include/Bottom.php");
?>