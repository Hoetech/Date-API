<?php
include 'connection.php';

$city = $_GET['city'];
echo '<script>let city = "'.$city.'"</script>';

$sql1 = "select * from city where name = '$city'";
$result1 = mysqli_query($conn, $sql1);

$sql2 = "select * from city where name = '$city'";
$result2 = mysqli_query($conn, $sql2);

$city_id = null;

while ($roww = mysqli_fetch_assoc($result2)) {
    $city_id = $roww['city_id'];
}

$sql3 = "select * from poi where city_id = $city_id";
$result3 = mysqli_query($conn, $sql3);


$sql4 = "select * from images where city_id = $city_id";
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
                    <script>city = "' . $row12['name'] . '";</script>
                    <script>let lat = ' . $row12['latitude'] . '</script>
                    <script>let lng = ' . $row12['longitude'] . '</script>
                    <h1 class="text-success my-3">' . $row12["name"] . '</h1>
                    <div class="row">
                        <div class="col-4">
                            <h5>Country: ' . $row12["country"] . '</h5>
                        </div>
                        <div class="col-4">
                            <h5>Currency: ' . $row12["currency"] . '</h5>
                        </div>
                        <div class="col-4">
                            <h5>Population: ' . $row12["population"] . '</h5>
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
        <div id="weather" class="row shadow p-4 rounded" style="margin-left: 13%; margin-right: 13%; background-color: white;">
            <div>
                <h2 class="text-success my-3">Weather Updates</h2>
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


    <div class="mt-5 bg-white text-center py-5" style="margin-left: 13%; margin-right: 13%;">
        <div>
            <h2 class="text-success my-3">Place Of Interest</h2>
        </div>
        <div class="row d-flex justify-content-center mx-2">
            <?php
            while ($row3 = mysqli_fetch_assoc($result3)) {
                echo '
                <div class="col-3 mt-4 text-center" style="cursor: pointer;">
                    <div class="shadow p-4" style="min-height: 350px;">
                    


                            <form method="GET" action="/rssfeed/poiRss.php">
                            <div class="row" style="margin-left: 15%; margin-right: 15%;">
                            
                                    <div class="col-3 text-center" style="cursor: pointer;">
                                        <input style="color: #269845;background-color: white; border: none; font-size: 24px" value="' . $row3['poi_id'] . '" name="poi_id" type="hidden"/>
                                        <input style="color: #269845;background-color: white; border: none; font-size: 18px" value="' . $row3['name'] . '" name="submit" type="submit"/>
                                    </div>
                                
                            </div>
                        </form>
                        <!-- <h2>' . $row3['name'] . '</h2> -->
                        <h5>Description:</h5>
                        <p>' . $row3['description'] . '</p>
                        <a href="' . $row3['wiki_url'] . '">View on wikipedia</a>
                        <p class="text-success mt-2">' . $row3['tags'] . '</p>
                    </div>
                </div>
                ';
            }
            ?>
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
                zoom: 8,
                center: location
            });
            var marker = new google.maps.Marker({
                position: location,
                map: map,
                title:'".$_GET['city']."'
            });
            const infowindow=new google.maps.InfoWindow({
            content:'".$_GET['city']."'
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

        
            const apiKey = '4c19da022ab950acda93445835dbda4a';
            // const city = 'London';
            const apiUrl = `https://api.openweathermap.org/data/2.5/forecast?q=${city}&units=metric&appid=${apiKey}`;

            // Group the weather data by day
            function groupByDay(list) {
                const days = {};
                list.forEach(item => {
                    const date = new Date(item.dt_txt).toLocaleDateString('en-US', {
                        weekday: 'long'
                    });
                    if (!days[date]) {
                        days[date] = [];
                    }
                    days[date].push(item);
                });
                return days;
            }

            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    console.log(data);

                    // Group the weather data by day
                    const days = groupByDay(data.list);

                    let w = document.getElementById("weather");
                    let div;

                    // Log the weather data for each day
                    for (const [date, items] of Object.entries(days)) {
                        const temperatures = items.map(item => item.main.temp);
                        const minTemperature = Math.min(...temperatures);
                        const maxTemperature = Math.max(...temperatures);
                        console.log(`${date}: min ${minTemperature}°C, max ${maxTemperature}°C`);
                        div = document.createElement("div");
                        div.classList.add('col');
                        div.classList.add('text-center');

                        let heading = document.createElement('h2');
                        heading.innerHTML = (minTemperature ).toFixed(2) + "°C";
                        heading.classList.add('text-success');

                        let dd = document.createElement('h4');
                        dd.innerHTML = date;
                        dd.classList.add('text-success');

                        div.appendChild(heading);
                        div.appendChild(dd);
                        w.appendChild(div);
                    }
                })
                .catch(error => console.log(error));
        
    </script>

    <script>
        function myCity(name) {
            console.log(name)
            window.location.assign("localhost/ressfeed/home.php?city=" + name);
        }
    </script>


</body>

</html>