<?php
redirectToHandler('dr');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Ongoing Turn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
    <?php include_once('assets/bootstrap/css/bootstrap.min.css'); ?>
</style>

<body style="/*background: url(&quot;design.jpg&quot;);*/background-position: 0 -60px;">
    <nav class="navbar navbar-light navbar-expand-md fixed-top navbar-shrink py-3" id="mainNav">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?= SROOT ?>LoginHandler/redirectToHandler">
                <span class="bs-icon-sm bs-icon-circle shadow d-flex justify-content-center align-items-center me-2 bs-icon"><img class="img-fluid" src="https://static.wixstatic.com/media/dcfc03_6c7b355ab8c0449c9583b19c1badbeb1~mv2.png/v1/fill/w_338,h_328,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/Artboard%207%20copy%203.png" /></span><span>Supply Chain Management System</span></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link active" href="<?= SROOT ?>DriverHandler/turnCompletion">Ongoing Turn</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= SROOT ?>DriverHandler/applyLeave">Apply Leave</a></li>

                </ul>
                <a class="fw-light fs-5"><span style="margin-right: 5px;"><i class="fa fa-user" aria-hidden="true"></i> <?php print_r($_SESSION['user_id']); ?></span></a>
                <div class="d-lg-none mb-3"></div>
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
            </div>
        </div>
    </header>
    <section class="py-5">
        <div class="container py-5">
            <div class="row m-2">
                <h3>Ongoing Turn</h3>
            </div>
            <div class="mx-auto">
                <div class="row d-flex justify-content-center">
                    <div class="col mb-4">
                        <div class="card bg-primary-light mt-2">
                            <?php if (isset($this->route_map)) { ?>
                                <div class="row m-3">
                                    <div class="col-md-8 col-12">
                                        <h3 class="mb-4"><i class="fa fa-truck" aria-hidden="true"></i> Turn <?php echo $this->ongoingTurns[0]->turn_id ?> </h3>
                                        <h5>Route Map </h5>
                                        <iframe id="Iframe" src="<?= $this->route_map ?>" width="100%" height="400" style="border:2;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    </div>
                                    <div class="col-md-4 col-12 align-self-center">
                                        <div class="card-body text-left py-5 ">
                                            <br>
                                            <h6 class="card-subtitle mb-2"><i class="fa fa-calendar" aria-hidden="true"></i> <?= $this->turns[0]->turn_start_time ? "Started Time : " . $this->turns[0]->turn_start_time : "Scheduled Time " . $this->turns[0]->scheduled_date . " " . $this->turns[0]->scheduled_time ?></h6><br>
                                            <p class="card-text"><i class="fa fa-user" aria-hidden="true"></i> <?= "Driver Assistant: " . $this->turns[0]->assistant_name . "  (" .  $this->turns[0]->assistant_id . ")" ?></p>
                                            <p class="card-text"><i class="fa fa-truck" aria-hidden="true"></i> <?= "Truck No: " . $this->turns[0]->truck_no ?></p>
                                            <p class="card-text"><i class="fa fa-clock-o" aria-hidden="true"></i> <?= "Maximum Avg. Completion Time: " . $this->turns[0]->avg_time . " Hours" ?></p>
                                        </div>
                                        <div class="card-body text-md-center px-md-5">
                                            <p class="fw-bold text-primary card-text mb-2">
                                                <?php if ($this->remainingOrders === '0') {
                                                    echo 'Turn Completed';
                                                } else {
                                                    echo 'Ongoing Turn';
                                                } ?>
                                            </p>
                                            <h4 class="fw-bold card-title mb-3">
                                                <?php if ($this->remainingOrders === '0') {
                                                    echo 'All orders delivered !';
                                                } else {
                                                    echo $this->remainingOrders;
                                                    echo ' orders remaining to be delivered';
                                                } ?>
                                            </h4>
                                        </div>
                                        <div class="row m-lg-5 mt-lg-0 mb-lg-2">
                                            <?php if ($this->ongoingTurns != 0) {
                                                if ($this->remainingOrders != '0') { ?>
                                                    <button class="btn btn-primary btn-lg" type="button" disabled>TURN COMPLETED</button>

                                                <?php   } else { ?>
                                                    <a href="<?= SROOT ?>DriverHandler/recordTurnCompletion/<?= $this->ongoingTurns[0]->turn_id ?>">
                                                        <button class="btn btn-primary btn-lg" type="button">TURN COMPLETED</button>
                                                    </a>
                                            <?php }
                                            } ?>

                                        </div>

                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="card-body text-center px-4 py-5 px-md-5">
                                    <h3 class="fw-bold text-primary card-text mb-5">
                                        No Ongoing Turn !
                                    </h3>

                                    <div class="row">

                                        <?php if (count($this->turns) > 0) { ?>
                                            <div class="row m-2">
                                                <h3>Assigned Turns</h3>
                                            </div>
                                            <div class="row">
                                                <?php foreach ($this->turns as $turn) {
                                                ?>
                                                    <div class="col-12 mt-3 mb-3">
                                                        <div class="card bg-light shadow-lg">
                                                            <div class="card-body">
                                                                <div class="row mb-2">
                                                                    <div class="col-lg-8 col-12">
                                                                        <iframe id="Iframe" src="<?= $turn->route_map ?>" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                                                    </div>
                                                                    <div class="col-lg-4 col-12 align-self-center">
                                                                        <h3 class="card-title"><?= "Turn " . $turn->turn_id ?></h3>
                                                                        <?php if ($turn->turn_start_time) { ?>
                                                                            <h5 class="card-subtitle mb-2 text-muted"><span class="badge bg-danger">Ongoing Turn</span></h5>

                                                                        <?php } ?>
                                                                        <br>
                                                                        <h6 class="card-subtitle mb-2 text-muted"><i class="fa fa-calendar" aria-hidden="true"></i> <?= $turn->turn_start_time ? "Started Time : " . $turn->turn_start_time : "Scheduled Time " . $turn->scheduled_date . " " . $turn->scheduled_time ?></h6><br>
                                                                        <p class="card-text"><i class="fa fa-user" aria-hidden="true"></i><?= "Driver Assistant: " . $turn->assistant_name . "  (" .  $turn->assistant_id . ")" ?></p>
                                                                        <p class="card-text"><i class="fa fa-truck" aria-hidden="true"></i> <?= "Truck No: " . $turn->truck_no ?></p>
                                                                        <p class="card-text"><i class="fa fa-clock-o" aria-hidden="true"></i> <?= "Maximum Avg. Completion Time: " . $turn->avg_time . " Hours" ?></p>
                                                                        <br>
                                                                        <?php if ($turn->turn_start_time) { ?><a href="<?= SROOT ?>DriverHandler/turnCompletion" class="btn btn-outline-info btn-sm">View Ongoing Turn</a><?php } else { ?>
                                                                            <button class="btn btn-dark btn-sm disabled">Not started</button>
                                                                        <?php } ?>

                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <h1>No Turns Assigned for You</h1>
                                            <?php } ?>

                                            </div>

                                    </div>

                                <?php } ?>
                                </div>
                        </div>
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
        // Selecting the iframe element
        var frame = document.getElementById("Iframe");

        // Adjusting the iframe height onload event
        frame.onload = function()
        // function execute while load the iframe
        {
            // set the height of the iframe as 
            // the height of the iframe content
            frame.style.height =
                frame.contentWindow.document.body.scrollHeight + 'px';


            // set the width of the iframe as the 
            // width of the iframe content
            frame.style.width =
                frame.contentWindow.document.body.scrollWidth + 'px';

        }
    </script>
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