<?php

require("sendgrid-php-master/sendgrid-php.php");
$from = new SendGrid\Email("Example User", "g.stein142@gmail.com");
$subject = "Sending with SendGrid is Fun";
$to = new SendGrid\Email("Example User", "gene.stein@me.com);
$content = new SendGrid\Content("text/plain", "and easy to do anywhere, even with PHP");
$mail = new SendGrid\Mail($from, $subject, $to, $content);

$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

$response = $sg->client->mail()->send()->post($mail);
echo $response->statusCode();
print_r($response->headers());
echo $response->body();

echo "this maybe did not work";

?>