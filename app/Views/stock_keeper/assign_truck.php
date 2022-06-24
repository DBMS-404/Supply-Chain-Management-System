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

    <table>
        <tr>
            <td>
                <label for="truck">Truck:</label>
            </td>
            <td>
                <select name="truck" id="truck">
                    <option value="" disabled selected>Select truck here</option>
                    <option value="t01">Truck 01</option>
                    <option value="t02">Truck 02</option>
                </select>
            </td>
        </tr>

        <tr>
            <td>
                <label for="driver">Driver:</label>
            </td>
            <td>
                <select name="driver" id="driver">
                    <option value="" disabled selected>Select driver here</option>
                    <option value="d01">Driver 01</option>
                    <option value="d02">Driver 02</option>
                </select>
            </td>
        </tr>

        <tr>
            <td>
                <label for="driver_assistant">Driver Assistant:</label>
            </td>
            <td>
                <select name="driver_assistant" id="driver_assistant">
                    <option value="" disabled selected>Select driver assistant here</option>
                    <option value="da01">Driver Assistant 01</option>
                    <option value="da02">Driver Assistant 02</option>
                </select>
            </td>
        </tr>

        <tr>
            <td>
                <label for="schedule_date">Schedule Date</label>
            </td>
            <td>
                <input type="date" id="schedule_date" name="schedule_date">
            </td>
        </tr>

        <tr>
            <td>
                <label for="schedule_time">Schedule Date</label>
            </td>
            <td>
                <input type="time" id="schedule_time" name="schedule_time">
            </td>
        </tr>

        <tr>
            <td>
                <a href="<?=SROOT?>StockKeeperHandler/assignturn">Assign</a>
            </td>
            <td>
                <a href="<?=SROOT?>StockKeeperHandler/viewroutes">Cancel</a>
            </td>
        </tr>

    </table>

</body>
</html>