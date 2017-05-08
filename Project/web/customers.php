<?php include '../includes/layouts/header.php';?>

<!-- Заглавие на страницата -->
<title>Клиенти</title>

<div class="page-header">
    <br>
    <h2>Клиенти</h2>
</div>

<dl class="dl-horizontal">
<?php
    $page = !(empty($_GET['page'])) ? (int)$_GET['page'] : 0;
    $results_per_page = 10;
    $offset= (int)$page * $results_per_page;
    
    include '../includes/database.php';
    
    //Свързване с БД
    $pdo = Database::connect();

    $nRows = $pdo->query('SELECT count(*) FROM customers')->fetchColumn(); 
    echo $nRows;
    $lastPage=floor($nRows/$results_per_page);
    echo ' '.$lastPage;
    $sql_types = "SELECT * FROM `types`";
    
    foreach ($pdo->query($sql_types) as $row) {
        echo '<dt>' . 'Tип ' . $row['type_id'] . '</dt>';
        echo '<dd>' . $row['type_name'] . '</dd>';  
    }
?>

</dl>
 
<!--/ Бутон за добавяне на нов клиент -->
<p>
    <a href="customers_add.php" class="btn btn-primary"> <span class="glyphicon glyphicon-plus"></span> Добави клиент</a>
</p>

<ul class="pagination">
    <li class="previous"><a href="customers.php<?php echo (($page>1)&&($page<=$lastPage)) ? '?page='.($page-1) : ''; ?>">Предишна</a></li>
    <li class="next"><a href="customers.php<?php echo (($page>=0)&&($page<=$lastPage)) ? '?page='.($page+1) : ''; ?>">Next</a></li>
</ul>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <!-- Добави имената на колоните -->
            <th class="text-right">#</th>
            <th>Име</th>
            <th>Тип</th>
            <th>Операции</th>
        </tr>
    </thead>
  
    <!-- Добавяне на записите -->
    <tbody>
  
<?php
    //Избиране на записи от таблицата на клиентите
    $sql_customers = "SELECT 
        `customer_id`,
        `customer_name`,
        `customer_type_id`
        FROM `customers`
        ORDER BY customer_id ASC
        LIMIT $results_per_page
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

<?php include '../includes/layouts/footer.php'; ?>