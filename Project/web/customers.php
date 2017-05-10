<?php include '../includes/layouts/header.php';?>
<?php require '../controllers/customersController.php' ?>

<?php
    //Връзка с базата данни и инициализиране на променливите
    include '../includes/database.php';
   
    // pagination variables
    $self = $_SERVER['PHP_SELF'];
    $page = !(empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    $resultsPerPage = 10 ;
    $offset = (int)($page-1) * $resultsPerPage;
    $sort = !empty($_GET["sort"]) ? $_GET['sort'] : NULL;
    $type = !empty($_GET["type"]) ? $_GET['type'] : NULL;
    
    //pagination sorting type variables, 1 for each column
    $customer_idNextType = ($sort == 1 and $type == "asc") ? "desc" : "asc";
    $customer_nameNextType = ($sort == 2 and $type == "asc") ? "desc" : "asc";
    $customer_type_idNextType = ($sort == 3 and $type == "asc") ? "desc" : "asc";
    
    //connect to DB to get number of rows for Pagination
    $pdo = Database::connect();

    $nRows = $pdo->
        query('SELECT count(*) FROM `' . 'customers' . '`')->fetchColumn(); 
    $lastPage = ceil(($nRows-1) / $resultsPerPage);
?>

<!-- Заглавие на страницата -->
<title>Клиенти</title>

<div class="page-header">
    <br>
    <h3>Клиенти</h3>
</div>

<dl class="dl-horizontal">
<?= CustomersController::displayTypeOfClients($pdo);?>
</dl>
 
<!-- Бутон за добавяне на нов клиент -->

<a href="customers_addModal.php" class="btn btn-success"> 
    <span class="glyphicon glyphicon-plus"></span> Добави клиент
</a>

<?php include '../includes/pagination.php';?>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <!-- Добави имената на колоните +pagination sorting type variables-->
            <th class="text-right">
                <span>
                    <a href="?sort=1&type=<?php echo $customer_idNextType; ?>" class="column-title">#</a>
                </span>
            </th>
            <th>
                <span>
                    <a href="?sort=2&type=<?php echo $customer_nameNextType; ?>" class="column-title">Име</a>
                </span>
            </th>
            <th>
                <span>
                    <a href="?sort=3&type=<?php echo $customer_type_idNextType; ?>" class="column-title">Тип</a>
                </span>
            </th>
            <th>Операции</th>
        </tr>
    </thead>
  
    <!-- Добавяне на записите -->
    <tbody>
  
<?php
   $orderBy = CustomersController::orderBy($sort, $type);

    ?>
    
        <div class="container text-center">
        Показване на записи <?= ($offset+1) . ' - ' . 
            (($nRows <($offset +$resultsPerPage)) ? $nRows : $offset + $resultsPerPage);?>
        , от общо <?=$nRows;?>
        </div>
<?=CustomersController::fillTable($pdo, $orderBy, $resultsPerPage, $offset); ?>

    </tbody>
</table>


<?php include '../includes/pagination.php';?>

<?php
 Database::disconnect();
 include '../includes/layouts/footer.php'; 
 ?>