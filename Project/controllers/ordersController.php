<?php
class OrdersController
{   
    public static function orderBy($sort, $type) {
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
        return $orderBy;
    }
    
    public static function getRowsCount(PDO $pdo) {
        return $pdo->query("SELECT count(*) FROM (
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
    }
    
    public static function addNew() {
        return '
        <a href="orders_add.php" class="btn btn-success"> 
            <span class="glyphicon glyphicon-plus"></span> Добави поръчка
        </a>';
        }
    
    public static function fillTable (PDO $pdo, $orderBy, $resultsPerPage, $offset, $search) {
        //$search = test_input($search);
        
        $where = ($search == '') ? '1' : " customer_name LIKE '$search%'";
//        echo 'WHERE = ' . $where;
            
        
         $sql= "SELECT 
            ci_id, 
            CONCAT('(..', RIGHT(customer_id,3), ') ', customer_name,' (тип ' ,customer_type_id, ')') AS customer,
            CONCAT('(..', RIGHT(item_id,3), ') ', item_name) AS item,
            item_price,
            ci_quantity,
            item_price*ci_quantity AS total,
            DATE_FORMAT(ci_date,'%d/%m/%Y') AS date
            FROM customers_items LEFT JOIN customers ON ci_customer_id = customer_id 
            LEFT JOIN items ON ci_item_id = item_id 
            WHERE $where
            ORDER BY $orderBy
            LIMIT $resultsPerPage
            OFFSET $offset
            ";
//            echo $sql;

        //Запълване на таблицата
        foreach ($pdo->query($sql) as $row) {
           
            //Колоните
            echo '<tr>';
            
            echo '<td class="col-sm-1 text-right">'. $row['ci_id'] . '</td>';
            echo '<td class="col-sm-3">' . $row['customer'] . '</td>';
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
        
       
    }
    private static function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
    }

    public static function calculateSums(PDO $pdo){
        $sql = "SELECT 
            SUM(item_price*ci_quantity) AS total, 
            customer_type_id 
            FROM customers_items LEFT JOIN items ON ci_item_id = item_id 
            LEFT JOIN customers ON ci_customer_id = customer_id 
            GROUP BY customer_type_id 
            ORDER BY customer_type_id
            "; 
            $paid = $remain = 0;
            foreach ($pdo->query($sql) as $row) {
                 
                if($row['customer_type_id']==1){
                    $paid+=$row['total'];
                } 
                if ($row['customer_type_id']==2) {
                    $paid += 0.15*$row['total'];
                    $remain += 0.85 * $row['total'];
                }
                if ($row['customer_type_id']==3) {
                    $remain += $row['total'];
                }
            }
            $paid = '<b>' . number_format($paid,2,'</b>.', ' ');
            $remain = '<b>' . number_format($remain,2 ,'</b>.', ' ');
            return array($paid, $remain);
    }
    
}

   
?>
