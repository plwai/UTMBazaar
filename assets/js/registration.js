
	$(document).ready(function(){
		check_all();
		setInterval(allow_submit, 3000);
		
		$('#cancel').prop('disabled', true);
		$('input[type="text"]').keyup(function() {
			if($(this).val() != '') {
			$('#cancel').prop('disabled', false);
			}
		});
		$('#submit').prop('disabled', true);
		

		
	});
	function allow_submit(){
		if(check_all2()) {	
			$('#submit').prop('disabled', false);
		}
	}
	function check_all2(){
		return (check_sirname()&&check_name()&&check_e_mail()&&check_email()&&check_password()&&check_passconf());
	};
	function check_all(){
		$("#sirname").keyup(function(){
			check_sirname();
		}),
	  
		$("#name").keyup(function(){
			check_name();
		}),
	  
		$("#e-mail").keyup(function(){
			check_e_mail();
		}),
		$("#email").keyup(function(){
			check_email();
		}),
		
		$("#password").keyup(function(){
			check_password();
		}),
		
		$("#passconf").keyup(function(){
			check_passconf();
		});
		return (check_sirname()&&check_name()&&check_e_mail()&&check_email()&&check_password()&&check_passconf());
	};
	function check_sirname(){
		if($("#sirname").val().length > 0 ){
			if($("#sirname").val().length >= 2 && isValidAlphapetOnly($("#sirname").val()) ){
				$("#usr_verify1").css({ "background-image": "url('../assets/images/yes.png')" });
				document.getElementById("sirnametxt").innerHTML=" ";
				sirname_state=true;
			}
			else{
				$("#usr_verify1").css({ "background-image": "url('../assets/images/no.png')" });
				document.getElementById("sirnametxt").innerHTML="Must aleast 2 char and alphapet only";
				sirname_state=false;
			}
		}
		else{
			document.getElementById("sirnametxt").innerHTML=" ";
			$("#usr_verify1").css({ "background-image": "none" });
			sirname_state=false;
		}
		return sirname_state;
	};
	
	function check_name(){
		var name = $("#name").val();
		if($("#name").val().length >0){
			if($("#name").val().length >= 3 && isValidAlphapetOnly(name)){
				$("#usr_verify2").css({ "background-image": "url('../assets/images/yes.png')" });
				document.getElementById("nametxt").innerHTML=" ";
				name_state=true;
			}
			else{
				$("#usr_verify2").css({ "background-image": "url('../assets/images/no.png')" });
				document.getElementById("nametxt").innerHTML=" 	Must atleast 3 char and alphapet only";
				name_state=false;
			}
		}
		else{
			document.getElementById("nametxt").innerHTML=" ";
			$("#usr_verify2").css({ "background-image": "none" });
			name_state=false;
		}
		return name_state;
	};
	
	function check_e_mail(){
		var email = $("#e-mail").val();
        if(email != 0){
            if(isValidEmailAddress(email)){
				$("#usr_verify3").css({ "background-image": "url('../assets/images/no.png')" });
				document.getElementById("e-mailtxt").innerHTML=" ";
				$.ajax({
				type: "POST",
				url: "check_email",
				dataType: 'json',
				data: {email:$("#e-mail").val()}
				}).done(function(msg){
					if(msg.res==1){
						$("#usr_verify3").css({ "background-image": "url('../assets/images/yes.png')" });
						document.getElementById("e-mailtxt").innerHTML=" ";
						email_state = true;
					}
					else{
						$("#usr_verify3").css({ "background-image": "url('../assets/images/no.png')" });
						document.getElementById("e-mailtxt").innerHTML="Email is using ";
						email_state = false;
					}
			
				});
            }
			else {
				$("#usr_verify3").css({ "background-image": "url('../assets/images/no.png')" });
				document.getElementById("e-mailtxt").innerHTML=" Please enter valid email address";
				email_state = false;
            }
        }
        else{
            $("#usr_verify3").css({ "background-image": "none" });
			document.getElementById("e-mailtxt").innerHTML=" ";
			email_state=false;
        }
		return email_state;
	};
	
	function check_email(){
		var email = $("#email").val();
        if(email != 0){
            if(isValidEmailAddress(email))
            {
               $("#usr_verify4").css({ "background-image": "url('../assets/images/no.png')" });
			   document.getElementById("emailtxt").innerHTML=" ";
			   mail_state=false;
			   if(email!=$("#e-mail").val()){
					$("#usr_verify4").css({ "background-image": "url('../assets/images/no.png')" });
					document.getElementById("emailtxt").innerHTML="Email enter is not same ";
					mail_state=false;
				}
				else{
					$("#usr_verify4").css({ "background-image": "url('../assets/images/yes.png')" });
					document.getElementById("emailtxt").innerHTML=" ";
					mail_state=true;
			   }
            }
			else{
				$("#usr_verify4").css({ "background-image": "url('../assets/images/no.png')" });
				document.getElementById("emailtxt").innerHTML="Please enter valid email address ";
				mail_state=false;
            }
 
        }
        else{
            $("#usr_verify4").css({ "background-image": "none" });
			document.getElementById("emailtxt").innerHTML=" ";
			mail_state=false;
        }
		return mail_state;
	};
	
	function check_password(){
		if($("#password").val().length > 0){
			if($("#password").val().length >= 4){
				$("#usr_verify5").css({ "background-image": "url('../assets/images/yes.png')" });
				document.getElementById("passwordtxt").innerHTML="";
				password_state=true;
			} 
			else{
				$("#usr_verify5").css({ "background-image": "url('../assets/images/no.png')" }); 
				document.getElementById("passwordtxt").innerHTML="Password must atleast 4 char ";
				password_state=true;
			}			
		}
		else{
			$("#usr_verify5").css({ "background-image": "none" });
			document.getElementById("passwordtxt").innerHTML="";
			password_state=false;
		}
		return password_state;
	};
	
	function check_passconf(){
		if($("#passconf").val().length > 0){
			if($("#passconf").val().length >=4){
				$("#usr_verify6").css({ "background-image": "url('../assets/images/no.png')" });
				document.getElementById("passconftxt").innerHTML="";
				passconf_state=false;
				if($("#passconf").val()!=$("#password").val()){
					$("#usr_verify6").css({ "background-image": "url('../assets/images/no.png')" });
					document.getElementById("passconftxt").innerHTML=" Password must match vith previous ";
					passconf_state=false;
				}
				else{
					$("#usr_verify6").css({ "background-image": "url('../assets/images/yes.png')" }); 
					document.getElementById("passconftxt").innerHTML="";
					passconf_state=true;
				}
			}
			else{
				$("#usr_verify6").css({ "background-image": "url('../assets/images/no.png')" }); 
				document.getElementById("passconftxt").innerHTML="Password must atleast 4 char ";
				passconf_state=false;
			}			
		}
		else{
			$("#usr_verify6").css({ "background-image": "none" });
			document.getElementById("passconftxt").innerHTML="";
			passconf_state=false;
		}
		return passconf_state;
	};
	function isValidEmailAddress(emailAddress) {
 		var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
 		return pattern.test(emailAddress);
	};
	function isValidAlphapetOnly(testString){
		var pattern = new RegExp(/^[a-zA-Z\s]+$/);
		return pattern.test(testString)
	};
	
	

