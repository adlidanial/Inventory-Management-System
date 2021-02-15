<?php
session_start();
//connect with file config.php
include('config.php');

if(isset($_POST['submit']))
{
    $status = $_POST["status"];

    //execute to check if status exist or not on table
    $sql = "SELECT * FROM status WHERE name = ?";
    $result = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($result, 's', $status);
    mysqli_stmt_execute($result);
    $result = mysqli_stmt_get_result($result);
    $asset = mysqli_fetch_assoc($result);
    
    if (!$asset) // if asset does not exists
    {
        $query = "INSERT INTO status (name, date_created, date_modify) 
          VALUES(?, now(), now())";
    
        $result = mysqli_prepare($connect, $query);
        mysqli_stmt_bind_param($result, 's', $status);
        $result = mysqli_stmt_execute($result);
        
        if($result)
        {
            echo ("<script>
            window.alert('Succesfully insert new status.');
            window.location.href='status.php';
            </script>");
            //header('location: index.php');
        }
        else
        {
            echo ("<script>
            window.alert('Ralat. Tidak boleh simpan!');
            </script>");
        }
    }
    else
    {
        echo ("<script>
        window.alert('Status name has been exist.');
        </script>");
    }
}
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
</head>

<body style="background-color: rgb(218,218,218);">
    <nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-white portfolio-navbar">
        <div class="container"><a class="navbar-brand logo" href="index.php"><img src="../assets/img/tf.png" style="width: 25%;height: 20%;"></a><button data-toggle="collapse" class="navbar-toggler" data-target="#navbarNav"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon" style="color: rgb(255,255,255);background-color: #ff00e2;"></span></button>
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
                    <li class="nav-item" role="presentation"><a class="nav-link" href="index.php?logout='1'" style="color: rgb(0,0,0);">Logout</a></li>
                </ul>
        </div>
        </div>
    </nav>
    <main class="page lanidng-page">
        <section class="portfolio-block block-intro">
            <div class="container">
                <div style="margin-top: -50px;">
                    <h2>Add Status</h2>
                </div>
                <hr>
                <div>
                    <form style="background-color: #ffffff;" method="post" action="add_status.php">
                        <div class="form-group text-left">
                            <label>Status Name</label>
                            <input class="form-control" type="text" name="status" required>
                        </div>
                        <button class="btn btn-primary border rounded float-right" type="submit" name="submit">Save</button>
                        <a href="status.php"><button class="btn btn-secondary border rounded float-left" type="button">Back</button></a>
                    </form>
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