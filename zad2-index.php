<?php include 'includes/layouts/header.php'; ?>

    <div class="container">
        <h2>Тримесечия</h2>

        <form class="form-horizontal" name="form1" action="zad2-response.php" method="post">

            <div class="form-group">
                <label class=" control-label col-sm-5" for="trim1"> Задайте стойност за първото тримесечие:</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="trim1">
                </div>
            </div>

            <div class="form-group">
                <label class=" control-label col-sm-5" for="trim2">Задайте стойност за второто тримесечие::</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="trim2">
                </div>
            </div>

            <div class="form-group">
                <label class=" control-label col-sm-5" for="trim3">Задайте стойност за третото тримесечие:</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="trim3">
                </div>
            </div>

            <div class="form-group">
                <label class=" control-label col-sm-5" for="trim4">Задайте стойност за четвъртото тримесечие:</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="trim4">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-5 col-sm-10">
                    <button type="submit" class="btn btn-success" name="submit">Потвърдете</button>
                    <button type="reset" class="btn btn-danger" name="cancel">Отказ</button>
                </div>
            </div>
        </form>
    </div>
	
<?php include 'includes/layouts/footer.php'; ?>
