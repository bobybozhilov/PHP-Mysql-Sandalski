<?php include '../includes/layouts/header.php';?>
<?php require '../controllers/ordersController.php' ?>

<?php
    //Връзка с базата данни и инициализиране на променливите
    include '../includes/database.php';
   
    // pagination variables
    $self = $_SERVER['PHP_SELF'];
    $page = !(empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    $resultsPerPage = 10;
    $offset = (int)($page-1) * $resultsPerPage;
    $sort = !empty($_GET["sort"]) ? $_GET['sort'] : NULL;
    $type = !empty($_GET["type"]) ? $_GET['type'] : NULL;
    
    //pagination sorting type variables, 1 for each column
    $type1NextType = ($sort == 1 and $type == "asc") ? "desc" : "asc";
    $type2NextType = ($sort == 2 and $type == "asc") ? "desc" : "asc";
    $type3NextType = ($sort == 3 and $type == "asc") ? "desc" : "asc";
    $type4NextType = ($sort == 4 and $type == "asc") ? "desc" : "asc";
    $type5NextType = ($sort == 5 and $type == "asc") ? "desc" : "asc";
    $type6NextType = ($sort == 6 and $type == "asc") ? "desc" : "asc";
    $type7NextType = ($sort == 7 and $type == "asc") ? "desc" : "asc";
    
    //connect to DB to get number of rows for Pagination
    $pdo = Database::connect();
    $nRows = ordersController::getRowsCount($pdo);
    $lastPage = ceil(($nRows-1) / $resultsPerPage);
?>

<!-- Заглавие на страницата -->
<title>Поръчки</title>

<div class="page-header">
    <br>
    <h3>Поръчки</h3>
</div>

 
<!-- Бутон за добавяне на нов клиент -->

<?= OrdersController::addNew();?>

<?php if($nRows>$resultsPerPage) {include '../includes/pagination.php';}?>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <!-- Добави имената на колоните +pagination sorting type variables-->
            <th class="text-right">
                <span>
                    <a href="?sort=1&type=<?php echo $type1NextType; ?>" class="column-title">#</a>
                </span>
            </th>
            <th>
                <span>
                    <a href="?sort=2&type=<?php echo $type2NextType; ?>" class="column-title">Клиент</a>
                </span>
            </th>
            <th>
                <span>
                    <a href="?sort=3&type=<?php echo $type3NextType; ?>" class="column-title">Артикул</a>
                </span>
            </th>
            <th>
                <span>
                    <a href="?sort=4&type=<?php echo $type4NextType; ?>" class="column-title">Цена</a>
                </span>
            </th>
            <th>
                <span>
                    <a href="?sort=5&type=<?php echo $type5NextType; ?>" class="column-title">количество</a>
                </span>
            </th>
            <th>
                <span>
                    <a href="?sort=6&type=<?php echo $type6NextType; ?>" class="column-title">общо</a>
                </span>
            </th>
            <th>
                <span>
                    <a href="?sort=7&type=<?php echo $type7NextType; ?>" class="column-title">Дата</a>
                </span>
            </th>
            <th>Операции</th>
        </tr>
    </thead>
  
    <!-- Добавяне на записите -->
    <tbody>
  
<?php
   $orderBy = ordersController::orderBy($sort, $type);

    ?>
    
        <div class="container text-center">
        Показване на записи <?= ($offset+1) . ' - ' . 
            (($nRows <($offset +$resultsPerPage)) ? $nRows : $offset + $resultsPerPage);?>
        , от общо <?=$nRows;?>
        </div>
<?=ordersController::fillTable($pdo, $orderBy, $resultsPerPage, $offset); ?>

    </tbody>
</table>


<?php if($nRows>$resultsPerPage) {include '../includes/pagination.php';}?>

<?php list ($paid, $remain) = ordersController::calculateSums($pdo); ?>

<p>Събрана сума: <?=$paid;?> лв. , Оставаща сума: <?=$remain;?> лв.</p>

<?php
 Database::disconnect();
 include '../includes/layouts/footer.php'; 
 ?>