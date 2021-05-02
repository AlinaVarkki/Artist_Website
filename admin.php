<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="resources\logo.png"/>
    <title>Admin</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <style>

        #main {
            background: #1abc9c;
        }

        .container {
            text-align: center;

        }

        .login
        {
            height: 90vh;
        }

        .bg-image {
            background-image: url("resources/admin.jpg");
            background-size: cover;
            background-position: center center;

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

        h1 {
            color: white;
        }

        #pic{
            padding-top: 5%;
        }

    </style>
</head>
<body>
<?php
include "./navBar.html";
?>
<div id="main">
    <?php

    function safePost($password)
    {
        if (isset($_POST[$password])) {
            return strip_tags($_POST[$password]);
        } else {
            return "";
        }
    }

    if (isset($_SESSION["sessionUser"])) {
        $password = $_SESSION["sessionUser"];
        $sessionUser = $_SESSION["sessionUser"];
    } else {
        $sessionUser = "";
        $password = safePost("password");
    }

    $loginOK = (md5($password) == "15076ac5b5928b2aad1dc8f709c15530") || (md5($sessionUser) == "15076ac5b5928b2aad1dc8f709c15530");

    if ($loginOK) {
        if (!isset($_SESSION["sessionUser"])) {
            session_regenerate_id();
            $_SESSION["sessionUser"] = $password;
        }
    }

    if (!$loginOK){
        ?>

        <div class="container-fluid">
            <div class="row no-gutter">
                <!-- The image half -->
                <div class="col-md-6 d-none d-md-flex bg-image"></div>

                <!-- The content half -->
                <div class="col-md-6 bg-light">
                    <div class="login d-flex align-items-center py-5">

                        <!-- Demo content-->
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-10 col-xl-7 mx-auto">
                                    <h3 class="display-4">Hi Cara!</h3>
                                    <p class="text-muted mb-4">Please log in to use your admin power</p>

                                    <form name="login" method="post" action="admin.php">
                                        <div class="form-group mb-3">
                                            <?php
                                            if ($password != "") {
                                                echo "<p style='color: red'  > password incorrect, please try again </p>";
                                            }
                                            ?>
                                            <label>
                                                <input type="password" name="password" placeholder="Password" required=""
                                                       class="form-control rounded-pill border-0 shadow-sm px-4 text-primary">
                                            </label>

                                            <br>
                                            <input type="submit" id="submit" name="Login">

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
    } else {

    ?>

    <?php
    require_once"/home/jjb18169/DEVWEB/2020/1020Ex1/password.php";

    $host = "devweb2020.cis.strath.ac.uk";
    $user = "jjb18169";
    $password = get_password();
    $dbname = "jjb18169";

    $conn = new mysqli($host, $user, $password, $dbname);

    $sql = "SELECT*FROM `Orders`";
    $result = $conn->query($sql);
    ?>

    <div class="container py-5">
        <h1 style="padding-top: 5%">Orders</h1>

        <div class="row">
            <div class="col-lg-7 mx-auto bg-white rounded shadow">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col" class="col-2">Painting Name</th>
                            <th scope="col" class="col-2">Painting ID</th>
                            <th scope="col" class="col-2">Buyer Name</th>
                            <th scope="col" class="col-2">Buyer Phone Number</th>
                            <th scope="col" class="col-2">Buyer email</th>
                            <th scope="col" class="col-2">Buyer address</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {

                                echo "<tr>";
                                echo "<td scope='row' class='col-2'>" . $row['PaintingName'] . "</td>";
                                echo "<td class='col-2'>" . $row['PaintingID'] . "</td>";
                                echo "<td class='col-2'>" . $row['Name'] . "</td>";
                                echo "<td class='col-2'>" . $row['PhoneNumber'] . "</td>";
                                echo "<td class='col-2'>" . $row['Email'] . "</td>";
                                echo "<td class='col-2'>" . $row['PostalAddress'] . "</td>";
                                echo "</tr>";
                            }
                        }
                        $conn->close();
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!--    table that lists all gallery visitors registered through track and trace system-->

    <?php
    $conn = new mysqli($host, $user, $password, $dbname);

    $sql = "SELECT*FROM `trackAndTrace`";
    $result = $conn->query($sql);
    ?>
    <div class="container py-5">
        <h1>Visitors Track&Trace information</h1>

        <div class="row">
            <div class="col-lg-7 mx-auto bg-white rounded shadow">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col" class="span2 offset1">Visitor id</th>
                            <th scope="col" class="span2">Visitor name</th>
                            <th scope="col" class="span2">Visitor address</th>
                            <th scope="col" class="span2">Visitor Phone Number</th>
                            <th scope="col" class="span2">Date and time of visit</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {

                                echo "<tr>";
                                echo "<td scope='col' class='span2 offset1'>" . $row['id'] . "</td>";
                                echo "<td class='col'>" . $row['name'] . "</td>";
                                echo "<td class='col'>" . $row['address'] . "</td>";
                                echo "<td class='col'>" . $row['number'] . "</td>";
                                echo "<td class='col'>" . $row['datetime'] . "</td>";
                                echo "<td class='col'>";
                            }
                        }
                        $conn->close();
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</div>
</body>
</html>
