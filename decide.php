<?php
 session_start();
 require 'connect.inc.php';
 
 $user_id=$_SESSION['user_id'];
 $result=$mysqli->query('select id , type from users');
  while($row= $result->fetch_assoc())
  {
	 if($user_id==$row['id'])
	 {
		 if($row['type']=='f')
		 {
		    echo 'you are faculty';
			header('location: facpage.php');
		 }
	     else if($row['type']=='s')
		 {
		    header('location: Tstud.php');	 
		 }
	  }
	  
   }
   
?>