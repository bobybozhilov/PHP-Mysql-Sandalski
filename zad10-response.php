<?php include 'includes/layouts/header.php'; ?>

<?php
$total_weight = $req_wght = $st_count = '';
$lorries_array = array();

$index = 0;
$temp_smallest;
$temp_index;

$min_index=0;
$max_index=0;


if(isset($_POST['req_weight'])) 
{
}

if(isset($_POST['lorries'])) 
{
	$lorries_array = explode(" ", $_POST['lorries']);
	lorries_array_sort = lorries_array;

	//Selection sort algorithm
	for ($i = 0; $i < count($lorries_array); $i++) {

		$index = $i;

		for ($j = $i + 1; $j <= count($lorries_array); $j++) {

			if ($lorries_array[$j] < $lorries_array_sort[$index]) {
				$index = $j;
			}
		} // end for j
		
		$temp_smallest = $lorries_array_sort[$index];
		$temp_index = $indexes[$index];
		
		$lorries_array_sort[$index] = $lorries_array_sort[$i];
		$indexes[$index]= $indexes[$i];
		
		$lorries_array_sort[$i] = $temp_smallest;
		$indexes[$i] = $temp_index;

	} // end for i
	
	
	
	
	if($weights!=''){
		foreach($lorries_array as $weight){
			$total_weight += $weight;
			
		}

		$avg = $total_weight / count($weights);
	}
}

?>

<h2>Изчисляване на средно тегло</h2>

<h4 class="text-center">Изчисляване на средно тегло</h4>

<p><b>Броят на студентите е  <?php echo $st_count; ?> </b></p>
<p><b>Зададените тегла са:  <?php foreach($weights as $weight){ echo $weight." ";} ?> </b></p>
<p><b>Общото тегло е  <?php echo $total_weight; ?> кг</b></p>
<p><b>Средното тегло е  <?php echo round($avg,3	); ?> кг</b></p>

<a href="zad10-index.php">Обратно</a>

<?php include 'includes/layouts/footer.php'; ?>