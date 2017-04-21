<!--https://fisn.uni-plovdiv.bg/sandalski/FMI/-->

<?php include 'includes/layouts/header.php'; ?>

<?php
//$ware = accoutance = placement = false;
$ware_name = 'Склад';
$accoutance_name = 'Счетоводство';
$placement_name='Пласмент';
//test
$ware_val=100;
$accoutance_val=200;
$placement_val=250;

$bgn = 'лева';

function namebuilder($name, $val, $currency ){
	return $name . ' ' . $val . ' ' . $currency;
}
?>


    <div class="container">
        <h2 class="text-center">Продажба на софтуерни продукти</h2>
		<h2 class="text-center">При закупуване на повече от един продукт се прави 10% отстъпка от общата сума!</h2>

        <form class="form-horizontal" name="form1" action="zad8-response.php" method="post">

            <div class="form-group">
                <label class=" control-label col-sm-3" for="name"> Задайте името на клиента:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name">
                </div>
            </div>

			<label class=" control-label col-sm-3" for="checkboxes"> Изберете софтуерни продукти:</label>
		 <div class="form-group col-sm-3" name="checkboxes">
		 <br>
           <div class="checkbox">
			  <label><input type="checkbox" name="cost[]" value="ware" ><?php echo namebuilder($ware_name, $ware_val, $bgn);?></label>
			</div>
			
			<div class="checkbox">
			  <label><input type="checkbox" name="cost[]" value="accoutance"><?php echo namebuilder($accoutance_name, $accoutance_val, $bgn);?></label>
			</div>
			
			<div class="checkbox ">
			  <label><input type="checkbox" name="cost[]" value="placement"><?php echo namebuilder($placement_name, $placement_val, $bgn);?></label>
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
	
	<form name="category">
		<div class="radio">
		  <label><input type="radio" name="optradio">Ръкожодна длъжност</label>
		</div>
		<div class="radio">
		  <label><input type="radio" name="optradio">сътрудник</label>
		</div>
		<div class="radio ">
		  <label><input type="radio" name="optradio" >специалист</label>
		</div>
		<div class="radio ">
		  <label><input type="radio" name="optradio" >друга категория</label>
		</div>
	</form>
	
	<form name="experience">
	
		<div class="radio">
		  <label><input type="radio" name="optradio">0-5</label>
		</div>
		<div class="radio">
		  <label><input type="radio" name="optradio">6-12</label>
		</div>
		<div class="radio ">
		  <label><input type="radio" name="optradio" >13-22</label>
		</div>
		<div class="radio ">
		  <label><input type="radio" name="optradio" >над 22</label>
		</div>
	</form>
	
<?php include 'includes/layouts/footer.php'; ?>