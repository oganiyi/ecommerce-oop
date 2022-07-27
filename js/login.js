let login_form = document.forms["login-form"];
let validity = document.querySelector("#validity");

login_form.onsubmit = (e) => {
  e.preventDefault();

  const formData = new FormData(login_form);

  fetch("server/common/login.php", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((data) => {
      console.log(data);

      if (data.validity) {
        validity.style.display = "block";
        if (data.validity === "invalid") {
          validity.style.color = "red";
          validity.innerHTML =
            "Invalid details. Check your details and try again";
        }
        if (data.validity === "valid") {
          validity.style.color = "green";
          validity.innerHTML =
            "You are now logged in. You will be redirected soon...";

          if (data.level === "admin" || data.level === "seller") {
            setTimeout(() => {
              window.location.assign("common/dashboard.php");
            }, 2000);
          }
          if (data.level === "user") {
            setTimeout(() => {
              window.location.assign("index.php");
            }, 2000);
          }
        }
      }
    })
    .catch((error) => {
      console.log(error);
    });
};
