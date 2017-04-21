<?php include 'includes/layouts/header.php'; ?>

<?php
$ware_val=$accoutance_val = $placement_val=0;
$info = '';

$ware_name = 'Склад';
$accoutance_name = 'Счетоводство';
$placement_name='Пласмент';

$ware_val=100;
$accoutance_val=200;
$placement_val=250;

$bgn = 'лева';
$total = 0;
$bgn = 'лева';
$count=0;

if(isset($_POST['cost'])) 
{
	foreach($_POST['cost'] as $cost)
	{
		echo $cost;
		$total += $cost;
		//echo namebuilder($ware_name, $ware_val, $bgn);
	}
}
if (array_key_exists('flavours', $_POST)) 
{
    //
}


if(array_key_exists('ware', $_POST)) 
{
	$total += $ware_val;
	$info .=  namebuilder($ware_name, $ware_val, $bgn);
	$count++;
}
if(array_key_exists('accoutance', $_POST)) 
{
	$total += $accoutance_val;
	$info .=  namebuilder($accoutance_name, $accoutance_val, $bgn);
	$count++;
}
if(array_key_exists('placement', $_POST)) 
{
	$total += $placement_val;
	$info .=  namebuilder($placement_name, $placement_val, $bgn);
	$count++;
}

if($count>=2){
	$total *= 0.9;
}

function namebuilder($name, $val, $currency )
{
	return $name . ' ' . $val . ' ' . $currency . "\r\n";
}

?>

<h2>Основно средство</h2>

<h4 class="text-center">Изчисляване на единична цена на стока без ДДС</h4>
<span>
<?php

$separator = "\r\n";
$line = strtok($info, $separator);

while ($line !== false) {
    echo '<p>' . $line . '</p>' ;
    $line = strtok( $separator );
}

?></span>
<p><b>общо <?php echo $total; ?> лева</b></p>

<a href="zad4-index.php">Обратно</a>

<?php include 'includes/layouts/footer.php'; ?>