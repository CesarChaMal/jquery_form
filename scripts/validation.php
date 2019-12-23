<?php
session_start(); 
require_once("dbc.php");
$link = mysql_connect("$host","$username","$password") or die("Couldn't make connection.");
mysql_select_db($dbname, $link) or die("Couldn't select database");

	function validateName($name){
		if ( preg_match("/^[a-zA-Z][a-zA-Z]+$/", $name) || preg_match("/^([a-zA-Z][a-zA-Z]+[\s])([a-zA-Z][a-zA-Z]+[\s])*[a-zA-Z][a-zA-Z]+$/", $name) ) {
    		return true;
		} else {
   			return false;
		}
	}

	function validateNameIn($iname){
		if ( preg_match("/^([a-zA-Z][.][\s])([a-zA-Z][.][\s])*[a-zA-Z]+$/", $iname) || preg_match("/^[a-zA-Z][a-zA-Z][a-zA-Z]*$/", $iname) ) {
    		return true;
		} else {
   			return false;
		}
	}

	function validateAdd($add){
		if (strlen($add)<4) {
    		return false;
		} else {
   			return true;
		}
	}
			
	function validateNIC($nic){
		if (preg_match("/^[0-9]{9}[v|V]$/", $nic)) {
    		return true;
		} else {
   			return false;
		}
	}
	
	function validateDOB($dob){
		if (preg_match("/^(0[1-9]|[12][0-9]|3[01])[\/](0[1-9]|1[012])[\/](19|20)\d\d$/", $dob)) {
    		return true;
		} else {
   			return false;
		}
	}

	function validateGender($gen){
		if ($gen == "male" || $gen == "female") {
    		return true;
		} else {
   			return false;
		}
	}

	function validatePhNum($ph){
		if (preg_match("/^0[0-9]{9}$/", $ph)) {
    		return true;
		} else {
   			return false;
		}
	}

	function validateSecEmail($secEmail){
		if (preg_match("/^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/", $secEmail) || $secEmail=="" ) {
    		return true;
		} else {
   			return false;
		}
	}	
	
	function isValiedLoginName($chname){
		$query = "SELECT * FROM details_user WHERE desired_user_name='".$chname."'";
		$result = mysql_query($query);
		$num_rows = mysql_num_rows($result);
		
		if($num_rows == 0){
			return true;
		}else{
			return false;
		}
	}
						
	function validateImg($imgveri){
		//if it's valid
		if(sha1($imgveri) == $_SESSION['e_sri_image_random_value']) 
		{
			return true;
		}
		//if it's NOT valid
		else
			return false;
	}
?>