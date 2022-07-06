<?php
redirectToHandler('sk');
?>

<?php

$this->filter = $this->filter ?? "all";;
$trains = $_SESSION['trains'];

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <title>Orders</title>

    <style>
        <?php include_once('assets/bootstrap/css/bootstrap.min.css'); ?>
    </style>
    <script>
        input = document.getElementById("input");
        filter = input.value.toUpperCase();
        orders = document.getElementById("orders");
        strong = orders.getElementsByTagName("strong");

        function search() {
            var input, filter, th, i, txtValue;
            input = document.getElementById("input");
            filter = input.value.toUpperCase();
            orders = document.getElementById("orders");
            strong = orders.getElementsByTagName("strong");

            for (i = 0; i < strong.length; i++) {
                th = strong[i];
                txtValue = th.textContent || th.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    strong[i].parentElement.parentElement.parentElement.style.display = "";
                } else {
                    strong[i].parentElement.parentElement.parentElement.style.display = "none";
                }
            }
        }
    </script>
</head>

<body style="/*background: url(&quot;design.jpg&quot;);*/background-position: 0 -60px;">
    <nav class="navbar navbar-light navbar-expand-md fixed-top navbar-shrink py-3" id="mainNav">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?= SROOT ?>LoginHandler/redirectToHandler">
                <span class="bs-icon-sm bs-icon-circle   shadow d-flex justify-content-center align-items-center me-2 bs-icon"><img class="img-fluid" src="https://static.wixstatic.com/media/dcfc03_6c7b355ab8c0449c9583b19c1badbeb1~mv2.png/v1/fill/w_338,h_328,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/Artboard%207%20copy%203.png"></span><span>Supply Chain Management System</span></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link active" href="<?= SROOT ?>StockKeeperHandler">Orders</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= SROOT ?>StockKeeperHandler/viewroutes">Trucks</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= SROOT ?>StockKeeperHandler/viewleaves">Leaves</a></li>
                </ul>
                <a class="fw-light fs-5"><span style="margin-right: 5px;"><i class="fa fa-user" aria-hidden="true"></i> <?php print_r($_SESSION['user_id']); ?></span></a>
                <div  class="d-lg-none mb-3"></div>
                <a class="btn btn-primary btn-sm shadow" role="button" href="<?= SROOT ?>LoginHandler/logout">Logout</a>
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

    <section class="py-5">
        <div class="container">
            <div class="row mb-2">
                <h2 style="font-family: sans-serif">Orders Received From Train</h2>
            </div>


            <div class="row mb-2">
                <div class="col-sm-3 col-12 ps-0">
                    <form action="<?= SROOT ?>StockKeeperHandler/filtertrains" method='post'>
                        <div class="form-floating">
                            <select id="floatingSelect" name='filter-status' onchange='this.form.submit()' class="form-select">
                                <?php
                                foreach ($trains as $key => $value) {
                                    if ($key == $this->filter) {
                                        echo "<option value =" . $key . " selected= 'selected'>" . $value . " (" . $this->counts[$key] . ")" . "</option>";
                                    } else {
                                        echo "<option value=" . $key . ">" . $value . " (" . $this->counts[$key] . ")" . "</option>";
                                    }
                                }

                                ?>
                            </select>
                            <label for="floatingSelect">Filter by Train</label>
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



            <div class="row" id="orders">
                <?php if (count($this->orders) > 0) { ?>
                    <ul class="list-group">
                        <?php foreach ($this->orders as $item_order) { ?>

                            <li class="list-group-item p-4">
                                <div class="row">
                                    <h4><strong>
                                            <i class="fa fa-shopping-bag me-2" aria-hidden="true"></i>
                                            Order: <?= $item_order->order_id ?>
                                        </strong></h4>
                                </div>
                                <div class="row mt-3 mb-3 align-items-center">
                                    <div class="col-sm-3">
                                        <i class="fa fa-train me-2" aria-hidden="true"></i>
                                        <?= $item_order->train_name ?>
                                    </div>
                                    <div class="col-sm-3">
                                        <i class="fa fa-envelope me-2" aria-hidden="true"></i>
                                        <?= $item_order->address ?>
                                    </div>
                                    <div class="col-sm-3">
                                        <i class="fa fa-shopping-cart me-2" aria-hidden="true"></i>
                                        <?= $item_order->weight . " kg" ?>
                                    </div>
                                    <div class="col-sm-3 align-self-center">
                                        <a type="button" class="btn btn-primary" href="<?= SROOT ?>StockKeeperHandler/markasrecieved/
                            <?= $item_order->order_id ?>/<?= $item_order->train_id ?>/<?= $item_order->weight ?>">Mark As Received</a>
                                    </div>
                                </div>
                            </li>

                        <?php } ?>
                    </ul>
                <?php } else { ?>
                    <h1>Orders not received yet</h1>
                <?php } ?>
            </div>


        </div>
    </section>

    <footer class="bg-primary-gradient">
        <div class="container py-4 ">
            <div class="text-muted d-flex justify-content-between align-items-center">
                <p class="mb-0">Copyright © 2022 Team 404</p>
            </div>
        </div>
    </footer>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bold-and-bright.js"></script>
</body>

</html>