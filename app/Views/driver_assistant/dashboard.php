<?php 
    redirectToHandler('da');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - Brand</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
</head>

<style>
    <?php include_once('assets/bootstrap/css/bootstrap.min.css');
    include_once('assets/font-awesome/css/font-awesome.min.css'); ?>
</style>


    <body style="/*background: url(&quot;design.jpg&quot;);*/background-position: 0 -60px;">
        <nav class="navbar navbar-light navbar-expand-md fixed-top navbar-shrink py-3" id="mainNav">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="<?= SROOT ?>LoginHandler/redirectToHandler">
                    <span class="bs-icon-sm bs-icon-circle shadow d-flex justify-content-center align-items-center me-2 bs-icon"><img class="img-fluid" src="https://static.wixstatic.com/media/dcfc03_6c7b355ab8c0449c9583b19c1badbeb1~mv2.png/v1/fill/w_338,h_328,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/Artboard%207%20copy%203.png" /></span><span>Supply Chain Management System</span></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item"><a class="nav-link active" href="<?= SROOT ?>AssistantHandler">Turns</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= SROOT ?>AssistantHandler/applyLeave">Apply Leave</a></li>
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
        <section class="py-5">

            <div class="container">
                <div class="row">

                    <?php if (count($this->turns) > 0) { ?>
                        <div class="row m-2">
                            <h3>Assigned Turns</h3>
                        </div>
                        <div class="row">
                            <?php foreach ($this->turns as $turn) {
                            ?>
                                <div class="col-sm-6 col-12 mt-3 mb-3">
                                    <div class="card bg-light shadow-lg">
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <iframe src="<?= $turn->route_map ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                            </div>
                                            <h5 class="card-title"><?= "Turn " . $turn->turn_id ?></h5>
                                            <h6 class="card-subtitle mb-2 text-muted"><span class="badge bg-info"><?= $turn->turn_start_time ? "Ongoing Turn" : "Not Yet Started" ?></span></h6>
                                            <h6 class="card-subtitle mb-2 text-muted"><i class="fa fa-calendar" aria-hidden="true"></i> <?= $turn->turn_start_time ? "Started Time : " . $turn->turn_start_time : "Scheduled Time " . $turn->scheduled_date . " " . $turn->scheduled_time ?></h6>
                                            <p class="card-text"><i class="fa fa-truck" aria-hidden="true"></i> <?= "Truck No: " . $turn->truck_no ?><br>
                                            <i class="fa fa-clock-o" aria-hidden="true"></i> <?= "Maximum Avg. Completion Time: " . $turn->avg_time." Hours" ?></p>
                                            <?php if ($turn->turn_start_time) { ?><a href="<?= SROOT ?>AssistantHandler/vieworders/<?= $turn->turn_id ?>" class="btn btn-outline-info btn-sm">View Turn</a><?php }else{ ?>
                                            <a href="<?= SROOT ?>AssistantHandler/vieworders/<?= $turn->turn_id ?>" class="btn btn-dark btn-sm disabled">Not started</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <h1>No Turns Assigned for You</h1>
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