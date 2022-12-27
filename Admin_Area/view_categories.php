<?php
function headerTag(){
?>


<?php
}
$head = headerTag();
$title='View Product Categories';
$breadcrumb=array('Dashboard','Product Catagories');
include("include/Top.php");
include("database/Connection.php");
include("database/Function.php");
if(isset($_POST['submit'])) {
    $id=$_POST['id'];
    $table_name = "categories";
    $update="kategori='". $_POST['kategori'] ."'";
    Update($table_name,$update,$id);
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Berhasil!</strong> Data telah diubah.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}
?>
<!-- Content -->
<div id="myloading"></div>
<div class="card" style="border-color:#DDDDDD">
    <div class="card-body" style="background-color:#F5F5F5">
        <p class="card-title"><i class="fa-solid fa-money-bill-1 me-2"></i>View Catagories</p>
      </div>

      <div class="card-body">
        <div class="table-responsive"><!-- table-responsive Starts -->

          <table class="table table-sm table-bordered table-hover table-striped"><!-- table table-bordered table-hover table-striped Starts -->

          <thead><!-- thead Starts -->
          <tr>
          <th>#</th>
          <th style="min-width: 200px;">Kategori</th>
          <th>Delete</th>
          <th>Edit</th>
          </tr>
          </thead><!-- thead Ends -->
          <?php
           $categories = SelectAll('categories');
           if(!is_null($categories)){
           foreach($categories as $index => $list){
          ?>
          <tr>
            <td><?php echo $index+1; ?></td>
            <td id="td_<?php echo $list['id']; ?>" onClick="edit('<?php echo $list['id']; ?>','<?php echo $list['kategori']; ?>')" style="max-width: 100px;"><?php echo $list['kategori']; ?></td>
            <td><a class="link-dark" href="delete_categories.php?id=<?php echo $list['id']; ?>" onclick="if (confirm('Delete selected item?')){return true;}else{event.stopPropagation(); event.preventDefault();};"><i class="fa-solid fa-trash-can me-2"></i>Delete</a></td>
            <td><button class="btn btn-link-dark" onClick="edit('<?php echo $list['id']; ?>','<?php echo $list['kategori']; ?>')"><i class="fa fa-pencil me-2"></i>Edit</button></td>
          </tr>
          <?php }
          } ?>
          <script>
            function loading(){
                let cols = document.getElementById('myloading').innerHTML='<div class="alert alert-warning text-center" role="alert"><h3>Loading...</h3></div>';
            }
            function edit(id,value) {
                let cols = document.getElementById('td_'+id);
                let cancel_function="cancel('"+id+"','"+value+"')";
             
                var form = document.createElement("form");
                form.setAttribute("method", "post");
                form.setAttribute("action", "view_categories.php");

                var input_group = document.createElement("div");
                input_group.setAttribute("class", "input-group");

                var input_id = document.createElement("input");
                input_id.setAttribute("type", "hidden");
                input_id.setAttribute("name", "id");
                input_id.setAttribute("value", id);
                input_group.appendChild(input_id);
                
                var input_kategori = document.createElement("input");
                input_kategori.setAttribute("type", "text");
                input_kategori.setAttribute("id", "input_"+id);
                input_kategori.setAttribute("name", "kategori");
                input_kategori.setAttribute("value",value);
                input_kategori.setAttribute("class","form-control input-sm");
                input_kategori.setAttribute("onblur",cancel_function);
                input_kategori.setAttribute("placeholder","categories");
                input_group.appendChild(input_kategori);

                var input_submit = document.createElement("input");
                input_submit.setAttribute("type", "submit");
                input_submit.setAttribute("class", "btn btn-outline-secondary");
                input_submit.setAttribute("onClick", "loading()");
                input_submit.setAttribute("name", "submit");
                input_submit.setAttribute("value", "Save");
                input_group.appendChild(input_submit);

                form.appendChild(input_group);

                cols.firstChild.nodeValue='';
                cols.appendChild(form);
                
                setTimeout(function() {
                    const input = document.getElementById("input_"+id);
                    var val = input.value;
                    input.value = '';
                    input.value = val;
                    input.focus();
                }, 250);
            }
            function cancel(id,value){
                setTimeout(function() {
                let cols = document.getElementById('td_'+id);
                while (cols.lastElementChild) {
                    cols.removeChild(cols.lastElementChild);
                }
                let text = document.createTextNode(value);
                cols.appendChild(text);
                }, 250);
            }
          </script>
          <tbody><!-- tbody Starts -->

          </tbody><!-- tbody Ends -->
          </table><!-- table table-bordered table-hover table-striped Ends -->
        </div>
      </div>
    </div>
<!-- ContentEnd -->
<?php
include("include/Bottom.php");
?>