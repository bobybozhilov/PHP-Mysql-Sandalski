<html>
<link href="css/bootstrap.css" rel="stylesheet">
<h1>hello <?php echo (5+6)?></h1>
<body>
	<h3>Items from shop "Success" Plovdiv</h3>

<?php
$name = "";
$name = $_POST['name'];

$price =0;
$price =  $_POST['price'];

$year = 0;
$year= $_POST['year'];

$overhaul = 0;
$overhaul = $_POST['overhaul'];


$newPrice=0;
$newPrice=$price;

if((date("Y")-$year)>=5){
	$newPrice=$price*(1-0.01*$overhaul);
}
?>
<div class="panel panel-default">
<?php
echo "Name: ".$name."<br>";
echo "price: ".$price.'<br>' ;
echo "year: ".$year.'<br>';
echo "overhaul: ".$overhaul.'<br>';
echo "Single one: ". $newPrice;
?>
</div>
</body>

</html>
