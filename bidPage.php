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
$userId = $_SESSION['userId'];
$itemIdReq = $_REQUEST['id'];

$db = new mysqli('dbauction.mysql.database.azure.com', 'group29admin@dbauction', 'Ilovedatabases1', 'auction')
or	die('Could not connect: ');
	

$sql = "SELECT A.name, A.description, A.startPrice, A.resPrice, a.endDate, B.currentHighestBidderEmail, B.bidAmount, B.itemId  FROM
(SELECT itemId, name, description, startPrice, resPrice, endDate FROM items WHERE itemId = '$itemIdReq') AS A LEFT OUTER JOIN
(SELECT p.email AS currentHighestBidderEmail, b.buyerId, b.bidAmount, b.itemId FROM bids b, buyers p WHERE itemId = '$itemIdReq' AND bidAmount = (SELECT MAX(bidAmount) FROM bids WHERE itemId = '$itemIdReq') AND p.buyerId = b.buyerId) AS B ON A.itemId = B.itemId;"
or die('error with query');
   		

$result = $db->query($sql)
or die('Error with query'); 
    $row = $result -> fetch_assoc();
    echo "<table><tr><th>Name</th><th>Description</th><th>End Date</th><th>Starting Price</th><th>Highest Bid</th><th>Reservice Price></th></tr>";
        
        $highestBid = $row["bidAmount"];
        $currentHighestBidderEmail = $row["currentHighestBidderEmail"];
        $itemName = $row["name"];
        $resPrice = $row["resPrice"];
    // output data
    echo "<tr><td>".$row["name"]."</td><td>".$row["description"]."</td><td> ".$row["endDate"]." </td><td> ".$row["startPrice"]."</td><td>".$row["bidAmount"]."</td><td>".$row["resPrice"]."</td></tr>";

    echo "</table>";

//also add 1 to viewCount, browsing. Browsing has a unique ID on buyerId, itemID
$sql = "INSERT INTO browsing (itemId, buyerId) VALUES ($itemIdReq, $userId);";
$db->query($sql);

$db->close();

?>
<form action = "placeBid.php" method = "post">
<input type = "hidden" name = "resPrice" value = "<?php echo $resPrice; ?>" />
<input type = "hidden" name = "itemIdReq" value = "<?php echo $itemIdReq; ?>" />
<input type = "hidden" name = "itemName" value = "<?php echo $itemName; ?>" />
<input type = "hidden" name = "highestBid" value = "<?php echo $highestBid; ?>" />
<input type = "hidden" name = "currentHighestBidderEmail" value = "<?php echo $currentHighestBidderEmail; ?>" />
<input type= "text" name= "bidAmountEntered"/> 
<input type="submit" value="Place Bid"  />

</form>
