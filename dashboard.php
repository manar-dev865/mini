<?php

include("config.php");

if(!isset($_SESSION["user_id"]))
{
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<div class="card">

<div class="card-header bg-success text-white">

<h2>Dashboard</h2>

</div>

<div class="card-body">

<h4>

Welcome

<?php echo $_SESSION["user_name"]; ?>

</h4>

<hr>

<a
href="profile.php"
class="btn btn-primary">

Profile

</a>

<a
href="edit_profile.php"
class="btn btn-warning">

Edit Profile

</a>

<a
href="change_password.php"
class="btn btn-info">

Change Password

</a>

<a
href="logout.php"
class="btn btn-danger">

Logout

</a>

</div>

</div>

</div>

</body>

</html>