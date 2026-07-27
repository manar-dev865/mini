<?php

include("config.php");

if(!isset($_SESSION["user_id"]))
{
    header("Location: login.php");
    exit();
}

$id = $_SESSION["user_id"];

$result = mysqli_query($conn,"SELECT * FROM students WHERE id='$id'");

$user = mysqli_fetch_assoc($result);

if(isset($_POST["change"]))
{

$current_password = $_POST["current_password"];
$new_password = $_POST["new_password"];
$confirm_password = $_POST["confirm_password"];

$errors = [];

if(!password_verify($current_password,$user["password"]))
{
    $errors[] = "Current Password is incorrect.";
}

if(strlen($new_password) < 6)
{
    $errors[] = "New Password must be at least 6 characters.";
}

if($new_password != $confirm_password)
{
    $errors[] = "Passwords do not match.";
}

if(count($errors)==0)
{

$hash = password_hash($new_password,PASSWORD_DEFAULT);

$sql = "UPDATE students
SET password='$hash'
WHERE id='$id'";

if(mysqli_query($conn,$sql))
{
    $success = "Password Changed Successfully.";
}

}

}

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>Change Password</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2>Change Password</h2>

<form method="POST">

<div class="mb-3">

<label>Current Password</label>

<input
type="password"
name="current_password"
class="form-control"
required>

</div>

<div class="mb-3">

<label>New Password</label>

<input
type="password"
name="new_password"
class="form-control"
required>

</div>
<div class="mb-3">

<label>Confirm Password</label>

<input
type="password"
name="confirm_password"
class="form-control"
required>

</div>

<button
type="submit"
name="change"
class="btn btn-success">

Change Password

</button>

<a
href="dashboard.php"
class="btn btn-secondary">

Back

</a>

</form>

<?php

if(isset($success))
{

echo "<div class='alert alert-success mt-3'>
$success
</div>";

}

if(!empty($errors))
{

foreach($errors as $error)
{

echo "<div class='alert alert-danger mt-3'>
$error
</div>";

}

}

?>

</div>

</body>

</html>