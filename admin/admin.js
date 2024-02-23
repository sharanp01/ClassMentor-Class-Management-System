function validateInputs() {
  var input1 = document.getElementById("errormsg").value;

  var regex = /^[a-zA-Z]+$/; // Regular expression to allow only letters

  var error1 = document.getElementById("errorf");

  if (!regex.test(input1)) {
    error1.textContent = "Invalid input. Only letters are allowed.";
  } else {
    error1.textContent = "";
  }
}
function validateInputs2() {
  var input2 = document.getElementById("errormsg2").value;
  var error2 = document.getElementById("errorl");

  var regex = /^[a-zA-Z]+$/;
  if (!regex.test(input2)) {
    error2.textContent = "Invalid input. Only letters are allowed.";
  } else {
    error2.textContent = "";
  }
}
function validateInputs3() {
  var email = document.getElementById("errore").value;

  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Basic email validation
  var emailError = document.getElementById("errormsge");
  if (!emailRegex.test(email)) {
    emailError.textContent = "Invalid email format.";
  } else {
    emailError.textContent = "";
  }
}
function validateInputs4() {
  var phoneNumber = document.getElementById("errorp").value;
  var phoneRegex = /^\d{1,10}$/;
  var phoneError = document.getElementById("errormsgp");

  if (!phoneRegex.test(phoneNumber)) {
    phoneError.textContent =
      "Invalid phone number. It should be numeric and up to 10 digits.";
  } else {
    phoneError.textContent = "";
  }
}
function validateAge(age, minAge, maxAge) {
  return age >= minAge && age <= maxAge;
}

function validateUserAge() {
  var ageInput = document.getElementById("studentage").value;
  var minimumAge = 15;
  var maximumAge = 100;
  var messageElement = document.getElementById("errormsgage");

  if (validateAge(ageInput, minimumAge, maximumAge)) {
      messageElement.textContent = ""; // Display message if age is valid
  } else {
      messageElement.textContent = "Your age is not valid. Please make sure you are between 15 and 100 years old."; // Display message if age is not valid
  }
}
function validatePass() {
  var password1 = document.getElementById("password1").value;
  var password2 = document.getElementById("password2").value;
  errorpass1 = document.getElementById("errormsgpassword1");
  errorpass2 = document.getElementById("errormsgpassword2");
  if (password1.getlength() > 10) {
    errorpass1.textContent = "The password should only contain 10 characters";
  } else {
    errorpass1.textContent = "";
  }
  if (password1 != password2) {
    errorpass2.textContent = "The password doesnt match";
  } else {
    errorpass2.textContent = "";
  }
}
function validatePass(){
  var tpassword1 = document.getElementById('password1').value;
  var tpassword2 = document.getElementById('password2').value;
  var errormsg5 = document.getElementById('errormsgcp');
  if(tpassword1 != tpassword2){
       errormsg5.textContent = "Password doesnt match";
  }
  else{
    errormsg5.textContent = " ";
  }
}

function validateEditInputs() {
    var columns = document.getElementById('showdata').value;
    var newdata = document.getElementById('newdata').value;
    var errormsg = document.getElementById('errormsg');
    if (columns == "Email") {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(newdata)) {
            errormsg.textContent = "Invalid email format.";
        } else {
            errormsg.textContent = "";
        }
    }
    if (columns == "Firstname" || columns == "Lastname") {
        var regex = /^[a-zA-Z]+$/;
        if (!regex.test(newdata)) {
            errormsg.textContent = "Invalid input. Only letters are allowed.";
        } else {
            errormsg.textContent = "";
        }
    }
    if (columns == "Phone") {
        var phoneRegex = /^\d{1,10}$/;
        if (!phoneRegex.test(newdata)) {
            errormsg.textContent ="Invalid phone number. It should be numeric and up to 10 digits.";
        } else {
            errormsg.textContent = "";
        }
    }
}

