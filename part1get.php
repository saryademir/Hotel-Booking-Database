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
$sql = "SELECT CityName FROM cities ";
$result = mysqli_query($conn,$sql) or die("Error");
echo '<span style="color:red;font-size: 30px;">'."Enter start and end date to see number of booked rooms between these dates".'</span>';
echo "<br><br>";
	echo "<form action='part1show.php' method='post'>";
	//echo '<label for = "cityname">City Names:</label>';
	echo '<span style=" color:pink;font-size: 25px;"<label for = "cityname">City Names:</label> </span>';
	echo '<select name="cityname">';
	while($row = mysqli_fetch_array($result)) {
		echo "<option value='" . $row["CityName"] . "'>";
        echo $row["CityName"];
		echo "</option>";
    }
	echo '</select>';
	

	echo "<br><br>";
	echo '<span style=" color:pink;font-size: 25px; <label for="Booking1Date">Date 1:</label> </span>';
 	echo '<input type="date" id="Booking1Date" name="Booking1Date">';
 	echo "<br><br>";
	echo '<span style=" color:pink;font-size: 25px; <label for="Booking2Date">Date 2:</label> </span>';
 	echo '<input type="date" id="Booking2Date" name="Booking2Date">';
 	echo "<br><br>";
	echo '<input type="submit" value="Submit">';
	echo "</form>";
mysqli_close($conn);
?>

</body>
</html>
