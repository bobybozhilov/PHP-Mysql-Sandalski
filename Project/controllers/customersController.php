<?php
class CustomersController
{
    // Покажи различните видове клиенти
    public static function displayTypeOfClients (PDO $pdo) {  
        $sqlTypes = "SELECT * FROM `types`";
        $str = ''; 
        foreach ($pdo->query($sqlTypes) as $row) {
            $str .= '<dt>' . 'Tип ' . $row['type_id'] . '</dt>';
            $str .= '<dd>' . $row['type_name'] . '</dd>';  
        }
        return $str;
    }
    
    public static function orderBy($sort, $type) {
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
        return $orderBy;
    }
    
    public static function getRowsCount(PDO $pdo) {
        return $pdo->query('SELECT count(*) FROM `' . 'customers' . '`')->fetchColumn(); 
    }
    
    public static function addNew() {
        return '<a href="customers_add.php" class="btn btn-success"> 
            <span class="glyphicon glyphicon-plus"></span> Добави клиент
        </a>';
    }
    
    public static function fillTable (PDO $pdo, $orderBy, $resultsPerPage, $offset) {
         $sql = "SELECT 
            `customer_id`,
            `customer_name`,
            `customer_type_id`
            FROM `customers`
            ORDER BY $orderBy
            LIMIT $resultsPerPage
            OFFSET $offset
            ";

        //Запълване на таблицата
        foreach ($pdo->query($sql) as $row) {
           
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
                
//                //Бутон "Информация"   
//                echo '<a class="btn btn-xs btn-success"data-toggle="tooltip" data-placement="bottom"' . 
//                    'title="Информация" ' .  
//                    'href="customers_info.php?id=' . $row['customer_id'] . 
//                    '"><span class="glyphicon glyphicon-eye-open"></span></a>';
                             
                //Бутон "Промени"   
                echo '<a class="btn btn-xs btn-warning"data-toggle="tooltip" data-placement="bottom"' . 
                    'title="Промени"' . 
                    'href="customers_edit.php?id=' . $row['customer_id'] .
                    '"><span class="glyphicon glyphicon-pencil"></span></a>';
                               
                //Бутон "Изтрий"
                echo '<a class="btn btn-xs btn-danger"data-toggle="tooltip" data-placement="bottom"' . 
                    'title="Изтрий"' . 
                    'href="customers_delete.php?id=' . $row['customer_id'] . 
                    '"><span class="glyphicon glyphicon-trash"></span></a>';
                
            echo '</td>';
            echo '</tr>';
        }
    }

}