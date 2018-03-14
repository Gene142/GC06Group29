<?php SESSION_START(); ?>
<DOCTYPE html>
	<html>
	<head>
	</head>
	<body>


<?php 
$bidAmountEntered = (int) $_POST["bidAmountEntered"];
$itemIdReq = $_POST["itemIdReq"];
$buyerId = $_SESSION["userId"];
$highestBid = (int) $_POST["highestBid"];
$currentHighestBidderEmail = $_POST["currentHighestBidderEmail"];
$itemName = $_POST["itemName"];


$db = new mysqli('dbauction.mysql.database.azure.com', 'group29admin@dbauction', 'Ilovedatabases1', 'auction')
or	die('Could not connect');

if((int)$bidAmountEntered > $highestBid) {
	//insert into database FIX BuyerID BIDAMOUNT entered below
	$sql = "INSERT INTO bids (itemId, bidAmount, buyerId)
VALUES ('$itemIdReq','$bidAmountEntered', '$buyerId')";
	if ($db->query($sql) === TRUE) {
    	echo "Bid Successful";
    	include('sendMail');
    	sendEmailToOutbid($currentHighestBidderEmail, $highestBid, $bidAmountEntered, $itemName);

	} else {
		echo "bid failed: enter a higher bid thanks";
	}
} else {
	echo "current highest bid: $currentHighestBid";
	echo "bid amount entered: $bidAmountEntered";
	echo "invalid amount entered";
	}
	//add bidWatchers: if maxBidAmount has been overwritten, email the buyer. We have their Id must simply find  a way to email.

$db -> close();
?>
<form>
<input type="button" value="Back To Previous Page" onclick="window.location.href='bidPage.php'" />
<input type="button" value="Back to Home" onclick="window.location.href='buyerHome.php'" />
</form>
</body>
</html>