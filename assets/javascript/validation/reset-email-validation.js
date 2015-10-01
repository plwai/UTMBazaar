var base_url = window.location.origin;

$('form').validate({
        rules: {
          email:{
            required: true
          }
        },
        messages: {
            email: {
                required: "Please Enter Email!",
                email: "This is not a valid email!"
            }
        },
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });
