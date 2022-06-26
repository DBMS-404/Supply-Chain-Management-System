<?php

$page_title = "Orders";
$orders_active = "active";
$leaves_active = "";
$routes_active = "";

require_once 'app/views/includes/sk_header.php';
?>

<div class="container">
    <ul class="list-group">
        <?php foreach ($this->orders as $item_order) { ?>

        <li class="list-group-item p-4">
            <div class="row">Order ID: <?= $item_order->order_id ?></div>
            <div class="row">Train: <?= $item_order->train_name ?></div>
            <div class="row">Weight: <?= $item_order->weight . " kg" ?></div>
            <div class="row">Address: <?= $item_order->address ?></div>
            <div class="row">
                <div class="col-8"></div>
                <div class="col-4">
                    <a type="button" class="btn btn-primary" href="<?=SROOT?>StockKeeperHandler/markasrecieved/
                        <?= $item_order->order_id ?>/<?= $item_order->train_id ?>/<?= $item_order->weight ?>">Mark As Received</a>
                </div>
            </div>

        </li>

        <?php } ?>

    </ul>

    <div class="row mt-4 mb-4">
        <div class="col-11">
            <a type="button" class="btn btn-primary pl-5 pr-5" href="<?=SROOT?>StockKeeperHandler">Home</a>
        </div>
    </div>

</div>







<?php

require_once 'app/views/includes/footer.php';
