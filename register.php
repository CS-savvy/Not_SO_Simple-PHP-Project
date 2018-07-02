<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registration Page</title>
</head>
<?php
  
require 'connect.inc.php';
if(isset($_POST['firstname'])&&isset($_POST['lastname'])&&isset($_POST['username'])&&isset($_POST['pass'])&&isset($_POST['pass_again'])&&isset($_POST['type'])){
$firstname = $_POST['firstname'];
$lastname =  $_POST['lastname'];
$username =  $_POST['username'];
$pass =  $_POST['pass'];
$pass_again =  $_POST['pass_again'];
$type =  $_POST['type'];
if($pass!=$pass_again)
{
	echo 'password do not matches Try Again';
}
else
{   $k=0;
	  $result=$mysqli->query('select username from users ');
	  while($row= $result->fetch_assoc())
	  {
		if($row['username'] == $username)
		{
		   echo 'user name exist Try unique names ';
		   $k++;
		   break;  
		} 
	  }
	  if($k==0)
	 { $pass_hash=md5($pass);
		$qry="insert into users( username,password,firstname,lastname,type) values('$username' ,'$pass_hash','$firstname','$lastname','$type')";
		$row=$mysqli->query($qry);
  if($row) 
  echo "Record Inserted";
  else
  echo "Record Not Inserted";
  echo $mysqli->error;
		header('location: info.php'); 
	   }
	  
}



}

?>
<body>
<h1>Registration Page</h1>
<form action="register.php" method="post">
<table>
<tr>
<td> Firstname </td>
<td><input type="text" required="required" name="firstname" placeholder="Enter your firstName"/></td></tr>
<tr><td>Lastname</td>
<td><input type="text" required="required" name="lastname" placeholder="Enter your lastname"/>
</td></tr>
<tr><td>username</td>
<td><input type="text" required="required" name="username" placeholder="Username"/>
</td></tr>
<tr>
<td>Password</td>
<td><input type="password" required="required" name="pass" placeholder="Enter the password"/></td></tr>
<tr>
<td>password Again
<td><input type="password" required="required" name="pass_again" placeholder="re-enter the password"/></td>
<td>&nbsp;</td></tr>
<tr><td>
<input name="type" type="radio" value="s" checked="checked"  /> I am a student<br>
<input type="radio"  name="type" value="f" /> I am a Faculty<br>
</td></tr>

<td><input type="reset" value="clear"/></td>
<td><input type="submit" value="Register" /></td>
</table>

</body>
</html>