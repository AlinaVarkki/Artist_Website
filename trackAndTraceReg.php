<!DOCTYPE html>
<html lang="eng">

<head>
    <link rel="icon" type="image/png" href="resources\logo.png"/>
    <title>Track&Trace</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <style>
        body {
            background: -webkit-linear-gradient(left, #1abc9c, #70ffe1);
        }

        .contact-form {
            background: #fff;
            margin-top: 10%;
            margin-bottom: 5%;
            width: 70%;
        }

        .contact-form .form-control {
            border-radius: 1rem;
        }

        .contact-image {
            text-align: center;
        }

        .contact-image img {
            border-radius: 8rem;
            width: 25%;
            margin-top: -5%;
        }

        .contact-form form {
            padding: 7%;
        }

        .contact-form form .row {
            margin-bottom: -3%;
        }

        .contact-form h3 {
            margin-bottom: 8%;
            margin-top: -10%;
            text-align: center;
            color: #1abc9c;
        }

        #submit {
            color: #513b86 !important;
            text-transform: uppercase;
            background: #ffffff;
            padding: 5px;
            padding-left: 30px;
            padding-right: 30px;
            border: 2px solid #513b86 !important;
            border-radius: 6px;
            display: inline-block;
            transition: all 0.3s ease 0s;
        }

        #submit:hover {
            color: #494949 !important;
            border-radius: 30px;
            border-color: #494949 !important;
            transition: all 0.3s ease 0s;
        }
    </style>

    <script>
        function check() {

            var name = document.forms["trackForm"]["visitorName"];
            var address = document.forms["trackForm"]["visitorAddress"];
            var number = document.forms["trackForm"]["visitorNumber"];
            var dateTime = document.forms["trackForm"]["dateTime"];

            var errs = "";

            if (name.value === "") {
                errs += "Name\n"
                name.style.background = "pink";
            }
            if (address.value === "") {
                errs += "Address\n"
                address.style.background = "pink";
            }
            if (number.value === "") {
                errs += "Phone number\n"
                number.style.background = "pink";
            }
            if (dateTime.value === "") {
                errs += "Date and Time\n"
                dateTime.style.background = "pink";
            }
            if (errs !== "") {
                alert("Sorry, the following fields should be filled: \n" + errs);
            }
            return (errs === "");
        }

        function turnWhite(fieldname) {
            var name = document.forms["trackForm"][fieldname];
            name.style.background = "white";
        }
    </script>
</head>
<body>

<?php
include "./navBar.html";
?>

<div id="main">

    <?php

require_once"/home/jjb18169/DEVWEB/2020/1020Ex1/password.php";

    function getPOSTsafely($connection, $name)
    {
        if (isset($_POST[$name])) {
            return $connection->real_escape_string($_POST[$name]);
        } else {
            return "";
        }
    }

    $host = "devweb2020.cis.strath.ac.uk";
    $user = "jjb18169";
    $password = get_password();
    $dbname = "jjb18169";

    //Connect to MySql
    $conn = new mysqli($host, $user, $password, $dbname);

    if (!isset($_POST['visitorName'])) {

        ?>
        <div class="container contact-form">
            <div class="contact-image">
                <img src="resources/admin.jpg" alt="logo"/>

                <form name="trackForm" action="trackAndTraceReg.php" onsubmit="return check();" method="post">

                    <div class="row">
                        <div class="form-group">
                            <h2>Given the current circumstances we require all visitors to notify us about their visit.
                                Please fill the form below and specify the time you would like to come to ✨CaraArt✨
                                gallery. </h2>
                            <h2>See you!</h2>
                        </div>
                        <div class="form-group">
                            Name: <input type="text" name="visitorName" class="form-control"
                                         onchange="turnWhite('visitorName')"/>
                        </div>
                        <div class="form-group">
                            Postal Address: <input ="text" name="visitorAddress" class="form-control"  onchange=
                            "turnWhite('visitorAddress')" />
                        </div>
                        <div class="form-group">
                            Phone number: <input type="tel" name="visitorNumber" class="form-control"
                                                 pattern='^\+?\d{0,13}' onchange="turnWhite('visitorNumber')"/>
                        </div>
                        <div class="form-group">
                            Time and date of appointment: <input type="datetime-local" name="dateTime"
                                                                 class="form-control" onchange="turnWhite('dateTime')"/>
                        </div>

                        <p><input type="submit" id="submit"/></p>
                    </div>
                </form>
            </div>
        </div>
        <?php
    } else {


        $name = getPOSTsafely($conn, "visitorName");
        $address = getPOSTsafely($conn, "visitorAddress");
        $phoneNumber = getPOSTsafely($conn, "visitorNumber");
        $dateTime = getPOSTsafely($conn, "dateTime");


        echo '    <div class="container contact-form">
        <div class="contact-image">
            <img src="resources/Darina.png" alt="rocket_contact"/>

            <form name="bookingForm" action="artBookingPage.php" onsubmit="return check();" method="post">
                <div class="row">
                        <div class="form-group">
                            <h1>' . $name . ',</h1>
                            <h1>Thank you for registering to visit Caras gallery!  See you on ' . $dateTime . '</h1>
                        </div>
                </div>

            </form>

        </div>
    </div>';

        $sql = "INSERT INTO `trackAndTrace` (`name`, `address`, `number`, `datetime`) VALUES ('$name', '$address', '$phoneNumber', '$dateTime');";
        $result = $conn->query($sql);
        $conn->close();
    }
    ?>
</div>
</body>
</html>
