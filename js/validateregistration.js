

$(function() {
  $("#registerform").validate({
   rules: {
     username: "required",
     email: {
       required: true,
       email: true
     },
     password: {
       required: true,
       minlength: 5,
       maxlength: 20
     }
   },
   messages: {
     username: "please enter a username",
     email: "please enter a valid email address",
     password: {
       required: "please enter a password",
       minlength: "password must be more than 5 characters long",
       maxlength: "password must be shorter than 20 characters"
     },
   },
   submitHandler: function(form) {
    form.submit();
   }
 });
});
