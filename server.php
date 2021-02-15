<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'kktf');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $fullname = mysqli_real_escape_string($db, $_POST['fullname']);
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $noic = mysqli_real_escape_string($db, $_POST['noic']);
  $telno = mysqli_real_escape_string($db, $_POST['telno']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($fullname)) { array_push($errors, "Full name is required"); }
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
    array_push($errors, "The two passwords does not match!");
  }
  if (empty($noic)) { array_push($errors, "Identification Card No is required"); }
  if (empty($telno)) { array_push($errors, "Phone number is required"); }
  $pass1 = strlen($password_1);
  $pass2 = strlen($password_2);
  // first check the database to make sure 
  // a user does not already exist with the same email
  $user_check_query = "SELECT * FROM user WHERE email=? LIMIT 1";
  $result = mysqli_prepare($db, $user_check_query);
  mysqli_stmt_bind_param($result, 's', $email);
  mysqli_stmt_execute($result);
  $result = mysqli_stmt_get_result($result);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    /*if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }*/

    if ($user['email'] === $email) {
      array_push($errors, "Email already exists!");
    }
  }
  else if(!is_numeric($telno))
  {
    array_push($errors, "Phone number must be in numeric.");
  }
  else if($pass1 < 7 || $pass2 < 7)
  {
    array_push($errors, "Password must be at least 8 character");
  }
  else
  {
      // Finally, register user if there are no errors in the form
      if (count($errors) == 0) {
        $password = md5($password_1);//encrypt the password before saving in the database

        $query = "INSERT INTO user (name, noic, nophone, email, username, password, role) 
              VALUES(?, ?, ?, ?, ?, ?, 'ADMIN')";
        
        $result = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($result, 'ssssss', $fullname, $noic, $telno, $email, $username, $password);
        $result = mysqli_stmt_execute($result);
        //$result = mysqli_stmt_get_result($result);
        
        if($result)
        {
          $_SESSION['username'] = $username;
          $_SESSION['success'] = "You are now logged in";
          echo ("<script>
          window.alert('Succesfully Register. You have to logged in.');
          window.location.href='index.php';
          </script>");
          //header('location: index.php');
        }
        else
        {
        }
      }
  }

  
}

// ... 
// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $password = md5($password);
  	$query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
      while($data = mysqli_fetch_assoc($results)){
        $role = $data["role"];
      }
  	  $_SESSION['username'] = $username;
      $_SESSION['success'] = "You are now logged in";
      $_SESSION['role'] = $role;
      
      if($role == "ADMIN")
      {
        header('location: admin/index.php');
      }
      else if($role == "MANAGER")
      {
        header('location: manager/index.php');
      }
  	 
  	}else {
        echo "<script>alert('Wrong username/password combination');</script>";
  		//array_push($errors, "Wrong username/password combination");
  	}
  }
}

?>