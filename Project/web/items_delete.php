<?php
    require '../includes/database.php';
    $id = null; 
    
    if (!empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
    if ( null==$id ) {
        header("Location: items.php");
    }

    if ( !empty($_POST)) {
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM `items` WHERE `items`.`item_id` = ?";
        $query = $pdo->prepare($sql);
        $query->execute(array($id));
        Database::disconnect();
        header('Location:items.php');
            
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT *
            FROM `items`
            WHERE `item_id`= ?";
            
        $query = $pdo->prepare($sql);
        $query->execute(array($id));
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $itemName = $data['item_name'];
        $itemPrice = $data['item_price'];
        Database::disconnect();
    }  
?>

<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="utf-8">
    <link   href="../bootstrap/css/bootstrap.css" rel="stylesheet">
</head>
 
<body>

    <title>Изтриване на артикул</title>
    
    <div class="container">
        <h3>Изтриване на артикул № <?=$_GET['id'];?></h3>

        <form class="form-horizontal">
            <div class="form-group">
                <label class="control-label col-sm-2" for="id">№:</label>
                <div class="col-sm-7">
                    <p class="form-control-static"><?=$id;?></p>
                </div>
            </div>        
            <div class="form-group">
                <label class="control-label col-sm-2" for="customerId">Имена:</label>
                <div class="col-sm-7">
                    <p class="form-control-static"><?=$itemName;?></p>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="customerTypeId">Тип:</label>
                <div class="col-sm-7">
                    <p class="form-control-static"><?=$itemPrice?></p>
                    </select>
                </div>
            </div>
            <br>
        </form>
        
         <form class="form-horizontal" method="post" action="items_delete.php?id=<?=$id;?>">
            <div class="form-actions">
                <div class="col-sm-6 col-sm-offset-2">
                    <button type="submit" class="btn btn-success" name="submit">Потвърди</button>
                     <a class="btn btn-danger" href="items.php">Откажи</a>
                </div>
            </div>
        </form>
    </div>
                
<script src="../bootstrap/js/bootstrap.js"></script>
</body>
</html>