<?php
if ($_POST) {
    $values = posted_values($_POST);
}

if (isset($this->edit_values)) {
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
    <style>
        .bg-danger {
            color: #FF0000;
        }

        .Appcontainer {
            z-index: 2;
            border-radius: 15px;
            background-color: #e9e9e9ed;
            height: 15%;
            width: 40%;
            margin: auto;
            margin-top: 2cm;
            padding: 30px;
            padding-left: 30px;
            padding-right: 30px;
            box-shadow: 10px 10px 50px 0.1px rgba(0, 0, 0, 0.664);
        }
    </style>
    <?php include_once('css/baseForm.php'); ?>
</head>

<body>
    <div class="container-fluid">
        <h1 class="header" style="text-align: center;">Manage stock</h1>
        <div class="Appcontainer">
            <form class="form-horizontal" action="<?= SROOT ?>StockManagerHandler/manageStock/<?= $this->item_id ?>" method="post">
                <label>Item Name: </label>
                <input class="form-control" type="text" name="name" value="<?= ($values['name'] ?? "") ?>" required> <br><br>
                <label>Quantity: </label>
                <input class="form-control" type="text" name="available_count" value="<?= ($values['available_count'] ?? "") ?>" required> <br><br>
                <label>Unit price: </label>
                <input class="form-control" type="text" name="unit_price" value="<?= ($values['unit_price'] ?? "") ?>" required> <br><br>
                <input class="btn btn-success" type="submit" value="Submit">

            </form>
            <span class='bg-danger'>
                <?= $this->displayErrors ?? "" ?>
            </span>
        </div>
    </div>
</body>

</html>