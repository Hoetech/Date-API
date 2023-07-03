<?php
include 'connection.php';

$sql1 = "select * from city";
$result1 = mysqli_query($conn, $sql1);
$rss_feed_url = "http://localhost/rssfeed/rss.xml";

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

    <div class="container mt-5 text-center py-5">
        <h1 class="mt-2 mb-3 text-success"> Twin CITIES</h1>


        <form method="GET" action="/rssfeed/cityRss.php">
            <div class="row" style="margin-left: 40%; margin-right: 15%;">
                <?php
                while ($row = mysqli_fetch_assoc($result1)) {
                    echo '
                
                <div class="col-3 text-center" style="cursor: pointer;">
                    <i class="fas fa-map" style="color:#198754; font-size: 60px;"></i><br>
                    <input style="color: #269845;background-color: white; border: none; font-size: 24px" value="' . $row['name'] . '" name="city" type="submit"/>
                 </div>
                 ';
                }
                ?>
            </div>
        </form>



    </div>

    <script>
        function myCity(name) {
            console.log(name)
            window.location.assign("localhost/ressfeed/home.php?city=" + name);
        }
    </script>


</body>

</html>?