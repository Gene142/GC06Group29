<?php
require_once('sendgrid-php-master\sendgrid-php.php');
require_once('sendgrid-php-master\vendor\autoload.php');

function sendEmailToSellerWithBuyer($buyerFirstName, $sellerEmail, $sellerFirstName, $bidAmount, $buyerAddress, $itemName) {

$from = new SendGrid\Email("Example User", "azure_47a5aade659a39df1ab52b1bdd241e42@azure.com");
$subject = "Your auction of $itemName";
$to = new SendGrid\Email("Example User", "$sellerEmail");
$content = new SendGrid\Content("text/plain", "Hello $sellerFirstName, your auction of $itemName has sold for $bidAmount to $buyerFirstName who lives at $buyerAddress");
$mail = new SendGrid\Mail($from, $subject, $to, $content);

$apiKey = getenv('SendGridKey');
$sg = new \SendGrid($apiKey);

$response = $sg->client->mail()->send()->post($mail);
echo $response->statusCode();
print_r($response->headers());
echo $response->body();

}

function sendEmailToSellerWithoutBuyer() {
$buyerEmail = $row['buyerEmail'];
		$buyerFirstName = $row['buyerFirstName'];
		$sellerEmail = $row['sellerEmail'];
		$sellerFirstName = $row['sellerFirstName'];
		$bidAmount = $row['bidAmount'];
		$buyerAddress = $row['buyerAddress'];
		$itemName = $row['itemName'];
}

function sendEmailToWinner() {

}

?>

