<?php include 'includes/layouts/header.php'; ?>

<?php 
$name_err = $quantity_err = $total_err = $tax_err = '';
$name = $quantity = $total = '';
$tax = 20;
$single_net_price = '';

// Валидация на входните данни
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	// Проверка за името на стоката
	if (empty($_POST["name"])) {
		$name_err = "*"."Моля въведете името на стоката";
	} else {
		$name = test_input($_POST["name"]);
	}
	
	// Проверка за количество
	if (empty($_POST["quantity"])) {
		$quantity_err = "*"."Моля въведете количество на стоката";
	} elseif ($_POST["quantity"] <= 0) {
		$quantity_err = "*"."Количеството на стоката трябва да е цяло число по-голямо от 0";
	} else {
		$quantity = intval(test_input($_POST["quantity"]));
	}
	
	// Проверка за обща сума с ДДС
	if (empty($_POST["total"])) {
		$total_err = "*"."Моля въведете обща сума с ДДС";
	} elseif ($_POST["total"] < 0) {
		$total_err = "*"."Общата сума с ДДС трябва да е по-голяма или равна на 0";
	} else {
		$total = test_input($_POST["total"]);
	}
	
	//Проверка за ДДС
	if (empty($_POST["tax"])) {
		$tax_err = "*"."Моля задайте ДДС в %";
	} elseif ($_POST["tax"] < 0) {
		$tax_err = "*"."Данък Добавена стойност трябва да е по-голям или равен на 0%";
	} else {
		$tax = test_input($_POST["tax"]);
	}
}

// Метод за Форматиране на входните данни 
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Изчисляване на единична стойност без ДДС
if(!empty($name) && !empty($total) && !empty($quantity) && !empty($tax)) {
	$single_net_price = $total / ($quantity * (1 + (0.01 * $tax)));
	$single_net_price = round($single_net_price, 2);
}
?>

<div class="container">
	<h2 class="text-center">Стока от магазин "Успех" Пловдив</h2>

	<form class="form-horizontal" name="form1" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">

		<!-- $name -->
		<div class="form-group">
			<label class=" control-label col-sm-4" for="name"> Задайте името на стоката:</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="name" value="<?php echo $name;?>">
				<span class="error"><?php echo $name_err;?></span>
			</div>
		</div>

		<!-- $quantity -->
		<div class="form-group">
			<label class=" control-label col-sm-4" for="quantity"> Задайте количество на стоката:</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="quantity" value="<?php echo $quantity;?>">
				<span class="error"><?php echo $quantity_err;?></span>
			</div>
		</div>

		<!-- $total -->
		<div class="form-group">
			<label class=" control-label col-sm-4" for="total"> Задайте обща сума с ДДС:</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="total" value="<?php echo $total;?>">
				<span class="error"><?php echo $total_err;?></span>
			</div>
		</div>

		<!-- $tax -->
		<div class="form-group">
			<label class=" control-label col-sm-4" for="tax"> Задайте ДДС в момента в %:</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="tax" value="<?php echo $tax;?>">
				<span class="error"><?php echo $tax_err;?></span>
			</div>
		</div>
		
		
		<!-- output $single_net_price -->
		<div class="panel panel-success">
		<div class="form-group form-group-lg">
			<label class=" control-label col-sm-4" for="single_net_price"> Единична цена без ДДС:</label>
			<div class="col-sm-6">
				<p type="text" class="form-control-static" name="single_net_price"><?php echo (!empty($_POST)) ? sprintf("%01.2f лв.", $single_net_price) : '';?></p>
			</div>
		</div>
		</div>
		
		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-10">
				<button type="submit" class="btn btn-success" name="submit">Потвърдете</button>
				<button type="reset" class="btn btn-danger" name="cancel">Отказ</button>
			</div>
		</div>
	</form>
</div>
	
<?php include 'includes/layouts/footer.php'; ?>
