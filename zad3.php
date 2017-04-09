<!--https://fisn.uni-plovdiv.bg/sandalski/FMI/-->

<?php include 'includes/layouts/header.php'; ?>

<?php 
// Form Validation
$distance_err = $depart_time_err = $avg_speed_err = '';
$distance = $depart_time = $avg_speed = '';

$time = $time_str = $eta='';
$hours = $minutes = "--";

$depart_array = array();
$time_array = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["distance"])) {
		$distance_err = "*"."Моля въведете дължина на пътя";
	} else {
		$distance = test_input($_POST["distance"]);
	}
	if (empty($_POST["depart_time"])) {
		$depart_time_err = "*"."Моля въведете време на тръгване";
	} else {
		$depart_time = test_input($_POST["depart_time"]);
	}
	if (empty($_POST["avg_speed"])) {
		$avg_speed_err = "*"."Моля въведете средна скорост";
	} else {
		$avg_speed = test_input($_POST["avg_speed"]);
	}
}

// Formating input
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Calculating values
if(!empty($distance)&&!empty($avg_speed)&&!empty($depart_time)&&($avg_speed>0))
{
	$time = $distance/$avg_speed;
	$time_str = sprintf('%02d:%02d', (int) $time, fmod($time, 1) * 60);

	$the_time = date('H:i ', strtotime($depart_time));

	$depart_time =  preg_match ('(([01]?\d|2[0-3]):([0-5]\d))', $depart_time, $depart_array);
	$time_str = preg_match ('(([01]?\d|2[0-3]):([0-5]\d))', $time_str, $time_array);
	
	$hours = intval($depart_array[1])+intval($time_array[1]);
	$minutes =intval($depart_array[2])+intval($time_array[2]);
	
	if($minutes>=60)
	{
		$minutes -= 60;
		$hours++;
	}
	if($hours>=24)
	{
		$hours -= 24;
	}
	
	$hours = sprintf("%02d", $hours);
	$minutes = sprintf("%02d", $minutes);
}
?>

<div class="container">
	<h2 class="text-center">Очаквано време на пристигане</h2>

	<form class="form-horizontal" name="eta_form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" onsubmit="return validateForm()" method="post">

		<div class="form-group">
			<label class=" control-label col-sm-6" for="distance"> Въведете път за изминаване на превозното средство в <u>км</u>:</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" name="distance" value="<?php echo (!empty($_POST))? $_POST['distance'] : ''; ?>">
				 <span class="error"><?php echo $distance_err;?></span>
			</div>
		</div>

		<div class="form-group">
			<label class=" control-label col-sm-6" for="depart_time"> Въведете време на тръгване (чч:мм):</label>
			<div class="col-sm-4">
				<input type="time" class="form-control" name="depart_time" value="<?php echo (!empty($_POST))? $_POST['depart_time'] : ''; ?>">
				<span class="error"><?php echo $depart_time_err;?></span>
			</div>
		</div>

		<div class="form-group">
			<label class=" control-label col-sm-6" for="avg_speed"> Въведете препоръчителна средна скорост <u>км/ч</u>:</label>
			<div class="col-sm-4">
				<input type="" class="form-control" name="avg_speed" value="<?php echo (!empty($_POST))? $_POST['avg_speed'] : ''; ?>">
				<span class="error"><?php echo $avg_speed_err;?></span>
			</div>
		</div>

		<div class="form-group">
			<label class=" control-label col-sm-6" for="eta"> Очакваното време за пристигане е :</label>
			<div class="col-sm-4">
				<p type="text" class="form-control-static" name="eta"><?php echo (!empty($_POST))? ($hours." : ".$minutes." ч.") : '';?></p>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-6 col-sm-6">
				<button type="submit" class="btn btn-success" name="submit">Потвърдете</button>
				<button type="reset" class="btn btn-danger" name="cancel">Отказ</button>
			</div>
		</div>
	</form>
</div>
	
<?php include 'includes/layouts/footer.php'; ?>