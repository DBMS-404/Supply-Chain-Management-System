<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - Brand</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
</head>
<style>
    <?php include_once('assets/bootstrap/css/bootstrap.min.css'); ?>
</style>

<body style="/*background: url(&quot;design.jpg&quot;);*/background-position: 0 -60px;">
    <nav class="navbar navbar-light navbar-expand-md fixed-top navbar-shrink py-3" id="mainNav">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <span class="bs-icon-sm bs-icon-circle bs-icon-primary shadow d-flex justify-content-center align-items-center me-2 bs-icon"><img class="img-fluid" src="assets/img/logo-modified.png"></span><span>Supply Chain Management System</span></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
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
            <div class="card">
                <?php if (count($this->orders) > 0) {
                    foreach ($this->orders as $item_order) { ?>
                        <tr>
                            <td>
                                <div>
                                    <?= "Order " . $item_order->order_id ?><br>
                                    <?= $item_order->weight . " kg" ?><br>
                                    <?= $item_order->address ?><br><br>
                                </div>
                            </td>
                            <td>
                                <?php if ($item_order->status == "new") { ?>
                                    <a href="<?= SROOT ?>StockManagerHandler/assignto_train/<?= $item_order->order_id ?>">Assign</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <h1>No orders available</h1>
                <?php } ?>
            </div>
        </div>
    </section>
    <footer class="bg-primary-gradient fixed-bottom">
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