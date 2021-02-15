<?php
session_start();
//connect with file config.php
include('config.php');

if(isset($_POST['submit']))
{
    $assetbarcode = $_POST["assetbarcode"];
    $assetname = $_POST["assetname"];
    $assetid = $_POST["assetid"];
    $price = $_POST["price"];

    $query = "UPDATE asset SET
                date_modify = now(),
                asset_barcode = ?,
                name = ?,
                price = ?
                WHERE asset_id = ?";
    //$query = "INSERT INTO asset (fk_user_id, asset_barcode, name, quantity, date_created, date_modify) 
        // VALUES(?, ?, ?, ?, now(), now())";

    $result = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($result, 'ssdi', $assetbarcode, $assetname, $price, $assetid);
    $result = mysqli_stmt_execute($result);
    
    if($result)
    {
        echo ("<script>
        window.alert('Succesfully update asset.');
        window.location.href='asset.php';
        </script>");
        //header('location: index.php');
    }
    else
    {
        echo ("<script>
        window.alert('Ralat. Tidak boleh ubah!');
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
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="asset.php" style="color: rgb(0,0,0);">Asset</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="status.php" style="color: rgb(0,0,0);">Status</a></li>
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
                    <h2>Update Asset</h2>
                </div>
                <hr>
                <div>
                    <form style="background-color: #ffffff;" method="post" action="edit_asset.php">
                    <?php
                        $id = $_GET['id'];
                        //query to database SELECT table based on bigger id
                        $sql = mysqli_query($connect, "SELECT * FROM asset
                        WHERE asset_id = $id") or die(mysqli_error($connect));

                        //if query above make  > 0 so running script below if...
                        if(mysqli_num_rows($sql) > 0){
                            while($data = mysqli_fetch_assoc($sql)){

                    ?>
                        <div class="form-group">
                            <p style="text-align:center"><video id="video" width="400" height="200" autoplay></video></p>
                            <button class="btn btn-secondary border rounded" type="button">Snap Barcode</button>
                        </div>
                        <div class="form-group text-left">
                            <label>Barcode ID</label>
                            <input class="form-control" value="<?php echo $data['asset_barcode']; ?>" type="text" name="assetbarcode" required>
                        </div>
                        <div class="form-group text-left">
                            <label>Name</label>
                            <input class="form-control" value="<?php echo $data['name']; ?>" type="text" name="assetname" required>
                        </div>
                        <div class="form-group text-left">
                            <label>Price</label>
                            <input class="form-control" value="<?php echo $data['price'];}} ?>" type="text" name="price" required>
                        </div>
                        <input type="hidden" name="assetid" value="<?php echo $id; ?>">
                        <button class="btn btn-primary border rounded float-right" name="submit" type="submit">Update</button>
                        <a href="asset.php"><button class="btn btn-secondary border rounded float-left" type="button">Back</button></a>
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
    // Grab elements, create settings, etc.
    var video = document.getElementById('video');

    // Get access to the camera!
    if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        // Not adding `{ audio: true }` since we only want video now
        navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
            //video.src = window.URL.createObjectURL(stream);
            video.srcObject = stream;
            video.play();
        });
    }
    </script>
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