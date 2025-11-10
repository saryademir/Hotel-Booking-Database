<?php 
$servername = "localhost";
$username = "root";
$password = "mysql";

$conn = new mysqli($servername, $username, $password);

set_time_limit(600);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "DROP DATABASE IF EXISTS sarya_demir";
$result = mysqli_query($conn,$sql);
$sql = "CREATE DATABASE IF NOT EXISTS sarya_demir";
$result = mysqli_query($conn,$sql);
if ($conn->query($sql) === TRUE) {   echo "Database  created successfully\n"; } else {   echo "Error creating database: " . $conn->error; }
$conn->close();
 ?>
 
 <?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "sarya_demir";
$conn = mysqli_connect($servername, $username, $password);
echo "Connected";
$sql = "USE sarya_demir;";

$result = mysqli_query($conn,$sql) or die("10");

$sql = "CREATE TABLE IF NOT EXISTS `Districts`
		(`DistrictID` INT NOT NULL AUTO_INCREMENT,
		`DistrictName` VARCHAR(40) NOT NULL,
		PRIMARY KEY(`DistrictID`)) ENGINE = InnoDB";
		
$result = mysqli_query($conn,$sql) or die("11");

$sql ="CREATE TABLE IF NOT EXISTS `Cities`
	(`CityID`INT NOT NULL AUTO_INCREMENT, 
	`CityName` VARCHAR(40) NOT NULL,
	`DistrictID`INT NOT NULL, 
	FOREIGN KEY fk_Cities_DistrictID(`DistrictID`) 
		REFERENCES Districts(`DistrictID`),
	PRIMARY KEY(`CityID`)) ENGINE = InnoDB";
		
$result = mysqli_query($conn,$sql) or die("12");

$sql = "CREATE TABLE IF NOT EXISTS `Clients`
		(`ClientID`INT NOT NULL AUTO_INCREMENT,
		`ClientName` VARCHAR(50) NOT NULL,
		PRIMARY KEY(`ClientID`))ENGINE = InnoDB";
		
$result = mysqli_query($conn,$sql) or die("13");

$sql = "CREATE TABLE IF NOT EXISTS `TravelAgents`
		(`TravelAgentID`INT NOT NULL AUTO_INCREMENT,
		`TravelAgentName` VARCHAR(50) NOT NULL,
		PRIMARY KEY(`TravelAgentID`))ENGINE = InnoDB";
		
		
$result = mysqli_query($conn,$sql) or die("14");


$sql = "CREATE TABLE IF NOT EXISTS `Hotels`
		(`HotelID`INT NOT NULL AUTO_INCREMENT,
		`HotelName` VARCHAR(50),
		`CityID`INT NOT NULL, 
		FOREIGN KEY fk_Hotels_CityID(`CityID`) 
			REFERENCES Cities(`CityID`),
		PRIMARY KEY(`HotelID`)) ENGINE = InnoDB";
		
$result = mysqli_query($conn,$sql) or die("15");

$sql = "CREATE TABLE IF NOT EXISTS `RoomTypes`
		(`RoomTypeID`INT NOT NULL AUTO_INCREMENT,
		`RoomTypeName` VARCHAR(50) NOT NULL,
		`RoomPrice` INT NOT NULL,
		PRIMARY KEY(`RoomTypeID`))ENGINE = InnoDB";
		
$result = mysqli_query($conn,$sql) or die("15");

$sql ="CREATE TABLE IF NOT EXISTS `Rooms`
	(`RoomID`INT NOT NULL AUTO_INCREMENT, 
	`RoomTypeID`INT NOT NULL, 
	`HotelID`INT NOT NULL, 
	FOREIGN KEY fk_Rooms_RoomTypeID(`RoomTypeID`) 
		REFERENCES RoomTypes(`RoomTypeID`),
	FOREIGN KEY fk_Rooms_HotelID(`HotelID`) 
		REFERENCES Hotels(`HotelID`),
	PRIMARY KEY(`RoomID`)) ENGINE = InnoDB";
		
	
$result = mysqli_query($conn,$sql) or die("16");

$sql = "CREATE TABLE IF NOT EXISTS `Bookings`
	(`BookingID` INT NOT NULL AUTO_INCREMENT, 
	`BookingDate` DATE NOT NULL,
	`CheckInDate` DATE NOT NULL,
	`CheckOutDate` DATE NOT NULL,
	`RoomID` INT NOT NULL, 
	`TravelAgentName` VARCHAR(50), 
	`TravelAgentID` INT NOT NULL, 
	`ClientID` INT NOT NULL, 
	FOREIGN KEY fk_Bookings_RoomID(`RoomID`) 
		REFERENCES Rooms(`RoomID`),
	FOREIGN KEY fk_Bookings_TravelAgentID(`TravelAgentID`) 
		REFERENCES TravelAgents(`TravelAgentID`),
	FOREIGN KEY fk_Bookings_ClientID(`ClientID`) 
		REFERENCES Clients(`ClientID`),
	PRIMARY KEY(`BookingID`))ENGINE = InnoDB";
	
$result = mysqli_query($conn,$sql) ;

		if ($result === FALSE) 
			{
				printf("error: %s\n", mysqli_error($conn));
			}
	


$sql = "CREATE TABLE IF NOT EXISTS `Facilities`
		(`FacilityID`INT NOT NULL AUTO_INCREMENT,
		`FacilityName` VARCHAR(40) NOT NULL,
		`HotelID`INT NOT NULL,
		FOREIGN KEY fk_Facilities_HotelID(`HotelID`) 
			REFERENCES Hotels(`HotelID`), 
		PRIMARY KEY(`FacilityID`))ENGINE = InnoDB";
		
$result = mysqli_query($conn,$sql) or die("18");

if(($handle = fopen("Districts.csv", 
                        "r")) !== FALSE) {
            $n = 1;
            while(($row = fgetcsv($handle)) 
                                !== FALSE) {
 
				$sql = "INSERT into districts(DistrictName)
                values('$row[0]')";
	$result = mysqli_query($conn,$sql) or die("190");
				

			}
			fclose($handle);
						}
				
						
if(($handle = fopen("TravelAgents.csv", 
                        "r")) !== FALSE) {
            $n = 1;
            while(($row = fgetcsv($handle)) 
                                !== FALSE) {
 
				$sql = "INSERT into travelagents(TravelAgentName)
                values('$row[0]')";
	$result = mysqli_query($conn,$sql) or die("400");
				

			}
			fclose($handle);
						}
					

if(($handle = fopen("RoomType.csv", 
                        "r")) !== FALSE) {
            $n = 1;
            while(($row = fgetcsv($handle)) 
                                !== FALSE) {
  
                
				$sql = "INSERT into roomtypes(RoomTypeName,RoomPrice)
                values('$row[0]','$row[1]')";
	$result = mysqli_query($conn,$sql) ;
			if ($result === FALSE) 
			{
				printf("error: %s\n", mysqli_error($conn));
			}
	
				

			}
			fclose($handle);
		
						}


if(($handle = fopen("Citys.csv", 
                        "r")) !== FALSE) {
            $n = 1;
            while(($row = fgetcsv($handle)) 
                                !== FALSE) {
 
				$sql = "INSERT into cities(CityName,DistrictID)
                values('$row[0]','$row[1]')";
	$result = mysqli_query($conn,$sql);
		if ($result === FALSE) 
			{
				printf("error: %s\n", mysqli_error($conn));
			}
	
				

			}
			fclose($handle);
						}		
$array1=array();
if(($handle = fopen("Hotel.csv", 
                        "r")) !== FALSE) {
            $n = 1;
            while(($row = fgetcsv($handle)) 
                                !== FALSE) {
 
					$array1[]=$row[0];

		if ($result === FALSE) 
			{
				printf("error: %s\n", mysqli_error($conn));
			}
	
				

			}
			fclose($handle);
						}								

$j=0;
$tmp=1;
$c=1;
for($x=1;$x<=81;$x++)
{
		
	for($i=0;$i<5;$i++)
	{
		
		
			$z=rand(0,9);
				$sql = "INSERT into hotels(CityID,HotelName) 
		values('$x','$array1[$z]')"; //hotel id tut
				$c++;
				
				$result = mysqli_query($conn,$sql);
		}
	
	
	
	
}	


$facilityArrayName=array();
if(($handle = fopen("Facility.csv", 
                        "r")) !== FALSE) {
            $n = 1;
            while(($row = fgetcsv($handle)) 
                                !== FALSE) {
 
				
				$facilityArrayName[]=$row[0];
	$result = mysqli_query($conn,$sql) or die("20");
				

			}
			fclose($handle);
						}
$m=0;	
for($x=1;$x<405;$x++)
{
	$m=0;
	while($m<10)
	{
		$sql = "INSERT into facilities(FacilityName,HotelID)
                values('$facilityArrayName[$m]','$x')";
		
		$result = mysqli_query($conn,$sql);
		$m++;
		
	}
	$m=0;
}


$j=0;
for($i=1;$i<=405;$i++)
{
	for($x=0;$x<30;$x++)
	{
		$tmp=rand(1,5);
		$sql = "INSERT into rooms(RoomTypeID,HotelID)
                values('$tmp','$i')";
		$result = mysqli_query($conn,$sql) ;
		if ($result === FALSE) 
			{
				printf("error: %s\n", mysqli_error($conn));
			}
	}
}

$names=array();
$surnames=array();
if(($handle = fopen("Name.csv", 
                        "r")) !== FALSE) {
            $n = 1;
            while(($row = fgetcsv($handle)) 
                                !== FALSE) {
  
                
								$names[]=$row[0];
	$result = mysqli_query($conn,$sql) or die("50");
				

			}
			fclose($handle);
			
						}	
if(($handle = fopen("Surname.csv", 
                        "r")) !== FALSE) {
            $n = 1;
            while(($row = fgetcsv($handle)) 
                                !== FALSE) {
  
                
								$surnames[]=$row[0];
	$result = mysqli_query($conn,$sql) or die("50");
				

			}
			fclose($handle);
						}			
$tempName = NULL;
$tempSurname = NULL;
$temp=NULL;
$name=NULL;
$surname=NULL;
	

for($i=1;$i<1620;$i++)
{
	
	$tempName= rand(1,499);

	$tempSurname= rand(1,499);
	
	$name=$names[$tempName];
	
	$surname=$surnames[$tempSurname];
	$temp=$name." ".$surname;

	$sql = "INSERT into clients(ClientName)
                values('$temp')";
	$result = mysqli_query($conn,$sql) or die("100");
	
}

$result = mysqli_query($conn,$sql) or die("18");


if(($handle = fopen("Bookings.csv", 
                        "r")) !== FALSE) {
            $n = 1;
            while(($row = fgetcsv($handle)) 
                                !== FALSE) {
 
				$sql = "INSERT into bookings(ClientID,RoomID,TravelAgentName,TravelAgentID,BookingDate,CheckInDate,CheckOutDate)
                values('$row[0]','$row[1]','$row[2]','$row[3]','$row[4]','$row[5]','$row[6]')";
				
	$result = mysqli_query($conn,$sql) ;
				if ($result === FALSE) 
			{
				printf("error: %s\n", mysqli_error($conn));
			}

			}
			fclose($handle);
						}

								
?>