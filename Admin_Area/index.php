<?php
function headerTag(){
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<?php
}
$head = headerTag();
$title='Dashboard';
$breadcrumb=array('Dashboard');
include("include/Top.php");
include("database/Connection.php");
include("database/Function.php");
function CountRow($table_name){
  include("database/Connection.php");
  
  return $conn->query("SELECT * FROM ".$table_name)->num_rows;
  $conn->close();
}

function PesananCount($status){
  include("database/Connection.php");
  return $conn->query("SELECT * FROM pesanan WHERE status ='".$status."'")->num_rows;
  $conn->close();
}


function PesananSumInterval($tgl_start,$tgl_end){
  include("database/Connection.php");
  return $conn->query("SELECT IFNULL(sum(harga*jumlah),0) as total FROM pesanan WHERE tanggal_pesan >= '$tgl_start' AND tanggal_pesan <= '$tgl_end' and status='Complete'")->fetch_assoc()['total'];
  $conn->close();
}

function PesananTop(){
  include("database/Connection.php");
  return $conn->query("SELECT nama_produk, COUNT(jumlah) as jumlah FROM `pesanan` WHERE status='Complete' OR status='Paid' GROUP BY nama_produk ORDER BY jumlah DESC LIMIT 4;");
  $conn->close();
}


$earning = (int)$conn->query("SELECT IFNULL(sum(harga*jumlah),0) as sum FROM pesanan WHERE status ='Complete'")->fetch_assoc()['sum'];
$sql="SELECT pesanan.invoice,IFNULL(pembeli.email,'Deleted Account') as email,tanggal_pesan, status FROM `pesanan` LEFT JOIN pembeli ON pesanan.id_pembeli = pembeli.id GROUP BY invoice ORDER BY tanggal_pesan DESC LIMIT 5";

$orders=SelectRaw($sql);
?>
<!-- Content -->
<div class="row">
  <div class="col-md-6 col-xl-3 mb-3">
    <div class="card border-2" style="border-color:#337AB7">
      <div class="card-body p-3 text-white" style="background-color:#337AB7">
      <div class="row">
        <div class="col-2">
        <i class="fa fa-tasks fa-3x"></i>
        </div>
        <div class="col-10 text-end">
          <h1 class="card-title"><?php echo CountRow('product')?></h1>
          <small class="card-text">Products</small>
        </div>
      </div>
      </div>
      <div class="card-body d-grid gap-2">
        <a href="view_product.php" class="link-info d-flex justify-content-between text-decoration-none"><span>View Details</span><i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-xl-3 mb-3">
    <div class="card border-2" style="border-color:#5CD85C">
      <div class="card-body p-3 text-white" style="background-color:#5CD85C">
      <div class="row">
        <div class="col-2">
        <i class="fa fa-comments fa-3x"></i>
        </div>
        <div class="col-10 text-end">
          <h1 class="card-title"><?php echo CountRow('pembeli')?></h1>
          <small class="card-text">Customers</small>
        </div>
      </div>
      </div>
      <div class="card-body d-grid gap-2">
        <a href="view_customers.php" class="link-success d-flex justify-content-between text-decoration-none"><span>View Details</span><i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-xl-3 mb-3">
    <div class="card border-2" style="border-color:#F0AD4E">
      <div class="card-body p-3 text-white" style="background-color:#F0AD4E">
      <div class="row">
        <div class="col-2">
        <i class="fa fa-shopping-cart fa-3x"> </i>
        </div>
        <div class="col-10 text-end">
          <h1 class="card-title"><?php echo CountRow('categories')?></h1>
          <small class="card-text">Products Categories</small>
        </div>
      </div>
      </div>
      <div class="card-body d-grid gap-2">
        <a href="view_categories.php" class="link-warning d-flex justify-content-between text-decoration-none"><span>View Details</span><i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-xl-3 mb-3">
    <div class="card border-2" style="border-color:#D9534F">
      <div class="card-body p-3 text-white" style="background-color:#D9534F">
      <div class="row">
        <div class="col-2">
        <i class="fa-solid fa-life-ring fa-3x"></i>
        </div>
        <div class="col-10 text-end">
          <h1 class="card-title"><?php echo PesananCount('Paid')?></h1>
          <small class="card-text">Orders</small>
        </div>
      </div>
      </div>
      <div class="card-body d-grid gap-2">
        <a href="view_order.php" class="link-danger d-flex justify-content-between text-decoration-none"><span>View Details</span><i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-xl-3 mb-3">
    <div class="card border-2" style="border-color:#DFF0D8">
      <div class="card-body p-3 text-success" style="background-color:#DFF0D8">
      <div class="row">
        <div class="col-2">
        <i class="fa fa-dollar fa-3x"> </i>
        </div>
        <div class="col-10 text-end">
          <h1 class="card-title"><?php echo $earning;?></h1>
          <small class="card-text">Earnings</small>
        </div>
      </div>
      </div>
      <div class="card-body d-grid gap-2">
        <a href="view_order.php" class="link-success d-flex justify-content-between text-decoration-none"><span>View Details</span><i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-xl-3 mb-3">
    <div class="card border-2" style="border-color:#FCF8E3">
      <div class="card-body p-3 text-danger" style="background-color:#FCF8E3">
      <div class="row">
        <div class="col-2">
        <i class="fa fa-spinner fa-3x"> </i>
        </div>
        <div class="col-10 text-end">
          <h1 class="card-title"><?php echo PesananCount('Unpaid')?></h1>
          <small class="card-text">Pending Orders</small>
        </div>
      </div>
      </div>
      <div class="card-body d-grid gap-2">
        <a href="view_order.php" class="link-danger d-flex justify-content-between text-decoration-none"><span>View Details</span><i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>
  
  <div class="col-md-6 col-xl-3 mb-3">
    <div class="card border-2" style="border-color:#D9EDF7">
      <div class="card-body p-3 text-info" style="background-color:#D9EDF7">
      <div class="row">
        <div class="col-2">
        <i class="fa fa-check fa-3x"> </i>
        </div>
        <div class="col-10 text-end">
          <h1 class="card-title"><?php echo PesananCount('Complete')?></h1>
          <small class="card-text">Completed Orders</small>
        </div>
      </div>
      </div>
      <div class="card-body d-grid gap-2">
        <a href="view_order.php" class="link-info d-flex justify-content-between text-decoration-none"><span>View Details</span><i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
      <div class="card">
      <div class="card-body">
        <h3 class="card-title">Penghasilan Bulanan Per 5 Hari (Ribu)</h3>
          </div>
          <div class="card-body">
              <canvas id="chLine"></canvas>
          </div>
      </div>
  </div>
  <div class="col-6">
    <div class="card">
      <div class="card-body">
        <h3 class="card-title">Pembelian Paling Laris</h3>
          </div>
          <div class="card-body">
              <canvas id="barChart"></canvas>
          </div>
  </div>
  </div>

        <script>
                var ctxL = document.getElementById("chLine").getContext('2d');
                var myLineChart = new Chart(ctxL, {
                    type: 'line',
                    data: {
                    labels: ["10","15", "20","25", "30"],
                    datasets: [{
                        label: "Bulan Lalu",
                        data: [
                            <?php echo PesananSumInterval('2022-'. date('m',strtotime('-1 MONTH')) .'-01','2022-'. date('m',strtotime('-1 MONTH')) .'-05');?>,
                            <?php echo PesananSumInterval('2022-'. date('m',strtotime('-1 MONTH')) .'-06','2022-'. date('m',strtotime('-1 MONTH')) .'-10');?>,
                            <?php echo PesananSumInterval('2022-'. date('m',strtotime('-1 MONTH')) .'-11','2022-'. date('m',strtotime('-1 MONTH')) .'-15');?>,
                            <?php echo PesananSumInterval('2022-'. date('m',strtotime('-1 MONTH')) .'-16','2022-'. date('m',strtotime('-1 MONTH')) .'-20');?>,
                            <?php echo PesananSumInterval('2022-'. date('m',strtotime('-1 MONTH')) .'-21','2022-'. date('m',strtotime('-1 MONTH')) .'-25');?>,
                            <?php echo PesananSumInterval('2022-'. date('m',strtotime('-1 MONTH')) .'-26','2022-'. date('m',strtotime('-1 MONTH')) .'-30');?>
                            ],
                        backgroundColor: [
                            'rgba(105, 0, 132, .2)',
                        ],
                        borderColor: [
                            'rgba(200, 99, 132, .7)',
                        ],
                        borderWidth: 2
                        },
                        {
                        label: "Bulan Ini",
                        data: [
                          <?php echo PesananSumInterval('2022-'. date('m') .'-01','2022-'. date('m') .'-05');?>,
                            <?php echo PesananSumInterval('2022-'. date('m') .'-06','2022-'. date('m') .'-10');?>,
                            <?php echo PesananSumInterval('2022-'. date('m') .'-11','2022-'. date('m') .'-15');?>,
                            <?php echo PesananSumInterval('2022-'. date('m') .'-16','2022-'. date('m') .'-20');?>,
                            <?php echo PesananSumInterval('2022-'. date('m') .'-21','2022-'. date('m') .'-25');?>,
                            <?php echo PesananSumInterval('2022-'. date('m') .'-26','2022-'. date('m') .'-30');?>
                        ],
                        backgroundColor: [
                            'rgba(0, 137, 132, .2)',
                        ],
                        borderColor: [
                            'rgba(0, 10, 130, .7)',
                        ],
                        borderWidth: 2
                        }
                    ]
                    },
                    options: {
                    responsive: true,
                    plugins: {
                    datalabels: false
                    }
                    }
                });

                var canvas = document.getElementById("barChart");
                var ctx = canvas.getContext('2d');

                // Global Options:
                Chart.defaults.global.defaultFontColor = 'black';
                Chart.defaults.global.defaultFontSize = 14;

                var data = {
                    labels: 
                    [
                    <?php 
                      foreach(PesananTop() as $key => $top){
                        if($key < 3)
                        echo '"'.$top['nama_produk'].'",';
                        else
                        echo '"'.$top['nama_produk'].'"';
                      }
                      ?>
                    ],
                    datasets: [
                        {
                            fill: true,
                            backgroundColor: [
                                "#4b77a9",
                                "#5f255f",
                                "#d21243",
                                "#B27200"
                            ],
                            data: [
                              <?php 
                                foreach(PesananTop() as $key => $top){
                                  if($key < 3)
                                  echo $top['jumlah'].',';
                                  else
                                  echo $top['jumlah'];
                                }
                              ?>
                            ],
                // Notice the borderColor 
                            borderColor:	['black', 'black','black','black'],
                            borderWidth: [2,2]
                        }
                    ]
                };

                // Notice the rotation from the documentation.

                var options = {
                        title: {
                                display: true,
                                text: 'Penjualan Terlaris',
                                position: 'top'
                            },
                        rotation: -0.7 * Math.PI,
                        plugins: {
                        datalabels: {
                            formatter: function(value, ctx) {
                                let datasets = ctx.chart.data.datasets;

                                if (datasets.indexOf(ctx.dataset) === datasets.length - 1) {
                                let sum = datasets[0].data.reduce((a, b) => a + b, 0);
                                let percentage = Math.round((value / sum) * 100) + '%';
                                return percentage;
                                } else {
                                return percentage;
                                }
                            },
                            color: 'white'
                        }
                        }
                    };


                // Chart declaration:
                var myBarChart = new Chart(ctx, {
                    type: 'pie',
                    data: data,
                    options: options
                });

            </script>

  <div class="col-12">
    <div class="card" style="border-color:#337AB7">
      <div class="card-body text-white" style="background-color:#337AB7">
        <h5 class="card-title"><i class="fa-solid fa-money-bill-1 me-2"></i>New Orders</h5>
      </div>

      <div class="card-body">
      <div class="table-responsive"><!-- table-responsive Starts -->

      <table class="table table-bordered table-hover table-striped"><!-- table table-bordered table-hover table-striped Starts -->

        `<thead><!-- thead Starts -->
        <tr>
        <th>#</th>
        <th>Customer</th>
        <th>Invoice No</th>
        <th>Date</th>
        <th>Status</th>
        <th>Action</th>


        </tr>

        </thead><!-- thead Ends -->

        <tbody><!-- tbody Starts -->
        <?php
        if(!is_null($orders)){
        foreach($orders as $index => $order){?>
        <tr>
        <td><?php echo $index+1;?></td>
        <td><?php echo $order['email']?></td>
        <td><?php echo $order['invoice']?></td>
        <td><?php echo $order['tanggal_pesan']?></td>
        <td><?php echo $order['status']?></td>
        <td>
          <a href="detail_order.php?invoice=<?php echo $order['invoice'] ?>" class="link-dark d-inline m-2"><i class="fa-solid fa-info me-2"></i>View Detail</a>
        </td>
        </tr>
        <?php }}else{echo "No Data";} ?>
        </tbody><!-- tbody Ends -->


        </table><!-- table table-bordered table-hover table-striped Ends -->
        </div>
        </div>
        <div class="card-body d-flex justify-content-end">
          <a href="view_order.php" class="link-info text-decoration-none"><span>View All Orders</span><i class="fa fa-arrow-circle-right ms-2"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- ContentEnd -->
<?php
include("include/Bottom.php");
?>

    