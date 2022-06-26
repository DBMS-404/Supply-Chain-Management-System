<?php
$page = "Add Item";
if ($_POST) {
    $values = posted_values($_POST);
}

if (isset($this->edit_values)) {
    $values = $this->edit_values;
    $page = $values['name'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <title>Manage Stock</title>
    <style>
        <?php include_once('assets/bootstrap/css/bootstrap.min.css'); ?>
    </style>
</head>

<body style="/*background: url(&quot;design.jpg&quot;);*/background-position: 0 -60px;">
    <nav class="navbar navbar-light navbar-expand-md fixed-top navbar-shrink py-3" id="mainNav">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <span class="bs-icon-sm bs-icon-circle bs-icon-primary shadow d-flex justify-content-center align-items-center me-2 bs-icon"><img class="img-fluid" src="assets/img/logo-modified.png"></span><span>Supply Chain Management System</span></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link active" href="<?=SROOT?>StockManagerHandler/viewinventory">Inventory</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?=SROOT?>StockManagerHandler/vieworders">Orders</a></li>
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
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=SROOT?>StockManagerHandler">Home</a></li>
                <li class="breadcrumb-item"><a href="<?=SROOT?>StockManagerHandler/viewinventory">Inventory</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?=$page?></li>
            </ol>
        </nav>
        <div class="row d-flex justify-content-center">
            <h1>Manage stock</h1>
            <div class="col-md-8 col-xl-6">
                <span class='danger' style="color:red;">
                    <?= $this->displayErrors ?? "" ?>
                </span>
                <form class="p-3 p-xl-4" action="<?= SROOT ?>StockManagerHandler/manageStock/<?= $this->item_id ?>" method="post">
                    <label>Item Name: </label>
                    <input class="form-control" type="text" name="name" value="<?= ($values['name'] ?? "") ?>" required> <br><br>
                    <label>Quantity: </label>
                    <input class="form-control" type="text" name="available_count" value="<?= ($values['available_count'] ?? "") ?>" required> <br><br>
                    <label>Unit price: </label>
                    <input class="form-control" type="text" name="unit_price" value="<?= ($values['unit_price'] ?? "") ?>" required> <br><br>
                    <input class="btn btn-success" type="submit" value="Submit">

                </form>
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