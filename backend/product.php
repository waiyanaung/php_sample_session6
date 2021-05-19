<?php
include_once("header.php");
if(!isset($_SESSION['valid'])) {
	header('Location: index.php');
}


//fetching data in descending order (lastest entry first)
$result = mysqli_query($mysqli, "SELECT * FROM products WHERE login_id=".$_SESSION['id']." ORDER BY id DESC");
?>

<div class="jumbotron text-center">
  <h3>Register</h3>
</div>

<div class="container">
	<div class="row">
	  	<div class="col-sm-12 col-md-12">
		  <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
				<th>Product Name</th>
				<th>Quantity</th>
				<th>Price (euro)</th>
				<th>Action</th>
				<th>Action</th>
                </tr>
              </thead>             
              

			  <?php
				while($res = mysqli_fetch_array($result)) {	
					echo "<tbody>";	
					echo "<tr>";
					echo "<td>".$res['name']."</td>";
					echo "<td>".$res['qty']."</td>";
					echo "<td>".$res['price']."</td>";	
					echo "<td><a href=\"product_edit.php?id=$res[id]\">Edit</a></td>";
					echo "<td><a href=\"product_delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
					echo "</tbody>";		
				}
				?>
            </table>
          </div>
		
		</div>
	</div>
</div>

<?php
include('footer.php');
?>