<!DOCTYPE html>
<html>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "sarya_demir";

$conn = mysqli_connect($servername,$username,$password,$dbname);
if(!$conn){
	die("Connect fail:" . mysqli_connect_error());
}
$sql = "SELECT HotelID FROM Hotels ";
$result = mysqli_query($conn,$sql) or die("Error");




$hotelName= $_POST['hotelname'];

echo '<span style="color:blue; font-size: 35px;"> '."Selected Hotel is: $hotelName ".'</span>';

echo "<br>";
echo '<span style=" font-size: 25px;"> '."<br> Click on the Room Type button to see which room type has been booked how many times For Hotel
 ".'</span>';
	echo "<form action='part21.php' method='post'>";
	echo '</select> <textarea name="hotelname" rows="1" cols="11" >'.$hotelName.'</textarea>';
	echo '<input type ="submit" id="hotelName" value =" Room Type ">';
	echo "</form>";


echo '<span style=" font-size: 25px;"> '."<br> Click on an Agency button to see how much money agencies made from the booked rooms For Hotel".'</span>';
	echo "<form action='part22.php' method='post'>";
	echo '</select> <textarea name="hotelname" rows="1" cols="11" >'.$hotelName.'</textarea>';
	echo '<input type ="submit" id="hotelName" value =" Agency ">';
	echo "</form>";
	
	
$sql = "SELECT TravelAgentName FROM travelagents";
$result = mysqli_query($conn,$sql) or die("Error");

echo '<span style=" font-size: 25px;"> '."<br> Choose an agency to see all the booking information of that agency For Hotel".'</span>';
	echo "<form action='part23.php' method='post'>";
	echo '</select> <textarea name="hotelname" rows="1" cols="11" >'.$hotelName.'</textarea>';
	echo '<label for = "agencyname"> Agency Name:</label>';
	echo '<select name="agencyname">';
	while($row = mysqli_fetch_array($result)) {
		echo "<option value='" . $row["TravelAgentName"] . "'>";
        echo $row["TravelAgentName"];
		echo "</option>";
    }
	echo '</select>';
	echo '<input type ="submit" id="hotelName" value =" GO ">';
	echo "</form>";
	

$sql = "SELECT distinct(ClientName) FROM clients";
$result = mysqli_query($conn,$sql) or die("100");
	
echo '<span style=" font-size: 25px;"> '."<br> Choose a client name to see the booking information ".'</span>';
	echo "<form action='part24.php' method='post'>";
	echo '</select> <textarea name="hotelname" rows="1" cols="11" >'.$hotelName.'</textarea>';
	echo '<label for = "clientname">   Client Name:   </label>';
	echo '<select name="clientname">';

		
	$sql="	SELECT clients.ClientName AS NAME,hotels.HotelName AS HOTELNAME FROM bookings
	INNER JOIN clients ON clients.ClientID= bookings.ClientID
	INNER JOIN rooms ON rooms.RoomID = bookings.RoomID
	INNER JOIN hotels ON rooms.HotelID = hotels.HotelID
    INNER JOIN roomtypes ON roomtypes.RoomTypeID= rooms.RoomTypeID
	WHERE hotels.HotelName = '$hotelName' ";
	$result = mysqli_query($conn,$sql) or die("100");
	
	while($row = mysqli_fetch_array($result)) {
		echo "<option value='" . $row["NAME"] . "'>";
        echo $row["NAME"];
		echo "</option>";
    }
	echo '</select>';
	echo '<input type ="submit" id="hotelName" value =" GO ">';
	echo "</form>";
	
mysqli_close($conn);
?>

</body>
</html>
