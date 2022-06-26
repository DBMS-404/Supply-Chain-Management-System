<?php

$page_title = "Routes";
$orders_active = "";
$leaves_active = "";
$routes_active = "active";

require_once 'app/views/includes/sk_header.php';
?>


<div class="container">
    <h2>Routes</h2>

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#assign" data-bs-toggle="tab">Assign Truck</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#dispatch" data-bs-toggle="tab">Dispatch Truck</a>
        </li>

    </ul>

    <div class="tab-content">
        <div id="assign" class="tab-pane fade show active">

            <ul class="list-group">

                <?php foreach ($this->routesToAssign as $route) { ?>

                    <li class="list-group-item p-4">
                        <div class="row">Route <?= $route->route_id ?></div>
                        <div class="row">
                            <div class="col-8"></div>
                            <div class="col-4">
                                <a type="button" class="btn btn-primary" href="<?=SROOT?>StockKeeperHandler/assigntruck/<?= $route->route_id ?>">Assign</a>
                            </div>
                        </div>

                    </li>

                <?php } ?>

            </ul>
        </div>

        <div id="dispatch" class="tab-pane fade">

            <ul class="list-group">

                <?php foreach ($this->routesToDispatch as $turn) { ?>

                    <li class="list-group-item p-4">
                        <div class="row">Route <?= $turn->route_id ?></div>
                        <div class="row">
                            <div class="col-8"></div>
                            <div class="col-4">
                                <a type="button" class="btn btn-primary" href="<?=SROOT?>StockKeeperHandler/dispatchtruck/<?= $turn->turn_id ?>/<?= $turn->route_id ?>">Dispatch</a>
                            </div>
                        </div>

                    </li>

                <?php } ?>

            </ul>
        </div>
    </div>
    <div class="row mt-4 mb-4">
        <div class="col-11">
            <a type="button" class="btn btn-primary pl-5 pr-5" href="<?=SROOT?>StockKeeperHandler">Home</a>
        </div>
    </div>
</div>

<?php

require_once 'app/views/includes/footer.php';