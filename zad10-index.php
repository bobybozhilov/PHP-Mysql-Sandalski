<?php include 'includes/layouts/header.php'; ?>

<div class="container">
	<h2 class="text-center">Средно тегло</h2>

	<form class="form-group" name="form1" action="zad10-response.php" method="post">

		<div class="form-group">
			<label class=" control-label" for="lorries"> Задайте товароносимости на наличните камиони разделени със празно място </label>
			<input type="text" class="form-control" name="lorries">
			
			<label class=" control-label" for="req_weight"> Задайте товароносимости на наличните камиони разделени със празно място </label>
			<input type="text" class="form-control" name="req_weight">
			
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