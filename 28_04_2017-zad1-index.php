<?php include 'includes/layouts/header.php'; ?>

<div class="container">
	<h2 class="text-center">Средно тегло</h2>

	<form class="form-group" name="form1" action="28_04_2017-zad1-response.php" method="post">

		<div class="form-group">
			<label class=" control-label" for="name"> Задайте теглата в КГ разделени с /</label>
			
				<input type="text" class="form-control" name="name">
			
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