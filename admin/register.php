<?php
$pageTitle = "Register";
require_once "../common/admin-seller-nav.php";
if (!isset($_SESSION['email'])) {
    header('location:../login.php');
}
?>

<div class="container my-3">

    <form class="mx-auto" id="reg-form" name="registration_form" method="post">
        <div class="reg-yellow">Register admin / seller</div>
        <div id="validity" class="alert alert-dismissible"></div>

        <div class="row">
            <div class="form-floating my-3 col-md-6">
                <input type="text" class="form-control" id="fname" placeholder=" " name="fname">
                <label for="fname" class="ps-4 form-label">First name</label>
                <small id="fnameErr" class="text-danger"></small>
            </div>

            <div class="form-floating my-3 col-md-6">
                <input type="text" class="form-control" id="lname" placeholder=" " name="lname">
                <label for="lname" class="ps-4 form-label">Last name</label>
                <small id="lnameErr" class="text-danger"></small>
            </div>

            <div class="form-floating my-3 col-md-6">
                <input type="text" class="form-control" id="email" placeholder=" " name="email">
                <label for="email" class="ps-4 form-label">Email</label>
                <small id="emailErr" class="text-danger"></small>
            </div>

            <div class="form-floating my-3 col-md-6">
                <input type="text" class="form-control" id="pnum" placeholder=" " name="pnum">
                <label for="pnum" class="ps-4 form-label">Phone number</label>
                <small id="pnumErr" class="text-danger"></small>
            </div>

            <div class="form-floating my-3 col-md-6">
                <input type="text" class="form-control" id="uname" placeholder=" " name="uname">
                <label for="uname" class="ps-4 form-label">Username</label>
                <small id="unameErr" class="text-danger"></small>
            </div>

            <div class="form-floating my-3 col-md-6">
                <select class="form-select" name="level">
                    <option value="">Choose...</option>
                    <option value="admin">Admin</option>
                    <option value="seller">Seller</option>
                </select>
                <label for="level" class="ps-4 form-label">Level</label>
                <small id="levelErr" class="text-danger"></small>
            </div>

            <div class="form-floating my-3 col-sm-4">
                <input type="password" class="form-control" id="pword" placeholder=" " name="pword">
                <label for="pword" class="ps-4 form-label">Password</label>
                <small id="pwordErr" class="text-danger"></small>
            </div>

            <div class="form-floating my-3 col-md-4 offset-md-2">
                <input type="password" class="form-control" id="cpword" placeholder=" " name="cpword">
                <label for="cpword" class="ps-4 form-label">Confirm Password</label>
                <small id="cpwordErr" class="text-danger"></small>
            </div>
        </div>
        <input type="submit" name="register" value="Register" class="btn btn-success">
    </form>
</div>
<script src="../js/admin/register.js"></script>

<?php require_once "../common/admin-seller-footer.php"; ?>