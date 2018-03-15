<?php

$fname = $_POST ["firstName"];
$lname = $_POST ["lastName"];
$email = $_POST ["email"];
$address = $_POST ["address"];
$password = $_POST ["password"];

$db = mysqli_connect('dbauction.mysql.database.azure.com', 'group29admin@dbauction', 'Ilovedatabases1', 'auction')
or die ('could not connect to database');

    

$sql = "INSERT INTO seller (firstName, lastName, email, address, password) 
VALUES('$fname','$lname', '$email', $address ,'$password')";

if ($db -> query ($sql) === TRUE )
{
echo "New Record Successfully Created" ;
} else {
echo "error: " .$sql. "<br> " . $db -> error;
}
$db -> close ();

?> 