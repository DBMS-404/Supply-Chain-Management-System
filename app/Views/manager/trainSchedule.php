<?php 
    redirectToHandler('mn');
?>

<?php
$this->filter = $this->filter ?? "all";
$statuses = ['all' => "All", 'new' => "New", 'dtrain' => "Dispatch to train", 'ctrain' => "Collected from train", 'dtruck' => "Dispatched to truck", 'delivered' => "Delivered"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrainSchedule</title>
    <script>

        function search() {
            var input, filter, rooms, tr, th, i, txtValue;
            input = document.getElementById("input");
            filter = input.value.toUpperCase();
            orders = document.getElementById("orders");
            tr = orders.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                th = tr[i].getElementsByTagName("div")[0];
                txtValue = th.textContent || th.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }        
    </script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <!-- <div class="row" style="width: 890.2px;">
        <div class="col">
            <form action='<?= SROOT ?>StockManagerHandler/filterstatus' method='post'>
                <label for="filter">Filter by Status</label>
                <select name='filter-status' onchange='this.form.submit()'>
                    <?php
                    foreach ($trains as $key => $value) {
                        if ($key === $this->filter) {
                            echo "<option value =" . $key . " selected= 'selected'>" . $value . "</option>";
                        } else {
                            echo "<option value=" . $key . ">" . $value . "</option>";
                        }
                    }

                    ?>
                </select>
            </form>
        </div>
        <div class="col">
            <input type="text" id="input" onkeyup="search()" placeholder="Search by order ID">
        </div>
    </div> -->
    <div class="table-responsive" style="margin-top: 21px;margin-left: 22px;margin-right: 25px;">
    <a href="<?= SROOT ?>ManagerHandler/addTrain/" class="btn btn-success">Add New Train</a>
        <table class="table">
            <th>
                Trains Schedule
            </th>
            <tbody id="orders">
                <?php if (count($this->trains) > 0) {
                    foreach ($this->trains as $train) { ?>
                        <tr class="order-id" style="width: 807.2px;">
                            <td>
                                <div>
                                    <?= "Train " . $train->train_id ." - ".$train->train_name ?><br>
                                    <?= "Arriving on ". $train->arrival_day." at ".$train->arrival_time ?><br>
                                    <?= "Destination - ".$train->destination ?><br>
                                    <?= "Capacity - ".$train->filled_capacity." is filled out of ".$train->capacity ?>
                                </div>
                            </td>
                            <td>
                                <a href="<?= SROOT ?>ManagerHandler/editTrain/<?= $train->train_id ?>" class="btn btn-primary">Edit Details</a>
                            </td>
                            <td>
                                <a href="<?= SROOT ?>ManagerHandler/deleteTrain/<?= $train->train_id ?>" class="btn btn-danger">Delete</a>
                            </td>

                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <h1>No trains are scheduled yet!</h1>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <a href="<?= SROOT ?>ManagerHandler">Home</a>
</body>

</html>