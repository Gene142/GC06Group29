<html>

<body>
<form action = "newItem.php"  method = "post" />


<head>

        <meta charset = "UTF-8">
        <title> Ebid Sale Items</title>
        <img src="auctionimage.jpeg" width ="140" height = "140"></img> 
</head>
    
    <h1 style= "text-align:center; color:red">  Ebid   </h1 
    
    
    <h2> Enter your sale item details below</h2> <br> <br>

	
	<form style="margin-left": 30px action="dbtwo.php" method = "post">
      
      <p> Category 
   		 <select name="categoryId">
   		 <option value=" ">Select....</option>
   		  <option value="1">Electrical</option>
   		   <option value="2">Musical</option>
   		    <option value="3">Furniture</option>
   		     <option value="4444">Clothing</option>
   		     </select> 
   		     </p>
      
      <p> Name
       <input type = "text" name= "name"/> </p>
      <p> Description
       <input type = "text" name= "description"/> </p>
       <p> Start Price
       <input type = "text" name= "startPrice"/> </p>
       <p> Reserve Price
       <input type = "text" name= "resPrice"/> </p>
       <p> Auction End Date
       <input type="datetime-local" name= "endDate"/> </p>
       
       
	 <input type="submit" value= "Submit"/>	
		
     </form>  
     </body>
     
     </p>

	</html>