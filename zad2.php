<html>
<link href="css/bootstrap.css" rel="stylesheet">
<h1>hello <?php echo (5+6)?></h1>
<body>
	<h3>Items from shop "Success" Plovdiv</h3>

<?php
$name = "";
$quantity = $_POST['name'];
$quantity =0;
$quantity =  $_POST['quantity'];
$total = 0;
$total= $_POST['total'];
$tax = 0;
$tax = $_POST['tax'];
$ez = 0;
$ez=$total/($quantity*(1+0.01*$tax));
$ez=round($ez,2);
?>
<div class="panel panel-default">
<?php
echo "Name: ".$name."<br>";
echo "Quantity: ".$quantity.'<br>' ;
echo "Total: ".$total.'<br>';
echo "Tax: ".$tax.'<br>';
echo "Single one: ". $ez;
?>
</div>
</body>

</html>
