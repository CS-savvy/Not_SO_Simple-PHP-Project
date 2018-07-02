<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Coer Student Forum</title>
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
		 $name = $firstname.' '.$lastname;
		 break;
	 }
   }
   
   echo "Welcome $firstname , Here You Can Ask Your Question To Your Fav Faculty";
   
 ?>

</h1>


<h2>
<?php

echo  '<h3>Enter Your Question You Want To Ask To Your Faculty :</h3>

<form action="Tstud.php" method="post">
<table>
<tr><td>
<textarea name ="question" cols="80" rows ="5" required  placeholder="Ask You Question Here"></textarea></td></tr>
</table>

<h2> Select From Currently Available Faculty </h2>
<table>';
$result=$mysqli->query('select  id , firstname , lastname , type from users');
 while($row = $result->fetch_assoc())
 {
   if($row['type']=='f')
    {   
	    $f_id = $row['id'];
		
		$f_firstname = $row['firstname'];
		$f_lastname = $row['lastname']; 
		echo '<tr><td>
       <br>
       <input name="faculty" type="radio" required value ="'; echo $f_id; echo '"/>'; echo $f_firstname; echo ' '.$f_lastname; echo  '<br> </td></tr>';
     }
 }
 echo '</table>
<tr><td><br><input type="submit" value="Ask Question"/>
      </td></tr></table>
  </form>';
  echo '<BR><strong>HERE ARE PREVIOUSLY ASKED QUESTIONS : </strong>'
?>
</h2>
<h3>
<?php
  if(isset($_POST['question'])&&isset($_POST['faculty']))
  {
	  if(!empty($_POST['question'])&&!empty($_POST['faculty']))
	  {
		 $question = $_POST['question'];
	     $faculty  = $_POST['faculty'];
		 
		 
		 echo $faculty;
	        
		 $qry="insert into questions( Ques , faculty_id , ask_id , who_ask) values('$question' ,'$faculty'     ,'$user_id','$name')"; 
		 $row1=$mysqli->query($qry);
     if($row1) 
     echo "Record InsertPOSTed";
     else
     echo "Record Not Inserted";
     echo $mysqli->error;
		 
		 
	  }
  }
   if(isset($_POST['comment']))
      {
		  echo 'ok';
	  if(!empty($_POST['comment'])&&!empty($_POST['q_id'])&&!empty($_POST['u_id']))
	    { echo 'okay';
	      $comment = $_POST['comment'];
		  $qu_id = $_POST['q_id'];
		  $u_id = $_POST['u_id'];
		  echo $comment;
		  $qys="insert into comments( comm , q_id , u_id , who_ask ) values('$comment' ,'$qu_id' ,'$u_id' , '$name')";
		  $cow=$mysqli->query($qys);
     if($cow) 
     echo "Record Inserted";
     else
     echo "Record Not Inserted";
     echo $mysqli->error;
		    
		   
		   
	     }
		
      }
    

?>
  </h3> 
  <h4> 
 <?php
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
			 echo '<tr><td>';
			  echo '<b>Answers :</b>';
			  echo '</td></tr><tr><td>';        
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
			   echo '<br> Comments:<br>'; echo '</td></tr>';
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
				  echo '</td></tr><tr><td>'; 
				  echo '<br><b>Enter your Comments Here:<br></b>'; echo '</td></tr>
				      <tr><td>';
				echo '<form action="Tstud.php" method="POST">
                         <table>
                         <tr><td>
                         <textarea name ="comment" cols="40" rows ="2" required placeholder="Comment here"></textarea>
						 </td></tr>
						 <tr><td>
						 <input type="hidden" name="q_id" value="'; echo $q_id; echo '">
						 </td></tr>
						 <tr><td>
						 <input type="hidden" name="u_id" value="'; echo $user_id; echo '"> 
					     </td></tr>
											  
						 <tr><td><br><input type="submit" value="Comment"/>
                         </td></tr>
                         </table>
						 </form>';
						 echo '</td></tr></table><hr>';
			   
		 
	 }
	  
	  
  

?>

</h4>
<h5>
  </h5>


</body>
</html>