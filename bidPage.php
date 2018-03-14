<?php SESSION_START(); ?>
<!DOCTYPE html>
<html>
<head>
	<style>
table, th, td {
    border: 1px solid black;
}
</style>
Item Information
</head>
<body>
	

<?php
//this page is dedicated to the items. Upon clicking on an item, it leads here. Shows item information, would do a pic if we had time. Has link to click.
//gotta get the itemId firest
$itemIdReq = $_REQUEST['id'];

$db = new mysqli('dbauction.mysql.database.azure.com', 'group29admin@dbauction', 'Ilovedatabases1', 'auction')
or	die('Could not connect: ');
	

$sql = "SELECT A.name, A.description, A.startPrice, A.resPrice, a.endDate, B.currentHighestBidderEmail, B.bidAmount, B.itemId  FROM
(SELECT itemId, name, description, startPrice, resPrice, endDate FROM items WHERE itemId = '$itemIdReq') AS A LEFT OUTER JOIN
(SELECT p.email AS currentHighestBidderEmail, b.buyerId, b.bidAmount, b.itemId FROM bids b, buyers p WHERE itemId = '$itemIdReq' AND bidAmount = (SELECT MAX(bidAmount) FROM bids WHERE itemId = '$itemIdReq') AND p.buyerId = b.buyerId) AS B ON A.itemId = B.itemId;"
or die('error with query');
   		

$result = $db->query($sql)
or die('Error with query'); 
if ($result->num_rows > 0) {
    echo "<table><tr><th>Name</th><th>Description</th><th>End Date</th><th>Starting Price</th><th>Highest Bid</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["name"]."</td><td>".$row["description"]."</td><td> ".$row["endDate"]." </td><td> ".$row["startPrice"]."</td><td>".$row["bidAmount"]."</tr>";
        $highestBid = $row["bidAmount"];
        $currentHighestBidderEmail = $row["currentHighestBidderEmail"];
        $itemName = $row["name"];
    }
    echo "</table>";
} else {
    echo "0 results";
}


$db->close();

?>
<form action = "placeBid.php" method = "post">
<input type = "hidden" name = "itemIdReq" value = "$itemIdReq" />
<input type = "hidden" name = "itemName" value = "$itemName" />
<input type = "hidden" name = "highestBid" value = "$highestBid" />
<input type = "hidden" name = "currentHighestBidderEmail" value = "$currentHighestBidderEmail" />
<input type= "text" name= "bidAmountEntered"/> 
<input type="submit" value="Place Bid"  />

</form>
