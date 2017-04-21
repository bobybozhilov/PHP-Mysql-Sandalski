<?php include 'includes/layouts/header.php'; ?>

<?php
$ware_val=$accoutance_val$placement_val=0;

if(isset($_POST['ware']) && 
$_POST['ware'] == 'Yes') 
{
echo "Need wheelchair access.";
}

$ware_val=$_POST['name'];;
$accoutance_val=200;
$placement_val=250;

$bgn = 'лева';

function namebuilder($name, $val, $currency ){
	return $name . ' ' . $val . ' ' . $currency;
}
$name = "";
$name = $_POST['name'];

$price = 0;
$price =  $_POST['price'];

$year = 0;
$year= $_POST['year'];

$overhaul = 0;
$overhaul = $_POST['overhaul'];

$new_price = 0;
$new_price = $price;

if( (date("Y") - $year)>=5){
	$new_price = $price * (1- (0.01 * $overhaul) );
}
?>

<h2>Основно средство</h2>

<h4 class="text-center">Изчисляване на единична цена на стока без ДДС</h4>

<table class="table col-sm-8 table-bordered">
	<tbody class="text-center">
		<tr>
			<td class="col-sm-9">Име на средството</td>
			<td><?php echo $name ?></td>
		</tr>
		<tr>
			<td>Стойност при закупуване</td>
			<td><?php echo $price ?></td>
		</tr>
		<tr>
			<td>Година на закупуване</td>
			<td><?php echo $year ?></td>
		</tr>
		<tr>
			<td>% за амортизация</td>
			<td><?php echo $overhaul ?></td>
		</tr>
		<tr>
			<td>Стойност след проверка за амортизация</td>
			<td><?php echo $new_price ?></td>
		</tr>
	</tbody>
</table>	

<a href="zad4-index.php">Обратно</a>

<?php include 'includes/layouts/footer.php'; ?>