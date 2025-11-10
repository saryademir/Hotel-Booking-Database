<!DOCTYPE html>
<html>
<body>

<?php


$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "sarya_demir";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} 

$hotelName = $_POST['hotelname'];



$sql="SELECT travelagents.TravelAgentName AS AGENTNAME ,SUM(DATEDIFF(bookings.CheckOutDate,bookings.CheckInDate)*roomtypes.RoomPrice) AS PRICE FROM travelagents
	INNER JOIN bookings ON travelagents.TravelAgentID= bookings.TravelAgentID
	INNER JOIN rooms ON rooms.RoomID = bookings.RoomID
	INNER JOIN hotels ON rooms.HotelID = hotels.HotelID
    INNER JOIN roomtypes ON roomtypes.RoomTypeID= rooms.RoomTypeID
	WHERE hotels.HotelName = '$hotelName' 
    GROUP BY travelagents.TravelAgentName";



$result = mysqli_query($conn,$sql) or die("100");



if (mysqli_num_rows($result) > 0) {
    // output data of each row
	echo "<table  style='background-color:#DAE5D0;' border='4'>";
	echo '<span style="color:green;font-size: 40px;">'."Agency Names and Their Total Revenue For Hotel $hotelName ".'</span>';
	echo "<br><br>";
	echo "<tr style='background-color:#FEFBE7;'><td>Agency Name</td><td>Total Price</td></tr>";
    while($row = mysqli_fetch_array($result)) {
		echo "<tr>";
        echo "<td>" . $row["AGENTNAME"] . "</td><td>" . $row["PRICE"]. "</td>" ;
		echo "</tr>";
    }
	echo "</table>";
} else {
    echo "<br> 0 results <br>";
}
mysqli_close($conn);
?>
<html>
<body>