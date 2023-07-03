<?php
// Establish a connection to the MySQL database
$host = 'localhost';
$username = 'root';
$password = "";
$database = 'rssfeed';

$IMAGE_BASE_LINK = "http://localhost/rssfeed/uploads/";
$map_Api="https://maps.googleapis.com/maps/api/js?key=AIzaSyAS1Pv5iszFTAnVUXEew8Q4_FCU7Xa6aa8&callback=initMap";
$weather_Api="https://api.openweathermap.org/data/2.5/forecast";

$connection = mysqli_connect($host, $username, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set the appropriate header for an XML file
header("Content-Type: application/rss+xml; charset=UTF-8");

// Create the RSS feed structure
$xml = new DOMDocument("1.0", "UTF-8");

// Create the root element <rss> and set its attributes
$rss = $xml->createElement("rss");
$rss->setAttribute("version", "2.0");

// Append the root element to the XML document
$xml->appendChild($rss);

// Create the <channel> element
$channel = $xml->createElement("channel");

// Create the <title>, <link>, and <description> elements for the channel
$title = $xml->createElement("title", "City and Places of Interest RSS Feed");
$link = $xml->createElement("link", "http://localhost/rssfeed/home.php");
$description = $xml->createElement("description", "RSS feed showcasing cities and places of interest");

// Append the title, link, and description elements to the channel
$channel->appendChild($title);
$channel->appendChild($link);
$channel->appendChild($description);

// Retrieve data from the database
$query = "SELECT * FROM city";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Create an <item> element for each city
        $item = $xml->createElement("item");

        // Create the <title>, <link>, <description>, and <pubDate> elements for the item
        $itemTitle = $xml->createElement("title", $row['name']);
        $itemLink = $xml->createElement("link", "http://localhost/rssfeed/city.php?city_id=" . $row['city_id']);
        $itemDescription = $xml->createElement("description", $row['description']);
        $itemPubDate = $xml->createElement("pubDate", date("D, d M Y H:i:s T"));

        // Append the title, link, description, and pubDate elements to the item
        $item->appendChild($itemTitle);
        $item->appendChild($itemLink);
        $item->appendChild($itemDescription);
        $item->appendChild($itemPubDate);

        // Append the item to the channel
        $channel->appendChild($item);
    }
}

// Append the channel to the root element
$rss->appendChild($channel);

// Output the XML content
echo $xml->saveXML();

// Close the database connection
mysqli_close($connection);
?>
