<?php
     $customerNameError = null;
     $customerName = $customerTypeId = '';
    require '../includes/database.php';
    $pdo = Database::connect();
 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["customerName"])) {
            $customerNameErr = "Въведете име на клиент";
        } else {
            $customerName = test_input($_POST["customerName"]);
        }
     
        if ( !empty($_POST)) {
            // keep track validation errors
            
            // keep track post values
            $customerName = test_ = $_POST['customerName'];
            $customerTypeId = $_POST['customerTypeId'];
             
            // validate input
            $valid = true;
            if (empty($customerName)) {
                $customerNameError = 'Моля въведете имена на клиента!';
                $valid = false;
            }
            
             
            // insert data
            if ($valid) {
                $customerName = test_input($customerName);
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //select Table and Columns
                $sql = "INSERT INTO `customers` (`customer_name` , `customer_type_id`) VALUES (?,?)";
                $query = $pdo->prepare($sql);
                $query->execute(array($customerName,$customerTypeId));
                
                Database::disconnect();
                //header('Location: ' . $_SERVER['HTTP_REFERER']);
               header('Location:customers.php');
                
                exit;
            }
        }
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

    <title>Нов клиент</title>
    
    <div class="container">
        <h2>Добавяне на нов клиент</h2>

        <form class="form-horizontal" form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
            <div class="form-group">
                <label class="control-label col-sm-2" for="customerName">Имена:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="customerName" placeholder="Въведете имена на клиента">
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="customerTypeId">Тип:</label>
                <div class="col-sm-7">
                    <select class="form-control" name="customerTypeId">
                        <option value="1">Тип 1</option>
                        <option value="2">Тип 2</option>
                        <option value="3">Тип 3</option>
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

            <div class="form-group">
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