<?php
SESSION_START();

$categoryId = $_POST['categoryId'];


$db = mysqli_connect('dbauction.mysql.database.azure.com', 'group29admin@dbauction', 'Ilovedatabases1', 'auction')
or  die('Could not connect: ');

$sql = "SELECT A.itemId, B.name, B.description, B.categoryId, A.bidAmount FROM (select itemId, max(bidAmount) AS bidAmount from bids group by itemId) as A JOIN (SELECT itemId, name, description, startPrice, resPrice, categoryId, endDate from items) AS B ON A.itemId = B.itemId";

		
$result = $db->query($sql)
or die('Error with query'); 
echo '<tr>'."These Are the Current items on the category You have Searched For". '</tr>';
echo'<table border = "1">';



while ($row = $result->fetch_assoc()) {

echo '<tr><td>'."Name". '</td>'. '<td>' . $row['name'].'</td></tr>';
echo '<tr><td>' ."Item Description". '</td>'. '<td>' . $row['description'].'</td></tr>';
echo '<tr><td>' . "Bid Amount". '</td>'. '<td>' .'£'. $row['bidAmount'].'</td></tr>';
echo  '<tr><th colspan="8"><br/><hr width="100%"></th><tr>'
	
}



echo '</table>';

mysqli_close($db);




 ?>

