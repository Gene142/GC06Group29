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
$sql  = "SELECT A.name, A.description, A.startPrice, A.resPrice, A.endDate, B.highestBid, C.viewCount FROM
(SELECT * FROM items WHERE sellerId = '$sellerId' AND endDate > CURRENT_TIMESTAMP()) AS A LEFT OUTER JOIN 
(SELECT MAX(bidAmount) as highestBid, itemId FROM bids GROUP BY itemId) AS B ON A.itemId = B.itemId LEFT OUTER JOIN
(SELECT COUNT(itemId) AS viewCount, itemId FROM browsing GROUP BY itemId) AS C ON B.itemId = C.itemId;"
or die('error with query');
//run query, get all bids
$result = $db->query($sql)
or die('Error with query'); 
if ($result->num_rows > 0) {
    echo "<table><tr><th>Description</th><th>Name</th><th>Start Price</th><th>Reserve Price</th><th>End Date</th><th>Highest Bid($)</th><th>View Count</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["description"]."</td><td>".$row["name"]."</td><td>".$row["startPrice"]."</td><td>".$row['resPrice']."</td><td>".$row["endDate"]."</td><td>".$row["highestBid"]."</td><td>".$row["viewCount"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
//and close
$db->close();

  ?>
<form>
<input type="button" value="new Auction" onclick="window.location.href='newItem-form.html'" />
<input type="button" value="View Selling History" onclick="window.location.href='salesHistory.php'" />
</form>

</body>
</html>