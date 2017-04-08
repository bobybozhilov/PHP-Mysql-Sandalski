<?php include 'includes/layouts/header.php'; ?>
<?php
$name = "";
$quantity =0;
$total = 0;
$tax = 0;
$ez = 0;

$name = $_POST['name'];
$quantity =  $_POST['quantity'];
$total= $_POST['total'];
$tax = $_POST['tax'];

$ez=$total/($quantity*(1+0.01*$tax));
$ez=round($ez,2);
?>

<h2>Стока от магазин "Успех" Пловдив</h2>

<h4 class="text-center">Изчисляване на единична цена на стока без ДДС</h4>

<table class="table table-bordered">
	<tbody class="text-center">
		<tr>
			<td>Име на стоката</td>
			<td><?php echo $name ?></td>
		</tr>
		<tr>
			<td>Количество</td>
			<td><?php echo $quantity ?></td>
		</tr>
		<tr>
			<td>Обща сума с ДДС</td>
			<td><?php echo $total ?></td>
		</tr>
		<tr>
			<td>ДДС %</td>
			<td><?php echo $tax ?></td>
		</tr>
		<tr>
			<td>Единична цена без ДДС</td>
			<td><?php echo $ez ?></td>
		</tr>
	</tbody>
</table>	

<a href="zad1-index.php">Обратно</a>

<?php include 'includes/layouts/footer.php'; ?>
