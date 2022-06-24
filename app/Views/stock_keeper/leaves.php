<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Leaves</title>
</head>
<body>
    <h2>Leave Requests</h2>

    <table>
        <tr>
            <th>Username</th>
            <th>Driver/Driver Assistant</th>
            <th>Leave Date</th>
            <th>View</th>
        </tr>
        <?php

        foreach ($this->leaves as $leave) {
            ?>
            <tr>
                <td><?= $leave->first_name." ".$leave->last_name ?></td>
                <td>
                    <?php
                        if (substr($leave->user_id,0,2)=="DR"){
                            echo "Driver";
                        }else{
                            echo "Driver Assistant";
                        }
                    ?>
                </td>

                <td><?= $leave->date ?></td>
                <td>
                    <a href="<?=SROOT?>StockKeeperHandler/viewleavedetails/<?= $leave->leave_id ?>">View</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>

    <a href="<?=SROOT?>StockKeeperHandler">Home</a>
</body>
</html>