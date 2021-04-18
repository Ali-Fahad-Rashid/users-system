<?php include "header.php"; ?>
<br></br><br></br><br></br>

<?PHP 
if(isset($_POST['submit'])){
    $user=mysqli_real_escape_string($connection ,trim($_POST['user']));
    $pass=mysqli_real_escape_string($connection ,trim($_POST['pass']));
$error=['user'=>'','pass'=>'','email'=>''];

$query="SELECT * FROM users WHERE user_name='$user'";
$result=mysqli_query($connection,$query);
if(!$result){
die("query failed . " . mysqli_error($connection));
} 
$count=mysqli_num_rows($result);
if(empty($count)){
    $error['user']='username not exist';
}

if(array_filter($error)){}
else {
    $query="SELECT * FROM users WHERE user_name='$user'";
$result=mysqli_query($connection,$query);
if(!$result){
die("query failed . " . mysqli_error($connection));
} 

while($row=mysqli_fetch_array($result)){
$user=$row['user_name'];
$pass=$row['user_password'];
$email=$row['user_email'];
$user_id=$row['user_id'];

}
$_SESSION['user_id']=$user_id;
$_SESSION['user']=$user;
$_SESSION['email']=$email;
header('location: index.php');

}}
?>

<div class="container">
<div class="row">
<div class="col-3">
<form method="post">
<input type="text" value="" name="user" placeholder="Name" class="form-control m-2" required>
<p class="text-danger"> <?php echo isset($error['user']) ? $error['user'] : '';?> </p>
<input type="password" value="" name="pass" placeholder="Password" class="form-control m-2" required>
<p class="text-danger"> <?php echo isset($error['pass']) ? $error['pass'] : '';?> </p>
<input type="submit" value="login" name="submit" class="form-control m-2 btn btn-primary">
</form>
</div>
</div>
</div>
<?php include "footer.php"; ?>
