<?php
	require_once("scripts/validation.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>JQuery Ajax Form | Saranga Rathnayake</title>

<!-- CSS -->
<link rel="stylesheet" href="css/styles.css" type="text/css"/>
<link type="text/css" href="css/jquery-ui-1.7.2.custom.css" rel="stylesheet" />	

<!-- JavaScript -->
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script>
<script src="js/validation.js" type="text/javascript"></script>
<script type="text/javascript">
	$(function(){
				$('#datepicker').datepicker({
					dateFormat:'dd/mm/yy',
					changeMonth: true,
					changeYear: true,
					yearRange: '-90:+0',
					maxDate: '+0'
				});
	});
</script>
</head>
<div id="container">
<form id="logform" name="logform" class="logform" method="post" action="" >
<?php if( isset($_POST['saveForm']) && (!validateName($_POST['fname']) || !validateNameIn($_POST['iname']) || !validateAdd($_POST['address']) || !validateNIC($_POST['nic']) || !validateDOB($_POST['bday']) || !validateGender($_POST['gender']) || !validatePhNum($_POST['phno']) || !validateSecEmail($_POST['email2']) || !isValiedLoginName($_POST['email']) || !validateImg($_POST['imgveri']))):?>
	<div id="note">
	<ul>
		<?php if(!validateName($_POST['fname'])):?>
			<li>Full name is not valied !</li>
		<?php endif?>
		<?php if(!validateNameIn($_POST['iname'])):?>
			<li>Name with initials is not valied !</li>
		<?php endif?>     
		<?php if(!validateAdd($_POST['address'])):?>
			<li>Address is not valied !</li>
		<?php endif?>               
        <?php if(!validateNIC($_POST['nic'])):?>
			<li>Type a valid NIC, xxxxxxxxxV !</li>
		<?php endif?>
        <?php if(!validateDOB($_POST['bday'])):?>
			<li>Type a valid DOB, dd/mm/yyyy !</li>
		<?php endif?>  
        <?php if(!validateGender($_POST['gender'])):?>
			<li>Please select the gender !</li>
		<?php endif?>  
        <?php if(!validatePhNum($_POST['phno'])):?>
			<li>Type a valid phone number, 0xxxxxxxxx !</li>
		<?php endif?>          
        <?php if(!validateSecEmail($_POST['email2'])):?>
			<li>Type a valid secondry email !</li>
		<?php endif?>  
        <?php if(!isValiedLoginName($_POST['email'])):?>
			<li>This login name exist !</li>
		<?php endif?>       
		<?php if(!validateImg($_POST['imgveri'])):?>
			<li>Type the correct verification code !</li>
		<?php endif?>
	</ul>
	</div>
<?php elseif(isset($_POST['saveForm'])):
	$fname = trim($_POST['fname']);
	$iname = trim($_POST['iname']);
	$address = trim($_POST['address']);
	$nic = trim($_POST['nic']);
	$bday = trim($_POST['bday']);
	$gender = trim($_POST['gender']);
	$phno = trim($_POST['phno']);
	$email2 = trim($_POST['email2']);
	$email = trim($_POST['email']);
	
	$query="INSERT INTO details_user(`nic`,`full_name`,`name_with_initials`,`address`,`date_of_birth`,`desired_user_name`,`phone_number`,`secondary_email_address`,`gender`)VALUES('$nic','$fname','$iname','$address','$bday','$email','$phno','$email2','$gender')";
	$result = mysql_query($query);
	if($result == 1){
		echo '<div style="color:#0000FF;">Done , Thanks !</div>';
	}
	else{
		echo '<div style="color:#FF0000;">Error occured while saving, this NIC may be exist !</div>';
	}  
endif?>
<table width="549" border="0"  cellspacing="10" align="center">
  <tr>
    <td>Full Name</td>
    <td>
      <input type="text" name="fname" id="fname" size="45" />
      <br/><span id="nameInfo"></span> 
    </td>
  </tr>
  <tr>
    <td>Name with Initials</td>
    <td>
      	<input type="text" name="iname" id="iname" size="45" />
        <br/><span id="inameInfo"></span>
    </td>
  </tr>
  <tr>
	<td>Address</td>
	<td>
		<input type="text" name="address" id="address" size="45" />	
        <br/><span id="addressInfo"></span>
    </td>
  </tr>
  <tr>
    <td>NIC</td>
    <td>
    	<input type="text" name="nic" id="nic" size="10" />
        <br/><span id="nicInfo"></span>	
    </td>
  </tr>
  <tr>
    <td>Date of Birth</td>
    <td>
      <input name="bday" type="text" size="10" id="datepicker" />
      <br/><span id="bdayInfo"></span>
    </td>
  </tr>
  <tr>
	<td>Gender</td>
	<td>
		<input type="radio" name="gender" value="male" />
       	Male
       	<input type="radio" name="gender" value="female"  />
       	Female	
		<br/><span id="genderInfo"></span>	
     </td>     
  </tr>
  <tr>
    <td>Phone Number</td>
    <td>
		<input type="text" name="phno" id="phno" size="10" />	
        <br/><span id="phnoInfo"></span>	
    </td>
  </tr>
  <tr>
  	<td>
    	Secondary email<br />&nbsp;&nbsp;<span style="font-size:9px"><i>(Optional)</i></span>
    </td>
    <td>
    	<input name="email2" type="text" size="45" id="email2" /> 
        <br/><span id="email2Info"></span>
    </td>
  </tr>
  <tr>
    <td style="vertical-align:top;">Desired Login Name</td>
    <td>
		<input name="email" type="text" id="email" /> @grazerlk.com
        <br/><span id="emailInfo"></span>
    </td>
  </tr>
  <tr>
    <td rowspan="2" style="vertical-align:top;">Word Verification</td>
    <td>Type the characters you see in the picture below.<br/></td>
  </tr>
  <tr>
    <td>
    	<img src="scripts/imgveri.php" width="80" height="40" alt="Image" title="Image" /><br/>
    	<input type="text" name="imgveri" id="imgveri" size="8" style="margin-top:5px;"/>
        <br/><span id="imgveriInfo"></span> 	
    </td>
  </tr>
  <tr>
  	<td></td><td><input id="saveForm" name="saveForm" class="btTxt submit" type="submit" value="Create my Account"/></td>
  </tr>
</table>
</form>
</div>
</body>
</html>