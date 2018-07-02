
<?php
require 'core.inc.php' ;
require 'connect.inc.php' ;

if(!empty($_SESSION['user_id'])){
	echo 'you are logged in' ;
	
	}
	else{
include 'loginform.inc.php';
	}
?>