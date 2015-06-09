<!DOCTYPE HTML> 
<html>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<body align="center">

<?php

session_start();

$con = mysql_connect("localhost","root","");
if (!$con) {
  die('Error connecting: ' . mysql_error());
}
mysql_select_db("hwUserDb", $con);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if(!mysql_num_rows(mysql_query("SELECT * FROM user WHERE acc='$_SESSION[acc]' AND pw='$_POST[oldpw]' "))) {
    echo "<script>alert('Wrong password'); history.go(-1);</script>";
  }

  else if (strlen($_POST["pw"])<6 | strlen($_POST["pw"])>15) {
    echo "<script>alert('Password lengh must NOT be less than 6 or more than 15'); history.go(-1);</script>";
  } else if (!preg_match("/^[a-zA-Z0-9_]*$/",$_POST["pw"])) {
    echo "<script>alert('Only letters, numbers and _ are available'); history.go(-1);</script>";
  }

  else if($_POST["pw"]!=$_POST["repw"]) {
    echo "<script>alert('Passwords do NOT match'); history.go(-1);</script>";
  }

  else {
    mysql_query("UPDATE user  SET pw='$_POST[pw]' WHERE acc='$_SESSION[acc]' ");
    echo "<script> alert('Success'); history.go(-1); </script>"; 
  }
}

?>

<h2>改密码</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
  旧密码: <input type="password" name="oldpw">
  <br><br>
  新密码: <input type="password" name="pw">
  <br><br>
  新密码: <input type="password" name="repw">
  <br><br>
  <input type="submit" name="submit" value="Done">
</form>

</body>
</html>