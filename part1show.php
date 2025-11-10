<!DOCTYPE html>
<html>
<body>

<?php


$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "sarya_demir";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} 

$cityname = $_POST['cityname'];
$date1=$_POST['Booking1Date'];
$date2=$_POST['Booking2Date'];


$sql="SELECT hotels.HotelName, 
	COUNT(rooms.RoomID) AS BOOKINGNUM FROM bookings 
	INNER JOIN rooms ON rooms.RoomID = bookings.RoomID 
	INNER JOIN hotels ON rooms.HotelID = hotels.HotelID 
	INNER JOIN cities ON hotels.CityID = cities.CityID
	WHERE cities.CityName = '$cityname'  
	AND  DATE(Bookings.BookingDate) BETWEEN '$date1' AND '$date2'
	GROUP BY HotelName";

$result = mysqli_query($conn,$sql) or die("100");

if (mysqli_num_rows($result) > 0) {
    // output data of each row
	echo "<table style='background-color:#DAE5D0;'border='4'>";
	echo '<span style="color:purple;font-size: 40px;">'."Number of Booked Rooms Between the Selected Dated For City $cityname ".'</span>';
	echo "<br><br>";
	echo "<tr style='background-color:#FEFBE7;'><td>Hotel Name</td><td>Number Of Bookings</td></tr>";
    while($row = mysqli_fetch_array($result)) {
		echo "<tr>";
        echo "<td>" . $row["HotelName"] . "</td><td>" . $row["BOOKINGNUM"]. "</td>" ;
		echo "</tr>";
    }
	echo "</table>";
	echo "<br><br>";
	echo '<span style="font-size: 20px;">'."Data has been choosen between dates $date1 and $date2 ".'</span>';
	
} else {
    echo "<br> 0 results <br>";
}

echo "<br><br>";
echo '<span style="color:red;font-size: 25px;">'."Click Go To Part 2 if you want to continue".'</span>';
echo "<br><br>";
echo "<form action='SelectHotel.php' method='post'>";
	echo '<input type="submit" value="Go To Part 2">';
	echo "</form>";
mysqli_close($conn);
?>
<html>
<body>