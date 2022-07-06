<?php 
    redirectToHandler('mn');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>TrainSchedule</title>
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
                    <li class="nav-item"><a class="nav-link active" href="<?= SROOT ?>ManagerHandler/viewTrainSchedule">Train Schedule</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= SROOT ?>ManagerHandler/generateReport">Reports</a></li>
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
        <div class="m-3">
            <div class="row">
                <div class="col-sm-10">
                    <h1>Train Schedule </h1>
                </div>
                <div class="col-sm-2">
                    <div class="mt-3"><a href="<?= SROOT ?>ManagerHandler/addTrain/" class="btn-sm btn-success">Add New Train</a></div>
                </div>
            </div>         
        </div>
        <hr>
        <table class="table">
            <tbody id="trains">
                <?php if (count($this->trains) > 0) {
                    foreach ($this->trains as $train) { ?>
                        <tr class="train-id" style="width: 807.2px;">
                            <div class="row">
                                <div class="col-sm-8">
                                    <p class="fw-bolder fs-5"><i class="fa fa-train" aria-hidden="true"></i><?= "  Train " . $train->train_id ." - ".$train->train_name ?></p>
                                    <i class="fa fa-calendar" aria-hidden="true"></i><?= "  Arrival Day - ". $train->arrival_day ?><br>
                                    <i class="fa fa-clock-o" aria-hidden="true"></i><?= "  Arrival Time - ". $train->arrival_time ?><br>
                                    <i class="fa fa-map-marker" aria-hidden="true"></i><?= "  Destination - ".$train->destination ?><br><br>
                                    <div class="progress mb-2 w-75">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-<?php
                                        if(round($train->filled_capacity*100/$train->capacity)<=25){?>success
                                        <?php } elseif(round($train->filled_capacity*100/$train->capacity)<=80){?>warning
                                        <?php } else{?>danger
                                        <?php }?>
                                        " role="progressbar" style="width: <?= round($train->filled_capacity*100/$train->capacity)?>%;" aria-valuenow="<?= $train->filled_capacity?>" aria-valuemin="0" aria-valuemax="<?= $train->capacity?>"><?= round($train->filled_capacity*100/$train->capacity)?>%</div>
                                    </div>
                                    <?= "Capacity - ".$train->filled_capacity."g is filled out of ".$train->capacity."g" ?><br><br>
                                </div>

                                <div class="col-sm-2">
                                    <a href="<?= SROOT ?>ManagerHandler/editTrain/<?= $train->train_id ?>" class="btn-sm btn-primary">Edit Details</a>
                                </div>
                                <div class="col-sm-2">
                                    <a href="<?= SROOT ?>ManagerHandler/deleteTrain/<?= $train->train_id ?>" class="btn-sm btn-danger">Delete</a>
                                </div>   
                            </div>
                        </tr>
                        <hr>
                    <?php } ?>
                <?php } else { ?>
                    <h1>No trains are scheduled yet!</h1>
                <?php } ?>
            </tbody>
        </table>
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