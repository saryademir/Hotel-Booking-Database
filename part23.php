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

$hotelName = $_POST['hotelname'];
$agency= $_POST['agencyname'];




$sql="SELECT bookings.TravelAgentName AS AGENTNAME, bookings.BookingDate AS BOOKINGDATE ,bookings.CheckInDate AS CHECKINDATE, bookings.CheckOutDate AS CHECKOUTDATE, bookings.ClientID AS ClIENTID,bookings.BookingID AS BOOKINGID,bookings.RoomID AS ROOMID,bookings.TravelAgentID AS TRAVELAGENTID FROM bookings
	INNER JOIN rooms ON rooms.RoomID = bookings.RoomID
	INNER JOIN hotels ON rooms.HotelID = hotels.HotelID
    INNER JOIN roomtypes ON roomtypes.RoomTypeID= rooms.RoomTypeID
	WHERE hotels.HotelName = '$hotelName' AND bookings.TravelAgentName ='$agency'  ";



$result = mysqli_query($conn,$sql) or die("100");


if (mysqli_num_rows($result) > 0) {
    // output data of each row
	echo "<table style='background-color:#DAE5D0;' border='4'>";
	echo '<span style="color:orange;font-size: 40px;">'."Booking Information of Selected Agency For Hotel $hotelName ".'</span>';
	echo "<br><br>";
	 echo "<tr style='background-color:#FEFBE7;'><td>Booking ID</td><td>Agent Name</td><td>Travel Agent ID</td><td>Booking Date</td><td>Check In Date</td><td>Check Out Date</td><td>Client ID</td><td>Room ID</td></tr>";
    while($row = mysqli_fetch_array($result)) {
		echo "<tr >";
		 echo "<td >" . $row["BOOKINGID"] . "</td>";
        echo "<td >" . $row["AGENTNAME"] . "</td>";
		echo "<td >" . $row["TRAVELAGENTID"] . "</td>";
		echo "<td>" . $row["BOOKINGDATE"]. "</td>";
		echo "<td>" .$row["CHECKINDATE"] . "</td>";
		echo  "<td>" . $row["CHECKOUTDATE"].  "</td>" ;
		echo "<td>".$row["ClIENTID"] . "</td>";
		 echo "<td >" . $row["ROOMID"] . "</td>";
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