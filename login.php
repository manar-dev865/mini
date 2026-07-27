<?php

include("config.php");

if(isset($_POST["login"]))
{

$email = trim($_POST["email"]);
$password = $_POST["password"];

$sql = "SELECT * FROM students WHERE email='$email'";

$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result)==1)
{

$user = mysqli_fetch_assoc($result);

if(password_verify($password,$user["password"]))
{

$_SESSION["user_id"] = $user["id"];
$_SESSION["user_name"] = $user["first_name"];

header("Location: dashboard.php");
exit();

}
else
{

$error = "Invalid Password.";

}

}
else
{

$error = "Email Not Found.";

}

}

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2>Login</h2>

<form method="POST">

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
<button
type="submit"
name="login"
class="btn btn-primary">

Login

</button>

<a
href="register.php"
class="btn btn-success">

Register

</a>

</form>

<?php

if(isset($error))
{

echo "<div class='alert alert-danger mt-3'>
$error
</div>";

}

?>

</div>

</body>

</html>