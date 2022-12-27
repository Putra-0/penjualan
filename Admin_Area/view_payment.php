<?php
function headerTag(){
?>
<style>
#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation */
.modal-content, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

/* The Close Button */
.close-modal {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close-modal:hover,
.close-modal:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
</style>

<?php
}
$head = headerTag();
$title='View Payment';
$breadcrumb=array('Dashboard','View Payment');
include("include/Top.php");
include("database/Connection.php");
include("database/Function.php");

$payments=SelectAll('payment');

?>
<!-- Content -->
<div class="card" style="border-color:#DDDDDD;">
    <div class="card-body" style="background-color:#F5F5F5;">
        <h5 class="card-title"><i class="fa-solid fa-money-bill-1 me-2"></i>View Payment</h5>
    </div>
    <div class="card-body">
        <div class="container">
        <div class="table-responsive"><!-- table-responsive Starts -->

            <table class="table table-bordered table-sm table-hover table-striped"><!-- table table-bordered table-hover table-striped Starts -->

            <thead><!-- thead Starts -->
            <tr>
            <th>#</th>
            <th>Invoice No</th>
            <th>Amount Paid</th>
            <th>Payment Method</th>
            <th>Reference #</th>
            <th>Proof</th>
            <th>Action</th>


            </tr>

            </thead><!-- thead Ends -->

            <tbody><!-- tbody Starts -->
            <?php
          if(!is_null($payments)){
          foreach($payments as $index => $payment){?>
          <tr>
            <td><?php echo $index+1;?></td>
            <td><a href="detail_order.php?invoice=<?php echo $payment['invoice']?>" class="link-dark text-decoration-none"><?php echo $payment['invoice']?></a></td>
            <td>Rp. <?php echo $payment['nominal_kirim']?></td>
            <td><?php echo $payment['payment_mode']?></td>
            <td><?php echo $payment['id_reference']?></td>
            <td><img id="myImg" onclick="imgClick(this)" class="img-thumbnail" src="../image/transaction/<?php echo $payment['bukti_transaksi']?>" alt="proof <?php echo $payment['invoice']?>" style="width:100%;max-width:100px"></td>
            <td>
              <a class="link-dark" href="delete_payment.php?id=<?php echo $payment['id']; ?>" onclick="if (confirm('Delete selected item?')){return true;}else{event.stopPropagation(); event.preventDefault();};"><i class="fa-solid fa-trash-can me-2"></i>Delete</a>
            </td>
          </tr>
          <?php }}else{echo "No Data";} ?>
            </tbody><!-- tbody Ends -->


            </table><!-- table table-bordered table-hover table-striped Ends -->
            </div>
        </div>
    </div>
</div>
<div id="myModal" class="modal">
  <span class="close-modal">&times;</span>
  <img class="modal-content" id="imgmodal">
  <div id="caption"></div>
</div>
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var modalImg = document.getElementById("imgmodal");
var captionText = document.getElementById("caption");
function imgClick(img){
  modal.style.display = "block";
  modalImg.src = img.src;
  captionText.innerHTML = img.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close-modal")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
</script>
<!-- ContentEnd -->
<?php
include("include/Bottom.php");
?>

    