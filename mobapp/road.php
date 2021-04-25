<?php

 if (isset($_GET['xsl'])){
	 $xsl=$_GET['xsl'];

  $db = mysqli_connect("localhost", "dotbdsol_root", "dbs@)!&", "dotbdsol_erp") or die ("Could not connect to server"); 
  if(!$db){
	  die('Could not connect to db: ');
  }
  

  $result = mysqli_query($db,"select * from order_transaction where xsl='$xsl'") or die("Cannot execute query");
  
  
  $json_response = (array());
    
    while ($row = mysqli_fetch_row($result)) {
		
        $row_array['shopname'] = $row[0];
        
        array_push($json_response,$row_array);
		
    }
	echo json_encode(array('roads'=>$json_response));
	
	mysqli_close($db);
  }
?>


