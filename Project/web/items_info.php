<?php
    require '../includes/database.php';

    if (!empty($_GET['id'])) {
        $id = $_REQUEST['id'];

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
        $itemDescription = $data['item_description'];
        Database::disconnect();
    }  else {
        header('Location:items.php');
    }
?>
<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="utf-8">
    <link   href="../bootstrap/css/bootstrap.css" rel="stylesheet">
</head>
 
<body>

    <title>Информация за на артикул</title>
    
    <div class="container">
        <h3>Информация за артикул № <?=$_GET['id'];?></h3>

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
            
            <div class="form-group ">
                <label class="control-label col-sm-2" for="itemDescription">Описание:</label>
                <div class="col-sm-7 well well-sm">
                    <text class="form-control-static " rows="5"
                        name="itemDescription"><?=nl2br($itemDescription);?>
                    </text>
                </div>
            </div>
        
            <div class="form-actions">
                <div class="col-sm-6 col-sm-offset-2 ">
                    
                     <a class="btn-lg btn-primary" href="items.php">Oбратно</a>
                </div>
            </div>
        </form>
    </div>
                
<script src="../bootstrap/js/bootstrap.js"></script>
</body>
</html>