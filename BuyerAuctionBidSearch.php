<?php SESSION_START(); ?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php

$categoryId = $_POST['categoryId'];
$sortOption = $_POST['sortOption'];

$db = mysqli_connect('dbauction.mysql.database.azure.com', 'group29admin@dbauction', 'Ilovedatabases1', 'auction')
or  die('Could not connect: ');

$sql = "SELECT C.sellerId, C.itemId, C.name, C.description, C.categoryId, C.bidAmount, C.endDate, D.total, C.resPrice FROM
(SELECT B.sellerId, B.itemId, B.name, B.description, B.categoryId, A.bidAmount, B.endDate, B.resPrice FROM 
(select itemId, max(bidAmount) AS bidAmount from bids group by itemId) as A RIGHT OUTER JOIN 
(SELECT itemId, name, description, startPrice, resPrice, categoryId, endDate, sellerId from items WHERE endDate > CURRENT_TIMESTAMP() AND categoryId = '$categoryId') AS B ON A.itemId = B.itemId) AS C LEFT OUTER JOIN
 (SELECT SUM(pointsGiven) AS total, sellerId from feedback GROUP BY sellerId) AS D ON D.sellerId = C.sellerId ORDER BY $sortOption ;";
$result = $db->query($sql)
or die('Error with query2 $sortOption and $categoryId'); 
echo '<tr>'."These Are the Current items on the category You have Searched For". '</tr>';
echo'<table border = "1">';



while ($row = $result->fetch_assoc()) {

echo '<tr><td>'."Name". '</td>'. '<td>' . $row['name'].'</td></tr>';
echo '<tr><td>' ."Item Description". '</td>'. '<td>' . $row['description'].'</td></tr>';
echo '<tr><td>' . "Bid Amount". '</td>'. '<td>' .'£'. $row['bidAmount'].'</td></tr>';
echo '<tr><td>' . "End Date". '</td>'. '<td>' .'£'. $row['endDate'].'</td></tr>';
echo '<tr><td>' . "Seller Feedback Points". '</td>'. '<td>' .'£'. $row['total'].'</td></tr>';
echo '<tr><td>'."<a href='bidPage.php?id=".$row['itemId']."'>BID ON ITEM</a>".'</td>'. '<td>'."".'</td></tr>';

}



echo '</table>';

mysqli_close($db);
 ?>

 <form action = "BuyerAuctionBidSearch.php" method = "post">
	<button type="submit" value="IFNULL(C.bidAmount, C.resPrice)" name = 'sortOption'>Sort By Price</button>
    <button type="submit" value="C.name" name = 'sortOption'>Sort By Name</button>
    <button type="submit" value="C.endDate" name = 'sortOption'>Sort By End Date</button>
    <button type="submit" value="D.total" name = 'sortOption'>Sort By User Rating</button>
    <input type="hidden" name="categoryId" value="<?php echo $categoryId; ?>"/>
</form>

</body>
</html>

