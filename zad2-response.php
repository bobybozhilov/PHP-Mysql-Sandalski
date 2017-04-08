<?php include 'includes/layouts/header.php'; ?>

<?php
$trim1 = $trim2 = $trim3 = $trim4 = 0;
$avg_value = 0;

$index = 0;
$temp_smallest;
$temp_index;

$min_index=0;
$max_index=0;

$trim1 = $_POST['trim1'];
$trim2 = $_POST['trim2'];
$trim3 = $_POST['trim3'];
$trim4 = $_POST['trim4'];

//Year array and indexes array
$year = array($trim1, $trim2, $trim3, $trim4);
$year_sort = $year;

//Indexes array
$indexes= array(1,2,3,4);

// Average Value
$avg_value = ($trim1+$trim2+$trim3+$trim4) / 4;

//min and max element
$min_value = $year[0];
$max_value = $year[0];

for ($i = 0; $i < 4; $i++) {
	//minimum value and minimum index
	if($year[$i]<=$min_value)
	{
		$min_value = $year[$i];
		$min_index = $i;
	}
	
	//maxium value and maximum index
	if($year[$i]>=$max_value)
	{
		$max_value = $year[$i];
		$max_index = $i;
	}
}

//Selection sort algorithm
for ($i = 0; $i < 3; $i++) {

	$index = $i;

	for ($j = $i + 1; $j < 4; $j++) {

		if ($year[$j] < $year_sort[$index]) {
			$index = $j;
		}
	} // end for j
	
	$temp_smallest = $year_sort[$index];
	$temp_index = $indexes[$index];
	
	$year_sort[$index] = $year_sort[$i];
	$indexes[$index]= $indexes[$i];
	
	$year_sort[$i] = $temp_smallest;
	$indexes[$i] = $temp_index;

} // end for i
?>

<h2>Тримесечия</h2>

<ul class="list-group">

	<li class="list-group-item">Стойности по тримесечия
		<?php 
			for ($i = 0; $i < 4; $i++) 
				{ 
					echo " : ".'<b>'.$year[$i].'</b>'; 
				} 
		?>
	</li>
	
	<li class="list-group-item">Минималната стойност е = <?php echo '<b>'.$min_value.'</b>';?>
	с индекс = <?php echo '<b>'.($min_index+1).'</b>';?>
	</li>
	
	<li class="list-group-item">Максималната стойност е = <?php echo '<b>'.$max_value.'</b>';?>
	с индекс = <?php echo '<b>'.($max_index+1).'</b>';?>
	</li>
	
	<li class="list-group-item">Средната стойност е = <?php echo '<b>'.$avg_value.'</b>';?>
	</li>
	
	<li class="list-group-item">След сортиране
		<?php 
			for ($i = 0; $i < 4; $i++) 
				{ 
					echo " : ".'<b>'.$year_sort[$i].'</b>'; 
				} 
		?>
	</li>
	
	<li class="list-group-item">
	По тримесечия
		<?php 
			for ($i = 0; $i < 4; $i++) 
				{ 
					echo " : ".'<b>'.$indexes[$i].'</b>'; 
				} 
		?>
	</li>

</ul>

<a href="zad2-index.php">Обратно</a>

<?php include 'includes/layouts/footer.php'; ?>
