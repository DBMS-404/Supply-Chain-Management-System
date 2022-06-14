<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <header>
        <h1 class='header' style="padding: 10px;">Login</h1>
    </header>
    <br>
    <div class="outer">
        <div style="width:100%;">
            <div class="top">
                <main class='main'>
                    <form action="<?= SROOT ?>LoginHandler/login" method="post">
                        <div class="mb-3 row1">
                            <div class="col-sm-10" style="margin-left: 15px;">
                                <label>UserId</label><br>
                                <input type="text" class="form-control-plaintext" placeholder="UserId" name="user_id"><br><br>
                            </div>
                        </div>
                        <div class="mb-3 row1">
                            <div class="col-sm-10" style="margin-left: 15px;">
                                <label>Password</label><br>
                                <input type="password" class="form-control-plaintext" placeholder="Password" name="password"> <span class="error"><br><br>
                            </div>
                        </div>
                        <div class="mb-3 row1">
                            <div class="col-sm-10" style="margin-left: 15px;">
                                <input type="submit" class="btn btn-primary" name="submit" value="Sign-in">
                            </div>
                        </div>
                    </form>
                </main>
                <br>
            </div>
        </div>
    </div>

</body>
</html>