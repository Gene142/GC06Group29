<?php SESSION_START(); ?>
<DOCTYPE html>
	<html>
	<head>
	</head>
	<body>


<?php 
$bidAmountEntered = (int) $_POST["bidAmountEntered"];
$itemIdReq = $_POST["itemIdReq"];
$newBuyerId = $_SESSION["userId"];
$highestBid = (int) $_POST["highestBid"];
$currentHighestBidderEmail = $_POST["currentHighestBidderEmail"];
$itemName = $_POST["itemName"];
$resPrice = (int) $_POST["resPrice"];


$db = new mysqli('dbauction.mysql.database.azure.com', 'group29admin@dbauction', 'Ilovedatabases1', 'auction')
or	die('Could not connect');
if ($highestBid == 0 || $highestBid == NULL) {
	if($bidAmountEntered > $resPrice) {
		$sql = "INSERT INTO bids (itemId, bidAmount, buyerId) VALUES ('$itemIdReq','$bidAmountEntered', '$newBuyerId')";
		if ($db->query($sql) === TRUE) {
    		echo "Bid Successful";
    	} 
    }
} else if($bidAmountEntered > $highestBid) {
	//insert into database FIX BuyerID BIDAMOUNT entered below
	$sql = "INSERT INTO bids (itemId, bidAmount, buyerId VALUES ('$itemIdReq','$bidAmountEntered', '$newBuyerId')";
	if ($db->query($sql) === TRUE) {
    	echo "Bid Successful";
    	include_once('sendMail.php');
    	sendEmailToOutbid($currentHighestBidderEmail, $highestBid, $bidAmountEntered, $itemName);

	} else {
		echo "bid failed: enter a higher bid thanks";
		echo "bidAmountEntered = $bidAmountEntered and highestBid = $highestBid AND $currentHighestBidderEmail, $itemName";
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