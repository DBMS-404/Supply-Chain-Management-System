<?php 
    redirectToHandler('sm');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script>
        function search() {
            var input, filter, rooms, tr, th, i, txtValue;
            input = document.getElementById("input");
            filter = input.value.toUpperCase();
            items = document.getElementById("items");
            tr = items.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                th = tr[i].getElementsByTagName("span")[0];
                txtValue = th.textContent || th.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    </script>

    <title>Inventory</title>
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
                    <li class="nav-item"><a class="nav-link" href="<?= SROOT ?>StockManagerHandler/vieworders">Orders</a></li>
                    <li class="nav-item"><a class="nav-link active" href="<?= SROOT ?>StockManagerHandler/viewinventory">Inventory</a></li>
                </ul>
                <a class="fw-light fs-5"><span style="margin-right: 5px;"><i class="fa fa-user" aria-hidden="true"></i> <?php print_r($_SESSION['user_id']); ?></span></a>
                <div  class="d-lg-none mb-3"></div>
                <a class="btn btn-primary btn-sm shadow" role="button" href="<?= SROOT ?>LoginHandler/logout">Logout</a>
            </div>
        </div>
    </nav>
    <header class="bg-primary-gradient pt-5">
        <?php if (isset($_SESSION['status']) && $_SESSION['status']==='added') { ?>
                <div class="row">
                    <div class="col-md-4 offset-md-8 mt-3">
                        <div class="alert alert-success alert-dismissible fade show shadow-lg" role="alert">
                            Successfully Added <strong><?= $_SESSION['item']; ?></strong> to stocks
                            <?php unset($_SESSION['status']);
                                  unset($_SESSION['item'])?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
        <?php }elseif (isset($_SESSION['status']) && $_SESSION['status']==='deleted') { ?>
                <div class="row">
                    <div class="col-md-4 offset-md-8 mt-3">
                        <div class="alert alert-danger alert-dismissible fade show shadow-lg" role="alert">
                            Successfully deleted <strong><?= $_SESSION['item']; ?></strong> from stocks
                            <?php unset($_SESSION['status']);
                                  unset($_SESSION['item'])?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
        <?php }elseif (isset($_SESSION['status']) && $_SESSION['status']==='edited') { ?>
            <div class="row">
                    <div class="col-md-4 offset-md-8 mt-3">
                        <div class="alert alert-info alert-dismissible fade show shadow-lg" role="alert">
                            Successfully Edited the Stocks Details of <strong><?= $_SESSION['item']; ?></strong>
                            <?php unset($_SESSION['status']);
                                  unset($_SESSION['item'])?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
        <?php }?>
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
            <h1>Stocks</h1>

        </div>
        <div class="row">
            <div class="col-sm-3 col-12">
                <a href="<?= SROOT ?>StockManagerHandler/manageStock" class="btn btn btn-info">Add Stock Item</a> <br><br>
            </div>
            <div class="col-sm-3 col-12 offset-sm-6">
                <div class="input-group rounded">
                    <input class="form-control" type="text" id="input" onkeyup="search()" placeholder="Search by Item name">
                    <span class="input-group-text border-0" id="search-addon">
                        <i class="fa fa-search"></i>
                    </span>
                </div>
            </div>
        </div>
        <br>
        <div class="table-div">
            <?php if (count($this->inventory) > 0) { ?>
                <table class="table align-middle">
                    <tbody id="items">
                        <?php foreach ($this->inventory as $item) { ?>
                            <tr>
                                <td>
                                <br>
                                    <div>
                                        <span><?= $item->name ?></span><br>
                                        <?= "Available quantity: " . $item->available_count ?><br>
                                        <?= "Unit price Rs." . $item->unit_price ?><br>
                                    </div><br>
                                </td>
                                <td ><a class="btn btn-sm btn-danger" href="<?= SROOT ?>StockManagerHandler/delete/<?= $item->item_id ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                                <td><a class="btn btn-sm btn-primary" href="<?= SROOT ?>StockManagerHandler/manageStock/<?= $item->item_id ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            <?php } else { ?>
                <h2>No items in the stock</h2>
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