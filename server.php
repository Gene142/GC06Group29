<?php

$fname = $_POST ["firstName"];
$lname = $_POST ["lastName"];
$email = $_POST ["email"];
$password = $_POST ["password"];
$address = $_POST["address"];



$db = mysqli_connect('dbauction.mysql.database.azure.com', 'group29admin@dbauction', 'Ilovedatabases1', 'auction')
or die ('could not connect to database');
    

$sql = "INSERT INTO buyers(firstName, lastName, email, password, address) 
VALUES('$fname','$lname', '$email', '$password', '$address')";


if ($db -> query ($sql) === TRUE )
{
  	header('location: index.html');
} else {
echo "error: " .$sql. "<br> " . $db -> error;
}
$db -> close ();

?> 

