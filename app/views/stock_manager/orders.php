<?php
$this->filter = $this->filter ?? "all";
$statuses = ['all' => "All", 'new' => "New", 'dtrain' => "Dispatch to train", 'ctrain' => "Collected from train", 'atruck' => "Assigned to truck", 'dtruck' => "Dispatched to truck", 'delivered' => "Delivered"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
</head>

<body>
    <div>
        <form action='<?= SROOT ?>StockManagerHandler/filterstatus' method='post'>
            <label for="filter">Filter by Status</label>
            <select name='filter-status' onchange='this.form.submit()'>
                <?php
                foreach ($statuses as $key => $value) {
                    if ($key === $this->filter) {
                        echo "<option value =" . $key . " selected= 'selected'>" . $value . "</option>";
                    } else {
                        echo "<option value=" . $key . ">" . $value . "</option>";
                    }
                }

                ?>
            </select>
        </form>
    </div>
    <div>
        <table>
            <th>
                Orders
            </th>
            <?php if (count($this->orders) > 0) {
                foreach ($this->orders as $item_order) { ?>
                    <tr>
                        <td>
                            <div>
                                <?= "Order " . $item_order->order_id ?><br>
                                <?= $item_order->weight . " kg" ?><br>
                                <?= $item_order->address ?><br><br>
                            </div>
                        </td>
                        <td>
                            <?php if ($item_order->status == "new") { ?>
                                <a href="<?= SROOT ?>StockManagerHandler/assignto_train/<?= $item_order->order_id ?>">Assign</a>
                            <?php } ?>
                        </td>
                        <td>
                            <form action='<?= SROOT ?>StockManagerHandler/changeStatus/<?= $item_order->order_id ?>' method='post'>
                                <select name='status' onchange='this.form.submit()'>  
                                    <?php
                                    foreach ($statuses as $key => $value) {
                                        if ($key === $item_order->status) {
                                            echo "<option value =" . $key . " selected= 'selected'>" . $value . "</option>";
                                        } else {
                                            echo "<option value=" . $key . ">" . $value . "</option>";
                                        }
                                    }

                                    ?>
                                </select>
                            </form>
                        </td>

                    </tr>
                <?php } ?>
            <?php } else { ?>
                <h1>No orders available</h1>
            <?php } ?>
        </table>
    </div>

    <a href="<?=SROOT?>StockManagerHandler">Home</a>
</body>

</html>