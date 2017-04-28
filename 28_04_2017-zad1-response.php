<?php include 'includes/layouts/header.php'; ?>

<?php
$total_weight = $avg = $st_count = '';
$weights = array();

if(isset($_POST['name'])) 
{
$weights = explode("/", $_POST['name']);
if($weights!=''){
foreach($weights as $weight){
	$total_weight += $weight;
	$st_count++;
}

$avg = $total_weight / count($weights);
}
}

?>

<h2>Изчисляване на средно тегло</h2>

<h4 class="text-center">Изчисляване на средно тегло</h4>
<span>
<?php
//foreach($weights as $ $weight);
?></span>
<p><b>Броят на студентите е  <?php echo $st_count; ?> </b></p>
<p><b>Зададените тегла са:  <?php foreach($weights as $weight){ echo $weight." ";} ?> </b></p>
<p><b>Общото тегло е  <?php echo $total_weight; ?> кг</b></p>
<p><b>Средното тегло е  <?php echo round($avg,3); ?> кг</b></p>

<a href="28_04_2017-zad1-index.php">Обратно</a>

<?php include 'includes/layouts/footer.php'; ?>