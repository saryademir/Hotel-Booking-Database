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




$sql="SELECT roomtypes.RoomTypeName, 
	COUNT(rooms.RoomID) AS BOOKINGNUM FROM bookings 
	INNER JOIN rooms ON rooms.RoomID = bookings.RoomID 
    INNER JOIN hotels ON hotels.HotelID = rooms.HotelID
	INNER JOIN roomtypes ON rooms.RoomTypeID =roomtypes.RoomTypeID
	WHERE hotels.HotelName = '$hotelName'  
	GROUP BY RoomTypeName";



$result = mysqli_query($conn,$sql) or die("100");


if (mysqli_num_rows($result) > 0) {
 
	echo "<table style='background-color:#DAE5D0;' border='4'>";
	echo '<span style="color:purple;font-size: 40px;">'."Booked Room Types and Booking Numbers for $hotelName ".'</span>';
	echo "<br><br>";
	echo "<tr style='background-color:#FEFBE7;'><td>Room Types</td><td>Number Of Bookings</td></tr>";
    while($row = mysqli_fetch_array($result)) {
		echo "<tr>";
        echo "<td>" . $row["RoomTypeName"] . "</td><td>" . $row["BOOKINGNUM"]. "</td>" ;
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