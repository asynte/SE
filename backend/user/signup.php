<!DOCTYPE HTML> 
<html>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<body align="center">

<?php

$con = mysql_connect("localhost","root","");
if (!$con) {
  die('Error connecting: ' . mysql_error());
}
mysql_select_db("hwUserDb", $con);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["email"])) {
    echo "<script>alert('E-mail is required'); history.go(-1);</script>";
  }
  else if (strlen($_POST["acc"])<6 | strlen($_POST["acc"])>15) {
    echo "<script>alert('Username lengh must NOT be less than 6 or more than 15'); history.go(-1);</script>";
  }
  else if (!preg_match("/^[a-zA-Z0-9_]*$/",$_POST["acc"])) {
    echo "<script>alert('Only letters, numbers and _ are available'); history.go(-1);</script>";
  }
  else if(mysql_num_rows(mysql_query("SELECT * FROM user WHERE acc='$_POST[acc]' "))) {
    echo "<script>alert('Unavailable username'); history.go(-1);</script>";
  }

  else if (strlen($_POST["pw"])<6 | strlen($_POST["pw"])>16) {
    echo "<script>alert('Password lengh must NOT be less than 6 or more than 15'); history.go(-1);</script>";
  } else if (!preg_match("/^[a-zA-Z0-9_]*$/",$_POST["pw"])) {
    echo "<script>alert('Only letters, numbers and _ are available'); history.go(-1);</script>";
  }

  else if($_POST["pw"]!=$_POST["repw"]) {
    echo "<script>alert('Passwords do NOT match'); history.go(-1);</script>";
  }

  else {
    $email=$_POST["email"];
    $acc=$_POST["acc"];
    $pw=$_POST["pw"];
    mysql_query("INSERT INTO user(email, acc, pw)
                 VALUES('$email','$acc','$pw')");
    echo "<script> alert('Success'); history.go(-1);</script>"; 
  }
}

?>

<h2>Sign up</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
   Email: <input type="text" name="email">
   <br><br>

   Account: <input type="text" name="acc">
   <br><br>

   Password: <input type="password" name="pw">
   <br><br>

   Re-enter Password: <input type="password" name="repw">
   <br><br>

   <input type="submit" name="submit" value="Sign up"> 
</form>

</body>
</html>