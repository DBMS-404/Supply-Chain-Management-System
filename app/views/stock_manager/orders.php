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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Orders</title>
    <script>
        input = document.getElementById("input");
        filter = input.value.toUpperCase();
        orders = document.getElementById("orders");
        h5 = orders.getElementsByTagName("h5");
        console.log(h5);
        function search() {
            var input, filter, rooms, tr, th, i, txtValue;
            input = document.getElementById("input");
            filter = input.value.toUpperCase();
            orders = document.getElementById("orders");
            h5 = orders.getElementsByTagName("h5");

            for (i = 0; i < h5.length; i++) {
                th = h5[i].getElementsByTagName("div")[0];
                txtValue = th.textContent || th.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    h5[i].parentElement.parentElement.parentElement.style.display = "";
                } else {
                    h5[i].parentElement.parentElement.parentElement.style.display = "none";
                }
            }
        }
    </script>
    <style>
        <?php include_once('assets/bootstrap/css/bootstrap.min.css'); ?>
    </style>

</head>

<body style="/*background: url(&quot;design.jpg&quot;);*/background-position: 0 -60px;">
    <nav class="navbar navbar-light navbar-expand-md fixed-top navbar-shrink py-3" id="mainNav">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?=SROOT?>StockManagerHandler">
                <span class="bs-icon-sm bs-icon-circle bs-icon-primary shadow d-flex justify-content-center align-items-center me-2 bs-icon"><img class="img-fluid" src="assets/img/logo-modified.png"></span><span>Supply Chain Management System</span></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="<?= SROOT ?>StockManagerHandler/viewinventory">Inventory</a></li>
                    <li class="nav-item"><a class="nav-link active" href="<?= SROOT ?>StockManagerHandler/vieworders">Orders</a></li>
                </ul><a class="btn btn-primary btn-sm shadow" role="button" href="<?=SROOT?>LoginHandler/logout">Logout</a>
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
        <div class="m-4">
            <div class="row">
                <div class="col-sm-3 col-12">
                    <form action='<?= SROOT ?>StockManagerHandler/filterstatus' method='post'>
                        <div class="form-floating">
                            <select id="floatingSelect" name='filter-status' onchange='this.form.submit()' class="form-select">
                                <?php
                                foreach ($statuses as $key => $value) {
                                    if ($key === $this->filter) {
                                        echo "<option value =" . $key . " selected= 'selected'>" . $value." (" .$this->counts[$key].")". "</option>";
                                    } else {
                                        echo "<option value=" . $key . ">" . $value ." (" .$this->counts[$key].")". "</option>";
                                    }
                                }

                                ?>
                            </select>
                            <label for="floatingSelect">Filter by Status</label>
                        </div>
                    </form>
                </div>
                <div class="col-sm-3 col-12 offset-sm-6">
                    <div class="input-group rounded">
                        <input class="form-control" type="text" id="input" onkeyup="search()" placeholder="Search by order ID">
                        <span class="input-group-text border-0" id="search-addon">
                            <i class="fa fa-search"></i>
                        </span>
                        </div>
                    </div>
                </div>
            </div>
        <div>
            <div class="row" id="orders">
                <?php if (count($this->orders) > 0) {
                    foreach ($this->orders as $item_order) { ?>
                        <div class="col-sm-3 col-12 mb-4">
                            <div class="card bg-light" style="height: 215px; width:19rem;">
                                <div class="card-body">
                                    <h5 class="card-title"><div><?= "Order " . $item_order->order_id ?></div></h5>
                                    <h6 class="card-subtitle mb-2 text-muted"><?= $item_order->weight . " g" ?></h6>
                                    <p class="card-text"><?= $item_order->address ?></p>
                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            <form action='<?= SROOT ?>StockManagerHandler/changeStatus/<?= $item_order->order_id ?>' method='post'>
                                                <select name='status' onchange='this.form.submit()' class="form-select">
                                                    <?php
                                                    foreach ($statuses as $key => $value) {
                                                        if ($key !== "all") {
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
                                        </div>
                                        <div class="col-6 m-1">
                                            <?php if ($item_order->status == "new") { ?>
                                                <a href="<?= SROOT ?>StockManagerHandler/assignto_train/<?= $item_order->order_id ?>" class="btn btn-sm btn-primary">Assign</a>
                                            <?php }else { ?>
                                                <button type="button" class="btn btn-sm btn-primary" disabled>Assign</button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <h1>No orders available</h1>
                <?php } ?>
            </div>
        </div>
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