<?php SESSION_START(); ?>
<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
    border: 1px solid black;
}
</style>
</head>
<body>
<?php 
//continue session, get data

$userFirstName = $_SESSION['userFirstName'];
$buyerId = $_SESSION['userId'];
echo "Welcome to your purchasing history $userFirstName, listed below are your current bids!";
//create connection to DB
$db = new mysqli('dbauction.mysql.database.azure.com', 'group29admin@dbauction', 'Ilovedatabases1', 'auction')
or  die('Could not connect: ');

//query
$sql = "SELECT * FROM
(SELECT * FROM items) AS C INNER JOIN
(
SELECT A.itemId, A.total, B.buyerId, B.bidAmount FROM
(select itemId, MAX(bidAmount) AS total from bids GROUP BY itemId) AS A INNER JOIN 
(SELECT buyerId, itemId, bidAmount  FROM bids) AS B ON A.itemId = B.itemId AND B.bidAmount = A.total) AS D ON C.itemId = D.itemId WHERE buyerId = '$buyerId' AND closed = '1';"
//run query, get all bids
$result = $db->query($sql)
or die('Error with query'); 
if ($result->num_rows > 0) {
    echo "<table><tr><th>Description</th><th>Name</th><th>Start Price</th><th>End Date</th><th>Winning Bid ($)</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["description"]."</td><td>".$row["name"]."</td><td>".$row["startPrice"]."</td><td>".$row["endDate"]."</td><td>".$row["total"]."</td></tr>";
        echo '<tr><td>'."<a href='feedbackPage.php?id=".$row['sellerId']."'>LEAVE FEEDBACK</a>".'</td>'. '<td>'."".'</td></tr>';        
    }
    echo "</table>";
} else {
    echo "0 results";
}
//and close
include('AuctionControl.php');
AuctionControl();  

$db->close();
?>

</body>
</html>