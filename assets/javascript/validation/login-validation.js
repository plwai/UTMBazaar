
$(document).ready(function(){
	$('button#submit').click(function(e){
    e.preventDefault();

		validate_value = validation();
		if(validate_value == 'true'){
                $.ajax({
                type: "POST",
                url: window.location.origin + window.location.pathname + "/login",
                dataType: 'json',
                data: {email:$("#email").val(),password:$("#password").val()}
                }).done(function(msg){
                    if(msg.res==0){
                        $("p#respond").css('color', 'red');
                        document.getElementById("respond").innerHTML=" Invalid Email or Password ";
                    }
                    if(msg.done==1){
                      window.location.href = window.location.origin+window.location.pathname;
                    }
					//for banned user
					if(msg.res==3){
					$("p#respond").css('color', 'red');
                        document.getElementById("respond").innerHTML=" Sorry your account is facing some issues, please contact admin! ";
						}
                });
		}
	});

});


function validation(){
    var password = $("input#password").val();
    if (password == '' || password == null || password.length<4) {
        $("p#password").css('color', 'red');
        $("p#password").text('Please Enter Password with atleast length 4');
        var a = false;
    }
    else{
        $("p#password").text('');
        var a = true;
    }
    function isValidEmailAddress(emailAddress){
        var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
        return pattern.test(emailAddress);
    }

    var email = $("input#email").val();
    if (email == '' || email == null) {
        $("p#email").css('color', 'red');
        $("p#email").text('Please Enter Email Address');
        var b = false;
    }
    else{
        $("p#email").text('');
        var b = true;
    }

    var isEmail = isValidEmailAddress(email)
    if (!isEmail) {
        $("p#email2").css('color', 'red');
        $("p#email2").text('Please enter vaild email');
        var c = false;
    }
    else{
        $("p#email2").text('');
        var c = true;
    }

    if (a == false || b == false ||  c == false) {
        return  false;

    }else{
        return  'true';
    }
}
