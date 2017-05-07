<?php include 'includes/layouts/header.php'; ?>

<div class="container">
	<h2 class="text-center">Средно тегло</h2>

	<form class="form-group" name="form1" action="zad10-response.php" method="post">

		<div class="form-group">
			<div class="form-inline">
				<label class=" control-label" for="price"> Единична цена на продукта </label>
				<input type="text" class="form-control" name="price">
			</div>
			<br>
			<div class="form-inline">
				<label class=" control-label" for="partners_count"> Общ брой на партньорите </label>
				<input type="text" class="form-control" name="partners_count">
			</div>
			<br>
			<label class=" control-label" for="data"> Задайте : име, код за вида на партньора (примерно 1=дистрибутор; 2=клиент) и брой продукти </label>
			<textarea class="form-control" rows="5" name="data"></textarea>
			
		</div>

		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-6">
				<button type="submit" class="btn btn-success" name="submit">Потвърдете</button>
				<button type="reset" class="btn btn-danger" name="cancel">Отказ</button>
			</div>
		</div>
	</form>
</div>
	
<?php include 'includes/layouts/footer.php'; ?>