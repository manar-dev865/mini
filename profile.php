<?php

include("config.php");

if(!isset($_SESSION["user_id"]))
{
    header("Location: login.php");
    exit();
}

$id = $_SESSION["user_id"];

$sql = "SELECT * FROM students WHERE id='$id'";

$result = mysqli_query($conn,$sql);

$user = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>Profile</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<div class="card">

<div class="card-header bg-primary text-white">

<h2>User Profile</h2>

</div>

<div class="card-body">

<p>

<strong>First Name :</strong>

<?php echo $user["first_name"]; ?>

</p>

<p>

<strong>Last Name :</strong>

<?php echo $user["last_name"]; ?>

</p>

<p>

<strong>Email :</strong>

<?php echo $user["email"]; ?>

</p>

<p>

<strong>Phone :</strong>

<?php echo $user["phone"]; ?>

</p>

<p>

<strong>Gender :</strong>

<?php echo $user["gender"]; ?>

</p>

<a
href="dashboard.php"
class="btn btn-secondary">

Dashboard

</a>

<a
href="edit_profile.php"
class="btn btn-warning">

Edit Profile

</a>

</div>

</div>

</div>

</body>

</html>