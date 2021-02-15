<?php 
  session_start(); 
  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: ../login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: ../login.php");
  }
?>

<?php
//connect with file config.php
include('config.php');
?>

<?php error_reporting(0); //ignore all error in this page ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Inventory Management KKTF</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/css/pikaday.min.css">
</head>

<body style="background-color: rgb(218,218,218);">
    <nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-white portfolio-navbar">
        <div class="container"><a class="navbar-brand logo" href="index.php"><img src="../assets/img/tf.png" style="width: 25%;height: 20%;"></a><button data-toggle="collapse" class="navbar-toggler" data-target="#navbarNav"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon" style="color: rgb(255,255,255);background-color: #ff00e2;"></span></button>
            <div
                class="collapse navbar-collapse" id="navbarNav">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="index.php" style="color: rgb(0,0,0);">Home</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="asset.php" style="color: rgb(0,0,0);">Asset</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="status.php" style="color: rgb(0,0,0);">Status</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="summary.php" style="color: rgb(0,0,0);">Summary</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="index.php?logout='1'" style="color: rgb(0,0,0);">Logout</a></li>
                </ul>
        </div>
        </div>
    </nav>
    <main class="page lanidng-page">
        <section class="portfolio-block block-intro">
            <div class="container">
                <div style="margin-top: -50px;">
                    <h2>Summary</h2>
                </div>
                <div style="color: rgb(255,255,255);">
                    <form style="background-color: #ffffff;" method="post" action="document_record.php">
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group text-left">
                                    <label style="color: rgb(0,0,0);">Start Date</label>
                                    <input class="form-control" type="date" name="start" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group text-left">
                                    <label style="color: rgb(0,0,0);">End Date</label>
                                    <input class="form-control" type="date" name="end" required>
                                </div>
                            </div>
                        </div>
                        <button class="btn border rounded" style="background-color: #008CBA; color: white" type="submit" name="generate" formtarget="_blank">Generate Report</button>
                    </form>
                    <br>
                    <form style="background-color: #ffffff;" method="post" action="document_record.php">
                        <h4 style="color:black">Quick date:</h4>
                        <button class="btn border rounded" style="background-color: #008CBA; color: white" type="submit" name="month" formtarget="_blank">1 Month Report</button>
                        <button class="btn border rounded" style="background-color: #008CBA; color: white" type="submit" name="year" formtarget="_blank">1 Year Report</button>
                    <form>
                </div>
            </div>
        </section>
    </main>
    <footer class="page-footer" style="background-color: #ffffff;">
        <div class="container">
            <div class="links"><label>Copyright of College Tun Fatimah @ 2020</label></div>
        </div>
    </footer>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/pikaday.min.js"></script>
    <script src="../assets/js/script.min.js"></script>
</body>

</html>