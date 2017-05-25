<?php
    require '../includes/database.php';
    $id = null; 
    
    if (!empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
    if ( null==$id ) {
        header("Location: orders.php");
    }

    if ( !empty($_POST)) {
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM `customers_items` WHERE `customers_items`.`ci_id` = ?";
        $query = $pdo->prepare($sql);
        $query->execute(array($id));
        Database::disconnect();
        header('Location:orders.php');
            
    }
     
?>

<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="utf-8">
    <link   href="../bootstrap/css/bootstrap.css" rel="stylesheet">
</head>
 
<body>

    <title>Изтриване на поръчка</title>
    
    <div class="container">
        <h3>Изтриване на поръчка № <?=$_GET['id'];?> ?</h3>

         <form class="form-horizontal" method="post" action="orders_delete.php?id=<?=$id;?>">
            <div class="form-actions">
                <div class="col-sm-6 col-sm-offset-2">
                    <button type="submit" class="btn btn-success" name="submit">Потвърди</button>
                     <a class="btn btn-danger" href="orders.php">Откажи</a>
                </div>
            </div>
        </form>
    </div>
                
<script src="../bootstrap/js/bootstrap.js"></script>
</body>
</html>