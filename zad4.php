<!--https://fisn.uni-plovdiv.bg/sandalski/FMI/-->

<?php include 'includes/layouts/header.php'; ?>

<?php 
$initial_sum_err = $overall_sum_err = $interest_rate_err = '';
$initial_sum = $overall_sum= $interest_rate = '';

$years = $months = 0;

// Валидация на входните данни
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	// Проверка за Началната сума
	if (empty($_POST["initial_sum"])) {
		$initial_sum_err = "*"."Моля въведете начална сума";
	} elseif ($_POST["initial_sum"] <= 0) {
		$initial_sum_err = "*"."Началната сума трябва да е по-голяма от 0";
	} else {
		$initial_sum = test_input($_POST["initial_sum"]);
	}
	
	// Проверка за Крайната сума
	if (empty($_POST["overall_sum"])) {
		$overall_sum_err = "*"."Моля въведете крайна сума";
	} elseif ($_POST["overall_sum"] <= 0) {
		$overall_sum_err = "*"."Крайната сума трябва да е по-голяма от 0";
	} elseif ($_POST["overall_sum"] <= $_POST["initial_sum"]) {
		$overall_sum_err = "*"."Крайната сума трябва да е по-голяма от началната сума";
	} else {
		$overall_sum = test_input($_POST["overall_sum"]);
	}
	
	// Проверка за лихвения процент
	if (empty($_POST["interest_rate"])) {
		$interest_rate_err = "*"."Моля въведете годишната лихва";
	} elseif ($_POST["interest_rate"] < 0) {
		$interest_rate_err = "*"."Годишната лихва трябва да е по-голяма или равна на 0";
	} else {
		$interest_rate = test_input($_POST["interest_rate"]);
	}
}

// Метод за Форматиране на входните данни 
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Изчисляване на време за достигане до крайната сума
if(!empty($initial_sum)&&!empty($overall_sum)&&!empty($interest_rate)) {
	
	$initial_sum_temp = $initial_sum;
	
	while($initial_sum_temp < $overall_sum) {
		$initial_sum_temp += (($initial_sum*(0.01 * $interest_rate)) / 12);
		$months++;
	}
	
	$years = intval($months/12);
	$months %= 12;
}
?>

<div class="container">
	<h2 class="text-center">Изчисляване на пари</h2>

	<form class="form-horizontal" name="eta_form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" onsubmit="return validateForm()" method="post">

		<div class="form-group">
			<label class=" control-label col-sm-6" for="initial_sum"> Въведете начална сума:</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" name="initial_sum" value="<?php echo (!empty($_POST))? $initial_sum : ''; ?>">
				 <span class="error"><?php echo $initial_sum_err;?></span>
			</div>
		</div>

		<div class="form-group">
			<label class=" control-label col-sm-6" for="overall_sum"> Въведете крайна сума:</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" name="overall_sum" value="<?php echo (!empty($_POST))? $overall_sum : ''; ?>">
				<span class="error"><?php echo $overall_sum_err;?></span>
			</div>
		</div>

		<div class="form-group">
			<label class=" control-label col-sm-6" for="interest_rate"> Въведете годишна лихва в проценти:</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" name="interest_rate" value="<?php echo (!empty($_POST))? $interest_rate : ''; ?>">
				<span class="error"><?php echo $interest_rate_err;?></span>
			</div>
		</div>

		<div class="form-group">
			<label class=" control-label col-sm-6" for="end_sum"> За достигане на крайната сума ще са нужни: :</label>
			<div class="col-sm-4">
				<p type="text" class="form-control-static" name="end_sum"><?php echo (!empty($_POST))? $years.' години и '.$months.' месеца'  : '';?></p>
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