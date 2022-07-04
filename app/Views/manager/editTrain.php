<?php 
    redirectToHandler('mn');
?>

<?php
if ($_POST) {
    $values = posted_values($_POST);
}

if (isset($this->edit_values)) {
    $values = $this->edit_values;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EditTrainDetails</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        <?php include_once('assets/bootstrap/css/bootstrap.min.css'); ?>
    </style>
</head>

<body style="/*background: url(&quot;design.jpg&quot;);*/background-position: 0 -60px;">
    <nav class="navbar navbar-light navbar-expand-md fixed-top navbar-shrink py-3" id="mainNav">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <span class="bs-icon-sm bs-icon-circle   shadow d-flex justify-content-center align-items-center me-2 bs-icon"><img class="img-fluid" src="https://static.wixstatic.com/media/dcfc03_6c7b355ab8c0449c9583b19c1badbeb1~mv2.png/v1/fill/w_338,h_328,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/Artboard%207%20copy%203.png"></span><span>Supply Chain Management System</span></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link active" href="<?= SROOT ?>/ManagerHandler/viewTrainSchedule">Train Schedule</a></li>
                    <li class="nav-item"><a class="nav-link" href="">Reports</a></li>
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
    <div class="container">

        <div class="m-3">
            <h1>Edit Train Details</h1>
        </div>
        <hr>
        <div>
            <form class="p-3 p-xl-4" action="<?= SROOT ?>ManagerHandler/editTrain/<?= $this->train_id ?>" method="post">
                <div class='row mb-2'>
                    <div class=col-sm-2>
                        <label>Train Name: </label>
                    </div>
                    <div class=col-sm-2>
                        <input type="text" name="train_name" value="<?= ($values['train_name'] ?? "") ?>" required><br><br>
                    </div>
                </div>
                <div class='row mb-2'>
                    <div class=col-sm-2>
                        <label>Arrival Day: </label>
                    </div>
                    <div class=col-sm-2>
                        <input type="date" name="arrival_day" value="<?= ($values['arrival_day'] ?? "") ?>" required> <br><br>
                    </div>
                </div>
                <div class='row mb-2'>
                    <div class=col-sm-2>
                        <label>Arrival Time: </label>
                    </div>
                    <div class=col-sm-2>
                        <input type="time" name="arrival_time" value="<?= ($values['arrival_time'] ?? "") ?>" required> <br><br>
                    </div>
                </div>
                <div class='row mb-2'>
                    <div class=col-sm-2>
                        <label>Destination: </label>
                    </div>
                    <div class=col-sm-2>
                        <input type="text" name="destination" value="<?= ($values['destination'] ?? "") ?>" required> <br><br>
                    </div>
                </div>
                <div class='row mb-2'>
                    <div class=col-sm-2>
                        <label>Maximum Capacity: </label>
                    </div>
                    <div class=col-sm-2>
                        <input type="text" name="capacity" value="<?= ($values['capacity'] ?? "") ?>" required> <br><br>
                    </div>
                </div>
                <div class='row mb-2'>
                    <div class=col-sm-2>
                        <label>Filled Capacity: </label>
                    </div>
                    <div class=col-sm-2>
                        <input type="text" name="filled_capacity" value="<?= ($values['filled_capacity'] ?? "") ?>" required readonly> <br><br>
                    </div>
                </div>

                <input class="btn-sm btn-success" type="submit" value="Submit">

            </form>
        </div>
        <span class="text-danger">
            <strong><?= $this->displayErrors ?? "" ?></strong>
        </span>
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