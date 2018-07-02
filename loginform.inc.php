<?php
if(isset($_POST['username'])&&isset($_POST['password'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$password_hash = md5($password);
	

		
	
  $result=$mysqli->query('select id , username , password  from users');
  
 $k=0;
 while($row= $result->fetch_assoc())
  {
	  if($row['username'] == $username && $row['password'] == $password_hash)
	  {
	  echo 'works';
	  $k++;
	  $in_user = $row['id']; 
	  echo  $in_user;
	  $_SESSION['user_id']= $in_user;
	  echo $_SESSION['user_id'] ;
	  header('location: session.php');    	 
	 }
  }
	 if($k==0)
	 {
		echo 'enter correct username & Passkey';
		 
      }

 
   
}

?>

<form action="<?php echo $current_file; ?>" method="post">
<input type="text" name="username" placeholder="Enter your username" required>
<input type="password" name="password" placeholder="Password" required>
<input type="submit" value="Log IN" >
</form>
