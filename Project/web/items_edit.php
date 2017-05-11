<?php
    require '../includes/database.php';
    $itemNameError = $itemPriceError = $itemDescriptionError = '';
    $itemName = $itemPrice = $itemDescription = '';
    $id = null; 
    
    if (!empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
    if ( null==$id ) {
        header("Location: items.php");
    }

    if ( !empty($_POST)) {
        // keep track validation errors
        
        // keep track post values
        $itemName = $_POST['itemName'];
        $itemPrice = $_POST['itemPrice'];
        $itemDescription = $_POST['itemDescription'];
         
        // validate input
        $valid = true;
        if (empty($itemName)) {
            $itemNameError = 'Моля въведете имена на клиента!';
            $valid = false;
        }
        
        if (empty($itemPrice) or $itemPrice < 0) {
            $itemPriceError = 'Моля въведете цена > 0!';
            $valid = false;
        }
                     
        // update data
        if ($valid) {
            $itemName=test_input($itemName);
            $itemDescription=test_input($itemDescription);
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE items SET 
                item_name = ?, 
                item_price = ?, 
                item_description = ? 
                WHERE item_id= ?";
                
            $query = $pdo->prepare($sql);
            $query->execute(array($itemName, $itemPrice, $itemDescription, $id));
            Database::disconnect();
            
            header('Location:items.php');
        }
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
        $itemDescription = $data['item_description'];
        Database::disconnect();
    }
         
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="utf-8">
    <link   href="../bootstrap/css/bootstrap.css" rel="stylesheet">
</head>
 
<body>

    <title>Промяна на артикул</title>
    
    <div class="container">
        <h3>Промяна на артикул с № <?=$_GET['id'];?></h3>

        <form class="form-horizontal" method="post" action="items_edit.php?id=<?=$id;?>"> 
        
        <div class="form-group">
            <label class="control-label col-sm-2" for="itemName">Име:<?=$itemNameError;?></label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" placeholder="Въведете име на артикул" 
                     name="itemName" value="<?=$itemName;?>">
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="itemPrice">Цена:<?=$itemPriceError;?></label>
                <div class="col-sm-7">
                    <input type="number" min="0" step="any" class="form-control"
                        placeholder="Въведете цената на артикула"
                        name="itemPrice" value="<?=$itemPrice;?>">
                </div>
            </div>
           
            <div class="form-group">
                <label class="control-label col-sm-2" for="itemDescription">Описание:</label>
                <div class="col-sm-7">
                    <textarea class="form-control" rows="5"
                        name="itemDescription"><?=$itemDescription;?>
                    </textarea>
                </div>
            </div>

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