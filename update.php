<?php
include 'database.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Team</title>
    <script src="https://kit.fontawesome.com/28e3060a5c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="hr.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="my-5">
        <?php
        $apno = $_GET['updateid'];
        $query = "SELECT * FROM app WHERE ApplicationNo = '$apno' ";
        $query_run = mysqli_query($conn, $query);

        if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $items) {
                $Appno1 = $items['ApplicationNo'];
                $fn1 = $items['FirstName'];
                $ln1 = $items['LastName'];
                $mi1 = $items['MI'];
                $mail1 = $items['Email'];
                $pn1 = $items['PhoneNumber'];
                $bday1 = $items['Birthdate'];
                $age1 = $items['Age'];
                $sex1 = $items['Sex'];
                $adrs1 = $items['Adrs'];
                $brgy1 = $items['Baranggay'];
                $city1 = $items['City'];
                $prov1 = $items['Province'];
                $zip1 = $items['Zipcode'];
            }
        };
        ?>
        <div class="formtab">
            <form action="#" method="post">
                <h2 class="headap text-center">APPLICATION FORM</h2>
                <h4><i class="fa-solid fa-circle-user"></i> Personal Information</h4>
                <div class="form-group row">
                    <div class="col-5 input">
                        <label for="fname">First Name</label>
                        <input type="text" id="fname" name="fname" class="form-control" value="<?php echo $fn1 ?>" required>
                    </div>
                    <div class=" col-5 input">
                        <label for="lname">Last Name</label>
                        <input type="text" id="lname" name="lname" class="form-control" value="<?php echo $ln1 ?>" required>
                    </div>
                    <div class="col-2">
                        <label for="mi">M.I.</label>
                        <input type="text" id="mi" name="mi" class="form-control" value="<?php echo $mi1 ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-4 input">
                        <label for="mail">Email</label>
                        <input type="email" id="mail" name="mail" class="form-control" value="<?php echo $mail1 ?>" required>
                    </div>
                    <div class="col-4 input">
                        <label for="num">Phone Number</label>
                        <input type="number" id="num" name="num" class="form-control" value="<?php echo $pn1 ?>" required>
                    </div>
                    <div class="col-2 input">
                        <label for="bday">Birthdate</label>
                        <input type="date" id="bday" name="bday" class="form-control" value="<?php echo $bday1 ?>" required>
                    </div>
                    <div class="col-1 input">
                        <label for="age">Age</label>
                        <input type="number" id="age" name="age" class="form-control" value="<?php echo $age1 ?>" required>
                    </div>
                    <div class="col">
                        <label for="sex">Sex</label>
                        <select class="custom-select mr-sm-2" name="sex" id="sex" value="<?php echo $sex1 ?>" required>
                            <option value="F">F</option>
                            <option value="M">M</option>
                        </select>
                    </div>
                </div>
                <h4><i class="fa-solid fa-location-dot"></i> Home Address</h4>
                <div class="form-group row">
                    <div class="col input">
                        <label for="adrs">Street/House No./Building No./Village/Subd.</label>
                        <input type="text" id="adrs" name="adrs" class="form-control" value="<?php echo $adrs1 ?>" required>
                    </div>
                    <div class="col-3">
                        <label for="brgy">Baranggay</label>
                        <input type="text" id="brgy" name="brgy" class="form-control" value="<?php echo $brgy1 ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col input">
                        <label for="city">City</label>
                        <input type="text" id="city" name="city" class="form-control" value="<?php echo $city1 ?>" required>
                    </div>
                    <div class="col input">
                        <label for="prov">Province</label>
                        <input type="text" id="prov" name="prov" class="form-control" value="<?php echo $prov1 ?>" required>
                    </div>
                    <div class="col-2">
                        <label for="zip">Zipcode</label>
                        <input type="text" id="zip" name="zip" class="form-control" value="<?php echo $zip1 ?>" required>
                    </div>
                </div>

                <button class="btn btn-primary text-center" name="submit">Update</button>
            </form>
        </div>
    </div>
    <?php

    if (isset($_POST['submit'])) {
        $fn = $_POST['fname'];
        $ln = $_POST['lname'];
        $mi = $_POST['mi'];
        $mail = $_POST['mail'];
        $num = $_POST['num'];
        $bday = $_POST['bday'];
        $age = $_POST['age'];
        $sex = $_POST['sex'];
        $adrs = $_POST['adrs'];
        $brgy = $_POST['brgy'];
        $city = $_POST['city'];
        $prov = $_POST['prov'];
        $zip = $_POST['zip'];

        //application = tablename
        //FirstName, LastName.... = Column Names
        $sql1 = "UPDATE app SET FirstName = '$fn', LastName = '$ln', MI = '$mi', Email = '$mail', PhoneNumber = '$num', 
                Birthdate = '$bday', Age = '$age', Sex = '$sex', Adrs = '$adrs', Baranggay = '$brgy', City = '$city', 
                Province = '$prov', Zipcode = '$zip' WHERE ApplicationNo = $apno";
        $set = mysqli_query($conn, $sql1);


        if ($set) {
            echo "<script> window.location.href = 'hr.php';</script>";
        } else {
            die(mysqli_error($conn));
        }
    }
    ?>
</body>

</html>