<!DOCTYPE HTML> 
<html>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<body align="center">

<?php

session_start();

//connect to database
$con = mysql_connect("localhost","root","");
if (!$con) {
  die('Error connecting: ' . mysql_error());
}
mysql_select_db("hwUserDb", $con);

//login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  if(!mysql_num_rows(mysql_query("SELECT * FROM user WHERE acc='$_POST[acc]' "))) {
    echo "<script>alert('User does NOT exist'); history.go(-1);</script>";
  }
  else if(mysql_num_rows(mysql_query("SELECT * FROM user WHERE acc='$_POST[acc]' AND pw='$_POST[pw]' "))) {
      $_SESSION["acc"]=$_POST["acc"];
      echo "<script> alert('Success');parent.location.href='../user/home.php'; </script>";
  }
  else {
    echo "<script>alert('Wrong password'); history.go(-1);</script>";
  }
}

?>

<h2>Log In</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
  Account: <input type="text" name="acc">
  <br><br>
  Password: <input type="password" name="pw">
  <br><br>
  <input type="submit" name="submit" value="Log In">
</form>

</body>
</html>