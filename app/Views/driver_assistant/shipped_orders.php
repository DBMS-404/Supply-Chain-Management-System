<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Orders</title>
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
                    <li class="nav-item"><a class="nav-link" href="<?= SROOT ?>AssistantHandler/vieworders">Orders</a></li>
                    <li class="nav-item"><a class="nav-link" href="">Apply Leave</a></li>
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
    <section>
        <div class="container">
                <?php if (count($this->orders) > 0) { ?>
                    <div class="row m-3">
                    <iframe src="<?= $this->orders[0]->route_map ?>" width="400" height="300" style="border:2;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="row m-3">
                        <h3>Packages In Your Truck</h3>
                    </div>
                    <div class="row m-1">
                    <?php foreach ($this->orders as $item_order) { ?>
                        <div class="col-sm-3 col-12 m-2">
                        <div class="card bg-light" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title"><?= "Order " . $item_order->order_id ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted"><?= $item_order->address ?></h6>
                                <p class="card-text"><?= $item_order->weight . " g" ?></p>
                                <a href="<?=SROOT?>AssistantHandler/completeOneOrder/<?=$item_order->order_id?>" class="btn btn-outline-success btn-sm">Delivered</a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                <?php } else { ?>
                    <h1>No orders available</h1>
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