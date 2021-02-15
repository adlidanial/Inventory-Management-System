<?php 
  session_start(); 
  if ($_SESSION['role'] != "MANAGER") {
    echo ("<script>
    window.alert('You are not allowed to access this page.');
    window.location.href='../login.php';
    </script>");
  }
?>

<?php
//connect with file config.php
include('config.php');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Inventory Management KKTF</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/css/pikaday.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="custom.js"></script>
</head>

<body style="background-color: rgb(218,218,218);">
    <nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-white portfolio-navbar">
        <div class="container"><a class="navbar-brand logo" href="#"><img src="../assets/img/tf.png" style="width: 25%;height: 20%;"></a><button data-toggle="collapse" class="navbar-toggler" data-target="#navbarNav"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon" style="color: rgb(255,255,255);background-color: #ff00e2;"></span></button>
            <div
                class="collapse navbar-collapse" id="navbarNav">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="index.php" style="color: rgb(0,0,0);">Home</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="asset.php" style="color: rgb(0,0,0);">Asset</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="status.php" style="color: rgb(0,0,0);">Status</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="summary.php" style="color: rgb(0,0,0);">Summary</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="color: rgb(0,0,0);" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Maintenance
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                            <a class="dropdown-item" role="presentation" href="user.php" style="color: rgb(0,0,0);">User</a>
                        </div>
                    </li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="index.php?logout='1'.php" style="color: rgb(0,0,0);">Logout</a></li>
                </ul>
        </div>
        </div>
    </nav>
    <main class="page lanidng-page">
        <section class="portfolio-block block-intro">
            <div class="container">
                <div style="margin-top: -50px;">
                    <h2>Status</h2>
                </div>
                <div style="color: rgb(255,255,255);display:flex">
                    <i style="background-color: gray;border-radius: 10%;padding: 10px;width: 5%;" class="fa fa-search"></i>
                    <input type="text" class="table-filter form-control" data-table="order-table" name="valueToSearch" placeholder="Search here">
                </div>
                <hr>
                <a href="add_status.php" class="btn border rounded" style="color: white; background-color:#008CBA; float:right"><i class="fa fa-plus"></i> Add Status</a><br><br>
                <div style="background-color: #ffffff;">
                    <div class="table-responsive">
                        <table class="table table-striped order-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Date Created</th>
                                    <th>Date Modify</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                
                            //query to database SELECT table based on bigger id
                            $sql = mysqli_query($connect, "SELECT * FROM status") or die(mysqli_error($connect));

                            //if query above make  > 0 so running script below if...
                            if(mysqli_num_rows($sql) > 0){
                                
                                //make variable $no for keep number 
                                $no = 1;
                                $counter = 1;
                                //make repeation while from  query $sql
                                while($data = mysqli_fetch_assoc($sql)){
                                    
                                    //convert sql timestamp to string time
                                    $timecreate = strtotime($data['date_created']);
                                    $timemodify = strtotime($data['date_modify']);
                                    //appear data
                                    echo '
                                    <tr>
                                        <td>'.$counter.'</td>
                                        <td>'.$data['name'].'</td>
                                        <td>'.date('d/m/Y', $timecreate).'</td>
                                        <td>'.date('d/m/Y', $timemodify).'</td>
                                        <td>
                                            <a href="edit_status.php?id='.$data['status_id'].'" class="btn border rounded" style="color: white;background-color: #008CBA"><i class="fa fa-edit"></i> Edit</a>
                                            <a href="delete_status.php?id='.$data['status_id'].'"class="btn border rounded" style="color: white;background-color: #f44336" onclick="return confirm(\'You want delete this status with name='.$data['name'].' data?\')"><i class="fa fa-trash"></i> Delete</a>
                                        </td>
                                    
                                        
                                    </tr>
                                    ';
                                    $no++;
                                    $counter++;
                                }
                            
                            //if query make  0
                            } else {
                                echo '
                                <tr>
                                    <td colspan="12">no data.</td>
                                </tr>
                                ';
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
    <script>
        const $dropdown = $(".dropdown");
        const $dropdownToggle = $(".dropdown-toggle");
        const $dropdownMenu = $(".dropdown-menu");
        const showClass = "show";

        $(window).on("load resize", function() {
        if (this.matchMedia("(min-width: 768px)").matches) {
            $dropdown.hover(
            function() {
                const $this = $(this);
                $this.addClass(showClass);
                $this.find($dropdownToggle).attr("aria-expanded", "true");
                $this.find($dropdownMenu).addClass(showClass);
            },
            function() {
                const $this = $(this);
                $this.removeClass(showClass);
                $this.find($dropdownToggle).attr("aria-expanded", "false");
                $this.find($dropdownMenu).removeClass(showClass);
            }
            );
        } else {
            $dropdown.off("mouseenter mouseleave");
        }
        });
    </script>
</body>

</html>