<!doctype html>
<html>
<head>

<title>Coer Faculty Forum</title>
</head>

<body>
<a href="logout.php"> LogOUT</a>
<h1>
<?php
 require 'connect.inc.php';
 session_start();
  $user_id = $_SESSION['user_id'];
   $result=$mysqli->query('select id , firstname , lastname , type from users');
  while($row= $result->fetch_assoc())
  {
	  if($user_id==$row['id'])
	 {   
		 $firstname = $row['firstname'];
		 $lastname = $row['lastname'];
		 $name = $firstname.' '.$lastname.'  Answered';
		 break;
	 }
   }
   
   echo "Welcome $firstname , Here You Can Answer The Question Asked By Your Students :";
   
   ?>
   </h1>
   
   
   <?php
     echo '<br><strong>Here are the list of Questions :</strong><br>';
	   echo '<br><br>';
	     $resul_t=$mysqli->query('select  Q_id , Ques , faculty_id , ask_id , if_ans , who_ask from questions');
         while($ro_w= $resul_t->fetch_assoc())
	     {
			if($ro_w['faculty_id']==$user_id)
			{   $q_id=$ro_w['Q_id'];
				echo '<table>
				<tr><td><strong>';
				echo $ro_w['who_ask'].'  Asked :';
				echo '</strong></td></tr><tr><td>';
				echo  $ro_w['Ques'];
				echo '</td></tr><tr><td><b>';
				echo 'Previous Answers';
				  
			   echo '</b></td></tr><tr><td>';
				 $resul_ts=$mysqli->query('select ans , q_id , who_ans  from answers');
				      
	             	 while($ro_ws= $resul_ts->fetch_assoc())
                   {  		    
				      if($q_id==$ro_ws['q_id'])
					  { 
					     echo '<table><tr><td><b>';
						 echo $ro_ws['who_ans'];
						 echo '</b></td></tr><tr><td><i>';
						 echo $ro_ws['ans'];
						 echo '</i></td></tr></table>';
						  
						}
				   }
					echo '<form action="facpage.php" method="POST">
                         <table>
                         <tr><td>
                         <textarea name ="answer" cols="50" rows ="3" required placeholder="Answer here"></textarea>
						 </td></tr>
						 <tr><td>
						 <input type="hidden" name="q_id" value="'; echo $q_id; echo '">
						 </td></tr>
						 <tr><td>
						 <input type="hidden" name="u_id" value="'; echo $user_id; echo '"> 
					     </td></tr>
											  
						 <tr><td><br><input type="submit" value="Answer"/>
                         </td></tr>
                         </table>
						 </form>';
					
                   }
				 
			echo '<hr>';	 
				
				    
		 }
	 
   
   ?>
   
   <h3>
   <?php
   if(isset($_POST['answer']))
      {
		  
	  if(!empty($_POST['answer'])&&!empty($_POST['q_id'])&&!empty($_POST['u_id']))
	    { 
           $answer = $_POST['answer'];
		  $qu_id = $_POST['q_id'];
		  $u_id = $_POST['u_id'];
		  $qys="insert into answers( ans , q_id , who_ans) values('$answer' ,'$qu_id' ,'$name')";
		  $cow=$mysqli->query($qys);
     if($cow) 
     echo "Record Inserted";
     else
     echo "Record Not Inserted";
     echo $mysqli->error;
		         
		}
		
	}
   ?>   
       
   </body>
   </html>