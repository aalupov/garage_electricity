<?php
include_once ('includes/mysql.db.connect.php');
$mysql = new Database();
$tariff = 3.52;
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
<title>GSK Sandal-4 - General</title>
</head>
<body>
	<center>
		<h3>GSK Sandal-4 - General</h3>
		<br> <a class="btn btn-primary btn-lg btn-block" href="index.php"
			role="button">Home</a> <br>
		<!--Block to add the new data-->			
										<?php

        if (isset($_POST['year_put'])) {

            $year_put = $_POST['year_put'];
            $quarter_put = $_POST['quarter_put'];
            $data_put = $_POST['data_put'];
            $sql = "SELECT id,data,quarter,year FROM general WHERE year = " . $year_put . " 
              AND quarter = " . $quarter_put . " ORDER BY year LIMIT 1";
            $mysql->Query($sql);
            $row = $mysql->Rows()[0];
            if ($row) {
                ?>
        <div class="alert alert-danger" role="alert">This record have
			been in DB already!</div>
		<br>
		<!--Table-->
		<table class="table table-striped w-auto">
			<!--Table head-->
			<thead>
				<tr>
					<th>Year</th>
					<th>Quarter</th>
					<th>Data</th>
					<th>Remove</th>
				</tr>
			</thead>
			<!--Table head-->
			<!--Table body-->
			<tbody>
				<tr class="table-info">
					<th scope="row"><?php echo $row['year']; ?></th>
					<td><?php echo $row['quarter']; ?></td>
					<td><?php echo $row['data']; ?></td>
					<td><a class="btn btn-danger"
						href="general.php?index_id=<?php echo $row['id']; ?>"
						role="button" onclick="return confirm('Are you sure?')">Remove</a></td>
				</tr>
			</tbody>
			<!--Table body-->
		</table>
		<!--Table-->
		<br>

    <?php
            } else {
                $sql = "INSERT INTO general (id,quarter, year, data) 
             VALUES (NULL, " . $quarter_put . ", " . $year_put . ", " . $data_put . ")";
                $mysql->UpdateDb($sql);
                ?>
    		<div class="alert alert-success" role="alert">Data have been saved</div>
			<?php
            }
        }
        ?>
<!--Block to add the new data-->

		<!--Block to count the payment for electricity-->	        
 <?php
if (! empty($_POST['data_count'])) {
    $data_count = $_POST['data_count'];
    $sql = "SELECT data FROM general ORDER BY year,quarter";
    $mysql->Query($sql);
    $row = $mysql->Rows();
    $max = sizeof($row);
    $count_to_pay = $tariff * ($data_count - $row[$max - 1]['data']);
    ?>
    <div class="alert alert-success" role="alert">Should pay - <?php echo $count_to_pay; ?></div>
    <?php
}
?>
<!--Block to count the payment for electricity-->

		<!--Block to remove the data of electricity-->	       
        <?php
        if (isset($_GET['index_id'])) {
            $index_id = $_GET['index_id'];
            $sql = "DELETE FROM general WHERE general.id = " . $index_id;
            $mysql->Query($sql);
            ?>
		<div class="alert alert-success" role="alert">This record has been
			removed!</div>
		<?php
        }
        ?>
<!--Block to remove the data of electricity-->

		<!--Block to get the current data for electricity-->
		<form action="general.php" method="post">
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<label class="input-group-text" for="year">Year</label>
				</div>
				<select class="custom-select" name="year" id="year">
					<option selected>NULL</option>
					<option value="2019">2019</option>
					<option value="2020">2020</option>
					<option value="2021">2021</option>
					<option value="2022">2022</option>
					<option value="2023">2024</option>
				</select>
				<div class="input-group-prepend">
					<label class="input-group-text" for="quarter">Quarter</label>
				</div>
				<select class="custom-select" name="quarter" id="quarter">
					<option selected>NULL</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select>
			</div>
			<br> <input class="btn btn-secondary btn-lg btn-block" type="submit"
				value="Get Data">
		</form>
		<br>

<?php

if (isset($_POST['year'])) {
    ?>
    		<!--Table-->
		<table class="table table-striped w-auto">

			<!--Table head-->
			<thead>
				<tr>
					<th>Year</th>
					<th>Quarter</th>
					<th>Data</th>
					<th>Edit</th>
					<th>Remove</th>
				</tr>
			</thead>
			<!--Table head-->
			<!--Table body-->
			<tbody>
	<?php

    if ($_POST['year'] != 'NULL' && $_POST['quarter'] != 'NULL') {
        $year = $_POST['year'];
        $quarter = $_POST['quarter'];
        $sql = "SELECT id,year,quarter,data FROM general WHERE quarter = " . $quarter . " 
          AND year = " . $year . " ORDER BY year";
    } elseif ($_POST['year'] != 'NULL' && $_POST['quarter'] == 'NULL') {
        $year = $_POST['year'];
        $sql = "SELECT id,year,quarter,data FROM general WHERE year = " . $year . " ORDER BY year";
    } elseif ($_POST['year'] == 'NULL' && $_POST['quarter'] == 'NULL') {
        $sql = "SELECT * FROM general ORDER BY year";
    }
    $mysql->Query($sql);
    foreach ($mysql->Rows() as $row) {
        if ($quarter) {
            $quart = $quarter;
        } else {
            $quart = $row['quarter'];
        }
        $index_id = $row['id'];
        $year = $row['year'];
        $data = $row['data'];

        ?>
				<tr class="table-info">
					<th scope="row"><?php echo $year; ?></th>
					<td><?php echo $quart; ?></td>
					<td><?php echo $data; ?></td>
					<td><a class="btn btn-primary"
						href="edit.php?general_id=<?php echo $index_id; ?>" role="button">Edit</a></td>
					<td><a class="btn btn-danger"
						href="general.php?index_id=<?php echo $index_id; ?>"
						role="button" onclick="return confirm('Are you sure?')">Remove</a></td>
				</tr>
		<?php
    }
    ?>
    			</tbody>
			<!--Table body-->
		</table>
		<!--Table-->
		<br>
    <?php
}

?>
<!--Block to get the current data of electricity-->
		<br>
		<!--Form to count for electricity-->
		<h3>Counting</h3>
		<br>
		<form action="general.php" method="post">
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputGroup-sizing-default">Data</span>
				</div>
				<input type="number" class="form-control" aria-label="data_count"
					name="data_count" aria-describedby="inputGroup-sizing-default">
			</div>
			<br> <input class="btn btn-secondary btn-lg btn-block" type="submit"
				value="Count">
		</form>
		<!--Form to count for electricity-->
		<br>
		<!--Form to add new data for electricity-->
		<h3>Put New Data</h3>
		<br>
		<form action="general.php" method="post">
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<label class="input-group-text" for="year_put">Year*</label>
				</div>
				<select class="custom-select" name="year_put" id="year_put">
					<option value="2019">2019</option>
					<option value="2020">2020</option>
					<option value="2021">2021</option>
					<option value="2022">2022</option>
					<option value="2023">2024</option>
				</select>
				<div class="input-group-prepend">
					<label class="input-group-text" for="quarter_put">Quarter*</label>
				</div>
				<select class="custom-select" name="quarter_put" id="quarter_put">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select>
			</div>
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputGroup-sizing-default">Data*</span>
				</div>
				<input type="number" class="form-control" aria-label="data_put"
					name="data_put" aria-describedby="inputGroup-sizing-default" required="required">
			</div>

			<br> <input class="btn btn-secondary btn-lg btn-block" type="submit"
				value="Save Data">
		</form>
		<!--Form to add new data for electricity-->
		<br>
	</center>
</body>
</html>
