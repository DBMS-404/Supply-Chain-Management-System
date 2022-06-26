<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Assign</title>
</head>
<body>
    <h1>Route <?= $this->route_id ?></h1>

    <form action="<?=SROOT?>StockKeeperHandler/assignturn/<?= $this->route_id ?>" method="post">
        <table>
            <tr>
                <td>
                    <label for="truck">Truck:</label>
                </td>
                <td>
                    <select name="truck" id="truck" required>
                        <option disabled selected>Select truck here</option>
                        <?php foreach ($this->available_trucks as $truck){ ?>
                            <option value=<?= $truck->truck_id ?>><?= $truck->truck_no ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="driver">Driver:</label>
                </td>
                <td>
                    <select name="driver" id="driver" required>
                        <option disabled selected>Select driver here</option>
                        <?php foreach ($this->available_drivers as $driver){ ?>
                            <option value=<?= $driver->user_id ?>><?= $driver->first_name.' '.$driver->last_name ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="driver_assistant">Driver Assistant:</label>
                </td>
                <td>
                    <select name="driver_assistant" id="driver_assistant" required>
                        <option disabled selected>Select driver assistant here</option>
                        <?php foreach ($this->available_assistants as $assistant){ ?>
                            <option value=<?= $assistant->user_id ?>><?= $assistant->first_name.' '.$assistant->last_name ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>

            <!--        <tr>-->
            <!--            <td>-->
            <!--                <label for="schedule_date">Schedule Date</label>-->
            <!--            </td>-->
            <!--            <td>-->
            <!--                <input type="date" id="schedule_date" name="schedule_date">-->
            <!--            </td>-->
            <!--        </tr>-->
            <!---->
            <!--        <tr>-->
            <!--            <td>-->
            <!--                <label for="schedule_time">Schedule Time</label>-->
            <!--            </td>-->
            <!--            <td>-->
            <!--                <input type="time" id="schedule_time" name="schedule_time">-->
            <!--            </td>-->
            <!--        </tr>-->

            <tr>
                <td>
                    <input type="submit" value="Assign">

                </td>
                <td>
                    <a href="<?=SROOT?>StockKeeperHandler/viewroutes">Cancel</a>
                </td>
            </tr>

        </table>
    </form>

    <span>
        <?php
            if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
                echo $_SESSION['error'];
                $_SESSION['error'] = "";
            }
        ?>
    </span>



</body>
</html>