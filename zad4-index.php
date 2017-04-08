<!--https://fisn.uni-plovdiv.bg/sandalski/FMI/-->

<?php include 'includes/layouts/header.php'; ?>

    <div class="container">
        <h2 class="text-center">Амортизация</h2>

        <form class="form-horizontal" name="form1" action="zad4-response.php" method="post">

            <div class="form-group">
                <label class=" control-label col-sm-6" for="name"> Задайте името на основното средство:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="name">
                </div>
            </div>

            <div class="form-group">
                <label class=" control-label col-sm-6" for="quantity"> Задайте стойността при закупуване:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="price">
                </div>
            </div>

            <div class="form-group">
                <label class=" control-label col-sm-6" for="total"> Задайте годината на закупуване:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="year">
                </div>
            </div>

            <div class="form-group">
                <label class=" control-label col-sm-6" for="tax"> Задайте % за амортизация:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="overhaul">
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