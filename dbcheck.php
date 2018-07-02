<?php
  
   require 'connect.inc.php';
    $result=$mysqli->query('select firstname , lastname , type from users');
	print("<table border ='1'>");
while($row = $result->fetch_assoc())
{
	print"<tr>";
	print"<td>".$row['firstname']."</td>";
	print"<td>".$row['lastname']."</td>";
	print"<td>".$row['type']."</td>";
	print"</tr>";
	
}
print"</table>";
	
?>
 =