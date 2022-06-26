<?php

$page_title = "Leaves";
$orders_active = "";
$leaves_active = "active";
$routes_active = "";

require_once 'app/views/includes/sk_header.php';
?>

<div class="container">
    <h2>Leave Requests</h2>

    <ul class="list-group">
        <?php foreach ($this->leaves as $leave) { ?>

            <li class="list-group-item p-4">
                <div class="row"><?= $leave->first_name." ".$leave->last_name ?></div>
                <div class="row">
                    <?php
                    if (substr($leave->user_id,0,2)=="DR"){
                        echo "Driver";
                    }else{
                        echo "Driver Assistant";
                    }
                    ?>
                </div>
                <div class="row"><?= $leave->date ?></div>
                <div class="row">
                    <div class="col-8"></div>
                    <div class="col-4">
                        <a type="button" class="btn btn-primary" href="<?=SROOT?>StockKeeperHandler/viewleavedetails/<?= $leave->leave_id ?>">View</a>
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