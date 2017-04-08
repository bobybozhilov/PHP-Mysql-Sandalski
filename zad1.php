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
<!--link href="css/bootstrap.css" rel="stylesheet">
<html>
	<body>

<div class="container"-->
	<h2>Стока от магазин "Успех" Пловдив</h2>
	<p>изчисляване на единична цена на стока без ДДС</p>

<div class="panel panel-default">
<?php
echo "Name: ".$name."<br>";
echo "Quantity: ".$quantity.'<br>' ;
echo "Total: ".$total.'<br>';
echo "Tax: ".$tax.'<br>';
echo "Single one: ". $ez;
?>
</div>

<?php include 'includes/layouts/footer.php'; ?>
