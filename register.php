<?php include "header.php"; ?>
<br></br><br></br><br></br>

<?PHP 
if(isset($_POST['submit'])){
$user=mysqli_real_escape_string($connection ,trim($_POST['user']));
$pass=mysqli_real_escape_string($connection ,trim($_POST['pass']));
$pass2=mysqli_real_escape_string($connection ,trim($_POST['pass2']));
$email=mysqli_real_escape_string($connection ,trim($_POST['email']));
$error=['user'=>'','pass'=>'','email'=>''];

if(strlen($user)<3){

    $error['user']='username must be longer';
}

if($pass!=$pass2){
    $error['pass']='password are not the same';
}


$query="SELECT * FROM users WHERE user_name='$user'";
$result=mysqli_query($connection,$query);
if(!$result){
die("query failed . " . mysqli_error($connection));
} 
$count=mysqli_num_rows($result);
if(!empty($count)){
    $error['user']='username exist';
}

$query="SELECT * FROM users WHERE user_email='$email'";
$result=mysqli_query($connection,$query);
if(!$result){
die("query failed . " . mysqli_error($connection));
} 
$count=mysqli_num_rows($result);
if(!empty($count)){
    $error['email']='email exist';
}

if(array_filter($error)){}
else {
$query="INSERT INTO users (user_name,user_password,user_email)
 VALUES('$user','$pass','$email')";
$result=mysqli_query($connection,$query);
if(!$result){
die("query failed . " . mysqli_error($connection));
} 
$user_id=mysqli_insert_id($connection);

$_SESSION['user']=$user;
$_SESSION['email']=$email;
$_SESSION['user_id']=$user_id;
header('location: index.php');

}}
?>

<div class="container">
<div class="row">
<div class="col-3">
<form method="post">
<input type="text" value="<?php echo isset($user) ? $user : '';?>" name="user" placeholder="Name" class="form-control m-2" required autocomplete="on">
<p class="text-danger m-2"> <?php echo isset($error['user']) ? $error['user'] : '';?> </p>
<input type="password" value="<?php echo isset($pass) ? $pass : '';?>" name="pass" placeholder="Password" class="form-control m-2" required>
<p class="text-danger m-2"> <?php echo isset($error['pass']) ? $error['pass'] : '';?> </p>
<input type="password" value="<?php echo isset($pass2) ? $pass2 : '';?>" name="pass2" placeholder="Confirm Password" class="form-control m-2" required>
<input type="email" value="<?php echo isset($email) ? $email : '';?>" name="email" placeholder="Email" class="form-control m-2" required>
<p class="text-danger m-2"> <?php echo isset($error['email']) ? $error['email'] : '';?> </p>
<input type="submit" value="Reister" name="submit" class="form-control m-2 btn btn-primary">
</form>
</div>
</div>
</div>
<?php include "footer.php"; ?>
