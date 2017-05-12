<?php
     $itemNameError = $itemPriceError = $itemDescriptionError = null;
     $itemName = $itemPrice = $itemDescription = '';
    require '../includes/database.php';
    $pdo = Database::connect();
 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["itemName"])) {
            $itemNameErr = "Въведете име на артикул";
        } else {
            $itemName = test_input($_POST["itemName"]);
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
                $itemPriceError = 'Моля въведете цена!';
                $valid = false;
            }
            
             
            // insert data
            if ($valid) {
                $itemName=test_input($itemName);
                $itemDescription=test_input($itemDescription);
                
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //select Table and Columns
                $sql = "INSERT INTO `items` (`item_name` , `item_price`, `item_description`) VALUES (?,?,?)";
                $query = $pdo->prepare($sql);
                $query->execute(array($itemName, $itemPrice, $itemDescription));
                
                Database::disconnect();
               header('Location:items.php');
                
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

    <title>Нов артикул</title>
    
    <div class="container">
        <h2>Добавяне на нов артикул</h2>

        <form class="form-horizontal" form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
            <div class="form-group">
                <label class="control-label col-sm-2" for="itemName">Име:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="itemName" placeholder="Въведете име на артикул">
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="itemPrice">Цена:</label>
                <div class="col-sm-7">
                    <input type="number" min="0" step="any" class="form-control"
                        name="itemPrice" placeholder="Въведете цената на артикула">
                    
                </div>
            </div>
           
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="itemDescription">Описание:</label>
                <div class="col-sm-7">
                    <textarea class="form-control" rows="5"
                        name="itemDescription" placeholder="Описание на артикула">
                    </textarea>
                </div>
            </div>

            <div class="form-group">
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