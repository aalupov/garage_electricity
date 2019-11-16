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

<title>GSK Sandal-4</title>
</head>
<body>
	<h1>
		<center>GSK Sandal-4</center>
	</h1>
	<center>
		<br> <a class="btn btn-primary btn-lg btn-block" href="general.php"
			role="button">General</a> <br> 
			
		<!-- Block to remove of member -->
	        <?php
        if (isset($_GET['index_id'])) {
            $index_id = $_GET['index_id'];
            $sql = "DELETE FROM garages WHERE garages.id = " . $index_id;
            $mysql->Query($sql);
            ?>
		<div class="alert alert-success" role="alert">This record has been
			removed!</div>
		<?php
        }
        ?>
        <!-- Block to remove the member -->

		<!-- Block to add the new member -->
        	<?php

        if (! empty($_POST['number_put']) && ! empty($_POST['name_put']) && ! empty($_POST['address_put']) && ! empty($_POST['phone_put'])) {
            $number_put = $_POST['number_put'];
            $name_put = $_POST['name_put'];
            $address_put = $_POST['address_put'];
            $phone_put = $_POST['phone_put'];
            $sql = "SELECT id FROM garages WHERE number = " . $number_put . " LIMIT 1";
            $mysql->Query($sql);
            $row = $mysql->Rows()[0];
            if ($row) {
                ?>
        <div class="alert alert-danger" role="alert">This record have
			been in DB already!</div>
		<br>

    <?php
            } else {
                $sql = "INSERT INTO garages (id, number, name, address, phone) 
             VALUES (NULL, " . $number_put . ", '" . $name_put . "', '" . $address_put . "', " . $phone_put . ")";
                $mysql->UpdateDb($sql);
                ?>
    		<div class="alert alert-success" role="alert">Data have been saved</div>
			<?php
            }
        }
        ?>
        <!-- Block to add the new member -->

		<!--Table of members-->
		<table class="table table-striped w-auto">

			<!--Table head-->
			<thead>
				<tr>
					<th>Number</th>
					<th>Name</th>
					<th>Address</th>
					<th>Phone</th>
					<th>Remove</th>
				</tr>
			</thead>
			<!--Table head-->
			<!--Table body-->
			<tbody>
<?php
$sql = "SELECT * FROM garages ORDER BY number";
$mysql->Query($sql);

foreach ($mysql->Rows() as $row) {
    if ($row["number"] & 1) {
        echo '<tr class="table-info">';
    }
    ?>
				<th scope="row"><a class="btn btn-primary"
					href="member.php?id=<?php echo $row["number"]; ?>" role="button"><?php echo $row["number"]; ?></a></th>
				<td><?php echo $row["name"]; ?></td>
				<td><?php echo $row["address"]; ?></td>
				<td><a href="tel:+7<?php echo $row["phone"]; ?>"><?php echo $row["phone"]; ?></a></td>
				<td><a class="btn btn-primary"
					href="index.php?index_id=<?php echo $row['id']; ?>" role="button"
					onclick="return confirm('Are you sure?')">Remove</a></td>
				</tr>
<?php
}
?>
  </tbody>
			<!--Table body-->
		</table>
		<!--Table of members-->
		<br>
		<!--Form to add new member-->
		<form action="index.php" method="post">
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<label class="input-group-text" for="number_put">Number</label>
				</div>
				<select class="custom-select" name="number_put" id="number_put">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
				</select>
			</div>
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputGroup-sizing-default">Name</span>
				</div>
				<input type="text" class="form-control" aria-label="name_put"
					name="name_put" aria-describedby="inputGroup-sizing-default">
			</div>
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputGroup-sizing-default">Address</span>
				</div>
				<input type="text" class="form-control" aria-label="address_put"
					name="address_put" aria-describedby="inputGroup-sizing-default">
			</div>
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputGroup-sizing-default">Phone</span>
				</div>
				<input type="number" class="form-control" aria-label="phone_put"
					name="phone_put" aria-describedby="inputGroup-sizing-default">
			</div>
			<br> <input class="btn btn-secondary btn-lg btn-block" type="submit"
				value="Add Member">
		</form>
		<!--Form to add new member-->
		<br>
	</center>
</body>
</html>




