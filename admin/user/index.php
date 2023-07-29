<?php

include "../../init.php";
use Models\User;

?>

<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="style.css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<title>Admin Dashboard</title>

</head>
<body>


<div class="container-fluid">
<ul class="nav nav-pills nav-justified">
  <li style="background-color: #FFF8DC"><a  href="../../admin/index.php">Dashboard</a></li>
  <li style="background-color: #FAF0E6"><a  href="../admin/landlord/index.php">Manage Landlords</a></li>
  <li class="active" style="background-color: #FFFAF0"><a  href="index.php">Manage Users</a></li>
  <li style="background-color: #FFFACD"><a  href="../admin/property/index.php">Manage Properties</a></li>
  <li style="background-color: #FAFAF0"><a  href="../admin/application-request/index.php">Application Requests</a></li>
</ul>
</nav>


<div class="container-xl">
	<div class="table table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2><b>Users</b></h2>
					</div>
					<div class="col-sm-6">	
                        <form method="POST" action="add.php">
                            <button class="btn btn-success" style="margin-top:10px;">Add New User</button>
                        </form>				
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th scope="col">ID</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Contact Number</th>
                        <th scope="col">Email</th>
                        <th scope="col">City</th>
                        <th scope="col">Picture</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
                    $classes = new User('', '', '', '', '','','','','','','','','','','');
                    $classes->setConnection($connection);
                    $retrieveClasses = $classes->getLandlords();
                    foreach($retrieveClasses as $class){
                ?>
            <tr>
                <th scope="row"><?php echo $class['landlord_id']?></th>
                <td><?php echo $class['first_name']?></td>
                <td><?php echo $class['last_name']?></td>
                <td><?php echo $class['contact_number']?></td>
				<td><?php echo $class['email']?></td>
                <td><?php echo $class['city']?></td>
                <td><?php echo $class['picture_path']?></td>
				<td class="text-center">
					<a class="btn btn-sm btn-outline-primary edit" id="editBtn" type="button" href="view.php?landlord_id=<?php echo $class['landlord_id']?>" >Edit</a>
					<button class="btn btn-sm btn-outline-danger delete_tenant" type="button" data-id="<?php echo $class['landlord_id'] ?>">Delete</button>
				</td>
            </tr>
            <?php } ?>
				</tbody>
			</table>
		</div>
	</div>        
</div>
</body>

<style>
body {
	color: #566787;
	background: #f5f5f5;
	font-family: 'Varela Round', sans-serif;
	font-size: 13px;
}
.table-responsive {
    margin: 30px 0;
}
.table-wrapper {
	background: #fff;
	padding: 20px 25px;
	border-radius: 3px;
	min-width: 1000px;
	box-shadow: 0 1px 1px rgba(0,0,0,.05);
}
.table-title {        
	padding-bottom: 15px;
	background: #435d7d;
	color: #fff;
	padding: 16px 30px;
	min-width: 100%;
	margin: -20px -25px 10px;
	border-radius: 3px 3px 0 0;
}
.table-title h2 {
	margin: 5px 0 0;
	font-size: 24px;
}
.table-title .btn-group {
	float: right;
}
.table-title .btn {
	color: #fff;
	float: right;
	font-size: 13px;
	border: none;
	min-width: 50px;
	border-radius: 2px;
	border: none;
	outline: none !important;
	margin-left: 10px;
}
table.table tr th, table.table tr td {
	border-color: #e9e9e9;
	padding: 12px 15px;
	vertical-align: middle;
}
table.table tr th:first-child {
	width: 100px;
}
table.table tr th:last-child {
	width: 100px;
}
table.table-striped tbody tr:nth-of-type(odd) {
	background-color: #fcfcfc;
}
table.table-striped.table-hover tbody tr:hover {
	background: #f5f5f5;
}
table.table .avatar {
	border-radius: 50%;
	vertical-align: middle;
	margin-right: 10px;
}
.hint-text {
	float: left;
	margin-top: 10px;
	font-size: 13px;
}    
</style>
<script>
$(document).ready(function(){
	// Activate tooltip
	$('[$class-toggle="tooltip"]').tooltip();
});

// Get the modal
var modal = document.getElementById("editModal");

// Get the button that opens the modal
var btn = document.getElementById("editBtn");

// Get the <span> element that closes the modal
//var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
</html>