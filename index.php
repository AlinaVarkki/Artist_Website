<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="resources\logo.png"/>

    <title>About Cara</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<style>
    html, body {
        height: 100%;
        background: #513b86;
    }

    .carousel {
        background: ;
    }

    .carousel-item {
        max-height: 94vh;
    }

    .carousel-item img {
        max-height: 94vh;
    }

    .bg-1 {
        background-color: #1abc9c;
        color: #ffffff;
    }

    .bg-2 {
        background-color: #474e5d;
        color: #ffffff;
    }

    .bg-3 {
        background-color: #ffffff;
        color: #555555;
    }

    .container-fluid {
        padding-top: 80px;
        padding-bottom: 60px;
    }

    .nopadding {
        padding: 0 !important;
        margin: 0 !important;
    }

    .fa {
        padding: 8%;
        font-size: 30px;
        width: 30px;
        text-align: center;
        text-decoration: none;
        margin: 5px 2px;
        border-radius: 50%;
    }

    .fa-instagram {
        background: #125688;
        color: white;
    }

    .fa-tumblr {
        background: #2c4762;
        color: white;
    }

    .fa-pinterest {
        background: #cb2027;
        color: white;
    }


    .pad-right {
        padding-right: 25%;
    }

    .pad-left {
        padding-left: 30%;
    }
</style>
<body>

<?php
include "./navBar.html";
?>

<div class="container-fluid bg-1 text-center">
    <h3>Who Am I?</h3>
    <img src="resources\Darina.png" class="img-circle" alt="Bird" width="350" height="350">
    <h3>I'm an artist</h3>
    <h3>Here is proof</h3>
</div>

<div class="bd-example" align="center">
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="resources\beltsEst.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Vöökirja saladus (Secret of the belt pattern)</h5>
                    <p>The traditional Estonian belt has a mystical power of protecting the body from sickness and
                        evil.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="resources\goldenkings.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5> Golden Kings of the Woods</h5>
                    <p>Inspired by a song by an awesome Estonian folk band @tradattack</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="resources\estonian.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>The Estonian</h5>
                    <p>Blessed by the rye bread spirits.</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="container-fluid bg-2 text-center">
        <h3>What Am I?</h3>
        <p>Cara (Darina), 21, from Estonia. Currently studying architecture at the University of Sheffield. Obsessed
            with nature, fantasy, colours, dreams, and witchcraft. That kid in movies who accidentally finds the dead
            body in the woods.
        </p>
        <p> All the images on sale are guaranteed to have been made with love for art and Estonian swamps. Generally, I
            just like to create things I wish existed.
            Here is one of my self-portraits with my likes and dislikes
        </p>
    </div>

    <div class="container-fluid" style="margin-top:-80px">
        <div class="row">
            <div class="col-sm-4 col-xs-4 nopadding"><img src="resources\likesdis.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="col-sm-4 col-xs-4  " style="background: #1abc9c">
                <br>
                <p>
                <h3 style="color: white">Where To Find Me?</h3>
                </p>
                <p>
                <h3 style="color: white">Click below!</h3>
                </p>
                <br>
                <div class="flex-column pad-right">
                    <p><a href="https://www.instagram.com/darinster/ " target="_blank" class="fa fa-instagram"></a>
                    </p>
                </div>
                <div class="flex-column pad-left">
                    <p><a href="https://gr.pinterest.com/darinster/_saved/" target="_blank"
                          class="fa fa-pinterest"></a></a></p>
                </div>
                <div class="flex-column">
                    <p><a href="https://darinster.tumblr.com/" target="_blank" class="fa fa-tumblr"></a></p>
                </div>
            </div>

            <div class="col-sm-4 col-xs-4  nopadding"><img src="resources\DarinaPor.jpg" class="d-block w-100"
                                                           alt="..."></div>
        </div>
    </div>

</div>
</body>
</html>
