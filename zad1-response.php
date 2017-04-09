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


<h2>Стока от магазин "Успех" Пловдив</h2>

<h4 class="text-center">Изчисляване на единична цена на стока без ДДС</h4>

<table class="table table-bordered">
	<tbody class="text-center">
		<tr>
			<td>Име на стоката</td>
			<td><?php echo $name ?></td>
		</tr>
		<tr>
			<td>Количество</td>
			<td><?php echo $quantity ?></td>
		</tr>
		<tr>
			<td>Обща сума с ДДС</td>
			<td><?php echo $total ?></td>
		</tr>
		<tr>
			<td>ДДС %</td>
			<td><?php echo $tax ?></td>
		</tr>
		<tr>
			<td>Единична цена без ДДС</td>
			<td><?php echo $single_net_price ?></td>
		</tr>
	</tbody>
</table>	

<a href="zad1-index.php">Обратно</a>

<?php include 'includes/layouts/footer.php'; ?>
