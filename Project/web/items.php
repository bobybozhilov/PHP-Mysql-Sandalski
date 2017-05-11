<?php include '../includes/layouts/header.php';?>
<?php require '../controllers/itemsController.php' ?>

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
    
    //connect to DB to get number of rows for Pagination
    $pdo = Database::connect();
    $nRows = ItemsController::getRowsCount($pdo);
    $lastPage = ceil(($nRows-1) / $resultsPerPage);
?>

<!-- Заглавие на страницата -->
<title>Артикули</title>

<div class="page-header">
    <br>
    <h3>Артикули</h3>
</div>

 
<!-- Бутон за добавяне на нов клиент -->

<?= ItemsController::addNew();?>

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
                    <a href="?sort=2&type=<?php echo $type2NextType; ?>" class="column-title">Име</a>
                </span>
            </th>
            <th>
                <span>
                    <a href="?sort=3&type=<?php echo $type3NextType; ?>" class="column-title">Цена</a>
                </span>
            </th>
            <th>Операции</th>
        </tr>
    </thead>
  
    <!-- Добавяне на записите -->
    <tbody>
  
<?php
   $orderBy = ItemsController::orderBy($sort, $type);

    ?>
    
        <div class="container text-center">
        Показване на записи <?= ($offset+1) . ' - ' . 
            (($nRows <($offset +$resultsPerPage)) ? $nRows : $offset + $resultsPerPage);?>
        , от общо <?=$nRows;?>
        </div>
<?=ItemsController::fillTable($pdo, $orderBy, $resultsPerPage, $offset); ?>

    </tbody>
</table>


<?php if($nRows>$resultsPerPage) {include '../includes/pagination.php';}?>

<?php
 Database::disconnect();
 include '../includes/layouts/footer.php'; 
 ?>