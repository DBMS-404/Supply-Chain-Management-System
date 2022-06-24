<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Routes</title>
</head>
<body>
    <h2>Routes</h2>

    <table>
        <tr>
            <th>Route</th>
            <th></th>
        </tr>

        <?php

        foreach ($this->routes as $route) { ?>
            <tr>
                <td>Route <?= $route->route_id ?></td>
                <td>
                    <a href="<?=SROOT?>StockKeeperHandler/assigntruck/<?= $route->route_id ?>">Assign</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
</body>
</html>