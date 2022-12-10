<?php 
include './database/config.php'; 
include './components/header.php'; 

if(!isset($_SESSION['user_id'])) {
    ?>
<script>
location.href = 'login.php';
</script>
<?php
} else {
    $user_id = $_SESSION['user_id'];
    $get_account = mysqli_query($conn, "SELECT * FROM tbl_user WHERE user_id = $user_id");

    $row = mysqli_fetch_array($get_account);
}
?>

<style>
body {
    background-image: url('assets/img/dental.jpg');
    background-attachment: fixed;
    background-size: cover;
}

.appointment:hover {
    background: #328a82 !important;
    color: white !important;
}

.custom_btn {
    background: #6eada7 !important;
    border-color: #6eada7 !important;
}

.custom_btn:hover {
    background: #2a6861 !important;
    border-color: #2a6861 !important;
}
</style>

<section class="mt-5 mx-4">

    <!-- Account -->
    <div class="row d-flex justify-content-center">
        <div class="card col-sm-10 col-md-8 col-lg-6">
            <div class="card-body">
                <h4 class="fw-bold text-uppercase">Profile Details</h4>
                <form id="update_image">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <div class="d-flex flex-column gap-2">
                            <img style="border: 1px solid #6eada7;" src="./assets/img/<?= $row['profile_image'] ?>"
                                alt="user-avatar" class="d-block rounded" height="100" width="100"
                                id="uploadedAvatar" />
                            <?php
                            if($row['profile_image'] != 'profile.png') {
                            ?>
                            <button type="submit" class="btn btn-danger btn-sm">REMOVE</button>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="button-wrapper">
                            <!-- <label for="upload" class="btn btn-primary me-2 mb-4 custom_btn" tabindex="0">
                                <span class="d-none d-sm-block">Upload</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>
                                <input type="file" id="upload" class="account-file-input" hidden
                                    accept="image/png, image/jpeg" />
                            </label>
                            <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                <i class="bx bx-reset d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Reset</span>
                            </button> -->
                            <div class="d-flex flex-column flex-sm-row gap-2">
                                <input class="form-control form-control-sm w-100 w-sm-75" type="file" id="formFile">
                                <button type="submit" class="btn btn-primary btn-sm custom_btn">UPLOAD</button>
                            </div>

                            <p class="text-muted mb-0">Allowed JPG, JPEG or PNG. Max size of 10MB</p>
                        </div>
                    </div>
                </form>
            </div>
            <hr class="my-0">
            <div class="card-body">
                <form id="formAccountSettings" method="POST" onsubmit="return false">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">First Name</label>
                            <input class="form-control" type="text" id="firstName" name="firstName"
                                value="<?= $row['firstname'] ?>" autofocus />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input class="form-control" type="text" name="lastName" id="lastName"
                                value="<?= $row['lastname'] ?>" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input class="form-control" type="text" id="email" name="email" value="<?= $row['email'] ?>"
                                placeholder="john.doe@example.com" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="phoneNumber">Phone Number</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">+63</span>
                                <input type="text" id="phoneNumber" name="phoneNumber" class="form-control"
                                    placeholder="9992736514" value="<?= $row['contact'] ?>" />
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">Birth Date</label>
                            <input class="form-control" type="date" id="bday" name="bday"
                                value="<?= $row['birthdate'] ?>" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">Old Password</label>
                            <input class="form-control" type="password" id="old_pass" name="old_pass" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">New Password</label>
                            <input class="form-control" type="password" id="new_pass" name="new_pass"
                                placeholder="Ignore if you'll not change password" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">Confirm Password</label>
                            <input class="form-control" type="password" id="new_pass" name="new_pass"
                                placeholder="Ignore if you'll not change password" />
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2 custom_btn">Save changes</button>
                        <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Account -->

</section>


<script>
function myFunction() {
    var x = document.getElementById("pass1");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
    var y = document.getElementById("pass2");
    if (y.type === "password") {
        y.type = "text";
    } else {
        y.type = "password";
    }
}

var today = new Date();
var dd = today.getDate();
var mm = today.getMonth() + 1;
var yyyy = today.getFullYear();

if (dd < 10) {
    dd = '0' + dd;
}

if (mm < 10) {
    mm = '0' + mm;
}

today = yyyy + '-' + mm + '-' + dd;
document.getElementById("bday").setAttribute("max", today);

// SUBMIT REGISTER
$('#register').on('submit', function(e) {
    e.preventDefault();

    if ($('#pass1').val() != $('#pass2').val()) {
        Swal.fire({
            icon: 'error',
            title: 'Failed',
            text: 'The password confirmation does not match!'
        })
    } else {
        var form = new FormData(this);
        form.append('register', true);

        $.ajax({
            type: "POST",
            url: "./functions/register.php",
            data: form,
            dataType: 'text',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('#register_btn').prop('disabled', true);
                $('#register_btn').text('Processing...');
            },
            complete: function() {
                $('#register_btn').prop('disabled', false);
                $('#register_btn').text('REGISTER');
            },
            success: function(response) {
                if (response.includes('verification.php')) {
                    location.href = response;
                } else if (response.includes('email already used')) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed',
                        text: 'Email already used! Please try another email!'
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed',
                        text: 'Something went wrong!'
                    });
                }
                console.log(response);
            }
        })
    }
})
</script>
<?php include './components/bottom.php'; ?>