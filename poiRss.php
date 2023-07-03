<?php
include 'connection.php';

$poi_id = $_GET['poi_id'];

$sql1 = "select * from poi where poi_id = '$poi_id'";
$result1 = mysqli_query($conn, $sql1);

$sql3 = "select * from poi where poi_id = $poi_id";
$result3 = mysqli_query($conn, $sql3);


$sql4 = "select * from images where poi_id = $poi_id";
$result4 = mysqli_query($conn, $sql4);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">



    <style>
        body {
            background: rgb(81, 190, 158);
            background: linear-gradient(90deg, rgba(81, 190, 158, 1) 19%, rgba(110, 204, 142, 1) 100%, rgba(110, 204, 142, 1) 100%);
        }

        .container {
            background-color: white;
            padding: 20px !important;
            border-radius: .5rem;
        }

        label {
            color: #198754;
        }

        .owl-carousel .item img {
            display: block;
            width: 100%;
            height: auto;
        }
    </style>

</head>

<body>

    <div class="container">
        <div class="mx-5 d-flex justify-content-between">
            <div style="font-weight: 700; font-size: 18px; cursor: pointer;">
                <a href="/rssfeed/home.php">Home</a>
            </div>
            
        </div>
    </div>

    <div class="mt-5">
        <div class="shadow p-4 rounded" style="margin-left: 13%; margin-right: 13%; background-color: white;">
            <div>
                <?php
                while ($row12 = mysqli_fetch_assoc($result1)) {
                    echo '
                    <script>let lat = ' . $row12['latitude'] . '</script>
                    <script>let lng = ' . $row12['longitude'] . '</script>
                    <h1 class="text-success my-3">' . $row12["name"] . '</h1>
                    <div class="row">
                        <div class="col-4">
                            <h5>Wikipedia Url: ' . $row12["wiki_url"] . '</h5>
                        </div>
                        <div class="col-12 mt-3" style="font-weight: 600;">
                            <h5>Tags:</h5>
                            <p class="text-success">' . $row12["tags"] . '</p>
                        </div>
                        <div class="col-12 text-start mt-2">
                            <h5>Description:</h5>
                            <p>' . $row12["description"] . '</p>
                        </div>
                    </div>
                 ';
                }
                ?>

            </div>

        </div>
    </div>

    <div class="text-center mt-5">
        <div class="shadow p-4 rounded" style="margin-left: 13%; margin-right: 13%; background-color: white;">
            <div id="map" style="width: 100%; height: 400px;"></div>
        </div>
    </div>


    <div class="shadow p-4 rounded bg-white mt-5" style="margin-left: 13%; margin-right: 13%;">
        <div class="owl-carousel">
            <?php
            while ($row4 = mysqli_fetch_assoc($result4)) {
                echo '<div class="item"><img src="' . $row4["file"] . '"></div>';
            }
            ?>
            <!--             
            <div class="item"><img src="uploads/ERD1.png"></div>
            <div class="item"><img src="uploads/ERD1.png"></div>
            <div class="item"><img src="uploads/ERD1.png"></div>
            <div class="item"><img src="uploads/ERD1.png"></div>
            <div class="item"><img src="uploads/ERD1.png"></div> -->
        </div>
    </div>

    <?php


echo "

    <script>
        function initMap() {
            var location = {
                lat: lat,
                lng: lng
            };
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 14,
                center: location
            });
            var marker = new google.maps.Marker({
                position: location,
                map: map,
                title:'".$_GET['submit']."'
            });
            const infowindow=new google.maps.InfoWindow({
            content:'".$_GET['submit']."'
        })
        infowindow.open(map,marker);
            
        }
        
    </script>
    ";
    
    ?>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAS1Pv5iszFTAnVUXEew8Q4_FCU7Xa6aa8&callback=initMap">
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>


    <script>
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 5
                    }
                }
            })
        });
    </script>

    <script>
        function myCity(name) {
            console.log(name)
            window.location.assign("localhost/ressfeed/home.php?city=" + name);
        }
    </script>


</body>

</html>