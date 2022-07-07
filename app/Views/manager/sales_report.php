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
            <a class="navbar-brand d-flex align-items-center" href="/">
                <span class="bs-icon-sm bs-icon-circle   shadow d-flex justify-content-center align-items-center me-2 bs-icon"><img class="img-fluid" src="https://static.wixstatic.com/media/dcfc03_6c7b355ab8c0449c9583b19c1badbeb1~mv2.png/v1/fill/w_338,h_328,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/Artboard%207%20copy%203.png"></span><span>Supply Chain Management System</span></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="<?= SROOT ?>ManagerHandler/viewTrainSchedule">Train Schedule</a></li>
                    <li class="nav-item"><a class="nav-link active" href="<?= SROOT?>ManagerHandler/generateReport">Reports</a></li>
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
        <br>
        <div class="row m-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="<?= SROOT?>ManagerHandler/generateReport">Generate Reports</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sales Report</li>
                </ol>
            </nav>
        </div>
            <form class="p-3 p-xl-4" action="<?= SROOT ?>ManagerHandler/generateReport/4" method="post">
                <div class='row mb-2'>
                    <div class=col-sm-2>
                        <label for="time_period">Select the Time Period</label>
                    </div>
                    <div class=col-sm-2>
                        <select class="form-select"  name='time_period'>
                            <option value="0" selected>All Time</option>
                            <option value="1">1st Quarter</option>
                            <option value="2">2nd Quarter</option>
                            <option value="3">3rd Quarter</option>
                            <option value="4">4th Quarter</option>
                        </select>
                    </div>
                </div>
                <div class='row mb-2'>
                    <div class=col-sm-2>
                        <label for="city">Select the City</label>
                    </div>
                    <div class=col-sm-2>
                        <select class="form-select"  name='city'>
                            <option value="0-All Cities" selected>All cities</option>
                            <?php foreach($this->cities as $city){ ?>
                                <option value="<?= $city->city_id?>-<?= $city->name ?>"><?= $city->name ?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class=col-sm-2>
                        <label for="route">Select the Route</label>
                    </div>
                    <div class=col-sm-2>
                        <select class="form-select"  name='route'>
                            <option value="0" selected>All routes</option>
                            <?php foreach($this->routes as $route){ ?>
                                <option value="<?= $route->route_id ?>"><?= $route->route_id ?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                
                <div class='row mb-2'>
                    <div class=col-sm-3>
                        <input class="btn-sm btn-success" type="submit" value="Search">
                    </div>
                </div>
            </form>

        <div class="row">        
            <div class="row m-2">
                <h3>Sales Report</h3>
                <br><br>
                <h5 class='text-muted'>Time Range : <?php if($this->first_date=="" and $this->second_date==""){?>All Time
                                        <?php }else{?>Quarter<?= " ".$this->time_period." "?> || From <?=$this->first_date?> to <?=$this->second_date?>
                                        <?php }?> </h5>
                <h5 class='text-muted'>Route : <?= $this->route?> </h5>
                <h5 class='text-muted'>City : <?= $this->city?> </h5><br>
                <table class="table">
                    <tbody id="trains">
                        <hr>
                        <?php if (count($this->orders) > 0) {
                            foreach ($this->orders as $order) { ?>
                                <tr class="order-id" style="width: 807.2px;">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <p class="fw-bolder fs-5"><?= "Order ID - " . $order->order_id?></p>
                                        </div>
                                        <div class="col-sm-3 text-muted">
                                            <?= "Scheduled Date - ". $order->date ?><br>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <?= "Customer - ". $order->user_id." || ".$order->first_name." ".$order->last_name ?><br>
                                            <?= "Status - ".$order->status ?><br>
                                        </div>
                                        <div class="col-sm-2">
                                            <h5><span class="badge bg-success p-2"><?= "Weight - ".$order->weight." g"?></span></h5><br>
                                        </div>
                                        <div class="col-sm-2">
                                            <h5><span class="badge bg-danger p-2"><?= "Total Price - Rs.".$order->total_price?></span></h5><br>
                                        </div>  
                                    </div>
                                </tr>
                                <hr>
                            <?php } ?>
                        <?php } else { ?>
                            <h5>No orders have been placed!</h5>
                        <?php } ?>
                    </tbody>
                </table>
            <?php if(isset($this->displayErrors)){?>
                <br><br>
                <span class="text-danger"><h5><?=$this->displayErrors?></h5></span>
            <?php } else {?>  
        <?php } ?>
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