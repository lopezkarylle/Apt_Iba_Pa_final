<?php
use Models\Landlord;
include "../../init.php";
include ("../session.php");

?>
<!-- NOT OFFICIALLY INCLUDED -->
<div class="container-fluid">
	<form action="add.php" method="POST">
		<div class="row form-group">
            <div class="col-md-4">
				<label for="" class="control-label">First Name</label>
				<input type="text" class="form-control" name="first_name" required>
			</div>
		    <div class="col-md-4">
				<label for="" class="control-label">Last Name</label>
				<input type="text" class="form-control" name="last_name" required>
			</div>
            <div class="col-md-4">
				<label for="" class="control-label">Contact #</label>
				<input type="text" class="form-control" name="contact_number" required>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-md-4">
				<label for="" class="control-label">Email</label>
				<input type="email" class="form-control" name="email" required>
			</div>
			<div class="col-md-4">
				<label for="" class="control-label">pass</label>
				<input type="text" class="form-control" name="password" required>
			</div>
		</div>
        <button class="btn btn-sm btn-outline-danger delete_tenant" type="submit">Add</button>
	</form>
</div>

<?php 
try {
    if(isset($_POST['email'])){
        $landlord = new Landlord($_POST['first_name'], $_POST['last_name'], $_POST['contact_number'], $_POST['email'], $_POST['password'], 1, 1);
        $landlord->setConnection($connection);
        $student_added = $landlord->addLandlord();
        var_dump($student_added);
        echo "<script>window.location.href='index.php?success=1';</script>";
        exit();
    }
} catch (Exception $e) {
    echo "<script>window.location.href='index.php?error='" . $e->getMessage() . ";</script>";
    exit();
}