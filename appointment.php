<?php
include './database/config.php';
include './components/header.php';

if (!isset($_SESSION['user_id'])) {
    ?>
<script>
location.href = 'login.php';
</script>
<?php
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
</style>

<section class="mt-5 mx-4">

    <!--APPOINTMENT FORM-->
    <div class="row d-flex justify-content-center">
        <div class="col-sm-10 col-md-7">
            <form action="" method="POST" class="p-5 bg-white">

                <div>
                    <p class="text-center h1 fw-bold mb-4 mx-1 mx-md-4 mt-2">ONLINE APPOINTMENT REQUEST FORM</p>
                </div>

                <div class="row form-group p-1">
                    <div class="col-lg-6 mb-3 mb-md-0">
                        <label class="font-weight-bold" for="firstname">First Name</label>
                        <input type="text" id="firstname" name="firstname" class="form-control" placeholder="First Name"
                            value="<?= $row['firstname'] ?>">
                    </div>
                    <div class="col-lg-6">
                        <label class="font-weight-bold" for="lastname">Last Name</label>
                        <input type="text" id="lastname" name="lastname" class="form-control" value="<?= $row['lastname'] ?>">
                    </div>
                </div>

                <div class="row form-group p-1">
                    <div class="col-lg-6">
                        <label class="form-label" for="phoneNumber">Phone Number</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text">+63</span>
                            <input type="text" id="phoneNumber" name="phoneNumber" class="form-control"
                                placeholder="9992736514" value="<?=$row['contact']?>" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label class="font-weight-bold" for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="<?= $row['email'] ?>">
                    </div>
                </div>
                <div class="row form-group p-1">
                    <div class="col-lg-6 mb-3 mb-md-0">
                        <label class="font-weight-bold" for="fname">Date</label>
                        <input type="date" id="date" name="date" id="date" class="form-control" value="<?= $row['birthdate'] ?>" required>
                    </div>



                    <div class="col-lg-6">
                        <label class="font-weight-bold" for="">Clinic</label>
                        <select class="form-control input-sm" name="clinic" id="clinic">
                            <option value="Bacoor">Bacoor</option>
                            <option value="Paliparan">Paliparan</option>
                        </select>

                    </div>
                </div>

                <div class="row form-group p-1">
                    <div class="col-lg-6">
                        <label class="font-weight-bold" for="contact">Time</label>
                        <select class="form-control" name="time" id="time" required>
                            <option id="time" name="time" value="10:30 AM">10:30 AM</option>
                            <option id="time" name="time" value="11:30 AM">11:30 AM</option>
                            <option id="time" name="time" value="1:00 PM">1:00 PM</option>
                            <option id="time" name="time" value="1:30 PM">1:30 PM</option>
                            <option id="time" name="time" value="2:30 PM">2:00 PM</option>
                            <option id="time" name="time" value="2:30 PM">2:30 PM</option>
                            <option id="time" name="time" value="3:00 PM">3:00 PM</option>
                            <option id="time" name="time" value="3:30 PM">3:30 PM</option>
                            <option id="time" name="time" value="4:00 PM">4:00 PM</option>
                            <option id="time" name="time" value="4:30 PM">4:30 PM</option>
                        </select>

                    </div>
                    <div class="col-lg-6">
                        <label class="font-weight-bold" for="email">Services</label>
                        <div class="options">
                            <div class="form-check">
                                <input type="checkbox" required name="services[]" value="General Dentistry"></input>
                                <label>General Dentistry

                            </div>
                            </label>
                            <div class="form-check">
                                <input type="checkbox" required name="services[]" value="Oral Surgery">
                                <label>Oral Surgery

                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" required name="services[]" value="Orthodontics">
                                <label>Orthodontics

                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" required name="services[]" value="Endodontics">
                                <label>Endodontics

                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" required name="services[]" value="Periodontics">
                                <label>Periodontics

                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" required name="services[]" value="Cosmetic Dentistry">
                                <label>Cosmetic Dentistry

                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-12">
                        <button class="btn btn-dark" name="submit" id="submit">Submit</button>
                    </div>
                </div>


            </form>
        </div>
    </div>

</section>

<?php include './components/bottom.php';?>