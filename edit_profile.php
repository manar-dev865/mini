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

if(isset($_POST["update"]))
{

$first_name = trim($_POST["first_name"]);
$last_name  = trim($_POST["last_name"]);
$email      = trim($_POST["email"]);
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

if(count($errors)==0)
{

$sql = "UPDATE students SET

first_name='$first_name',

last_name='$last_name',

email='$email',

phone='$phone',

gender='$gender'

WHERE id='$id'";

if(mysqli_query($conn,$sql))
{
    header("Location: profile.php");
    exit();
}

}

}

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>Edit Profile</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2>Edit Profile</h2>

<form method="POST">

<div class="mb-3">

<label>First Name</label>

<input
type="text"
name="first_name"
class="form-control"
value="<?php echo $user["first_name"]; ?>"
required>

</div>

<div class="mb-3">

<label>Last Name</label>

<input
type="text"
name="last_name"
class="form-control"
value="<?php echo $user["last_name"]; ?>"
required>

</div>
<div class="mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
value="<?php echo $user["email"]; ?>"
required>

</div>

<div class="mb-3">

<label>Phone</label>

<input
type="text"
name="phone"
class="form-control"
value="<?php echo $user["phone"]; ?>"
required>

</div>

<div class="mb-3">

<label>Gender</label>

<select
name="gender"
class="form-control"
required>

<option value="Male" <?php if($user["gender"]=="Male") echo "selected"; ?>>Male</option>

<option value="Female" <?php if($user["gender"]=="Female") echo "selected"; ?>>Female</option>

</select>

</div>

<button
type="submit"
name="update"
class="btn btn-success">

Update Profile

</button>

<a
href="profile.php"
class="btn btn-secondary">

Cancel

</a>

</form>

</div>

</body>

</html>