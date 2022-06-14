<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Train Assignment</title>
</head>
<body>
    <div>
        <h2>Order Weight: <?=$this->order->weight." kg"?></h2>
    </div>
    <div>
        <table>
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
                            <?= "Remaining capacity: ".($train->capacity - $train->filled_capacity)?>
                        </td>
                        <td>
                            <?php if (($train->capacity - $train->filled_capacity)>0){?>
                                <a href="#">Assign</a>
                            <?php }?>
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <h1>No Trains schedules avialble</h1>
            <?php } ?>
        </table>
    </div>
</body>
</html>