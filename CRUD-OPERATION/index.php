<?php

spl_autoload_register(function($class){
	include "classes/".$class.".php";
});


?>



<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<title>Crud Operation</title>
</head>
<body style="background: #496166">

<header>
	<div class="container pt-5 pb-3">
		<h6 class="float-left text-light mt-2">CRUD With PDO - Template & Database Design</h6>
		<a href="index.php" class="float-right btn btn-info">Create New</a>
		<hr style="height: 6px; background: #37474a;" class="mt-5">
	</div>
</header>

<!-- Form part -->
<div id="form-part" class="">
	<div class="container">


<?php
/* this code for insert data */
$user = new Student();
if (isset($_POST['create'])) {
	$name = $_POST['name'];
	$dpt = $_POST['dpt'];
	$age = $_POST['age'];

	$user->setName($name);
	$user->setDpt($dpt);
	$user->setAge($age);

	if ($user->insertData()) {
		echo "<span class='text-warning font-weight-bold'>Data insert successfull</span>";
	}
}

/* this code for edit data */

if (isset($_POST['edit'])) {
	$id = $_POST['id'];
	$name = $_POST['name'];
	$dpt = $_POST['dpt'];
	$age = $_POST['age'];

	$user->setName($name);
	$user->setDpt($dpt);
	$user->setAge($age);

	if ($user->Update($id)) {
		echo "<span class='text-warning font-weight-bold'>Data Update successfull</span>";
	}
}


?>

<!-- This code for delete a data -->

<?php
	
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
		$id = (int)$_GET['id'];
		if ($user->Delete($id)) {
		echo "<span class='text-danger font-weight-bold'>Data Deleted successfull</span>";
	}
}

?>

<!-- Read all data for edit -->
<?php
	if (isset($_GET['action']) && $_GET['action'] == 'edit') {
		$id = (int)$_GET['id'];
		$result = $user->readById($id);

?>

		<div class="row">
			<div class="col-md-4">
				<form action="" method="post">
					<table style="width: 100%; ">
						<tr>
							<!-- This is hidden field for id -->
							<input type="hidden" value="<?php echo $result['id'] ?>" name="id">

							<td class="text-light">Name : </td>
							<td><input class="form-control form-control-sm bg-dark text-light" type="text" value="<?php echo $result['name'] ?>" name="name" required="1"></td>
						</tr>
						<tr>
							<td class="text-light">Dptartment : </td>
							<td><input class="form-control form-control-sm mt-2 bg-dark text-light" type="text" value="<?php echo $result['dpt'] ?>" name="dpt" required="1"></td>
						</tr>
						<tr>
							<td class="text-light">Age : </td>
							<td><input class="form-control form-control-sm mt-2 bg-dark text-light" type="text" value="<?php echo $result['age'] ?>" name="age" required="1"></td>
						</tr>
						<tr>
							<td> </td>
							<td><input class="btn btn-secondary btn-sm mt-2" type="submit" name="edit"></td>
						</tr>
					</table>
				</form>
			</div>
		</div>

<?php } else {
	


?>
		<div class="row">
			<div class="col-md-4" style="border-right: 1px dotted black;">
				<form action="" method="post">
					<table style="width: 100%; ">
						<tr>
							<td class="text-light">Name : </td>
							<td><input class="form-control form-control-sm bg-dark text-light" type="text" placeholder="Your Name..." name="name" required="1"></td>
						</tr>
						<tr>
							<td class="text-light">dptartment : </td>
							<td><input class="form-control form-control-sm mt-2 bg-dark text-light" type="text" placeholder="Your Name..." name="dpt" required="1"></td>
						</tr>
						<tr>
							<td class="text-light">Age : </td>
							<td><input class="form-control form-control-sm mt-2 bg-dark text-light" type="text" placeholder="Your Name..." name="age" required="1"></td>
						</tr>
						<tr>
							<td> </td>
							<td><input class="btn btn-secondary btn-sm mt-2" type="submit" placeholder="Your Name..." name="create"></td>
						</tr>
					</table>
				</form>
			</div>
<?php
}
?>
			<div class="col-md-8 mt-3 mt-md-0">
				<table class="table table-striped table-dark text-center">
				  <thead>
				    <tr>
				      <th>No</th>
				      <th>Name</th>
				      <th>dptartment</th>
				      <th>Age</th>
				      <th>Action</th>
				    </tr>
				  </thead>

<?php


foreach ($user->readAll() as $key => $value) {

?>
				  <tbody>
				    <tr>
				      <td><?php echo $value['id']; ?></td>
				      <td><?php echo $value['name']; ?></td>
				      <td><?php echo $value['dpt']; ?></td>
				      <td><?php echo $value['age']; ?></td>
					      <td>
						      <?php echo "<a class='btn btn-warning mt-2 mt-md-0' href='index.php?action=edit&id=".$value['id']."'>Edit</a>";?>

						      <?php echo "<a class='btn btn-danger mt-2 mt-md-0' href='index.php?action=delete&id=".$value['id']."' onclick='return confirm(\"Are you sure to delete this data......\")'>Delete</a>";?>
					    </td>
				    </tr> 
				  </tbody>

<?php

}

?>
				</table>
			</div>
		</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>