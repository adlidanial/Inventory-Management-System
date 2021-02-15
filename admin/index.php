<?php
//connect with file config.php
include('config.php');
?>

<?php error_reporting(0); //ignore all error in this page ?>

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

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Inventory Management KKTF</title>
    <script type="text/javascript" src="custom.js"></script>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/css/pikaday.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body style="background-color: rgb(218,218,218);">
    <nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-white portfolio-navbar">
        <div class="container"><a class="navbar-brand logo" href="index.php"><img src="../assets/img/tf.png" style="width: 25%;height: 20%;"></a><button data-toggle="collapse" class="navbar-toggler" data-target="#navbarNav"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon" style="color: rgb(255,255,255);background-color: #ff00e2;"></span></button>
            <div
                class="collapse navbar-collapse" id="navbarNav">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="index.php" style="color: rgb(0,0,0);">Home</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="asset.php" style="color: rgb(0,0,0);">Asset</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="status.php" style="color: rgb(0,0,0);">Status</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="summary.php" style="color: rgb(0,0,0);">Summary</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="index.php?logout='1'" style="color: rgb(0,0,0);">Logout</a></li>
                </ul>
        </div>
        </div>
    </nav>
    <main class="page lanidng-page">
        <section class="portfolio-block block-intro">
            <div class="container">
                <div style="margin-top: -50px;">
                    <h2>College Tun Fatimah Inventory</h2>
                    <div class="form-group">
                        <p>Date: <?php echo date("d/m/Y"); ?></p>
                        <p style="margin-top: -33px;">Day: <?php echo date("l") ?></p>
                    </div>
                </div>
                <div style="color: rgb(255,255,255);display:flex">
                    <i style="background-color: gray;border-radius: 10%;padding: 10px;width: 5%;" class="fa fa-search"></i>
                    <input type="text" class="table-filter form-control" data-table="myTable" name="valueToSearch" placeholder="Search here">
                </div>
                <br>
                <div style="background-color: #ffffff;">
                    <div class="table-responsive">
                        <table class="table table-striped myTable">
                            <thead>
                                <tr>
                                <th>No</th>
                                <th>Barcode ID</th>
                                <th>Asset Name</th>
                                <th>Status</th>
                                <th>Description</th>
                                <th>Date Created</th>
                                <th>Date Modify</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            //query to database SELECT table based on bigger id
                            $sql = mysqli_query($connect, "SELECT c.list_id, a.asset_barcode, a.name AS asset_name, b.status_id, b.name, c.description, c.date_created, c.date_modify
                            FROM asset a, status b, list_record c
                            WHERE a.asset_id = c.fk_asset_id AND b.status_id = c.fk_status_id
                            ORDER BY c.date_created DESC") or die(mysqli_error($connect));

                            //if query above make  > 0 so running script below if...
                            if(mysqli_num_rows($sql) > 0){
                                
                                //make variable $no for keep number 
                                $no = 1;
                            
                                //make repeation while from  query $sql
                                while($data = mysqli_fetch_assoc($sql)){
                            $timecreate = strtotime($data['date_created']);
                            $timemodify = strtotime($data['date_modify']);
                            if($data['description'] == '')
                            {
                            $data['description'] = '-';
                            }
                                    
                             //appear data
                            echo '
                            <tr>
                                <td>'.$no++.'</td>
                                <td>'.$data['asset_barcode'].'</td>
                                <td>'.$data['asset_name'].'</td>
                                <td>'.$data['name'].'</td>
                                <td>'.$data['description'].'</td>
                                <td>'.date('d/m/Y', $timecreate).'</td>
                                <td>'.date('d/m/Y', $timemodify).'</td>
                            </tr>';
                                    
                                }
                            //if query make  0
                            }else{
                                echo '
                                <tr>
                                    <td colspan="11">no data.</td>
                                </tr>';
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
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