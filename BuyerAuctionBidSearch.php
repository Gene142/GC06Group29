<?php SESSION_START(); ?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php

$categoryId = $_POST['categoryId'];
$sortOption = $_POST['sortOption'];
echo "these are the posts: $categoryId and $sortOption";

$db = mysqli_connect('dbauction.mysql.database.azure.com', 'group29admin@dbauction', 'Ilovedatabases1', 'auction')
or  die('Could not connect: ');

$sql = "SELECT B.itemId, B.name, B.description, B.categoryId, A.bidAmount, B.endDate FROM (select itemId, max(bidAmount) AS bidAmount from bids group by itemId) as A RIGHT OUTER JOIN (SELECT itemId, name, description, startPrice, resPrice, categoryId, endDate from items WHERE endDate > CURRENT_TIMESTAMP() AND categoryId = '$categoryId') AS B ON A.itemId = B.itemId ORDER BY $sortOption;";
		
$result = $db->query($sql)
or die('Error with query'); 
echo '<tr>'."These Are the Current items on the category You have Searched For". '</tr>';
echo'<table border = "1">';



while ($row = $result->fetch_assoc()) {

echo '<tr><td>'."Name". '</td>'. '<td>' . $row['name'].'</td></tr>';
echo '<tr><td>' ."Item Description". '</td>'. '<td>' . $row['description'].'</td></tr>';
echo '<tr><td>' . "Bid Amount". '</td>'. '<td>' .'£'. $row['bidAmount'].'</td></tr>';
echo '<tr><td>' . "End Date". '</td>'. '<td>' .'£'. $row['endDate'].'</td></tr>';
echo '<tr><td>'."<a href='bidPage.php?id=".$row['itemId']."'>BID ON ITEM</a>".'</td>'. '<td>'."".'</td></tr>';

}



echo '</table>';

mysqli_close($db);
 ?>

 <form action = "BuyerAuctionBidSearch.php" method = "post">
	<input type="submit" value="A.bidAmount" name = 'sortOption' />
    <input type="submit" value="B.name" name = 'sortOption' />
    <input type="submit" value="B.endDate" name = 'sortOption' />
    <input type="hidden" name="categoryId" value="<?php echo $categoryId; ?>"/>
</form>

</body>
</html>

