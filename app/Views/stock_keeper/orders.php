<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Orders</title>
</head>
<body>

    <table>
        <tr>
            <th>Order id</th>
            <th>Weight</th>
            <th>Address</th>
            <th></th>
        </tr>

        <?php

        foreach ($this->orders as $item_order) { ?>
                    <tr>
                        <td><?= $item_order->order_id ?></td>
                        <td><?= $item_order->weight . " g" ?></td>
                        <td><?= $item_order->address ?></td>
                        <td>
                            <a href="<?=SROOT?>StockKeeperHandler/markasrecieved/<?= $item_order->order_id ?>">Mark As Received</a>
                        </td>
                    </tr>
        <?php
            }
        ?>

    </table>

</body>
</html>