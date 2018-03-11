<?php 
//connect to db
$db = mysqli_connect('localhost', 'root', 'root', 'auction') 
or die("error connecting to database");
//get the ending ones
$sql = "SELECT MAX(b.bidAmount) AS bidAmount, s.email as sellerEmail, p.email as buyerEmail FROM items i, bids b, sellers s, buyers p WHERE i.endDate < CURRENT_TIMESTAMP() AND i.itemId = b.itemId AND s.sellerId = i.sellerId AND p.buyerId = b.buyerId";
$result = $db->query($sql) 
or die("error querying the database");

 $url = 'https://api.sendgrid.com/';
 $user = 'azure_d849edaa06925fb8c900ab5b25d654b8@azure.com';
 $pass = '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';
//send the emails: first ensure one must be send
if($result->num_rows > 0) {
	//get the info seperated
	$rows = mysql_fetch_assoc;
	//and now send emails
	foreach ($row in $rows) { 


 $params = array(
      'api_user' => $user,
      'api_key' => $pass,
      'to' => $row["buyerEmail"],
      'subject' => 'Your Auction',
      'html' => 'testing body',
      'text' => 'testing body',
      'from' => 'dbAuction',
   );

 $request = $url.'api/mail.send.json';

 // Generate curl request
 $session = curl_init($request);

 // Tell curl to use HTTP POST
 curl_setopt ($session, CURLOPT_POST, true);

 // Tell curl that this is the body of the POST
 curl_setopt ($session, CURLOPT_POSTFIELDS, $params);

 // Tell curl not to return headers, but do return the response
 curl_setopt($session, CURLOPT_HEADER, false);
 curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

 // obtain response
 $response = curl_exec($session);
 curl_close($session);

 // print everything out
 print_r($response);

	}
}


//close the connection
$db->close();


?>