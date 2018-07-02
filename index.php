<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home page</title>
</head>

<body>
<h1><a href="login.php"> LogIN</a>   Welcome To coer Student-Faculty Forum <a href="register.php"> register here </a>  <br><br ></h1>
<h2> Here Are Conversations : </h2>

 <?php
 require 'connect.inc.php';
   $resul_t=$mysqli->query('select  Q_id , Ques , faculty_id , ask_id , if_ans , who_ask from questions');
   
  while($ro_w= $resul_t->fetch_assoc())
  {  $que_id = $ro_w['Q_id'];
     $who_ask = $ro_w['who_ask'];
	  $q_id = $ro_w['Q_id'];
			 echo '<table><tr><td><strong>';
			
			echo $who_ask ; 
			
			echo '</strong></td></tr>';
			echo '<tr><td>';
			echo $ro_w['Ques'];
			echo '</td></tr>';
			 echo '<tr><td><b>';
			  echo 'Answer :';
			        echo '</b></td></tr><tr><td>';        
	 	          $resul_tss=$mysqli->query('select ans , q_id , who_ans  from answers');
				      
	             	 while($ro_wss= $resul_tss->fetch_assoc())
                   {  		    
				      if($q_id==$ro_wss['q_id'])
					  { 
					     echo '<table><tr><td><b>';
						 echo $ro_wss['who_ans'];
						 echo '</b></td></tr><tr><td><i>';
						 echo $ro_wss['ans'];
						 echo '</i></td></tr></table>';
						  
						}
				   } 			
					 
			  
			    echo '</td></tr>';
			      echo '<tr><td>';  
			   echo '<br><b> Comments:</b><br>'; echo '</td></tr>';
			       $resul_ts=$mysqli->query('select comm , q_id , who_ask  from comments');
				    echo '<tr><td>';  
	             	 while($ro_ws= $resul_ts->fetch_assoc())
                   {  		    
				      if($que_id==$ro_ws['q_id'])
					  { 
					     echo '<table><tr><td><b>';
						 echo $ro_ws['who_ask'];
						 echo '</b></td></tr><tr><td><i>';
						 echo $ro_ws['comm'];
						 echo '</i></td></tr></table>';
						  
						}
                   }
				  echo '</td></tr>><tr><td>'; 
				  	 echo '</td></tr></table><hr>';
			   
		 
	 }
	  
	  
  

?>

</h2>


</body>
</html>