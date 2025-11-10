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
$sql = "SELECT distinct(hotels.HotelName) FROM hotels ";
$result = mysqli_query($conn,$sql) or die("Error");

	echo "<form action='BookingInfo.php' method='post'>";
	echo '<span style="color:red;font-size: 40px;"> ' . "SELECT HOTEL". '</span>';
	echo "<br><br>";
	echo '<span style=" font-size: 30px;"<label> Hotel name: </label> </span>';
	echo" ";
	echo '<select name="hotelname">';
	while($row = mysqli_fetch_array($result)) {
		echo "<option value='" . $row["HotelName"] . "'>";
        echo $row["HotelName"];
		echo "</option>";
    }
	echo '</select>';
	
	echo '<input type="submit" value="Submit">';
	echo "</form>";
mysqli_close($conn);
?>

</body>
</html>
