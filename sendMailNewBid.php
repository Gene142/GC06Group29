<?php

$itemName = $_POST['itemName'];
$itemNewBid = $_POST['itemNewBid'];
$outbidBuyer = $_POST['']

require_once('sendgrid-php-master\sendgrid-php.php');
require_once('sendgrid-php-master\vendor\autoload.php');
function sendEmail() {

$from = new SendGrid\Email("Example User", "azure_47a5aade659a39df1ab52b1bdd241e42@azure.com");
$subject = "You have been outbid on $itemName !";
$to = new SendGrid\Email("Example User", "gene.stein@me.com");
$content = new SendGrid\Content("text/plain", "and easy to do anywhere, even with PHP");
$mail = new SendGrid\Mail($from, $subject, $to, $content);

$apiKey = getenv('SendGridKey');
$sg = new \SendGrid($apiKey);

$response = $sg->client->mail()->send()->post($mail);
echo $response->statusCode();
print_r($response->headers());
echo $response->body();

}

?>