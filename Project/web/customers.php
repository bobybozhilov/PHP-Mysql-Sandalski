<?php include '../includes/layouts/header.php';?>
<?php require '../controllers/customersController.php' ?>

<?php
    //Връзка с базата данни и инициализиране на променливите
    include '../includes/database.php';
   
    // pagination variables
    $self = $_SERVER['PHP_SELF'];
    $page = !(empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    $resultsPerPage = 20;
    $offset = (int)($page-1) * $resultsPerPage;
    $sort = !empty($_GET["sort"]) ? $_GET['sort'] : NULL;
    $type = !empty($_GET["type"]) ? $_GET['type'] : NULL;
    $search = !empty($_POST["search"]) ? $_POST["search"] : NULL;
    
    
    //pagination sorting type variables, 1 for each column
    $customer_idNextType = ($sort == 1 and $type == "asc") ? "desc" : "asc";
    $customer_nameNextType = ($sort == 2 and $type == "asc") ? "desc" : "asc";
    $customer_type_idNextType = ($sort == 3 and $type == "asc") ? "desc" : "asc";
    $totalNextType = ($sort == 4 and $type == "asc") ? "desc" : "asc";
    
    //connect to DB to get number of rows for Pagination
    $pdo = Database::connect();

    $nRows = CustomersController::getRowsCount($pdo);
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

<?= CustomersController::addNew();?> 

  <form class="form-inline text-center" method="post" action="<?=$_SERVER['PHP_SELF'];?>">
  <p>Търсене по минимална сума.</p>
    <div class="form-group">
      <input type="text" class="form-control" id="search" placeholder="Mинимална сума..." name="search">
    </div>
    <button type="submit" class="btn btn-default">Търси</button>
  </form>

<?php if($nRows>$resultsPerPage) {include '../includes/pagination.php';}?>

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
            <th>
                <span>
                    <a href="?sort=4&type=<?php echo $totalNextType; ?>" class="column-title">Сума</a>
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
<?=CustomersController::fillTable($pdo, $orderBy, $resultsPerPage, $offset, $search); ?>

    </tbody>
</table>

<?php if($nRows>$resultsPerPage) {include '../includes/pagination.php';}?>

<?php
 Database::disconnect();
 include '../includes/layouts/footer.php'; 
 ?>