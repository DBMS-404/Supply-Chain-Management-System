<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script>
        function search() {
            var input, filter, rooms, tr, th, i, txtValue;
            input = document.getElementById("input");
            filter = input.value.toUpperCase();
            items = document.getElementById("items");
            tr = items.getElementsByTagName("tr");

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

    <title>Inventory</title>
</head>

<body>
    <div>
        <h1>Stocks</h1>
        <a href="<?= SROOT ?>StockManagerHandler/manageStock" class="btn btn-primary">Add Stock Item</a> <br><br>
        <input type="text" id="input" onkeyup="search()" placeholder="Search by Item name">
        <?php if (count($this->inventory) > 0) { ?>
            <table class="table">
                <tbody id="items">
                    <?php foreach ($this->inventory as $item) { ?>
                        <tr>
                            <td>
                                <div>
                                    <?= $item->name ?><br>
                                    <?= "Available quantity: " . $item->available_count ?><br>
                                    <?= "Unit price Rs." . $item->unit_price ?><br>
                                </div><br>
                            </td>
                            <td><a class="btn btn-primary" href="<?= SROOT ?>StockManagerHandler/delete/<?= $item->item_id ?>">Delete</a></td>
                            <td><a class="btn btn-primary" href="<?= SROOT ?>StockManagerHandler/manageStock/<?= $item->item_id ?>">Edit</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        <?php } else { ?>
            <h2>No items in the stock</h2>
        <?php } ?>
    </div>

    <br><br><a href="<?= SROOT ?>StockManagerHandler">Home</a>
</body>

</html>