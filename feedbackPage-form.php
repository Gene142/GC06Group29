<?php SESSION_START(); 

$sellerId = $_REQUEST['id'];

?>
<html>

<body>
<form action = "feedbackPage.php"  method = "post" />


<head>

        <meta charset = "UTF-8">
        <title> Ebid Sale Items</title>
        <img src="auctionimage.jpeg" width ="140" height = "140"></img> 
</head>
    
    <h1 style= "text-align:center; color:red">  Ebid   </h1 
    
    
    <h2> Give your feedback as a rating of 1 to 5! </h2> <br> <br>

	
	<form style="margin-left": 30px action="dbtwo.php" method = "post">
      
      <p> How many feedback points would you like to give?
   		 <select name="pointsGiven">
   		 <option value=" ">Select....</option>
   		  <option value="1">1</option>
   		   <option value="2">2</option>
   		    <option value="3">3</option>
   		     <option value="4">4</option>
           <option value = "5">5</option>
   		     </select> 
   		     </p>
    <input type = "hidden" name = "sellerId" value = "<?php echo $sellerId; ?>" />
	 <input type="submit" value= "Submit"/>	
		
     </form>  
     </body>
     
     </p>

	</html>