<?php
//Step1
$fname = $_POST["fName"];
$lname = $_POST["lName"];

 $db = mysqli_connect('localhost','root','root','testConnection')
 or die('Error connecting to MySQL server dammit');


$sql = "INSERT INTO tested (firstName, lastName)
VALUES ('$fname', '$lname')";


if ($db->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}

$db->close();
?>

