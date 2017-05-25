<?php
    require '../includes/database.php';
    $ci_quantityError = '';
    $ci_customer_id = $ci_item_id = $ci_quantity = $ci_comment = '';
    $id = null; 
    
    if (!empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
    if ( null==$id ) {
        header("Location: orders.php");
    }

    if ( !empty($_POST)) {
        // keep track validation errors
        
        // keep track post values
        $ci_customer_id = $_POST['ci_customer_id'];
        $ci_item_id = $_POST['ci_item_id'];
        $ci_quantity = $_POST['ci_quantity'];
        $ci_comment = $_POST['ci_comment'];
         
        // validate input
        $valid = true;
        
        if (empty($ci_quantity) or $ci_quantity < 1) {
            $itemPriceError = 'Моля въведете количество >= 1!';
            $valid = false;
        }
                     
        // update data
        if ($valid) {
            $ci_quantity=test_input($ci_quantity);
            $ci_comment=test_input($ci_comment);
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE customers_items SET 
                ci_customer_id = ?, 
                ci_item_id = ?, 
                ci_quantity = ?,
                ci_comment = ? 
                WHERE item_id= ?";
                
            $query = $pdo->prepare($sql);
            $query->execute(array($ci_customer_id, $ci_item_id, $ci_quantity, $ci_comment, $id));
            Database::disconnect();
            
            header('Location:items.php');
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT *
            FROM `customers_items`
            WHERE `ci_id`= ?";
            
        $query = $pdo->prepare($sql);
        $query->execute(array($id));
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $ci_customer_id = $data['ci_customer_id'];
        $ci_item_id = $data['ci_item_id'];
        $ci_quantity = $data['ci_quantity'];
        $ci_comment = $data['ci_comment'];
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

    <title>Нова поръчка</title>
    
    <div class="container">
        <h2>Промяна на поръчка № <?=$id;?></h2>

        <form class="form-horizontal" form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 

            <div class="form-group">
                <label for="customer_id" class="col-sm-2 control-label">Клиент </label>
                <div class="col-sm-7">

                <?php 
                    try 
                    {
                        $sql = "SELECT customer_id, customer_name FROM customers";
                        $projresult = $pdo->query($sql);
                        $projresult->setFetchMode(PDO::FETCH_ASSOC);

                        echo '<select name="customer_id"  id="customer_id" class="form-control" >';

                        while ( $row = $projresult->fetch() ) 
                        {
                           
                            echo '<option value="' . $row['customer_id'] . '">' .
                                $row['customer_id'] . ' : ' . $row['customer_name'].
                                '</option>';
                        }

                        echo '</select>';

                        }   
                    catch (PDOException $e) 
                    {   
                            die("Some problem getting data from database !!!" . $e->getMessage());
                    }

                ?>

               </div>
            </div>
           
            <div class="form-group">
                <label for="item_id" class="col-sm-2 control-label">Артикул </label>
                <div class="col-sm-7">
                <?php 
                    try
                    {
                             $sql = "SELECT item_id, item_name, item_price FROM items";
                             $projresult = $pdo->query($sql);
                             $projresult->setFetchMode(PDO::FETCH_ASSOC);

                             echo '<select name="item_id"  id="item_id" class="form-control" >';

                         while ( $row = $projresult->fetch() ) 
                         {
                            echo '<option value="' . $row['item_id'] . '">' .
                                $row['item_id'] . ' : ' . $row['item_name'] .' , цена: '. $row['item_price'] . ' лв.'.
                                '</option>';
                         }

                         echo '</select>';
                    }
                    
                    catch (PDOException $e)
                    {   
                        die("Some problem getting data from database !!!" . $e->getMessage());
                    }

                ?>

               </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="quantity">Количество:</label>
                <div class="col-sm-7">
                    <input type="number" min="1" step="1" class="form-control"
                           name="quantity" placeholder="Въведете Количество" value="<?=$ci_quantity;?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="comment">Коментар:</label>
                <div class="col-sm-7">
                    <textarea class="form-control" rows="5"
                        name="comment" placeholder="Коментар към поръчката" value="<?=$ci_comment;?>">
                    </textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-6 col-sm-offset-2">
                    <button type="submit" class="btn btn-success" name="submit">Потвърди</button>
                     <a class="btn btn-danger" href="orders.php">Откажи</a>
                </div>
            </div>
        </form>
    </div>
        <?php Database::disconnect();?>              
<script src="../bootstrap/js/bootstrap.js"></script>
</body>
</html>