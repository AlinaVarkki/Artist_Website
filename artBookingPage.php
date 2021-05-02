<!DOCTYPE html>
<html lang="eng">
<head>
    <link rel="icon" type="image/png" href="resources\logo.png"/>

    <title>Book Art</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script>

        function check() {

            var name = document.forms["bookingForm"]["buyerName"];
            var number = document.forms["bookingForm"]["number"];
            var email = document.forms["bookingForm"]["email"];
            var address = document.forms["bookingForm"]["address"];

            var errs = "";

            if (name.value === "") {
                errs += "Name\n"
                name.style.background = "pink";
            }

            if (number.value === "") {
                errs += "Phone number\n"
                number.style.background = "pink";
            }

            if (email.value === "") {
                errs += "Email\n"
                email.style.background = "pink";
            }

            if (address.value === "") {
                errs += "Address\n"
                address.style.background = "pink";
            }

            if (errs !== "") {
                alert("Sorry, the following fields should be filled: \n" + errs);
            }
            return (errs === "");
        }

        function turnWhite(fieldname) {
            var name = document.forms["bookingForm"][fieldname];
            name.style.background = "white";
        }
    </script>

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
            padding: 5px 30px;
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
</head>

<body>

<?php
include "./navBar.html";
?>

<div id="main">
    <?php
    require_once"/home/jjb18169/DEVWEB/2020/1020Ex1/password.php";

    function getPOSTsafely($conn, $name)
    {
        if (isset($_POST[$name])) {
            return $conn->real_escape_string($_POST[$name]);
        } else {
            return "";
        }
    }

    $host = "devweb2020.cis.strath.ac.uk";
    $user = "jjb18169";
    $password = get_password();
    $dbname = "jjb18169";

    //Connect to MySql
    $conn2 = new mysqli($host, $user, $password, $dbname);

    //Issue the query
    $sqlAvailability = "SELECT `PaintingID` from `Orders` where `PaintingID` = '{$_POST['id']}'";
    $availability = $conn2->query($sqlAvailability);
    $row = mysqli_fetch_array($availability);

    if ($row > 0) {
        echo "<h1>Sorry, this painting is unavailable</h1>";

    } else if (isset($_POST['id']) && isset($_POST['name']) && !isset($_POST['buyerName'])) {

        $id = $_POST['id'];
        $paintingName = $_POST['name'];

        ?>

        <div class="container contact-form">
            <div class="contact-image">
                <img src="resources/admin.jpg" alt="logo"/>

                <form name="bookingForm" action="artBookingPage.php" onsubmit="return check();" method="post">
                    <div class="row">
                        <div class="form-group">
                            <h1>Book painting No <?php echo $id ?> Name: <?php echo $paintingName ?></h1>
                        </div>
                        <div class="form-group">
                            Name: <input type="text" name="buyerName" class="form-control"
                                         onchange="turnWhite('buyerName')"/>
                        </div>
                        <div class="form-group">
                            Phone number: <input type="tel" name="number" class="form-control" pattern='^\+?\d{0,13}'
                                                 onchange="turnWhite('number')"/>
                        </div>
                        <div class="form-group">
                            Email: <input type="email" name="email" class="form-control" onchange="turnWhite('email')"/>
                        </div>
                        <div class="form-group">
                            Postal-address: <input type="text" class="form-control" name="address"
                                                   onchange="turnWhite('address')"/>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?php echo $id ?>"/>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="name" value="<?php echo $paintingName ?>"/>
                        </div>

                        <p><input type="submit" id="submit"/></p>
                    </div>
                </form>
            </div>
        </div>
        <?php
    } else {

        $conn = new mysqli($host, $user, $password, $dbname);

        $id = getPOSTsafely($conn, "id");
        $paintingName = getPOSTsafely($conn, "name");
        $name = getPOSTsafely($conn, "buyerName");
        $phoneNumber = getPOSTsafely($conn, "number");
        $email = getPOSTsafely($conn, "email");
        $address = getPOSTsafely($conn, "address");


        echo '    <div class="container contact-form">
        <div class="contact-image">
            <img src="resources/admin.jpg" alt="rocket_contact"/>
            <form name="bookingForm" action="artBookingPage.php" onsubmit="return check();" method="post">
                <div class="row">
                        <div class="form-group">
                            <h1>' . $name . ',</h1>
                            <h1>Thank you for ordering painting No: ' . $id . '</h1>
                            <h1> Name: ' . $paintingName . '</h1>
                            <h1>Your order will be delivered to ' . $address . ' </h1>
                        </div>
                </div>
            </form>
        </div>
    </div>';

        $sql = "INSERT INTO `Orders` (`PaintingName`, `PaintingID`, `Name`, `PhoneNumber`, `Email`, `PostalAddress`) VALUES ('$paintingName', '$id', '$name', '$phoneNumber', '$email', '$address');";
        $result = $conn->query($sql);
        $conn->close();
    }
    ?>
</div>
</body>
</html>
