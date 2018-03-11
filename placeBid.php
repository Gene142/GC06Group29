<DOCTYPE html>
	<html>
	<head>
	</head>
	<body>


<?php 
$bidAmountEntered = (int) $_POST["bidAmountEntered"];
$itemIdReq = '1';

$db = new mysqli('localhost', 'root', 'root', 'auction')
or	die('Could not connect');
//get highest bid
$sqlHighestBid = "SELECT MAX(bidAmount) AS bidAmountMax, buyerId FROM bids WHERE itemId = '1' ";
$result = $db->query($sqlHighestBid);
$row=$result->fetch_assoc();
$currentHighestBid = (int)$row["bidAmountMax"];
$currentHighestBidder = $row["buyerId"];
if((int)$bidAmountEntered > $currentHighestBid) {
	//insert into database FIX BuyerID BIDAMOUNT entered below
	$sql = "INSERT INTO bids (itemId, bidAmount, buyerId)
VALUES ('1','$bidAmountEntered', '1')";
	if ($db->query($sql) === TRUE) {
    	echo "Bid Successful";
		$to      = 'gene.stein@me.com';
		$subject = 'the subject';
		$message = 'you have been outbid';
		$headers = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);

	} else {
    	echo "Error: " . $sql . "<br>" . $db->error;
		}
} else {
	echo " current highest bid: $currentHighestBid";
	echo "bid amount entered: $bidAmountEntered";
	echo "invalid amount entere";
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