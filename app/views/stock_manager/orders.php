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
    <title>Orders</title>
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
    <div class="row" style="width: 890.2px;">
        <div class="col">
            <form action='<?= SROOT ?>StockManagerHandler/filterstatus' method='post'>
                <label for="filter">Filter by Status</label>
                <select name='filter-status' onchange='this.form.submit()'>
                    <?php
                    foreach ($statuses as $key => $value) {
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
    </div>
    <div class="table-responsive" style="margin-top: 21px;margin-left: 22px;margin-right: 25px;">
        <table class="table">
            <th>
                Orders
            </th>
            <tbody id="orders">
                <?php if (count($this->orders) > 0) {
                    foreach ($this->orders as $item_order) { ?>
                        <tr class="order-id" style="width: 807.2px;">
                            <td>
                                <div>
                                    <?= "Order " . $item_order->order_id ?><br>
                                    <?= $item_order->weight . " kg" ?><br>
                                    <?= $item_order->address ?><br><br>
                                </div>
                            </td>
                            <td>
                                <?php if ($item_order->status == "new") { ?>
                                    <a href="<?= SROOT ?>StockManagerHandler/assignto_train/<?= $item_order->order_id ?>" class="btn btn-primary">Assign</a>
                                <?php } ?>
                            </td>
                            <td>
                                <form action='<?= SROOT ?>StockManagerHandler/changeStatus/<?= $item_order->order_id ?>' method='post'>
                                    <select name='status' onchange='this.form.submit()' class="btn btn-primary dropdown-toggle">
                                        <?php
                                        foreach ($statuses as $key => $value) {
                                            if ($key !== "all"){
                                                if ($key === $item_order->status) {
                                                    echo "<option value =" . $key . " selected= 'selected'>" . $value . "</option>";
                                                } else {
                                                    echo "<option value=" . $key . ">" . $value . "</option>";
                                                }
                                            }
                                        }

                                        ?>
                                    </select>
                                </form>
                            </td>

                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <h1>No orders available</h1>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <a href="<?= SROOT ?>StockManagerHandler">Home</a>
</body>

</html>