<?php
    require '../includes/database.php';

    if (!empty($_GET['id'])) {
        $id = $_REQUEST['id'];

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT *
            FROM `customers`
            WHERE `customer_id`= ?";
            
        $query = $pdo->prepare($sql);
        $query->execute(array($id));
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $customerName = $data['customer_name'];
        $customerTypeId = $data['customer_type_id'];
    }  else {
        header('Location:items.php');
    }
    
?>

<?php
   
    // pagination variables
    $self = $_SERVER['PHP_SELF'];
    $page = !(empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    $resultsPerPage = 10;
    $offset = (int)($page-1) * $resultsPerPage;
    $sort = !empty($_GET["sort"]) ? $_GET['sort'] : NULL;
    $type = !empty($_GET["type"]) ? $_GET['type'] : NULL;
    $search = !empty($_POST["search"]) ? $_POST["search"] : NULL;
    
    //pagination sorting type variables, 1 for each column
    $type1NextType = ($sort == 1 and $type == "asc") ? "desc" : "asc";
    $type3NextType = ($sort == 3 and $type == "asc") ? "desc" : "asc";
    $type4NextType = ($sort == 4 and $type == "asc") ? "desc" : "asc";
    $type5NextType = ($sort == 5 and $type == "asc") ? "desc" : "asc";
    $type6NextType = ($sort == 6 and $type == "asc") ? "desc" : "asc";
    $type7NextType = ($sort == 7 and $type == "asc") ? "desc" : "asc";
    
    //connect to DB to get number of rows for Pagination
   // $pdo = Database::connect();
    $nRows =$pdo->query("SELECT count(*) FROM (
            SELECT 
            ci_id, 
            CONCAT('(..', RIGHT(customer_id,3), ') ', customer_name,' (тип ' ,customer_type_id, ')') AS customer,
            CONCAT('(..', RIGHT(item_id,3), ') ', item_name) AS item,
            item_price,
            ci_quantity,
            item_price*ci_quantity AS total,
            DATE_FORMAT(ci_date,'%d/%m/%Y') AS date
            FROM customers_items LEFT Join customers ON ci_customer_id = customer_id LEFT JOIN items ON
            ci_item_id = item_id 
            WHERE 1) as x
            ")->fetchColumn();  
    
    
    $lastPage = ceil(($nRows-1) / $resultsPerPage);
?>



<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="utf-8">
    <link   href="../bootstrap/css/bootstrap.css" rel="stylesheet">
</head>
 
<body>

    <title>Информация за клиент</title>
    
    <div class="container">
        <h3><br> номер: <?=$_GET['id'].', '.$customerName . ', тип ' . $customerTypeId;?></h3>

        <?php if($nRows>$resultsPerPage) {include '../includes/pagination.php';}?>

<table class="table table-bordered table-sm">

<br>
<h4>Поръчки..</h4>
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
   switch($sort){
                case 1:
                    $orderBy = "ci_id $type";
                    break;
                    
                case 2:
                    $orderBy = "customer_name $type";
                    break;
                    
                case 3:
                    $orderBy = "item_id $type" ;
                    break;
                    
                case 4:
                    $orderBy = "item_price $type" ;
                    break;
                    
                case 5:
                    $orderBy = "ci_quantity $type" ;
                    break;
                    
                case 6:
                    $orderBy = "total $type" ;
                    break;
                    
                case 7:
                    $orderBy = "ci_date $type" ;
                    break;
                //Резултат различен от 1,2,3
                default:
                    $orderBy = 'ci_id';
            }

    ?>
    
      
<?php

$sql= "SELECT 
            ci_id, 
            CONCAT('(..', RIGHT(item_id,3), ') ', item_name) AS item,
            item_price,
            ci_quantity,
            item_price*ci_quantity AS total,
            DATE_FORMAT(ci_date,'%d/%m/%Y') AS date
            FROM customers_items LEFT JOIN customers ON ci_customer_id = customer_id 
            LEFT JOIN items ON ci_item_id = item_id 
            WHERE ci_customer_id = $id
            ";
//            echo $sql;

        //Запълване на таблицата
        foreach ($pdo->query($sql) as $row) {
           
            //Колоните
            echo '<tr>';
            
            echo '<td class="col-sm-1 text-right">'. $row['ci_id'] . '</td>';
            echo '<td class="col-sm-3 ">' . $row['item'] . '</td>';
            echo '<td class="col-sm-1 text-right">' . $row['item_price'] . ' лв.'. '</td>';
            echo '<td class="col-sm-1 text-right">' . $row['ci_quantity'] . ' бр.'. '</td>';
            echo '<td class="col-sm-1">' . $row['total'] . ' лв.'. '</td>';
            echo '<td class="col-sm-1">' . $row['date'] . '</td>';
            
            //Колоната "Операции"
            echo '<td class="col-sm-1 btn-group-justified">';
                
                /*/Бутон "Информация"   
                echo '<a class="btn btn-xs btn-success"data-toggle="tooltip" data-placement="bottom"' . 
                    'title="Информация" ' .  
                    'href="orders_info.php?id=' . $row['ci_id'] . 
                    '"><span class="glyphicon glyphicon-eye-open"></span></a>';*/
                             
                //Бутон "Промени"   
                echo '<a class="btn btn-xs btn-warning"data-toggle="tooltip" data-placement="bottom"' . 
                    'title="Промени"' . 
                    'href="orders_edit.php?id=' . $row['ci_id'] .
                    '"><span class="glyphicon glyphicon-pencil"></span></a>';
                               
                //Бутон "Изтрий"
                echo '<a class="btn btn-xs btn-danger"data-toggle="tooltip" data-placement="bottom"' . 
                    'title="Изтрий"' . 
                    'href="orders_delete.php?id=' . $row['ci_id'] . 
                    '"><span class="glyphicon glyphicon-trash"></span></a>';
                
            echo '</td>';
            echo '</tr>';
        }
        
       

?>

    </tbody>
</table>


<?php if($nRows>$resultsPerPage) {include '../includes/pagination.php';}?>
        

                    
                     <a class="btn-lg btn-primary" href="customers.php">Oбратно</a>
                </div>
                
<script src="../bootstrap/js/bootstrap.js"></script>
</body>
</html>