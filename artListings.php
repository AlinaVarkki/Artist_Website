<!--page containing art and an option to buy each of them-->

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="resources\logo.png"/>
    <title>Gallery</title>
    <style>
        #main{
            padding-top: 4%;
            background: #1abc9c;

        }

        html {
            background: #1abc9c;
        }

        .container-fluid {
            background: #1abc9c;
            padding-top: 3%;
        }

        body {
            background: #1abc9c;
        }

        img {
            width: 80%;
            height: 100%;
            background-color: grey;
        }

        .card .read-more:hover {
            font-size: 14px;
        }

        .card:hover {
            box-shadow: 8px 8px 8px #e1e1ff;
            transform: scale(1.05);
            transition: transform .4s;
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

        #pagination {
            padding-top: 5%;
        }

        .pagination > li > a {
            background-color: white;
            color: #513b86;
        }

        .pagination > li > a:focus,
        .pagination > li > a:hover,
        .pagination > li > span:focus,
        .pagination > li > span:hover {
            color: #5a5a5a;
            background-color: #eee;
            border-color: #ddd;
        }

        .pagination > .active > a {
            color: white;
            background-color: #513b86 !Important;
            border: solid 1px #513b86 !Important;
        }

        .pagination > .active > a:hover {
            background-color: #12002f !Important;
            border: solid 1px #513b86;
        }

    </style>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<?php
include "./navBar.html";
?>

<div id="main">

    <?php
    require_once"/home/jjb18169/DEVWEB/2020/1020Ex1/password.php";

    $host = "devweb2020.cis.strath.ac.uk";
    $user = "jjb18169";
    $password = get_password();
    $dbname = "jjb18169";

    //Connect to MySql
    $conn = new mysqli($host, $user, $password, $dbname);


    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }

    $no_of_records_per_page = 12;
    $offset = ($pageno - 1) * $no_of_records_per_page;

    $total_pages_sql = "SELECT COUNT(*) FROM `artListings`";
    $resultTotalPages = $conn->query($total_pages_sql);
    $total_rows = mysqli_fetch_array($resultTotalPages)[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);


    $sqlForPagination = "SELECT * FROM `artListings` LIMIT $offset, $no_of_records_per_page";

    $res_data = $conn->query($sqlForPagination);

    echo '<div class="container-fluid">
  <div class="row">';
    echo '<div class="row">';


    while ($row = mysqli_fetch_array($res_data)) {

        echo '
    <div class="col-6 col-md-4 col-lg-3 mb-4">
      <div class="card card-cascade wider text-center">
      <div class="view view-cascade overlay">
        <img class="card-img-top" src="data:image/jpeg;base64,' . base64_encode($row['artPhoto']) . ' "height=450" width="450" />
      </div>
        <div class="card-body">
          <h2 class="card-title"><span class="fa fa-external-link mr-1"></span><h4>

          ' . $row['name'] . '

          </h4>
          </h2>
              <p><h7>
              ' . $row['widthMM'] . " x " . $row['heightMM'] . 'cm
              </h7>
              </p>
              <form method="post" action="artPieceInfo.php">
                    <input type="submit" name="action" value="More" id="submit"/>
                      <input type="hidden" name="id" value= "' . $row['id'] . '" />
                   </form>
        </div>
      </div>
    </div>';

    }
    $conn->close();
    ?>
</div>

<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center" id="pagination">

        <li class="page-item"><a class="page-link" href="<?php if ($pageno <= 1) {
                echo '#';
            } else {
                echo "?pageno=" . ($pageno - 1);
            } ?>">Previous</a></li>
        <?php
        if ($pageno == 1) {
            ?>

            <li class="page-item disabled"><a class="page-link" href="<?php echo '#'; ?>">1</a></li>
            <li class="page-item"><a class="page-link"
                                     href="<?php echo "?pageno=" . ($pageno + 1); ?>"><?php echo $pageno + 1 ?></a></li>
            <li class="page-item"><a class="page-link"
                                     href="<?php echo "?pageno=" . ($pageno + 2); ?>"><?php echo $pageno + 2 ?></a></li>
            <?php
        } else if ($pageno == $total_pages) {
            ?>

            <li class="page-item"><a class="page-link"
                                     href="<?php echo "?pageno=" . ($pageno - 2); ?>"><?php echo $pageno - 2 ?></a></li>
            <li class="page-item"><a class="page-link"
                                     href="<?php echo "?pageno=" . ($pageno - 1); ?>"><?php echo $pageno - 1 ?></a></li>
            <li class="page-item disabled"><a class="page-link"
                                              href="<?php echo "?pageno=" . ($pageno + 2); ?>"><?php echo $pageno ?></a>
            </li>
            <?php
        } else {
            ?>
            <li class="page-item"><a class="page-link"
                                     href="<?php echo "?pageno=" . ($pageno - 1); ?>"><?php echo $pageno - 1 ?></a></li>
            <li class="page-item disabled"><a class="page-link" href="<?php echo '#'; ?>"><?php echo $pageno ?></a></li>
            <li class="page-item"><a class="page-link"
                                     href="<?php echo "?pageno=" . ($pageno + 1); ?>"><?php echo $pageno + 1 ?></a></li>

            <?php
        }
        ?>
        <li class="page-item"><a class="page-link" href="<?php if ($pageno >= $total_pages) {
                echo '#';
            } else {
                echo "?pageno=" . ($pageno + 1);
            } ?>">Next</a></li>

    </ul>
</nav>
</body>
</html>
