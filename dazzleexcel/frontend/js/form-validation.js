
// Wait for the DOM to be ready
$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='register']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      custname: "required",
      custemail: {
        required: true,
        // Specify that email should be validated
        // by the built-in "email" rule
        email: true
      },
      custpass: {
        required: true,
        minlength: 5
      },
      custcpass : {
          minlength : 5,
          equalTo : "#custpass"
      }
    },
    // Specify validation error messages
    messages: {
      custname: "Please enter your firstname",
      custemail: "Please enter a valid email address",
      custpass: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });


  $("form[name='profileedit']").validate({
    rules: {
      newpass: {
        required: true,
        minlength: 5
      },
      confirmpass : {
          minlength : 5,
          equalTo : "#newpass"
      },
      cphone: {
          required: true,
          number: true 
      },
    },
    // Specify validation error messages
    messages: {
      newpass: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
    },
    submitHandler: function(form) {
      form.submit();
    }
  });


  $("form[name='checkout']").validate({
    rules: {
      address1: "required",
      address2: "required",
      city: "required",
      countryid: "required",
      pocode: "required",
    },
    // Specify validation error messages
    messages: {
       address1: "Please enter your Address1",
       address2: "Please enter your Address2",
       city: "Please enter your City",
       countryid: "Please Select your Country",
       pocode: "Please enter your Zipcode",
    },
    submitHandler: function(form) {
      form.submit();
    }
  });

  $("form[name='addeditaddress']").validate({
    rules: {
      address1: "required",
      address2: "required",
      towncity: "required",
      countryid: "required",
      zipcode: "required",
    },
    // Specify validation error messages
    messages: {
       address1: "Please enter your Address1",
       address2: "Please enter your Address2",
       towncity: "Please enter your Town/City",
       countryid: "Please Select your Country",
       zipcode: "Please enter your Zipcode",
    },
    submitHandler: function(form) {
      form.submit();
    }
  });




});