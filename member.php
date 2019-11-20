<?php
include_once ('includes/mysql.db.connect.php');
$mysql = new Database();
$id = $_REQUEST['id'];
$tariff = 3.7;
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

	<!--Block to show info of the member-->
<?php
$sql = "SELECT name FROM garages WHERE number = " . $id;
$mysql->Query($sql);
$result = $mysql->Rows();
?>
	<h3>
		<center>Garage #<?php echo $id; ?> - <?php echo $result[0]["name"]; ?></center>
	</h3>
	<center>
		<br> <a class="btn btn-primary btn-lg btn-block" href="index.php"
			role="button">Home</a> <br> <br>
		<!--Block to show info of the member-->

		<!--Block to add the new payment-->			
										<?php

        if (isset($_POST['year_put'])) {

            if (! empty($_POST['prepaid_put'])) {
                $prepaid_put = $_POST['prepaid_put'];
            } else {
                $prepaid_put = 'NULL';
            }
            if (! empty($_POST['salary_put'])) {
                $salary_put = $_POST['salary_put'];
            } else {
                $salary_put = 'NULL';
            }
            $year_put = $_POST['year_put'];
            $quarter_put = $_POST['quarter_put'];
            $data_put = $_POST['data_put'];
            $payment = $_POST['payment'];
            $sql = "SELECT id,quarter,data,paid,prepaid,year,salary FROM data WHERE garage_id = " . $id . "
     AND year = " . $year_put . " AND quarter = " . $quarter_put . " ORDER BY year LIMIT 1";
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
					<th>Paid</th>
					<th>Prepaid</th>
					<th>Salary</th>
					<th>Edit</th>
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
					<td><?php echo $row['paid']; ?></td>
					<td><?php echo $row['prepaid']; ?></td>
					<td><?php echo $row['salary']; ?></td>
					<td><a class="btn btn-primary"
						href="edit.php?data_id=<?php echo $row['id']; ?>" role="button">Edit</a></td>
					<td><a class="btn btn-danger"
						href="member.php?id=<?php echo $id; ?>&index_id=<?php echo $row['id']; ?>"
						role="button" onclick="return confirm('Are you sure?')">Remove</a></td>
				</tr>
			</tbody>
			<!--Table body-->
		</table>
		<!--Table-->
		<br>

    <?php
            } else {
                $sql = "INSERT INTO data (id, garage_id, quarter, year, data, paid, prepaid, salary) 
             VALUES (NULL, " . $id . ", " . $quarter_put . ", " . $year_put . ", " . $data_put . ", " . $payment . ", " . $prepaid_put . ", " . $salary_put . ")";
                $mysql->UpdateDb($sql);
                ?>
    		<div class="alert alert-success" role="alert">Data have been saved</div>
			<?php
            }
        }
        ?>
<!--Block to add the new payment-->

		<!--Block to count the payment for electricity-->	        
 <?php
if (! empty($_POST['data_count'])) {
    $data_count = $_POST['data_count'];
    $sql = "SELECT data,prepaid FROM data WHERE garage_id = " . $id . "
     AND NOT (paid = 0) ORDER BY year,quarter";
    $mysql->Query($sql);
    $row = $mysql->Rows();
    $max = sizeof($row);
    $count_to_pay = $tariff * ($data_count - $row[$max - 1]['data']) - $row[$max - 1]['prepaid'];
    ?>
    <div class="alert alert-success" role="alert">Should pay - <?php echo $count_to_pay; ?></div>
    <?php
}
?>
<!--Block to count the payment for electricity-->

		<!--Block to remove the payment for electricity-->	       
        <?php
        if (isset($_GET['index_id'])) {
            $index_id = $_GET['index_id'];
            $sql = "DELETE FROM data WHERE data.id = " . $index_id;
            $mysql->Query($sql);
            ?>
		<div class="alert alert-success" role="alert">This record has been
			removed!</div>
		<?php
        }
        ?>
<!--Block to remove the payment for electricity-->

		<!--Block to get the current data for electricity-->
		<form action="member.php?id=<?php echo $id; ?>" method="post">
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<label class="input-group-text" for="year">Year</label>
				</div>
				<select class="custom-select" name="year" id="year">
					<option selected>NULL</option>
					<option value="2016">2016</option>
					<option value="2017">2017</option>
					<option value="2018">2018</option>
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
					<th>Paid</th>
					<th>Prepaid</th>
					<th>Salary</th>
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
        $sql = "SELECT id,year,data,paid,prepaid,salary FROM data WHERE garage_id = " . $id . " 
     AND quarter = " . $quarter . " AND year = " . $year . " ORDER BY year";
    } elseif ($_POST['year'] != 'NULL' && $_POST['quarter'] == 'NULL') {
        $year = $_POST['year'];
        $sql = "SELECT id,year,quarter,data,paid,prepaid,salary FROM data WHERE garage_id = " . $id . "
     AND year = " . $year . " ORDER BY year,quarter";
    } elseif ($_POST['year'] == 'NULL' && $_POST['quarter'] == 'NULL') {
        $sql = "SELECT * FROM data WHERE garage_id = " . $id . " ORDER BY year,quarter";
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
        $paid = $row['paid'];
        $salary = $row['salary'];
        $prepaid = $row['prepaid'];

        ?>
				<tr class="table-info">
					<th scope="row"><?php echo $year; ?></th>
					<td><?php echo $quart; ?></td>
					<td><?php echo $data; ?></td>
					<td><?php echo $paid; ?></td>
					<td><?php echo $prepaid; ?></td>
					<td><?php echo $salary; ?></td>
					<td><a class="btn btn-primary"
						href="edit.php?data_id=<?php echo $index_id; ?>" role="button">Edit</a></td>
					<td><a class="btn btn-danger"
						href="member.php?id=<?php echo $id; ?>&index_id=<?php echo $index_id; ?>"
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
<!--Block to get the current data for electricity-->
		<br>
		<!--Form to count for electricity-->
		<h3>Counting</h3>
		<br>
		<form action="member.php?id=<?php echo $id; ?>" method="post">
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
		<form action="member.php?id=<?php echo $id; ?>" method="post">
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<label class="input-group-text" for="year_put">Year*</label>
				</div>
				<select class="custom-select" name="year_put" id="year_put">
					<option value="2018">2018</option>
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
					name="data_put" aria-describedby="inputGroup-sizing-default"
					required="required">
			</div>
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputGroup-sizing-default">Payment*</span>
				</div>
				<input type="number" class="form-control" aria-label="payment"
					name="payment" aria-describedby="inputGroup-sizing-default"
					required="required">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputGroup-sizing-default">Prepaid</span>
				</div>
				<input type="number" class="form-control" aria-label="prepaid_put"
					name="prepaid_put" aria-describedby="inputGroup-sizing-default">
			</div>
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputGroup-sizing-default">Salary</span>
				</div>
				<input type="number" class="form-control" aria-label="salary_put"
					name="salary_put" aria-describedby="inputGroup-sizing-default">
			</div>
			<br> <input class="btn btn-secondary btn-lg btn-block" type="submit"
				value="Save Data">
		</form>
		<!--Form to add new data for electricity-->
		<br>
		<!--Block to get the current data by all members-->
		<form action="member.php?id=<?php echo $id; ?>" method="post">
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<label class="input-group-text" for="year_all">Year</label>
				</div>
				<select class="custom-select" name="year_all" id="year_all">
					<option selected>NULL</option>
					<option value="2019">2019</option>
					<option value="2020">2020</option>
					<option value="2021">2021</option>
					<option value="2022">2022</option>
					<option value="2023">2024</option>
				</select>
				<div class="input-group-prepend">
					<label class="input-group-text" for="quarter_all">Quarter</label>
				</div>
				<select class="custom-select" name="quarter_all" id="quarter_all">
					<option selected>NULL</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select>
			</div>
			<br> <input class="btn btn-secondary btn-lg btn-block" type="submit"
				value="Get Data by Everybody">
		</form>
		<br>

<?php

if (isset($_POST['year_all'])) {
    ?>
    		<!--Table-->
		<table class="table table-striped w-auto">

			<!--Table head-->
			<thead>
				<tr>
					<th>Number</th>
					<th>Name</th>
					<th>Year</th>
					<th>Quarter</th>
					<th>Data</th>
					<th>Paid</th>
					<th>Prepaid</th>
					<th>Salary</th>
				</tr>
			</thead>
			<!--Table head-->
			<!--Table body-->
			<tbody>
	<?php

    if ($_POST['year_all'] != 'NULL' && $_POST['quarter_all'] != 'NULL') {
        $year = $_POST['year_all'];
        $quarter = $_POST['quarter_all'];
        $sql = "SELECT garages.number,garages.name,data.year,data.quarter,data.data,data.paid,data.prepaid,data.salary FROM data, garages 
          WHERE data.quarter = " . $quarter . " 
          AND data.year = " . $year . " 
          AND data.garage_id = garages.number 
          ORDER BY data.garage_id";
    } elseif ($_POST['year_all'] != 'NULL' && $_POST['quarter_all'] == 'NULL') {
        $year = $_POST['year_all'];
        $sql = "SELECT garages.number,garages.name,data.year,data.quarter,data.data,data.paid,data.prepaid,data.salary FROM data,garages 
          WHERE data.year = " . $year . " 
          AND data.garage_id = garages.number 
          ORDER BY data.garage_id";
    } elseif ($_POST['year_all'] == 'NULL' && $_POST['quarter_all'] == 'NULL') {
        $sql = "SELECT garages.number,garages.name,data.year,data.quarter,data.data,data.paid,data.prepaid,data.salary FROM data,garages  
         WHERE data.garage_id = garages.number
         ORDER BY data.garage_id";
    }
    $mysql->Query($sql);
    foreach ($mysql->Rows() as $row) {
        if ($quarter) {
            $quart = $quarter;
        } else {
            $quart = $row['quarter'];
        }
        $number = $row['number'];
        $name = $row['name'];
        $year = $row['year'];
        $data = $row['data'];
        $paid = $row['paid'];
        $salary = $row['salary'];
        $prepaid = $row['prepaid'];

        ?>
				<tr class="table-info">
					<th scope="row"><?php echo $number; ?></th>
					<td><?php echo $name; ?></td>
					<td><?php echo $year; ?></td>
					<td><?php echo $quart; ?></td>
					<td><?php echo $data; ?></td>
					<td><?php echo $paid; ?></td>
					<td><?php echo $prepaid; ?></td>
					<td><?php echo $salary; ?></td>
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
<!--Block to get the current data by all members-->
		<br>
	</center>
</body>
</html>
