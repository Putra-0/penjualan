<?php
function headerTag(){
?>
<link rel="stylesheet" href="CSS/table.css">
<?php
}
$head = headerTag();
$title='View Order';
$breadcrumb=array('Dashboard','View Order','Detail Order');
include("include/Top.php");
include("database/Connection.php");
include("database/Function.php");
if(!isset($_GET['invoice'])){
    echo '<script type="text/javascript"> window.location="view_order.php";</script>';
}
$find = $conn->query("SELECT * FROM `pesanan` WHERE invoice='".$_GET['invoice']."'");
if($find->num_rows == 0){
    echo '<script type="text/javascript"> window.location="view_order.php";</script>';
}
if(isset($_POST['id_pesanan'])){
    for ($i=0; $i < count($_POST['id_pesanan']); $i++) { 
        $conn->query("UPDATE pesanan SET harga=".$_POST['harga'][$i].", jumlah=".$_POST['jumlah'][$i].", status='".$_POST['status']."', ongkir=".$_POST['shipping'].", resi='".$_POST['resi']."', keterangan='".$_POST['keterangan']."' WHERE id=".$_POST['id_pesanan'][$i]);
    }
    if(isset($_POST['delete'])){
        for ($i=0; $i < count($_POST['delete']); $i++) { 
            $conn->query("DELETE FROM pesanan WHERE id=".$_POST['delete'][$i]);
    }
}
}

$sql="SELECT pesanan.id,pesanan.id_pembeli,pesanan.invoice,pesanan.nama_produk,harga,jumlah,kurir,layanan,ongkir, harga*jumlah as sub_total,resi,status,keterangan  FROM `pesanan` WHERE pesanan.invoice='".$_GET['invoice']."'";
$sum=$conn->query("SELECT sum(harga*jumlah)+ongkir as total FROM `pesanan` WHERE invoice='".$_GET['invoice']."'")->fetch_assoc();
$orders=SelectRaw($sql);
?>
<!-- Content -->
<div class="card" style="border-color:#DDDDDD;">
    <div class="card-body" style="background-color:#F5F5F5;">
        <h5 class="card-title"><i class="fa-solid fa-money-bill-1 me-2"></i>Orders Detail</h5>
    </div>
    <div class="card-body">
        <div class="container">
        <?php
        $data = $orders->fetch_assoc();
        include("database/Connection.php");
        $pembeli = $conn->query("SELECT * FROM pembeli where id=".$data['id_pembeli']);
        $conn->close();
        ?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Pembeli</h5>
                <?php
                 if($pembeli){
                $pembeli = $pembeli->fetch_assoc();
                ?>
                <div class="table-responsive"><!-- table-responsive Starts -->

                    <table class="table table-sm table-bordered table-hover table-striped"><!-- table table-bordered table-hover table-striped Starts -->

                    <tr>
                    <td class="table-col-fit p-2">Nama Pembeli</td>
                    <td class="table-col-fit p-2">:</td>
                    <th class="p-2"><?php echo $pembeli['nama']?></th>
                    </tr>
                    <tr>
                    <td class="table-col-fit p-2">Email</td>
                    <td class="table-col-fit p-2">:</td>
                    <th class="p-2"><?php echo $pembeli['email']?></th>
                    </tr>

                    <tr>
                    <td class="table-col-fit p-2">No Telepon</td>
                    <td class="table-col-fit p-2">:</td>
                    <th class="p-2"><?php echo $pembeli['nomor_hp']?></th>
                    </tr>
                    <tr>
                    <td class="table-col-fit p-2">Alamat</td>
                    <td class="table-col-fit p-2">:</td>
                    <th class="p-2"><?php echo $pembeli['alamat']?></th>
                    </tr>
                    
                    </table><!-- table table-bordered table-hover table-striped Ends -->
                    </div>
            <?php }else {?>
                <h1 class="card-text">Akun Ini Telah Dihapus</h1>
            <?php }?>
            </div>
        </div>
        <div class="card mt-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h2 class="card-title">Order</h2>
                        </div>
                        <div class="col-6">
                            <button id="btn_edit" class="btn btn-primary d-block float-end" onclick="edit_mode()" type="button"><i class="fa fa-pencil"></i></button>
                            <a href="detail_order.php?invoice=<?php echo $_GET['invoice']?>" id="btn_cancel" class="btn btn-danger d-none float-end"><i class="fa-solid fa-xmark"></i></a>
                            <script>
                                function edit_mode() {
                                    document.getElementById("btn_edit").outerHTML="";
                                    const btn_cancel = document.getElementById("btn_cancel");
                                    btn_cancel.classList.remove('d-none');
                                    btn_cancel.classList.add('d-block');

                                    const btn_submit = document.getElementById("btn_submit");
                                    btn_submit.classList.remove('d-none');
                                    btn_submit.classList.add('d-block');

                                    const status = document.getElementById("order_status");
                                    const selected = status.innerText;
                                    let option= '<option value="" disabled>Select Status</option>';
                                    
                                    if (selected == 'Cancel'){
                                        option+='<option value="Cancel" selected>Cancel</option>';
                                    }else{
                                        option+='<option value="Cancel">Cancel</option>';
                                    }

                                    if (selected == 'Unpaid'){
                                        option+='<option id="unpaid" value="Unpaid" selected>Unpaid</option>';
                                    }else{
                                        option+='<option id="unpaid" value="Unpaid">Unpaid</option>';
                                    }

                                    if (selected == 'Paid'){
                                        option+='<option id="paid" value="Paid" selected>Paid</option>';
                                    }else{
                                        option+='<option id="paid" value="Paid">Paid</option>';
                                    }

                                    if (selected == 'Shipped'){
                                        option+='<option value="Shipped" selected>Shipped</option>';
                                    }else{
                                        option+='<option value="Shipped">Shipped</option>';
                                    }

                                    if (selected == 'Complete'){
                                        option+='<option value="Complete" selected>Complete</option>';
                                    }else{
                                        option+='<option value="Complete">Complete</option>';
                                    }
                                    
                                    status.innerHTML='<select id="select_status" style="max-width:125px" name="status" class="form-select d-inline">'+option+'</select>'
                                    
                                    const shipping = document.getElementById("order_shipping");
                                    shipping.innerHTML = '<input type="number" class="form-control" step="1000.00" id="input_shipping" name="shipping" onchange="total()" style="max-width:200px" value="'+shipping.innerText+'" min="0">'

                                    <?php
                                     if(!is_null($orders)){
                                         if($data['kurir'] == 'JNE') echo 'const pattern ='."'pattern=".'"([0-9]{15,15}|)"'."';";
                                         else if($data['kurir'] == 'TIKI') echo 'const pattern ='."'pattern=".'"([0-9]{12,12}|)"'."';";
                                         else if($data['kurir'] == 'POS INDONESIA') echo 'const pattern ='."'pattern=".'"([0-9]{11,11}|)"'."';";
                                         else echo 'const pattern = "";';
                                    } 
                                        
                                     ?>

                                    const resi = document.getElementById("resi");
                                    if(resi.innerText == '-'){
                                        resi.innerHTML ='<input type="text" name="resi" style="max-width:200px" '+pattern+' onchange="change_status();" oninput="this.onchange();" onkeypress="this.onchange();" onpaste="this.onchange();" oninput="this.onchange();" value="" class="form-control" id="input_resi">';
                                    }else{
                                        resi.innerHTML ='<input type="text" name="resi" style="max-width:200px" '+pattern+' onchange="change_status();" oninput="this.onchange();" onkeypress="this.onchange();" onpaste="this.onchange();" oninput="this.onchange();" value="'+resi.innerText+'" class="form-control" id="input_resi">';
                                        change_status();
                                    }
                                    
                                    const keterangan = document.getElementById("keterangan");
                                        keterangan.innerHTML ='<textarea class="form-control" name="keterangan" rows="3">'+keterangan.innerText+'</textarea>';
                                    if(keterangan.innerText == '-'){
                                        keterangan.innerHTML ='<textarea class="form-control" name="keterangan" rows="3"></textarea>';
                                    }else{
                                        keterangan.innerHTML ='<textarea class="form-control" name="keterangan" rows="3">'+keterangan.innerText+'</textarea>';
                                    }
                                    
                                    

                                    document.querySelectorAll('#delete').forEach(el=>{
                                            el.classList.remove("d-none");
                                        });
                                    
                                    const jumlah = document.querySelectorAll('[id^="jumlah_"]');
                                    for (let i = 0; i < jumlah.length; i++) {
                                        const el = jumlah[i];
                                        let value = el.innerHTML;
                                        el.innerHTML='<input type="number" id="input_jumlah_'+i+'" class="form-control" name="jumlah[]" onchange="updateInput('+i+')" style="height: 30px;width: 60px;" value="'+value+'" min="1">';
                                    }

                                    const harga = document.querySelectorAll('[id^="harga_"]');
                                    for (let i = 0; i < harga.length; i++) {
                                        const el = harga[i];
                                        let value = el.innerHTML.replace("Rp. ","");
                                        el.innerHTML='<input type="number" id="input_harga_'+i+'" step="1000.00" class="form-control" name="harga[]" onchange="updateInput('+i+')" value="'+value+'">';
                                    }
                                }
                                function change_status() {
                                    const value = document.getElementById("input_resi").value;
                                    const status = document.getElementById("select_status");
                                    if(value == ""){
                                        document.getElementById("unpaid").disabled=false;
                                        document.getElementById("paid").disabled=false;
                                    }else{
                                        document.getElementById("unpaid").disabled=true;
                                        document.getElementById("paid").disabled=true;
                                        if(status.value == "Unpaid" || status.value == "Paid"){
                                            status.value="Shipped";
                                    }
                                    }
                                }
                                function updateInput(id){
                                    let harga = document.getElementById("input_harga_"+id).value;
                                    let jumlah = document.getElementById("input_jumlah_"+id).value;
                                    document.getElementById("sub_total_"+id).innerHTML = "Rp. "+((jumlah*harga).toFixed(2));
                                    total();
                                }
                                function total() {
                                    const sub_harga = document.querySelectorAll('[id^="sub_total_"]');
                                    const ship = document.getElementById("input_shipping").value;
                                    let sub_total = 0;
                                    for (let i = 0; i < sub_harga.length; i++) {
                                        sub_total += parseInt(sub_harga[i].innerHTML.replace("Rp. ",""));
                                    }
                                    document.getElementById("total").innerHTML = (parseFloat(ship) + sub_total).toFixed(2);
                                }
                                function set_check(check_box) {
                                    if(check_box.checked){
                                        if(confirm("Are you sure")){
                                            check_box.checked=true;
                                        }else{
                                            check_box.checked=false;
                                        }
                                    }
                                    
                                }
                            </script>
                        </div>
                    </div>
                    <form action="detail_order.php?invoice=<?php echo $_GET['invoice']?>"" method="post">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-4">
                                    <p class="card-text">Couriel : <?php echo (!is_null($orders))? $data['kurir'] :""?></p>
                                </div>
                                <div class="col-lg-4">
                                    <p class="card-text">Service : <?php echo (!is_null($orders))? $data['layanan'] :""?></p>
                                </div>
                                <div class="col-lg-4">
                                    <p class="card-text">Status Order : <span id="order_status"><?php echo (!is_null($orders))? $data['status'] :""?></span></p>
                                </div>
                                <div class="col-lg-4">
                                    <p class="card-text">Shipping : Rp. <span id="order_shipping"><?php echo (!is_null($orders))? $data['ongkir'] :"0"?></span></p>
                                </div>
                                <div class="col-lg-4">
                                    Resi : <span id="resi"><?php echo (!is_null($data['resi']) && $data['resi'] !='' )? $data['resi'] :"-"?></span>
                                </div>
                                <div class="col-lg-4">
                                    Keterangan : <p id="keterangan"><?php echo (!is_null($data['keterangan'])  && $data['keterangan'] !='')? $data['keterangan'] :'-'?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 order-first order-lg-last">
                            <h5 class="card-title"> Invoice : <?php echo (!is_null($orders))? $data['invoice'] :"0"?></h5>
                        </div>
                    </div>
                <div class="card-body">
                <div class="table-responsive"><!-- table-responsive Starts -->
                    <table class="table table-sm table-bordered table-hover table-striped"><!-- table table-bordered table-hover table-striped Starts -->

                    <thead><!-- thead Starts -->
                    <tr>
                    <th>#</th>
                    <th>Produk</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Sub Total</th>
                    <th id="delete" class="d-none">Delete</th>

                    </tr>

                    </thead><!-- thead Ends -->

                    <tbody><!-- tbody Starts -->
                    <?php
                    if(!is_null($orders)){
                    foreach($orders as $index => $order){?>
                    <input type="hidden" name="id_pesanan[]" value="<?php echo $order['id']?>">
                    <tr id="row_data_<?php echo $index;?>">
                    <td><?php echo $index+1;?></td>
                    <td id="produk_<?php echo $index;?>"><?php echo $order['nama_produk']?></td>
                    <td id="harga_<?php echo $index;?>">Rp. <?php echo $order['harga']?></td>
                    <td id="jumlah_<?php echo $index;?>"><?php echo $order['jumlah']?></td>
                    <td id="sub_total_<?php echo $index;?>">Rp. <?php echo $order['sub_total']?></td>
                    <td id="delete" class="d-none"><input type="checkbox" onChange="set_check(this)" class="form-check-input" name="delete[]" value="<?php echo $order['id']?>"></td>
                    </tr>
                    <?php }}else{echo "No Data";} ?>
                    </tbody><!-- tbody Ends -->


                    </table><!-- table table-bordered table-hover table-striped Ends -->
                    </div>
                    <button id="btn_submit" class="btn btn-info d-none ms-auto mx-2 text-white" type="submit"><i class="fa fa-refresh me-2"></i>Update Cart</button>
                    </form>
                    <h3 class="card-title text-end">Total: Rp. <span id="total"><?php echo (!is_null($sum))? $sum['total'] :"0"?></span></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ContentEnd -->
<?php
include("include/Bottom.php");
?>

    