<?php
class ItemsController
{   
    public static function orderBy($sort, $type) {
             switch($sort){
                case 1:
                    $orderBy = "item_id $type";
                    break;
                    
                case 2:
                    $orderBy = "item_name $type";
                    break;
                    
                case 3:
                    $orderBy = "item_price $type" ;
                    break;
                    
                //Резултат различен от 1,2,3
                default:
                    $orderBy = 'item_id';
            }
        return $orderBy;
    }
    
    public static function getRowsCount(PDO $pdo) {
        return $pdo->query('SELECT count(*) FROM `' . 'items' . '`')->fetchColumn(); 
    }
    
    public static function addNew() {
        return '
        <a href="items_add.php" class="btn btn-success"> 
            <span class="glyphicon glyphicon-plus"></span> Добави артикул
        </a>';
        }
    
    public static function fillTable (PDO $pdo, $orderBy, $resultsPerPage, $offset) {
         $sql= "SELECT 
            `item_id`,
            `item_name`,
            `item_price`
            FROM `items`
            ORDER BY $orderBy
            LIMIT $resultsPerPage
            OFFSET $offset
            ";

        //Запълване на таблицата
        foreach ($pdo->query($sql) as $row) {
           
            //Колоните
            echo '<tr>';
            
            echo '<td class="col-sm-1 text-right">'. $row['item_id'] . '</td>';
            echo '<td class="col-sm-8">' . $row['item_name'] . '</td>';
            echo '<td class="col-sm-2">' . $row['item_price'] . ' лв.'. '</td>';
            
            //Колоната "Операции"
            echo '<td class="col-sm-1 btn-group-justified">';
                
                //Бутон "Информация"   
                echo '<a class="btn btn-xs btn-success"data-toggle="tooltip" data-placement="bottom"' . 
                    'title="Информация" ' .  
                    'href="items_info.php?id=' . $row['item_id'] . 
                    '"><span class="glyphicon glyphicon-eye-open"></span></a>';
                             
                //Бутон "Промени"   
                echo '<a class="btn btn-xs btn-warning"data-toggle="tooltip" data-placement="bottom"' . 
                    'title="Промени"' . 
                    'href="items_edit.php?id=' . $row['item_id'] .
                    '"><span class="glyphicon glyphicon-pencil"></span></a>';
                               
                //Бутон "Изтрий"
                echo '<a class="btn btn-xs btn-danger"data-toggle="tooltip" data-placement="bottom"' . 
                    'title="Изтрий"' . 
                    'href="items_delete.php?id=' . $row['item_id'] . 
                    '"><span class="glyphicon glyphicon-trash"></span></a>';
                
            echo '</td>';
            echo '</tr>';
        }
    }

}