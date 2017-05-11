<?php
    require '../includes/database.php';
    $customerNameError = null;
    $id = null; 
    
    if (!empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
    if ( null==$id ) {
        header("Location: customers.php");
    }

    if ( !empty($_POST)) {
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM `customers` WHERE `customers`.`customer_id` = ?";
        $query = $pdo->prepare($sql);
        $query->execute(array($id));
        Database::disconnect();
        header('Location:customers.php');
            
    } else {
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

    <title>Изтриване на клиент</title>
    
    <div class="container">
        <h3>Изтриване на клиент с № <?=$_GET['id'];?></h3>

        
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
                    <p class="form-control-static"><?=$customerName;?></p>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="customerTypeId">Тип:</label>
                <div class="col-sm-7">
                    <p class="form-control-static"><?=$customerTypeId?></p>
                    </select>
                </div>
            </div>
            <br>
        </form>
        
         <form class="form-horizontal" method="post" action="customers_delete.php?id=<?=$id;?>">
            <div class="form-actions">
                <div class="col-sm-6 col-sm-offset-2">
                    <button type="submit" class="btn btn-success" name="submit">Потвърди</button>
                     <a class="btn btn-danger" href="customers.php<?php /*echo ($_SERVER["PHP_SELF"]==$_SERVER['HTTP_REFERER']) ? 'customers.php' : $_SERVER["HTTP_REFERER"];*/ ?>">Откажи</a>
                </div>
            </div>
        </form>
    </div>
                
<script src="../bootstrap/js/bootstrap.js"></script>
</body>
</html>