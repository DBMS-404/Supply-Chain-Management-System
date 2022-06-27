<?php 
    redirectToHandler('mn');
?>

<?php
if ($_POST) {
    $values = posted_values($_POST);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Train</title>
</head>

<body>
    <h1>Add New Train</h1>
    <div>
        <form action="<?= SROOT ?>ManagerHandler/addTrain/" method="post">
            <label>Train Name: </label>
            <input type="text" name="train_name" value="<?= ($values['train_name'] ?? "") ?>" required> <br><br>
            <label>Arrival Day: </label>
            <input type="date" name="arrival_day" value="<?= ($values['arrival_day'] ?? "") ?>" required> <br><br>
            <label>Arrival Time: </label>
            <input type="time" name="arrival_time" value="<?= ($values['arrival_time'] ?? "") ?>" required> <br><br>
            <label>Destination: </label>
            <input type="text" name="destination" value="<?= ($values['destination'] ?? "") ?>" required> <br><br>
            <label>Maximum Capacity: </label>
            <input type="text" name="capacity" value="<?= ($values['capacity'] ?? "") ?>" required> <br><br>
            <input type="submit" value="Submit">

        </form>
    </div>
    <span>
        <?= $this->displayErrors ?? "" ?>
    </span>
</body>

</html>