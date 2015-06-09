<?php

//connect to database
$con = mysql_connect("localhost","root","");
if (!$con)
  {
    die('Error connecting: ' . mysql_error());
  }

//create my database
if (mysql_query("CREATE DATABASE hwUserDb",$con))
  {
    echo "Database created";
  }
else
  {
    echo "Error creating database: " . mysql_error();
  }

//create table
mysql_select_db("hwUserDb", $con);
$sql = "CREATE TABLE user (
	    email varchar(30) not null,
        acc varchar(15) not null,
        pw varchar(15) not null,
        primary key(acc))";
mysql_query($sql,$con);

mysql_close($con);

?>