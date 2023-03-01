<?php 

require_once 'C:\xampp\htdocs\php-test\Model\Core\adapter.php';

$employeeNumber= $_GET['id'];
$sql = "SELECT `customerNumber` from `customers` where `salesRepEmployeeNumber` ='$employeeNumber' ";
$adapter = new Model_Core_Adapter;
$customers = $adapter->fetchRow($sql);
$customerNumber  = $customers['customerNumber'];
$query = "SELECT * from `orders` where `customerNumber`= {$customerNumber}";
$adapter = new Model_Core_Adapter;
$orders = $adapter->fetchAll($query);

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<table>
		<tr>
			<td> ORDER STATUS:
				<select>
				<?php foreach ($orders as $status): ?> 
					<option><?php echo $status['status'];?></option>
				<?php endforeach; ?>
				</select>
			</td>
			<td> ORDER DATE:
				<select>
				<?php foreach ($orders as $status): ?> 
					<option><?php echo $status['orderDate'];?></option>
				<?php endforeach; ?>
				</select>
			</td>
			<td> CUSTOMER:
				<select>
				<?php foreach ($orders as $status): ?> 
					<option><?php echo $status['status'];?></option>
				<?php endforeach; ?>
				</select>
			</td>
			<td>
				<input type="submit" name="submit">
			</td>
		</tr>
	</table>
	<br>
	<br>
	<table border="1" width="100%">
		<tr>
			<td>Order Number</td>
			<td>Order Date</td>
			<td>Shipped Date</td>
			<td>Comment</td>	
			<td>Status</td>
		</tr>
		<?php foreach ($orders as $order):?> 
		<tr>
			<td><?php echo $order['orderNumber']?></td>
			<td><?php echo $order['orderDate']?></td>
			<td><?php echo $order['shippedDate']?></td>
			<td width="500px"><?php echo $order['comments']?></td>
			<td><?php echo $order['status']?></td>
		</tr>
		<?php 
		endforeach;
		?>
	</table>
</body>
</html>