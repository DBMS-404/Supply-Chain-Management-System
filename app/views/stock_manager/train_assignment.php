<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Train Assignment</title>
    <?php include_once('css/baseTable.php'); ?>

</head>
<body>
    <div class="container-fluid">
    <div>
        <h2>Order Weight: <?=$this->order->weight." kg"?></h2>
    </div>
    <div class="table-div">
        <table class="table">
        <?php if (count($this->trains) > 0) {
                foreach ($this->trains as $train) { ?>
                    <tr>
                        <td>
                            <div>
                                <?= $train->train_name ?><br>
                                <?= "Destination: ".$train->destination?><br>
                                <?= "Arrival Day: ".$train->arrival_day ?><br>
                                <?= "Arrival Time: ".$train->arrival_day?><br>
                            </div><br><br>
                        </td>
                        <td>
                            <span class="badge rounded-pill bg-success">
                                <?= "Remaining capacity: ".($train->capacity - $train->filled_capacity)?>
                            </span>
                        </td>
                        <td>
                            <?php if (($train->capacity - $train->filled_capacity)>0 && 
                            ($train->capacity - $train->filled_capacity - $this->order->weight)>= 0 ){?>
                                <a role="button" class="btn btn-primary" href="<?=SROOT?>StockManagerHandler/make_assignment/<?=$this->order->order_id?>/<?=$train->train_id?>">Assign</a>
                            <?php }?>
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <h1>No Trains schedules avialble</h1>
            <?php } ?>
        </table>
    </div>
    </div>
</body>
</html>