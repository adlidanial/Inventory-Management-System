<?php include('server.php') ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Inventory Management KKTF</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/css/pikaday.min.css">
</head>

<body style="background-color: rgb(218,218,218);">
    <main class="page hire-me-page">
        <section class="portfolio-block hire-me">
            <div class="container" style="margin-top: -80px;">
                <form style="margin-top: -46px;background-color: #ffffff;" method="post" action="register.php">
                    <div class="text-center"><img src="assets/img/tf.png"></div>
                    <div class="heading">
                        <h2>INVENTORY MANAGEMENT SYSTEM</h2>
                    </div>
                    <div style="background-color: rgb(218,218,218); color: red">
                        <?php include('errors.php'); ?>
                    </div>
                    <div class="form-group">
                        <label for="email">Full Name</label><span style="color: red">&#42;</span>
                        <input class="form-control" type="text" name="fullname" pattern="[a-zA-Z][a-zA-Z ]{2,}" required="">
                    </div>
                    <div class="form-group">
                        <label for="message">Identification Card No.</label><span style="color: red">&#42;</span>
                        <input class="form-control" type="text" name="noic" required="">
                    </div>
                    <div class="form-group">
                        <label for="message">Phone Number</label><span style="color: red">&#42;</span>
                        <input class="form-control" type="text" name="telno" required="">
                    </div>
                    <div class="form-group">
                        <label for="message">Email</label><span style="color: red">&#42;</span>
                        <input class="form-control" type="email" name="email" required="">
                    </div>
                    <div class="form-group">
                        <label for="message">Username</label><span style="color: red">&#42;</span>
                        <input class="form-control" type="text" name="username" required="">
                    </div>
                    <div class="form-group">
                        <label for="message">Password</label><span style="color: red">&#42;</span>
                        <input class="form-control" type="password" name="password_1" required="">
                    </div>
                    <div class="form-group">
                        <label for="message">Confirm Password</label><span style="color: red">&#42;</span>
                        <input class="form-control" type="password" name="password_2" required="">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-block rounded" name="reg_user" type="submit" style="background-color: rgb(255,0,226);color: rgb(255,255,255);">Register</button>
                    </div>
                    <div>
                        <label>Already register?&nbsp;</label><a href="login.php">Sign In</a></div>
                </form>
            </div>
        </section>
    </main>
    <footer class="page-footer" style="background-color: #ffffff;">
        <div class="container">
            <div class="links"><label>Copyright of College Tun Fatimah @ 2020</label></div>
        </div>
    </footer>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/pikaday.min.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>