<?php
session_start();
if(isset($_SESSION['user_id']))
{
	echo 'you are logged in';
	echo  $_SESSION['user_id'];
	header('location:  decide.php');
	}
?>