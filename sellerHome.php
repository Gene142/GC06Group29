<?php SESSION_START(); ?>
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
//continue session, get data
$userFirstName = $_SESSION['userFirstName'];
$buyerId = $_SESSION['userId'];
echo "Welcome to your home $userFirstName, listed below are your auctions!";
//create connection to DB
$db = new mysqli('dbauction.mysql.database.azure.com', 'group29admin@dbauction', 'Ilovedatabases1', 'auction')
or  die('Could not connect: ');

//query
$sql  = "SELECT A.itemId, A.name, A.description, A.startPrice, A.resPrice, A.endDate, A.currentBid, B.highestBid FROM (SELECT DISTINCT(b.itemId), i.name, i.description, i.startPrice, i.resPrice, i.endDate, MAX(bidAmount) AS currentBid FROM items i, bids b WHERE b.buyerId = '$buyerId' AND b.itemId = i.itemId GROUP BY itemId) AS A JOIN (SELECT DISTINCT(b.itemId), MAX(bidAmount) AS highestBid FROM items i, bids b WHERE b.itemId = i.itemId GROUP BY itemId) AS B ON A.itemId = B.itemId"
or die('error with query');
//run query, get all bids
$result = $db->query($sql)
or die('Error with query'); 
if ($result->num_rows > 0) {
    echo "<table><tr><th>Description</th><th>Name</th><th>Start Price</th><th>End Date</th><th>Last Bid Placed ($)</th><th>Highest Bid On Item ($)</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["description"]."</td><td>".$row["name"]."</td><td>".$row["startPrice"]."</td><td>".$row["endDate"]."</td><td>".$row["currentBid"]."</td><td>".$row["highestBid"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
//and close
$db->close();

  ?>
<form>
<input type="button" value="new Auction" onclick="window.location.href='newItem-form.php'" />
<input type="button" value="View Selling History" onclick="window.location.href='salesHistory.php'" />
</form>

</body>
</html>