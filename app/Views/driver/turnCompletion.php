<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - Brand</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
</head>

<body style="/*background: url(&quot;design.jpg&quot;);*/background-position: 0 -60px;">
    <nav class="navbar navbar-light navbar-expand-md fixed-top navbar-shrink py-3" id="mainNav">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <span class="bs-icon-sm bs-icon-circle bs-icon-primary shadow d-flex justify-content-center align-items-center me-2 bs-icon"><img class="img-fluid" src="assets/img/logo-modified.png"/></span><span>Supply Chain Management System</span></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link active" href="<?=SROOT?>DriverHandler/turnCompletion">Turn Completion</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?=SROOT?>DriverHandler/applyLeave">Apply Leave</a></li>
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
            </div>
        </div>
    </header>
    <section>
    <div class="container py-5">
        <div class="mx-auto" style="max-width: 900px;">
            <div class="row row-cols-1 row-cols-md-2 d-flex justify-content-center">
                <div class="col mb-4">
                    <div class="card bg-primary-light">
                        <div class="card-body text-center px-4 py-5 px-md-5">
                            <p class="fw-bold text-primary card-text mb-2">Click the button</p>
                            <h5 class="fw-bold card-title mb-3">If you have completed your ongoing turn</h5>
                            <button class="btn btn-primary btn-lg" type="button">TURN COMPLETED</button>
                        </div>
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
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bold-and-bright.js"></script>
</body>

</html>