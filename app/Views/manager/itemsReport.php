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
    <style>
        <?php include_once('assets/bootstrap/css/bootstrap.min.css'); ?>
    </style>
    <title>Generate Report</title>
</head>

<body style="/*background: url(&quot;design.jpg&quot;);*/background-position: 0 -60px;">
    <nav class="navbar navbar-light navbar-expand-md fixed-top navbar-shrink py-3" id="mainNav">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?= SROOT ?>LoginHandler/redirectToHandler">
                <span class="bs-icon-sm bs-icon-circle   shadow d-flex justify-content-center align-items-center me-2 bs-icon"><img class="img-fluid" src="https://static.wixstatic.com/media/dcfc03_6c7b355ab8c0449c9583b19c1badbeb1~mv2.png/v1/fill/w_338,h_328,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/Artboard%207%20copy%203.png"></span><span>Supply Chain Management System</span></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="<?= SROOT ?>ManagerHandler/viewTrainSchedule">Train Schedule</a></li>
                    <li class="nav-item"><a class="nav-link active" href="<?= SROOT ?>ManagerHandler/generateReport">Reports</a></li>
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
                <div class="col-12 col-lg-10 mx-auto">
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <br>
        <div class="row m-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="<?= SROOT ?>ManagerHandler/generateReport">Generate Reports</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Item Report</li>
                </ol>
            </nav>
        </div>
        <form action="<?= SROOT ?>ManagerHandler/generateReport/1" method='post'>
            <div class="row">
                <div class="col-sm-6">
                    <div class="from-floating input-group">
                        <span class="input-group-text">From - To</span>
                        <input name="first_date" type="date" aria-label="Starting Date" class="form-control">
                        <input name="second_date" type="date" aria-label="Ending Date" class="form-control">
                        <input class="btn-sm btn-success" type="submit" value="->">
                    </div>
                </div>
            </div>
        </form>
        <br>

        <div class="row">
            <div class="row m-2">
                <h3>Items with most orders</h3>
                <h5 class='text-muted'>Time Range : <?php if ($this->first_date == "" and $this->second_date == "") { ?>All Time
                    <?php } elseif ($this->first_date == "" and $this->second_date != "") { ?>Until <?= $this->second_date ?>
                    <?php } elseif ($this->first_date != "" and $this->second_date == "") { ?>From <?= $this->first_date ?>
                    <?php } else { ?>From <?= $this->first_date ?> to <?= $this->second_date ?>
                <?php } ?> </h5>
                <?php if (isset($this->displayErrors)) { ?>
                    <br><br>
                    <span class="text-danger">
                        <h5><?= $this->displayErrors ?></h5>
                    </span>
            </div>
        </div>

    <?php } else { ?>
        <?php if (count($this->items) > 0) {
                        $x = 0 ?>
            <div class="row">
                <?php foreach ($this->items as $item) {
                            $x++
                ?>
                    <div class="col-sm-4 col-12 mt-3 mb-3">
                        <div class="card bg-light shadow-lg">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <h5 class="card-title">Item : <?= $item->name ?></button></h5>
                                        <h6 class="card-subtitle mb-2 text-muted">Item ID : <?= $item->item_id ?></h6>
                                    </div>
                                    <div class="col-sm-3">
                                        <h4><span class="badge bg-danger"><?= $x ?></span></h4>
                                    </div>
                                </div>

                                <hr>
                                <!-- <h6 class="card-title"><button type='button' class='btn btn-danger'><?= $x ?></button></h5> -->
                                <p class="card-text"><?= "Sold amount : " . $item->item_count ?><br>
                                    <?= "Unit price : Rs." . $item->unit_price ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <span class="text-danger"><h5>No Items are sold in the selected Time Period</h5></span>
            <?php } ?>

            </div>
    </div>
    </div>
<?php } ?>
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