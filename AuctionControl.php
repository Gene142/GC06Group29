<?php 

function AuctionControl() {
//connect to database
$db = mysqli_connect('dbauction.mysql.database.azure.com', 'group29admin@dbauction', 'Ilovedatabases1', 'auction')
or  die('Could not connect: ');

//get all auctions that have ended but not closed
$sql = "SELECT A.name AS itemName, A.endDate, A.firstName AS sellerFirstName, A.email AS sellerEmail, B.firstName AS buyerFirstName, B.address AS buyerAddress, B.email AS buyerEmail, B.bidAmount FROM (SELECT i.itemId, i.name, i.endDate, s.firstName, s.email FROM items i, sellers s WHERE i.sellerId = s.sellerId AND i.endDate < CURRENT_TIMESTAMP() AND i.closed = '0') AS A LEFT OUTER JOIN (SELECT b.itemId, p.firstName, p.address, p.email, b.bidAmount FROM bids b, buyers p WHERE p.buyerId = b.BuyerId AND bidAmount = (SELECT MAX(bidAmount) FROM bids WHERE itemId = b.itemId)) AS B ON A.itemId = B.itemId;";

//run query
$result = $db->query($sql) 
or die ('Error with query');

//if > 0 rows, do some clean up
if($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		//first ensure there is a winner:
		$buyerEmail = $row['buyerEmail'];
		if($buyerEmail != null) {
		$buyerFirstName = $row['buyerFirstName'];
		$sellerEmail = $row['sellerEmail'];
		$sellerFirstName = $row['sellerFirstName'];
		$bidAmount = $row['bidAmount'];
		$buyerAddress = $row['buyerAddress'];
		$itemName = $row['itemName'];

		include('sendMail.php');
		sendEmailToSellerWithBuyer($buyerFirstName, $sellerEmail, $sellerFirstName, $bidAmount, $buyerAddress, $itemName);
		sendEmailToWinner($buyerEmail, $itemName, $buyerFirstName, $bidAmount);
		$sql2 = "UPDATE items SET closed = '1' WHERE closed = '0' AND endDate < CURRENT_TIMESTAMP();";
	} else {//if there is no winner
			//double check to ensure entire row is not empty
			$sellerEmail = $row['sellerEmail'];
			if($sellerEmail != null) {
				$sellerFirstName = $row['sellerFirstName'];
				$itemName = $row['itemName'];
				include_once('sendMail.php');
				sendEmailToSellerWithoutBuyer($sellerEmail, $sellerFirstName, $itemName);
			}
		
	}
}
}
}