<?php 
    $page = "Order ".$this->order->order_id;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Train Assignment</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
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
                    <li class="nav-item"><a class="nav-link" href="<?=SROOT?>StockManagerHandler/viewinventory">Inventory</a></li>
                    <li class="nav-item"><a class="nav-link active" href="<?=SROOT?>StockManagerHandler/vieworders">Orders</a></li>
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
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=SROOT?>StockManagerHandler">Home</a></li>
            <li class="breadcrumb-item"><a href="<?=SROOT?>StockManagerHandler/vieworders">Orders</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $page ?></li>
        </ol>
    </nav>
    <div>
        <span class="badge bg-info">
            <h2>Order Weight: <?=$this->order->weight." g"?></h2>
        </span>
    </div>
    <div class="table-div">
        <table class="table">
        <?php if (count($this->trains) > 0) {
                foreach ($this->trains as $train) { ?>
                    <tr>
                        <td>
                            <div>
                                <?= $train->train_name ?><br>
                                <?= "Destination: ".$train->destination?><br>
                                <?= "Arrival Day: ".$train->arrival_day ?><br>
                                <?= "Arrival Time: ".$train->arrival_day?><br>
                            </div><br><br>
                        </td>
                        <td>
                            <h4>
                                <span class="badge rounded-pill bg-success">
                                    <?= "Remaining capacity: ".($train->capacity - $train->filled_capacity)." g"?>
                                </span>
                            </h4>
                        </td>
                        <td>
                            <?php if (($train->capacity - $train->filled_capacity)>0 && 
                            ($train->capacity - $train->filled_capacity - $this->order->weight)>= 0 ){?>
                                <a role="button" class="btn btn-primary" href="<?=SROOT?>StockManagerHandler/make_assignment/<?=$this->order->order_id?>/<?=$train->train_id?>">Assign</a>
                            <?php }?>
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <h1>No Trains schedules avialble</h1>
            <?php } ?>
        </table>
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