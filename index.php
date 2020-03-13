<?php
require "header.php";
require "config.php";
?>

<div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="images/c4.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="images/c5.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="images/c3.jpg" class="d-block w-100" alt="...">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<hr>
<h3 style="text-align: center;color: orange"> AVAILABLE HOUSES</h3>
<hr>
<div class="row">
    <div class="col col-sm-4 col-md-4 col-lg-4 col-xl-4" id="eez">
        <div class="card" style="">
            <!--          specify the details of the styles you want on you picture here-->

            <div class="card-body">
                <h4 class="card-title"></h4>
                <img src="images/c1.jpg" alt="web icon" style="height: 500px;width:100%">
                <p class="card-text"></p>
                <p class="card-text"></p>

                <!--            remember to add the url at the href-->
            </div>
        </div>
    </div><br><br><br>
    <div class="col col-sm-4 col-md-4 col-lg-4 col-xl-4" id="eez">
        <div class="card" style="">
            <!--specify the details of the styles you want on you picture here-->

            <div class="card-body">
                <h4 class="card-title"></h4>
                <img src="images/h1a.jpg" alt="web icon" style="height: 500px;width:100%">
                <p class="card-text"></p>
                <p class="card-text"></p>

                <!--            remember to add the url at the href-->
            </div>
        </div>
    </div>
    <div class="col col-sm-4 col-md-4 col-lg-4 col-xl-4" id="eez">
        <div class="card" style="">
            <!--          specify the details of the styles you want on you picture here-->
            <div class="card-body">
                <h4 class="card-title"></h4>
                <img src="images/r1.jpeg" alt="web icon" style="height: 500px;width:100%">
                <p class="card-text"></p>
                <p class="card-text"></p>

                <!--            remember to add the url at the href-->
            </div>
        </div>
    </div>
</div>
    <hr>
<h3 id="want">Would you like to specify the type of house you want?</h3>
    <hr>
<div class="container">
    <div class="row">
    <div class="col col-sm-6 col-md-6 col-lg-6 col-xl-6" id="wr">

        <a href="bedsitter.php" class="btn bg-warning">Bedsitters</a><br><br><br>
        <a href="two_bedroom.php" class="btn bg-warning">Two Bedroom</a>


    </div>
    <div class="col col-sm-6 col-md-6 col-lg-6 col-xl-6" id="wr">
        <a href="mansion.php" class="btn bg-warning">Mansion</a><br><br><br>
        <a href="bungalow.php" class="btn bg-warning">Bungalow</a>
    </div>
    </div>
</div><br><br><br>
<!--houses here-->
<div class="container">
    <div class="row">
        <?php
        $sql = "SELECT * FROM `houses`";
        $houses = mysqli_query($connection, $sql);
        while($row=  mysqli_fetch_assoc($houses)) {
            echo "<tr>";
            $id = $row['id'];

            $location = $row['location'];
            $price = $row['price'];
            $description = $row['description'];
            $condition = $row['condition'];
            $image = $row['image'];
            require 'card.php';
        }
        ?>
    </div>
</div>




<?php
require "footer.php"
?>