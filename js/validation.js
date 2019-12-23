$(document).ready(function(){

	var name = $("#fname");
	var nameInfo = $("#nameInfo");
	var iname = $("#iname");
	var inameInfo = $("#inameInfo");
	var address = $("#address");
	var addressInfo = $("#addressInfo");	
	var email2 = $("#email2");
	var email2Info = $("#email2Info");
	var nic = $("#nic");
	var nicInfo = $("#nicInfo");
	var bday = $("#datepicker");
	var bdayInfo = $("#bdayInfo");
	var phno = $("#phno");
	var phnoInfo = $("#phnoInfo");	
	var gender = $('input[name=gender]');
	var genderInfo = $("#genderInfo");
	var email = $("#email");
	var emailInfo = $("#emailInfo");
	var imgveri = $("#imgveri");
	var imgveriInfo = $("#imgveriInfo");
	
	//On blur
	name.blur(validateNameAndSuggest);
	iname.blur(validateIName);
	address.blur(validateAddress);		
	email2.blur(validateEmail);
	nic.blur(validateNIC);
	phno.blur(validatePhNo);
	email.blur(validateLoginEmailAndSuggest);	
	imgveri.blur(validateImg);	
	
	// on changed
	bday.change(validateDOB);
	
	//On key press
	//name.keyup(validateName);
	//iname.keyup(validateIName);	
	//address.keyup(validateAddress);		
	//email2.keyup(validateEmail);
	//nic.keyup(validateNIC);
	//phno.keyup(validatePhNo);
	//email.keyup(validateLoginEmail);	
	//imgveri.keyup(validateImg);
	
	//On click
	gender.click(validateNIC);


	$("#logform").submit(function(){
		if(validateName() && validateIName() && validateAddress() && validateNIC()  && validateDOB() && validateGender() &&  validatePhNo() && validateEmail() && validateLoginEmail() && validateImg() ){
			return true;
		}
		else{
			return false;
		}
		
	});

	function validateName(){
		
		var a = $("#fname").val();
		var filter1 = /^[a-zA-Z][a-zA-Z]+$/;
		var filter2 = /^([a-zA-Z][a-zA-Z]+[\s])([a-zA-Z][a-zA-Z]+[\s])*[a-zA-Z][a-zA-Z]+$/;
		if(filter1.test(a) || filter2.test(a)){
			name.removeClass("error");
			nameInfo.text("");
			nameInfo.removeClass("error");
			return true;			
		}else{
			name.addClass("error");
			nameInfo.text("We want names with more than 3 letters!");
			nameInfo.addClass("error");
			return false;
		}
	}

	function validateNameAndSuggest(){
		
		var a = $("#fname").val();
		var filter1 = /^[a-zA-Z][a-zA-Z]+$/;
		var filter2 = /^([a-zA-Z][a-zA-Z]+[\s])([a-zA-Z][a-zA-Z]+[\s])*[a-zA-Z][a-zA-Z]+$/;
		if(filter1.test(a) || filter2.test(a)){
			name.removeClass("error");
			nameInfo.text("");
			nameInfo.removeClass("error");
			suggestName();
			return true;			
		}else{
			name.addClass("error");
			nameInfo.text("This name cannot be accept !");
			nameInfo.addClass("error");
			return false;
		}
	}
	
	function suggestName(){
		
		var str=name.val();
		var a1 = new Array();
		
		a1=str.split(" ");
		var l=a1.length;
		
		var namei="";
		for(x=0;x<(l-1);x++){
			namei= namei + (a1[x]).charAt(0).toUpperCase()+". ";
		}
		namei = namei +(a1[l-1]).replace((a1[l-1]).charAt(0),(a1[l-1]).charAt(0).toUpperCase());
		iname.val(namei);
	}
	
	function validateIName(){
		
		var a = $("#iname").val();
		var filter1 = /^([a-zA-Z][.][\s])([a-zA-Z][.][\s])*[a-zA-Z]+$/;
		var filter2 = /^[a-zA-Z][a-zA-Z][a-zA-Z]*$/;
		if(filter1.test(a) || filter2.test(a) ){
			iname.removeClass("error");
			inameInfo.text("");
			inameInfo.removeClass("error");
			return true;
		}else{
			iname.addClass("error");
			inameInfo.text("This name cannot be accept !");
			inameInfo.addClass("error");
			return false;			
		}
	}

	function validateAddress(){
		
		if(address.val().length < 4){
			address.addClass("error");
			addressInfo.text("Enter an address with more than 3 letters!");
			addressInfo.addClass("error");
			return false;
		}else{
			address.removeClass("error");
			addressInfo.text("");
			addressInfo.removeClass("error");
			return true;
		}
	}
	
	function validateEmail(){
		
		//testing regular expression
		var a = $("#email2").val();
		var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
		//if it's valid email
		if(filter.test(a)){
			email2.removeClass("error");
			email2Info.text("");
			email2Info.removeClass("error");
			suggestLoginNameO();
			return true;
		}
		else if(a==""){
			email2.removeClass("error");
			email2Info.text("");
			email2Info.removeClass("error");
			suggestLoginNameO();
			return true;
		}
		//if it's NOT valid
		else{
			email2.addClass("error");
			email2Info.text("Type a valid e-mail please !");
			email2Info.addClass("error");
			return false;
		}
	}	

	function suggestLoginNameO(){
		
		var str= $("#email2").val();
		var currentArr = new Array();
		currentArr=str.split("@");
		
		$.post("scripts/isValiedName.php",  { loginName:currentArr[0] },
  		function(data){
			if(data.charAt(0)=='1'){
				email.val(currentArr[0]);	
			}
		});	
	}
	
	function validateNIC(){
		
		var a = $("#nic").val();
		var filter = /^[0-9]{9}[v|V]$/;
		if(filter.test(a)){
			nic.removeClass("error");
			nicInfo.text("");
			nicInfo.removeClass("error");
			return true;
		}
		//if it's NOT valid
		else{
			nic.addClass("error");
			nicInfo.text("Type a valid NIC please, format: xxxxxxxxxV");
			nicInfo.addClass("error");
			return false;
		}
	}
	
	function validateDOB(){
		
		var a = $("#datepicker").val();
		var filter = /^(0[1-9]|[12][0-9]|3[01])[\/](0[1-9]|1[012])[\/](19|20)\d\d$/;
		if(filter.test(a)){
			bday.removeClass("error");
			bdayInfo.text("");
			bdayInfo.removeClass("error");
			return true;
		}
		//if it's NOT valid
		else{
			bday.addClass("error");
			bdayInfo.text("Type a valid date !");
			bdayInfo.addClass("error");
			return false;
		}
	}
	
	function validateGender(){
		
		var gender = $('input[name=gender]:checked').val() 
		var gender = gender+"";
		if(gender.length==9){
			genderInfo.text("Pleaase make a selection !");
			genderInfo.addClass("error");
			return false;
		}else{
			genderInfo.text("");
			genderInfo.removeClass("error");
			return true;
		}	
	}		
	
	function validatePhNo(){
		
		var a = $("#phno").val();
		var filter = /^0[0-9]{9}$/;
		if(filter.test(a)){
			phno.removeClass("error");
			phnoInfo.text("");
			phnoInfo.removeClass("error");
			return true;
		}
		else{
			phno.addClass("error");
			phnoInfo.text("Type a valid phone nubber please, format: 0xxxxxxxxx");
			phnoInfo.addClass("error");
			return false;
		}	
	}

	function validateImg(){
		
		var a = $("#imgveri").val();
		var filter = /^[0-9]{5}$/;
		if(filter.test(a)){
			imgveri.removeClass("error");
			imgveriInfo.text("");
			imgveriInfo.removeClass("error");
			return true;
		}
		else{
			imgveri.addClass("error");
			imgveriInfo.text("This code is not valied !");
			imgveriInfo.addClass("error");
			return false;
		}	
	}
	
	function validateLoginEmailAndSuggest(){
		
		//testing regular expression
		var a = $("#email").val();
		var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+$/;
		//if it's valid email
		
		if(filter.test(a)){
			
			$.post("scripts/isValiedName.php",  { loginName:a },
  				function(data){
				if(data.charAt(0)=='1'){
					email.removeClass("error");
					emailInfo.text("");
					emailInfo.removeClass("error");
					return true;
				}
				else{
					email.addClass("error");
					emailInfo.addClass("error");
					emailInfo.text("Loading suggestions...");
					suggestLogginName();
					return false;
				}
			});	
		}
		//if it's NOT valid
		else{
			email.addClass("error");
			emailInfo.text("Type a valid name please !");
			emailInfo.addClass("error");
			return false;
		}
	}	
	
	function suggestLogginName(){
		
		var name = $("#fname").val();
		var bday = $("#datepicker").val();
		
		if(validateName() && validateDOB()){
			$.post("scripts/isValiedName.php",  { loginName:name, birthday:bday, suggestion:"OK" },
  			function(data){
				emailInfo.html(data);
			});	
		}

	}
	
	function validateLoginEmail(){
		
		//testing regular expression
		var a = $("#email").val();
		var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+$/;
		//if it's valid email
		if(filter.test(a)){
			email.removeClass("error");
			emailInfo.text("");
			emailInfo.removeClass("error");
			return true;
		}
		//if it's NOT valid
		else{
			email.addClass("error");
			emailInfo.text("Type a valid name please !");
			emailInfo.addClass("error");
			return false;
		}
	}	
});