<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">

    <script>
        function search() {
            var input, filter, rooms, tr, th, i, txtValue;
            input = document.getElementById("input");
            filter = input.value.toUpperCase();
            items = document.getElementById("items");
            tr = items.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                th = tr[i].getElementsByTagName("span")[0];
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
    <style>
        <?php include_once('assets/bootstrap/css/bootstrap.min.css'); ?>
    </style>

</head>

<body style="/*background: url(&quot;design.jpg&quot;);*/background-position: 0 -60px;">
    <nav class="navbar navbar-light navbar-expand-md fixed-top navbar-shrink py-3" id="mainNav">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <span class="bs-icon-sm bs-icon-circle bs-icon-primary shadow d-flex justify-content-center align-items-center me-2 bs-icon"><img class="img-fluid" src="assets/img/logo-modified.png"></span><span>Supply Chain Management System</span></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link active" href="<?=SROOT?>StockManagerHandler/viewinventory">Inventory</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?=SROOT?>StockManagerHandler/vieworders">Orders</a></li>
                </ul><a class="btn btn-primary btn-sm shadow" role="button" href="signup.html">Logout</a>
            </div>
        </div>
    </nav>
    <header class="bg-primary-gradient pt-5">
        <div class="container pt-4 pt-xl-5">
            <div class="row pt-5">
                <div class="col-md-8 col-xl-6 text-center text-md-start mx-auto">
                    <div class="text-center">
                        <p class="fw-bold text-success mb-2">Voted #1 Worldwide</p>
                        <h1 class="fw-bold">The best solution for you and your customers</h1>
                    </div>
                </div>
                <div class="col-12 col-lg-10 mx-auto">
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <h1>Stocks</h1>
        <div class="row" style="width: 890.2px;">
            <div class="col">
                <a href="<?= SROOT ?>StockManagerHandler/manageStock" class="btn btn-sm btn-primary">Add Stock Item</a> <br><br>
            </div>
            <div class="col">
                <input type="text" id="input" onkeyup="search()" placeholder="Search by Item name">
            </div>
        </div>
        <div class="table-div">
            <?php if (count($this->inventory) > 0) { ?>
                <table class="table">
                    <tbody id="items">
                        <?php foreach ($this->inventory as $item) { ?>
                            <tr>
                                <td>
                                    <div>
                                        <span><?= $item->name ?></span><br>
                                        <?= "Available quantity: " . $item->available_count ?><br>
                                        <?= "Unit price Rs." . $item->unit_price ?><br>
                                    </div><br>
                                </td>
                                <td><a class="btn btn-sm btn-danger" href="<?= SROOT ?>StockManagerHandler/delete/<?= $item->item_id ?>">Delete</a></td>
                                <td><a class="btn btn-sm btn-primary" href="<?= SROOT ?>StockManagerHandler/manageStock/<?= $item->item_id ?>">Edit</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            <?php } else { ?>
                <h2>No items in the stock</h2>
            <?php } ?>
        </div>
    </div>
    <footer class="bg-primary-gradient">
        <div class="container py-4 ">
            <div class="text-muted d-flex justify-content-between align-items-center">
                <p class="mb-0">Copyright © 2022 Team 404</p>
            </div>
        </div>
    </footer>
    <script>
        <?php include_once('assets/js/jquery.min.js'); ?>
    </script>
    <script>
        <?php include_once('assets/bootstrap/js/bootstrap.min.js'); ?>
    </script>
    <script>
        <?php include_once('assets/js/bold-and-bright.js'); ?>
    </script>

</body>

</html>