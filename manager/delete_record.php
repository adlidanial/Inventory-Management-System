<?php
    //connect with file config.php
    include('config.php');

    $id = $_GET['id'];

    if(isset($id))
    {
        //execute to check if barcode exist or not on table
        $sql = "DELETE FROM list_record WHERE status_id = ?";
        $result = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($result, 'i', $id);
        $results = mysqli_stmt_execute($result);
        if($result)
        {
            echo ("<script>
            window.alert('Succesfully delete record.');
            window.location.href='index.php';
            </script>");
            //header('location: index.php');
        }
        else
        {
            echo ("<script>
            window.alert('Ralat. Tidak boleh hapus!');
            </script>");
        }
    }
?>