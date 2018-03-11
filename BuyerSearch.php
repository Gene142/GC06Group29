Result Size: 705 x 640
<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
    border: 1px solid black;
}
</style>
</head>
<body>
<?php

$db = new mysqli('dbauction.mysql.database.azure.com', 'group29admin@dbauction', 'Ilovedatabases1', 'dbauction')
or	die('Could not connect: asas');
	

$sql = "SELECT * FROM items"
or die('error with qyery');
   		

$result = $db->query($sql)
or die('Error with queryHGDHD'.mysql_error()); 
if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Name</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["description"]."</td><td>".$row["endDate"]." ".$row["startPrice"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}


$db->close();


 ?>


</body>
</html>
