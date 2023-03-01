<?php

require_once 'C:\xampp\htdocs\php-test\Model\Core\adapter.php';


// echo "<pre>";
$adapter = new Model_Core_Adapter();
$firstname = $_POST['firstname'];
// print_r($firstname);
$emailAddress = $_POST['email'];
$reportsTo = $_POST['reportsTo'];
$city = $_POST['city'];


$query = "SELECT DISTINCT employees.*, offices.city FROM `employees` LEFT JOIN `offices` ON employees.officeCode = offices.officeCode ;";
$empl = $adapter->fetchAll($query);

$query_re = "SELECT DISTINCT employees.reportsTo FROM `employees` LEFT JOIN `offices` ON employees.officeCode = offices.officeCode ;";
$empl_re = $adapter->fetchAll($query_re);


$query_city = "SELECT `city` FROM `offices` ;";
$citys = $adapter->fetchAll($query_city);


if ($firstname	== null && $email = null && $reportsTo	== null && $city = null ) {
	$sql = "SELECT employees.*, offices.city FROM `employees` LEFT JOIN `offices` ON employees.officeCode = offices.officeCode;";
}
else if ($firstname	!= null ) {
	$sql = "SELECT employees.*, offices.city FROM `employees` LEFT JOIN `offices` ON employees.officeCode = offices.officeCode WHERE employees.firstName = '$firstname'";
}
else if ($emailAddress != null) {
	$sql = "SELECT employees.*, offices.city FROM `employees` LEFT JOIN `offices` ON employees.officeCode = offices.officeCode WHERE employees.email = '$emailAddress'";
}
else if ($reportsTo	!= null) {
	$sql = "SELECT  employees.*, offices.city FROM `employees` LEFT JOIN `offices` ON employees.officeCode = offices.officeCode WHERE employees.reportsTo = {$reportsTo}";
}
else if ($city	!= null) {
	$sql = "SELECT employees.*, offices.city FROM `employees` LEFT JOIN `offices` ON employees.officeCode = offices.officeCode WHERE offices.city = '$city'";
}
else{
	$sql = "SELECT employees.*, offices.city FROM `employees` LEFT JOIN `offices` ON employees.officeCode = offices.officeCode ;";
}


$employees = $adapter->fetchAll($sql);


?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form method="POST">
	<table border="1" width="100%">
		<tr align="center">

			<td> Employee First Name :
				<select name="firstname">
					<option value="">please</option>
					<?php foreach ($empl as $firstName): ?> 
					<option value="<?php echo $firstName['firstName'];?>"><?php echo $firstName['firstName'];?></option>
					<?php endforeach; ?>
				</select>
			</td>
			<td> Employee Email :
				<select name="email">
					<option></option>
				<?php foreach ($empl as $email): ?> 
					<option value="<?php echo $email['email'];?>"><?php echo $email['email'];?></option>
				<?php endforeach; ?></select>
			</td>
			<td> Report To :
				<select name="reportsTo">
				<?php foreach ($empl_re as $reportsTo): ?> 
					<option><?php echo $reportsTo['reportsTo'];?></option>
				<?php endforeach; ?></select>
			</td>
			<td> Office City :
				<select name="city">
					<option></option>
				<?php foreach ($citys as $city): ?> 
					<option><?php echo $city['city'];?></option>
				<?php endforeach; ?></select>
			</td>
			<td>
				<input type="submit" value="submit">
				
			</td>
		</tr>
			
	</table>
	<br>
	<br>
	<table border="1" width="100%">
		<tr>
			<th>Employee Number</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Office City</th>
			<th>Report To</th>
			<th>Job Title</th>
			<th>Action View Employee</th>
		</tr>
		<?php foreach($employees as $Empolyee): ?>
		<tr>
			<td><?php echo $Empolyee['employeeNumber']?></td>
			<td><?php echo $Empolyee['firstName']?></td>
			<td><?php echo $Empolyee['lastName']?></td>
			<td><?php echo $Empolyee['email']?></td>
			<td><?php echo $Empolyee['city']?></td>
			<td><?php echo $Empolyee['reportsTo']?></td>
			<td><?php echo $Empolyee['jobTitle']?></td>
			<td><a href="order.php?id=<?php echo $Empolyee['employeeNumber']?>">View</a></td>
		</tr>
		
		<?php 
		endforeach;
		?>
	</table>
</form>
</body>
</html>