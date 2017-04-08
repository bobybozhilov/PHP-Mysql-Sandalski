<?php include 'includes/layouts/header.php'; ?>

    <div class="container">
        <h2 class="text-center">Стока от магазин "Успех" Пловдив</h2>

        <form class="form-horizontal" name="form1" action="zad1-response.php" method="post">

            <div class="form-group">
                <label class=" control-label col-sm-4" for="name"> Задайте името на стоката:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name">
                </div>
            </div>

            <div class="form-group">
                <label class=" control-label col-sm-4" for="quantity"> Задайте количество на стоката:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="quantity">
                </div>
            </div>

            <div class="form-group">
                <label class=" control-label col-sm-4" for="total"> Задайте обща сума с ДДС:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="total">
                </div>
            </div>

            <div class="form-group">
                <label class=" control-label col-sm-4" for="tax"> Задайте ДДС в момента в %:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="tax">
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
