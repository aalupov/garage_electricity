<?php
include_once ('includes/mysql.db.connect.php');
$mysql = new Database();
?>

<!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet"
	href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
	integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
	crossorigin="anonymous">
<title>GSK Sandal-4 - Edit</title>
</head>
<body>
	<center>
		<!--Block to show info of the garage -->
<?php
if (isset($_GET['garage_id'])) {
    $garage_id = $_GET['garage_id'];
    ?>
    <!--Block to update info of the garage -->
    <?php
    if (! empty($_POST['name_update']) && ! empty($_POST['address_update']) && ! empty($_POST['phone_update'])) {
        $name_update = $_POST['name_update'];
        $address_update = $_POST['address_update'];
        $phone_update = $_POST['phone_update'];
        $sql = "UPDATE garages SET name = '" . $name_update . "', address = '" . $address_update . "', phone = " . $phone_update . "
            WHERE id = " . $garage_id;
        $mysql->UpdateDb($sql);
        ?>
    		<div class="alert alert-success" role="alert">Data have been
			updated</div>
		<!--Block to update info of the garage -->
	<?php
    }
    $sql = "SELECT number,name,address,phone FROM garages WHERE id = " . $garage_id;
    $mysql->Query($sql);
    $result = $mysql->Rows();
    ?>
	<h3>
			<center>Garage #<?php echo $result[0]['number']; ?></center>
		</h3>
		<!--Block to show info of the garage -->
		<br> <a class="btn btn-primary btn-lg btn-block" href="index.php"
			role="button">Home</a> <br> <br>
		<!--Form to update info of the garage -->
		<h3>Update Info</h3>
		<br>
		<form action="edit.php?garage_id=<?php echo $garage_id; ?>"
			method="post">
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputGroup-sizing-default">Name*</span>
				</div>
				<input type="text" class="form-control" aria-label="name_update"
					name="name_update" aria-describedby="inputGroup-sizing-default"
					value="<?php echo $result[0]['name']; ?>">
			</div>
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputGroup-sizing-default">Address*</span>
				</div>
				<input type="text" class="form-control" aria-label="address_update"
					name="address_update" aria-describedby="inputGroup-sizing-default"
					value="<?php echo $result[0]['address']; ?>">
			</div>
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputGroup-sizing-default">Phone*</span>
				</div>
				<input type="number" class="form-control" aria-label="phone_update"
					name="phone_update" aria-describedby="inputGroup-sizing-default"
					value="<?php echo $result[0]['phone']; ?>">
			</div>
			<br> <input class="btn btn-secondary btn-lg btn-block" type="submit"
				value="Update Data">
		</form>
<?php
}
?>			
		<!--Form to update info of the garage -->

		<br>
		<!--Block to show info of the member -->
<?php
if (isset($_GET['data_id'])) {
    $data_id = $_GET['data_id'];
    ?>
    <!--Block to update info of electrocity -->
    <?php
    if (! empty($_POST['data_update']) && ! empty($_POST['paid_update'])) {
        $data_update = $_POST['data_update'];
        $paid_update = $_POST['paid_update'];
        if (! empty($_POST['prepaid_update'])) {
            $prepaid_update = $_POST['prepaid_update'];
        } else {
            $prepaid_update = 'NULL';
        }
        if (! empty($_POST['salary_update'])) {
            $salary_update = $_POST['salary_update'];
        } else {
            $salary_update = 'NULL';
        }
        $sql = "UPDATE data SET data = " . $data_update . ", paid = " . $paid_update . ", 
            prepaid = " . $prepaid_update . ", salary = " . $salary_update . "
            WHERE id = " . $data_id;
        $mysql->UpdateDb($sql);
        ?>
    		<div class="alert alert-success" role="alert">Data have been
			updated</div>
		<!--Block to update info of electrocity -->
	<?php
    }
    $sql = "SELECT * FROM data WHERE id = " . $data_id;
    $mysql->Query($sql);
    $result = $mysql->Rows();
    ?>
	<h3>
			<center>Garage #<?php echo $result[0]['garage_id']; ?> - Year - <?php echo $result[0]['year']; ?> - 
			Quarter - <?php echo $result[0]['quarter']; ?></center>
		</h3>
		<!--Block to show info of the member -->
		<br> <a class="btn btn-primary btn-lg btn-block" href="index.php"
			role="button">Home</a> <br> <br>
		<!--Form to update info of electrocity -->

		<h3>Update Data</h3>
		<br>
		<form action="edit.php?data_id=<?php echo $data_id; ?>" method="post">
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputGroup-sizing-default">Data*</span>
				</div>
				<input type="text" class="form-control" aria-label="data_update"
					name="data_update" aria-describedby="inputGroup-sizing-default"
					value="<?php echo $result[0]['data']; ?>">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputGroup-sizing-default">Paid*</span>
				</div>
				<input type="text" class="form-control" aria-label="paid_update"
					name="paid_update" aria-describedby="inputGroup-sizing-default"
					value="<?php echo $result[0]['paid']; ?>">
			</div>
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputGroup-sizing-default">Prepaid</span>
				</div>
				<input type="text" class="form-control" aria-label="prepaid_update"
					name="prepaid_update" aria-describedby="inputGroup-sizing-default"
					value="<?php echo $result[0]['prepaid']; ?>">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputGroup-sizing-default">Salary</span>
				</div>
				<input type="text" class="form-control" aria-label="salary_update"
					name="salary_update" aria-describedby="inputGroup-sizing-default"
					value="<?php echo $result[0]['salary']; ?>">
			</div>
			<br> <input class="btn btn-secondary btn-lg btn-block" type="submit"
				value="Update Data">
		</form>
		<br> <a class="btn btn-primary btn-lg btn-block"
			href="member.php?id=<?php echo $result[0]['garage_id']; ?>"
			role="button">Back</a> <br> <br>
<?php
}
?>			
		<!--Form to update info of electrocity -->

		<br>
		<!--Block to show the current general info -->
<?php
if (isset($_GET['general_id'])) {
    $general_id = $_GET['general_id'];
    ?>
    <!--Block to update general info of electrocity -->
    <?php
    if (! empty($_POST['data_general_update'])) {
        $data_general_update = $_POST['data_general_update'];
        $sql = "UPDATE general SET data = " . $data_general_update . "
            WHERE id = " . $general_id;
        $mysql->UpdateDb($sql);
        ?>
    		<div class="alert alert-success" role="alert">Data have been
			updated</div>
		<!--Block to update info of electrocity -->
	<?php
    }
    $sql = "SELECT * FROM general WHERE id = " . $general_id;
    $mysql->Query($sql);
    $result = $mysql->Rows();
    ?>
	<h3>
			<center>Year - <?php echo $result[0]['year']; ?> - 
			Quarter - <?php echo $result[0]['quarter']; ?></center>
		</h3>
		<!--Block to show the current general info -->
		<br> <a class="btn btn-primary btn-lg btn-block" href="index.php"
			role="button">Home</a> <br> <br>
		<!--Form to update general info of electrocity -->

		<h3>Update Data</h3>
		<br>
		<form action="edit.php?general_id=<?php echo $general_id; ?>"
			method="post">
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputGroup-sizing-default">Data*</span>
				</div>
				<input type="text" class="form-control"
					aria-label="data_general_update" name="data_general_update"
					aria-describedby="inputGroup-sizing-default"
					value="<?php echo $result[0]['data']; ?>">
			</div>
			<br> <input class="btn btn-secondary btn-lg btn-block" type="submit"
				value="Update Data">
		</form>
		<br> <a class="btn btn-primary btn-lg btn-block" href="general.php"
			role="button">Back</a> <br> <br>
<?php
}
?>			
		<!--Form to update general info of electrocity -->
		<br>
	</center>
</body>
</html>