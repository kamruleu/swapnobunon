<?php
 
 if (isset($_GET['xvendorid']) && isset($_GET['xdate'])){
	 $vendorid=$_GET['xvendorid'];
	 $date=$_GET['xdate'];
	 
	 $db = mysqli_connect("localhost", "dotbdsol_root", "dbs@)!&", "dotbdsol_erp") or die ("Could not connect to server"); 
     
	 if(!$db){
	  die('Could not connect to db: ');
      }
	  
	  
	  
	  $result = mysqli_query($db,"select xsl,xrdin,xamount from opostxn where xvendorid='$vendorid' and xdate='$date'") or die("Couldn't connect server");
	  
	  $json_response = (array());
	  
	  
	   while ($row = mysqli_fetch_row($result)) {
		
		$row_array['xsl'] = $row[0];
        $row_array['xrdin'] = $row[1];
		$row_array['xamount'] = $row[2];
        
        array_push($json_response,$row_array);
		
    }
	
	echo json_encode(array('transactions'=>$json_response));
	
	mysqli_close($db);
 }

?>