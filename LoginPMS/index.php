<?php
session_start();
$connect = mysqli_connect('localhost', 'root', '', 'pms');
// Check connection
if (!$connect) {
    die("Connection failed: " . $db-> mysqli_connect_error());
}
$username='';
$pass='';
$errors = array();
//ADMIN LOGIN
if (isset($_POST['login'])) {
$username = mysqli_real_escape_string($connect, $_POST['username']);
$pass = mysqli_real_escape_string($connect, $_POST['password']);
if (empty($username)) {
array_push($errors, "Enter Username");
}
if (empty($pass)) {
array_push($errors, "Enter Password");
}
if (count($errors) == 0) {
$query = "SELECT * FROM admin WHERE username='$username' AND password='$pass'";
$results = mysqli_query($connect, $query);
if (mysqli_num_rows($results) == 1) {
$_SESSION['username'] = $username;
header('location: dashboard/home.php');
}else {
array_push($errors, "Wrong username/password");
}
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/materialize.css">
    <link rel="stylesheet" href="css/tooplate.css">
    <style type="text/css">
        strong{
            font-weight: bold;
            font-family:cursive;
        }
    </style>
</head>

<body id="login">
    <div class="container">
        <div class="row tm-register-row tm-mb-35">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 tm-login-l">
                <form action="index.php" method="post" class="tm-bg-black p-5 h-100">
                   <?php include('errors.php'); ?>
                    <div class="input-field">
                        <input placeholder="Username" id="username" name="username" type="text" class="validate">
                    </div>
                    <div class="input-field mb-5">
                        <input placeholder="Password" id="password" name="password" type="password" class="validate">
                    </div>
                    <div class="tm-flex-lr">
                        <a href="#" class="white-text small">Forgot Password?</a>
                        <button type="submit" class="waves-effect btn-large btn-large-white px-4 black-text rounded-0" src="dashboardhome.php" name="login">Login</button>
                    </div>
                </form>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 tm-login-r">
                <header class="font-weight-light tm-bg-black p-5 h-100">
                    <h5 class="mt-0 text-white font-weight-light">Patient Management System</h5>
                    <p>This application allows and enables institutions like Hospitals better manage their patients' records and information.</p>
                </header>
            </div>
        </div>
        <footer class="row tm-mt-big mb-3">
            <div class="col-xl-12 text-center">
            <footer class="footer-link">
                <p class="tm-copyright-text">Copyright &copy;  <strong >f.b</strong> Patient.Management.System </p>
            </footer>
            </div>
        </footer>
    </div>
</body>

</html>