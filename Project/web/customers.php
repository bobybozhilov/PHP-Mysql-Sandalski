<?php include '../includes/layouts/header.php';?>

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

    $nRows = $pdo->query(
        'SELECT count(*) FROM `' . 
        'customers' . //table name
        '`')->fetchColumn(); 
    $lastPage = ceil(($nRows-1) / $resultsPerPage);
?>

<!-- Заглавие на страницата -->
<title>Клиенти</title>

<div class="page-header">
    <br>
    <h3>Клиенти</h3>
</div>

<dl class="dl-horizontal">
<?php
    // Покажи различните видове клиенти
    $sqlTypes = "SELECT * FROM `types`";
    foreach ($pdo->query($sqlTypes) as $row) {
        echo '<dt>' . 'Tип ' . $row['type_id'] . '</dt>';
        echo '<dd>' . $row['type_name'] . '</dd>';  
    }
?>
</dl>


 
<!-- Бутон за добавяне на нов клиент -->

<a href="customers_add.php" class="btn btn-success"> 
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
   //Modify sort - # to table column name
    switch($sort){
        case 1:
            $orderBy = "customer_id $type";
            break;
            
        case 2:
            $orderBy = "customer_name $type";
            break;
            
        case 3:
            $orderBy = "customer_type_id $type , customer_id ASC" ;
            break;
            
        //Резултат различен от 1,2,3
        default:
            $orderBy = 'customer_id';
    }
    ?>
    
        <div class="container text-center">
        Показване на записи <?= ($offset+1) . ' - ' . 
            (($nRows <($offset +$resultsPerPage)) ? $nRows : $offset + $resultsPerPage);?>
        , от общо <?=$nRows;?>
        </div>
<?php
    
    //Избиране на записи от таблицата на клиентите
    $sql_customers = "SELECT 
        `customer_id`,
        `customer_name`,
        `customer_type_id`
        FROM `customers`
        ORDER BY $orderBy
        LIMIT $resultsPerPage
        OFFSET $offset
        ";

    //Запълване на таблицата
    foreach ($pdo->query($sql_customers) as $row) {
       
        //Колоните
        echo '<tr class="';
        
        switch($row['customer_type_id']) {
            case 1:
                echo 'success';
                break;
                
            case 2:
                echo 'default';
                break;
                
            case 3:
                echo 'warning';
                break;
                
            //Резултат различен от 1,2,3
            default:
            echo 'default';
        }
        echo '">';
        
        echo '<td class="col-sm-1 text-right">'. $row['customer_id'] . '</td>';
        echo '<td class="col-sm-9">' . $row['customer_name'] . '</td>';
        echo '<td class="col-sm-1">' . $row['customer_type_id'] . '</td>';
        
        //Колоната "Операции"
        echo '<td class="col-sm-1 btn-group-justified">';
            
            //Бутон "Информация"   
            echo '<a class="btn btn-xs btn-success"data-toggle="tooltip" data-placement="bottom"' . 
                'title="Информация" ' .  
                'href="customers_info.php?id=' . $row['customer_id'] . 
                '"><span class="glyphicon glyphicon-eye-open"></span></a>';
                         
            //Бутон "Промени"   
            echo '<a class="btn btn-xs btn-warning"data-toggle="tooltip" data-placement="bottom"' . 
                'title="Промени"' . 
                'href="customers_edit.php?id=' . $row['customer_id'] .
                '"><span class="glyphicon glyphicon-pencil"></span></a>';
                           
            //Бутон "Изтрий"
            echo '<a class="btn btn-xs btn-danger"data-toggle="tooltip" data-placement="bottom"' . 
                'title="Изтрий"' . 
                'href="customer_delete.php?id=' . $row['customer_id'] . 
                '"><span class="glyphicon glyphicon-trash"></span></a>';
            
        echo '</td>';
        echo '</tr>';
    }
    
    //Прекъсване на връзката с Базата от Данни
    Database::disconnect();

?>
  
    </tbody>
</table>
<?php include '../includes/pagination.php';?>

<?php include '../includes/layouts/footer.php'; ?>