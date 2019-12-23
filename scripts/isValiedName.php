<?php
error_reporting (E_ALL ^ E_NOTICE);

$post = (!empty($_POST)) ? true : false;

if($post)
{
	require_once("dbc.php");
	$link = mysql_connect("$host","$username","$password") or die("Couldn't make connection.");
    mysql_select_db($dbname, $link) or die("Couldn't select database");
	
	$loginName = $_POST['loginName'];
	$bday = $_POST['birthday'];
	$suggestion = $_POST['suggestion'];
	
	if($suggestion == "OK")
	{
		$sug  = "Above name is alredy taken, try following;<br/>";
		$names = explode(" ",$loginName);
		
		$namecount = count($names);
		$sugcount = 0; 
		
		$month= (int)substr($bday,3,2);
		$dates= (int)substr($bday,0,2);
		$year = (int)substr($bday,-2);
		
		if($namecount < 4){
			for($a=0; $a < count($names); $a++){
				if(isValiedLoginName($names[$a])){
					$sug = $sug.$names[$a]."<br/>";
					$sugcount++;
				}
			}
		}else{
	
			for($a=count($names); $a >count($names)-3 ; $a--){
				if(isValiedLoginName($names[$a-1])){
					$sug = $sug.$names[$a-1]."<br/>";
					$sugcount++;
				}
			}
			
			$name1 = $names[count($names)-2].".".$names[count($names)-1];
			
			if(isValiedLoginName($name1)){
				$sug = $sug.$name1."<br/>";
				$sugcount++;
			}				
					
		}
		
		if($sugcount<5){
			$name2 = $names[count($names)-1].$year;
			if(isValiedLoginName($name2)){
				$sug = $sug.$name2."<br/>";
				$sugcount++;
			}
		}
		
		if($sugcount<5){
			$name3 = $names[count($names)-1].$month.$dates;
			if(isValiedLoginName($name3)){
				$sug = $sug.$name3."<br/>";
				$sugcount++;
			}
		}	
		
		echo $sug;		

	}
	else
	{
		if(isValiedLoginName($loginName))
		{
			echo 1;
		}
	}
}

?> 

<?php
	function isValiedLoginName($loginName){
		$query = "SELECT * FROM details_user WHERE desired_user_name='".$loginName."'";
		$result = mysql_query($query);
		$num_rows = mysql_num_rows($result);
		
		if($num_rows == 0){
			return true;
		}else{
			return false;
		}
	}

?>