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
            // keep track validation errors
            
            // keep track post values
            $customerName = $_POST['customerName'];
            $customerTypeId = $_POST['customerTypeId'];
             
            // validate input
            $valid = true;
            if (empty($customerName)) {
                $customerNameError = 'Моля въведете имена на клиента!';
                $valid = false;
            }
                         
            // update data
            if ($valid) {
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "UPDATE customers SET customer_name = ?, customer_type_id = ? WHERE customer_id= ?";
                $query = $pdo->prepare($sql);
                $query->execute(array($customerName, $customerTypeId, $id));
                Database::disconnect();
                
                header('Location:customers.php');
     
            }
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

    <title>Промяна на клиент</title>
    
    <div class="container">
        <h3>Промяна на клиент с № <?=$_GET['id'];?></h3>

        <form class="form-horizontal" method="post" action="customers_edit.php?id=<?=$id;?>"> 

            <div class="form-group">
                <label class="control-label col-sm-2" for="customerName">Имена:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="customerName" value="<?=$customerName;?>">
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="customerTypeId">Тип:</label>
                <div class="col-sm-7">
                    <select class="form-control" name="customerTypeId" value="<?=$customerTypeId?>">
                        <option value="1" <?=($customerTypeId == 1) ? 'selected' : '';?>>Тип 1</option>
                        <option value="2" <?=($customerTypeId == 2) ? 'selected' : '';?>>Тип 2</option>
                        <option value="3" <?=($customerTypeId == 3) ? 'selected' : '';?>>Тип 3</option>
                    </select>
                </div>
            </div>
            <br>
     
            <dl class="dl-horizontal well col-sm-8 col-sm-offset-1">
            <?php
                // Покажи различните видове клиенти
                $sqlTypes = "SELECT * FROM `types`";
                foreach ($pdo->query($sqlTypes) as $row) {
                    echo '<dt>' . 'Tип ' . $row['type_id'] . '</dt>';
                    echo '<dd>' . $row['type_name'] . '</dd>'; 
                    Database::disconnect();
                }
            ?>
            </dl>

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