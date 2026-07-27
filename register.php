<?php

include("config.php");

if(isset($_POST["register"]))
{

$first_name = trim($_POST["first_name"]);
$last_name  = trim($_POST["last_name"]);
$email      = trim($_POST["email"]);
$password   = $_POST["password"];
$phone      = trim($_POST["phone"]);
$gender     = $_POST["gender"];

$errors = [];

if(empty($first_name))
{
    $errors[] = "First Name is required.";
}

if(empty($last_name))
{
    $errors[] = "Last Name is required.";
}

if(empty($email))
{
    $errors[] = "Email is required.";
}

if(!filter_var($email,FILTER_VALIDATE_EMAIL))
{
    $errors[] = "Invalid Email.";
}

if(empty($password))
{
    $errors[] = "Password is required.";
}

$check = mysqli_query($conn,
"SELECT id FROM students WHERE email='$email'");

if(mysqli_num_rows($check)>0)
{
    $errors[] = "Email already exists.";
}

if(count($errors)==0)
{

$hash = password_hash($password,PASSWORD_DEFAULT);

$sql="INSERT INTO students
(first_name,last_name,email,password,phone,gender)

VALUES

('$first_name',
'$last_name',
'$email',
'$hash',
'$phone',
'$gender')";

if(mysqli_query($conn,$sql))
{

header("Location: login.php");
exit();

}

}

}

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>Register</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2>Register</h2>

<form method="POST">

<div class="mb-3">

<label>First Name</label>

<input
type="text"
name="first_name"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Last Name</label>

<input
type="text"
name="last_name"
class="form-control"
required>

</div>
<div class="mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Password</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Phone</label>

<input
type="text"
name="phone"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Gender</label>

<select
name="gender"
class="form-control"
required>

<option value="">Select</option>
<option value="Male">Male</option>
<option value="Female">Female</option>

</select>

</div>

<button
type="submit"
name="register"
class="btn btn-success">

Register

</button>

<a
href="login.php"
class="btn btn-primary">

Login

</a>

</form>

</div>

</body>

</html>