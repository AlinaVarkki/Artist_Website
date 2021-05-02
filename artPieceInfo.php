<!DOCTYPE html>
<html lang="en">


<head>

    <link rel="icon" type="image/png" href="resources\logo.png"/>

    <title>Art Info</title>

    <meta charset="UTF-8">
    <title>Title</title>

    <style>

        html {
            background: #1abc9c;
        }

        .container-fluid img {
            width: 100%;
            alignment: center;

        }

        .container-fluid {
            padding-top: 5%;
            background: #1abc9c;
        }

        h3, p, h4 {
            color: white;
        }

        #description {
            padding: 5%;
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
require_once"/home/jjb18169/DEVWEB/2020/1020Ex1/password.php";

$id = $_POST['id'];

$host = "devweb2020.cis.strath.ac.uk";
$user = "jjb18169";
$password = get_password();
$dbname = "jjb18169";

//Connect to MySql
$conn = new mysqli($host, $user, $password, $dbname);
$conn2 = new mysqli($host, $user, $password, $dbname);
//check painting availability
$sqlAvailability = "SELECT `PaintingID` from `Orders` where `PaintingID` = '$id'";
$availability = $conn2->query($sqlAvailability);
$row = mysqli_fetch_array($availability);
$av = null;
if ($row > 0) {
    $av = false;
} else {
    $av = true;
}
$conn2->close();
?>

<div id="main">

    <?php

    //Issue the query
    $sql = "SELECT*FROM `artListings` WHERE `id`= $id ";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {

        $name = $row['name'];
        echo '<div class="container-fluid">
              <div class="row justify-content-center">
                <div class="col-sm-6">
                  <img class="center-block" src="data:image/jpeg;base64,' . base64_encode($row['artPhoto']) . ' "height=100%" width="100%" alt="" style="box-shadow: 10px 10px 10px white"/>
                </div>
                <div class="col-sm-6" id = "description">



                 <h3>  ' . $name . ' </h3>
                 <h3> Completion date: ' . $row['completionDate'] . ' </h3>
                 <h3> Measurements: ' . $row['widthMM'] . ' x ' . $row['heightMM'] . ' cm</h3>
                 <h3> Price: ' . $row['price'] . ' £ </h3>
                 <p> Description: ' . $row['description'] . ' </p>

                 <div class="btn-toolbar mb-3" role="toolbar" aria-label="Basic example">

                  <button onclick="history.go(-1);" id="submit" >Back </button>';

        if ($av == true) {
            echo ' <form method="post" action="artBookingPage.php" >
                 <input type="submit" name="action" value="Book" id="submit" />
                  <input type="hidden" name="id" value= "' . $row['id'] . '" />
                  <input type="hidden" name="name" value="' . $row['name'] . '" />
               </form>
               </div>
              </div>
              </div>
            </div>
                ';
        } else {
            echo ' <form method="post" action="artBookingPage.php" >
                 <input type="submit" name="action" value="Book" id="submit" disabled />
                  <input type="hidden" name="id" value= "' . $row['id'] . '" />
                  <input type="hidden" name="name" value="' . $name . '" />
               </form>
               </div>
                <h4>  Sorry, this painting is unavailable </h4>
              </div>
              </div>
            </div>
                ';
        }
    }

    $conn->close();

    ?>
</div>
</body>
</html>
