<?php 
    redirectToHandler('sm');
?>

<?php
$page = "Order " . $this->order->order_id;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Train Assignment</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        <?php include_once('assets/bootstrap/css/bootstrap.min.css'); ?>
    </style>
</head>

<body style="/*background: url(&quot;design.jpg&quot;);*/background-position: 0 -60px;">
    <nav class="navbar navbar-light navbar-expand-md fixed-top navbar-shrink py-3" id="mainNav">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?= SROOT ?>LoginHandler/redirectToHandler">
                <span class="bs-icon-sm bs-icon-circle   shadow d-flex justify-content-center align-items-center me-2 bs-icon"><img class="img-fluid" src="https://static.wixstatic.com/media/dcfc03_6c7b355ab8c0449c9583b19c1badbeb1~mv2.png/v1/fill/w_338,h_328,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/Artboard%207%20copy%203.png"></span><span>Supply Chain Management System</span></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link active" href="<?= SROOT ?>StockManagerHandler/vieworders">Orders</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= SROOT ?>StockManagerHandler/viewinventory">Inventory</a></li>
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
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= SROOT ?>StockManagerHandler">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= SROOT ?>StockManagerHandler/vieworders">Orders</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $page ?></li>
            </ol>
        </nav>
        <div class="d-flex justify-content-center">
            <div class="row">
                <div class="col-12">
                    <div class="card bg-light" style="width: 60vw; ">
                        <div class="card-body text-center">
                            <h5 class="card-title">Order Details</h5>
                            <p class="card-text">Order Weight: <?= $this->order->weight . " g" ?> <br> Address: <?= $this->order->address ?></p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <?php if (count($this->trains) > 0) {
                                foreach ($this->trains as $train) { ?>
                                    <li class="list-group-item">
                                        <div class="row m-3">
                                            <div class="col-sm-6 col-12">
                                                <div>
                                                    <i class="fa fa-train" aria-hidden="true"></i><?= " " . $train->train_name ?><br>
                                                    <i class="fa fa-map-marker" aria-hidden="true"></i><?= " Destination: " . $train->destination ?><br>
                                                    <i class="fa fa-calendar" aria-hidden="true"></i><?= " Arrival Day: " . $train->arrival_day ?><br>
                                                    <i class="fa fa-clock-o" aria-hidden="true"></i><?= " Arrival Time: " . $train->arrival_time ?><br>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-12 align-self-center text-sm-end">
                                                <?php if (($train->capacity - $train->filled_capacity) > 0 &&
                                                    ($train->capacity - $train->filled_capacity - $this->order->weight) >= 0
                                                ) { ?>
                                                    <a role="button" class="btn btn-primary" href="<?= SROOT ?>StockManagerHandler/make_assignment/<?= $this->order->order_id ?>/<?= $train->train_id ?>">Assign</a>
                                                    <br><br>
                                                <?php } ?>
                                                <div>
                                                    <h5>
                                                        <span class="badge bg-success">
                                                            <?= "Remaining capacity: " . ($train->capacity - $train->filled_capacity) . " g" ?>
                                                        </span>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php } ?>
                            <?php } else { ?>
                                <span class="text-danger m-2 d-flex justify-content-center"><h5>No Train schedules avialble</h5></span>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-primary-gradient">
        <div class="container py-4 ">
            <div class="text-muted d-flex justify-content-between align-items-center">
                <p class="mb-0">Copyright ?? 2022 Team 404</p>
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