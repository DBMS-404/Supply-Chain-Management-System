<?php 
    if ($_POST){
        $values = posted_values($_POST);
    }

    if (isset($this->edit_values)){
        $values = $this->edit_values;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Stock</title>
</head>
<body>
    <h1>Manage stock</h1>
    <div>
        <form action="<?=SROOT?>StockManagerHandler/manageStock/<?= $this->item_id?>" method="post">
            <label>Item Name: </label>
            <input type="text" name="name" value = "<?= ($values['name'] ?? "")?>" required> <br><br>
            <label>Quantity: </label>
            <input type="text" name="available_count" value = "<?= ($values['available_count'] ?? "")?>" required> <br><br>
            <label>Unit price: </label>
            <input type="text" name="unit_price" value = "<?= ($values['unit_price'] ?? "")?>" required> <br><br>
            <input type="submit" value="Submit">
            
        </form>
    </div>
    <span>
        <?= $this->displayErrors ?? "" ?>
    </span>
</body>
</html>