<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
</head>
<body>
    <div>
        <h1>Stocks</h1>
        <a href="<?=SROOT?>StockManagerHandler/manageStock">Add Stock Item</a> <br><br>
        <?php if(count($this->inventory)>0){?>
            <table>
                <?php foreach ($this->inventory as $item) { ?>
                <tr>
                <td>
                    <div>
                        <?=$item->name?><br>
                        <?="Available quantity: ".$item->available_count?><br>
                        <?="Unit price Rs.".$item->unit_price?><br>
                    </div><br>
                </td>
                <td><a href="<?=SROOT?>StockManagerHandler/delete/<?=$item->item_id?>">Delete</a></td>
                <td><a href="<?=SROOT?>StockManagerHandler/manageStock/<?=$item->item_id?>">Edit</a></td>
                </tr>
                <?php } ?>
            </table>

        <?php } else { ?>
            <h2>No items in the stock</h2>
        <?php }?>
    </div>

    <br><br><a href="<?=SROOT?>StockManagerHandler">Home</a>
</body>
</html>