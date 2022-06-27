<?php
    $leave_details = $this->leave;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <title>View Leave</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
</head>
<style>
    <?php include_once('assets/bootstrap/css/bootstrap.min.css'); ?>
</style>

<body style="/*background: url(&quot;design.jpg&quot;);*/background-position: 0 -60px;">
<nav class="navbar navbar-light navbar-expand-md fixed-top navbar-shrink py-3" id="mainNav">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="/">
            <span class="bs-icon-sm bs-icon-circle   shadow d-flex justify-content-center align-items-center me-2 bs-icon"><img class="img-fluid" src="https://static.wixstatic.com/media/dcfc03_6c7b355ab8c0449c9583b19c1badbeb1~mv2.png/v1/fill/w_338,h_328,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/Artboard%207%20copy%203.png"></span><span>Supply Chain Management System</span></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="<?= SROOT ?>StockKeeperHandler">Orders</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= SROOT ?>StockKeeperHandler/viewroutes">Trucks</a></li>
                <li class="nav-item"><a class="nav-link active" href="<?= SROOT ?>StockKeeperHandler/viewleaves">Leaves</a></li>
            </ul><a class="btn btn-primary btn-sm shadow" role="button" href="<?= SROOT ?>LoginHandler/logout">Logout</a>
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

<section>
    <div class="row m-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="<?= SROOT ?>StockKeeperHandler/viewleaves">Leaves</a></li>
                <li class="breadcrumb-item active" aria-current="page">View</li>
            </ol>
        </nav>
    </div>

    <div class="container border col-sm-8 p-4 align-items-center">
        <h1>Leave Application</h1>

        <div class="form-group row">
            <label class="col-sm-4 col-form-label">First Name</label>
            <div class="col-sm-8">
                <input class="w-75" type="text" readonly value="<?= $leave_details->first_name ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label">Last Name</label>
            <div class="col-sm-8">
                <input class="w-75" type="text" readonly value="<?= $leave_details->last_name ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label">Date</label>
            <div class="col-sm-8">
                <input class="w-75" type="text" readonly value="<?= $leave_details->date ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label">City</label>
            <div class="col-sm-8">
                <input class="w-75" type="text" readonly value="<?= $leave_details->city_name ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label">Reason</label>
            <div class="col-sm-8">
                <textarea class="form-control w-75" rows="5"><?= $leave_details->leave_reason ?></textarea>
            </div>

        </div>
        <div class="form-group row mt-2">
            <label class="col-sm-4 col-form-label">Telephone</label>
            <div class="col-sm-8">
                <input class="w-75" type="text" readonly value="<?= $leave_details->mobile_no ?>">
            </div>
        </div>
        <div class="form-group row mt-2">
            <div class="col-sm-3"></div>
            <div class="btn-group col-sm-6 d-flex align-items-center justify-content-center">
                <a type="button" class="btn btn-success" href="<?=SROOT?>StockKeeperHandler/acceptleave/<?= $leave_details->leave_id ?>">Accept</a>
                <a type="button" class="btn btn-danger" href="<?=SROOT?>StockKeeperHandler/declineleave/<?= $leave_details->leave_id ?>">Decline</a>
            </div>
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