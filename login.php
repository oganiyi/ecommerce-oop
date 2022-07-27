<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <form class="mx-auto" id="login-form" name="login-form" method="post">
            <div class="row">
                <div id="validity"></div>

                <div class="form-floating my-3">
                    <input type="text" class="form-control" id="unameEmail" placeholder=" " name="unameEmail">
                    <label for="unameEmail" class="ps-4">Username / Email</label>
                </div>
            </div>
            <div class="row">
                <div class="form-floating my-3">
                    <input type="password" class="form-control" id="pword" placeholder=" " name="pword">
                    <label for="pword" class="ps-4 form-label">Password</label>
                </div>
            </div>
            <input type="submit" name="login" value="Login" class="btn btn-success">
        </form>
    </div>
    <script src="js/login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>