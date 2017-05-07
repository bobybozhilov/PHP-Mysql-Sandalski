<?php include 'includes/layouts/header.php'; ?>

<div class="container">
	<h2 class="text-center">Средно тегло</h2>

	<form class="form-group" name="form1" action="zad10-response.php" method="post">

		<div class="form-group">
			<div class="form-inline">
				<label class=" control-label" for="code"> Код : </label>
				<input type="text" class="form-control" name="code">
			</div>
			<br>
			<div class="form-inline">
				<label class=" control-label" for="name"> Име : </label>
				<input type="text" class="form-control" name="name">
			</div>
			<br>
			
        
			<div class="form-inline">
			<label class=" control-label" for="kind"> Тип : </label>
			<select class="form-control" id="kind">
				<option value ="1">Вземане</option>
				<option value ="2">Даване</option>
			</select>
			</div>
			<br>
			<div class="form-inline">
				<label class=" control-label" for="sum"> Сума : </label>
				<input type="text" class="form-control" name="sum">
			</div>
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