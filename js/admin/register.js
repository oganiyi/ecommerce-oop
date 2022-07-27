let registration_form = document.forms["registration_form"];
let firstName = registration_form["fname"];
let lastName = registration_form["lname"];
let email = registration_form["email"];
let phoneNumber = registration_form["pnum"];
let username = registration_form["uname"];
let level = registration_form["level"];
let password = registration_form["pword"];
let confirmPassword = registration_form["cpword"];

let errors = {};

let firstNameError = document.querySelector("#fnameErr");
let lastNameError = document.querySelector("#lnameErr");
let emailError = document.querySelector("#emailErr");
let phoneNumberError = document.querySelector("#pnumErr");
let usernameError = document.querySelector("#unameErr");
let levelError = document.querySelector("#levelErr");
let passwordError = document.querySelector("#pwordErr");
let confirmPasswordError = document.querySelector("#cpwordErr");
let validity = document.querySelector("#validity");

function validateFirstName(fname) {
  fname = fname.value.trim();
  if (fname === "") {
    errors.firstName = "First name cannot be empty";
  } else if (fname.split(" ").length != 1) {
    errors.firstName = "First name should only be a single name";
  } else if (!/^[a-zA-Z]+$/.test(fname)) {
    errors.firstName = "Please enter a valid name";
  } else {
    errors.firstName = "";
  }
  firstNameError.innerHTML = errors.firstName;
}

function validateLastName(lname) {
  lname = lname.value.trim();
  if (lname === "") {
    errors.lastName = "Last name cannot be empty";
  } else if (lname.split(" ").length != 1) {
    errors.lastName = "Last name should only be a single name";
  } else if (!/^[a-zA-Z]+$/.test(lname)) {
    errors.lastName = "Please enter a valid name";
  } else {
    errors.lastName = "";
  }
  lastNameError.innerHTML = errors.lastName;
}

function validateEmail(mail) {
  mail = mail.value.trim();
  let regex = new RegExp("[a-z0-9]+@[a-z]+.[a-z]{2,3}");
  if (mail === "") {
    errors.email = "Email cannot be empty";
  } else if (!regex.test(mail)) {
    errors.email = "Enter a valid email address";
  } else {
    errors.email = "";
  }
  emailError.innerHTML = errors.email;
}

function validatePhonenumber(pnum) {
  pnum = pnum.value.trim();
  var firstThreeDigit = pnum.substr(0, 3);
  if (pnum == "") {
    errors.phoneNumber = "Please input a phone number of length 11";
  } else if (
    (isNaN(pnum) && !Number.isInteger(pnum)) ||
    (firstThreeDigit != "070" &&
      firstThreeDigit != "080" &&
      firstThreeDigit != "081" &&
      firstThreeDigit != "090" &&
      firstThreeDigit != "091")
  ) {
    errors.phoneNumber =
      "Please only enter number without country code starting with 080, 081, 091 etc.";
  } else if (pnum.length != 11) {
    errors.phoneNumber = "Your phone number cannot be less or greater than 11";
  } else {
    errors.phoneNumber = "";
  }
  phoneNumberError.innerHTML = errors.phoneNumber;
}

function validateUsername(uname) {
  uname = uname.value.trim();
  if (uname === "") {
    errors.username = "Username cannot be empty";
  } else if (uname.split(" ").length != 1) {
    errors.username = "Username should only be a single name";
  } else if (typeof uname !== "string") {
    errors.username = "Only enter letters, numbers or characters";
  } else if (uname.length < 6 || uname.length > 12) {
    errors.username = "Username cannot be less than 6 or greater than 12";
  } else {
    errors.username = "";
  }
  usernameError.innerHTML = errors.username;
}

function validateLevel(lvl) {
  lvl = lvl.value.trim();
  if (lvl === "") {
    errors.level = "Select a level";
  } else if (lvl !== "admin" && lvl !== "seller") {
    errors.level = "Invalid level";
  } else {
    errors.level = "";
  }
  levelError.innerHTML = errors.level;
}

function validatePassword(pwd) {
  pwd = pwd.value.trim();
  if (pwd === "") {
    errors.password = "Password cannot be empty";
  } else if (typeof pwd !== "string") {
    errors.password = "Only enter letters, numbers or characters";
  } else if (pwd.length < 6 || pwd.length > 12) {
    errors.password = "Password cannot be less than 6 or greater than 12";
  } else {
    errors.password = "";
  }
  passwordError.innerHTML = errors.password;
}

function validateConfirmPassword(cpwd) {
  cpwd = cpwd.value.trim();
  if (cpwd === "") {
    errors.confirmPassword = "Confirm your password";
  } else if (typeof cpwd !== "string") {
    errors.confirmPassword = "Only enter letters, numbers or characters";
  } else if (cpwd != password.value.trim()) {
    errors.confirmPassword = "Password does not match";
  } else {
    errors.confirmPassword = "";
  }
  confirmPasswordError.innerHTML = errors.confirmPassword;
}

registration_form.onsubmit = (e) => {
  e.preventDefault();
  validateFirstName(firstName);
  validateLastName(lastName);
  validateEmail(email);
  validatePhonenumber(phoneNumber);
  validateUsername(username);
  validateLevel(level);
  validatePassword(password);
  validateConfirmPassword(confirmPassword);

  let formData = new FormData(registration_form);

  fetch("../server/admin/register.php", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((data) => {
      console.log(data);
      if (data.firstNameError) {
        firstNameError.innerHTML = data.firstNameError;
      }
      if (data.lastNameError) {
        lastNameError.innerHTML = data.lastNameError;
      }

      if (data.emailError) {
        emailError.innerHTML = data.emailError;
      }

      if (data.phoneNumberError) {
        phoneNumberError.innerHTML = data.phoneNumberError;
      }

      if (data.usernameError) {
        usernameError.innerHTML = data.usernameError;
      }

      if (data.levelError) {
        levelError.innerHTML = data.levelError;
      }

      if (data.passwordError) {
        passwordError.innerHTML = data.passwordError;
      }
      if (data.confirmPasswordError) {
        confirmPasswordError.innerHTML = data.confirmPasswordError;
      }

      if (data.validity) {
        validity.style.display = "block";
        if (data.validity === "invalid") {
          validity.classList.add("alert-danger");
          validity.classList.remove("alert-success");
          validity.innerHTML =
            '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>Error(s)!. Check your details and try again';
        }
        if (data.validity === "valid") {
          validity.classList.add("alert-success");
          validity.classList.remove("alert-danger");
          validity.innerHTML = `<button type="button" class="btn-close" data-bs-dismiss="alert"></button>${level.value} registered successfully`;
          window.location.assign("register.php");
        }
      }
    })
    .catch((error) => {
      console.log(error);
    });
};
