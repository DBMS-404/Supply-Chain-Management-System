<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Leave</title>
</head>
<body>
    <h1>Leave Application</h1>

    <?php
        $leave_details = $this->leave;
    ?>

    <table>
        <tr>
            <td>First Name</td>
            <td>
                <input type="text" readonly value="<?= $leave_details->firstName ?>">
            </td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td>
                <input type="text" readonly value="<?= $leave_details->lastName ?>">
            </td>
        </tr>
        <tr>
            <td>Date</td>
            <td>
                <input type="text" readonly value="<?= $leave_details->leaveDate ?>">
            </td>
        </tr>
        <tr>
            <td>City</td>
            <td>
                <input type="text" readonly value="<?= $leave_details->city ?>">
            </td>
        </tr>
        <tr>
            <td>Reason</td>
            <td>
                <input type="text" readonly value="<?= $leave_details->reason ?>">
            </td>
        </tr>
        <tr>
            <td>Telephone</td>
            <td>
                <input type="text" readonly value="<?= $leave_details->mobile ?>">
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <a href="<?=SROOT?>StockKeeperHandler/acceptleave/<?= $leave_details->leave_id ?>">Accept</a>
                <a href="<?=SROOT?>StockKeeperHandler/declineleave/<?= $leave_details->leave_id ?>">Decline</a>
                <a href="<?=SROOT?>StockKeeperHandler/viewleaves">Back</a>
            </td>
        </tr>
    </table>
</body>
</html>