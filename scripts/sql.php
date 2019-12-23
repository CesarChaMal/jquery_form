<?php
	require_once("dbc.php");
	mysql_connect ("$host", "$username","$password") or die('Cannot connect to the database because: ' . mysql_error());
	
	$query="CREATE DATABASE $dbname";
	mysql_query($query);
    
	mysql_select_db("$dbname") or die(mysql_error());

	$query="CREATE TABLE `details_user` (
				`nic` varchar(200) collate latin1_general_ci NOT NULL default '',
				`full_name` varchar(200) collate latin1_general_ci NOT NULL default '',
				`name_with_initials` varchar(200) collate latin1_general_ci NOT NULL default '',
				`address` varchar(200) collate latin1_general_ci NOT NULL default '',
				`date_of_birth` varchar(200) collate latin1_general_ci NOT NULL default '',
				`desired_user_name` varchar(200) collate latin1_general_ci NOT NULL default '',
				`phone_number` varchar(200) collate latin1_general_ci NOT NULL default '',
				`secondary_email_address` varchar(200) collate latin1_general_ci NOT NULL default '',
				`gender` varchar(200) collate latin1_general_ci NOT NULL default '',
				PRIMARY KEY (`desired_user_name`)
				)";
				
	$res = mysql_query($query);
	if($res == 1){
		echo "Database created !";
	}else{
		echo "Error occured while creating database !";
	}	


?>
