<?php

 if (isset($_GET['user'])){
	 $user=$_GET['user'];

  $db = mysqli_connect("localhost", "root", "", "sales_force_db") or die ("Could not connect to server"); 
  if(!$db){
	  die('Could not connect to db: ');
  }
  

  $result = mysqli_query($db,"select xroad from seroutetemp where xroute=(select xroute from seuserlic where xterminaluser='$user')") or die("Cannot execute query");
  
  
  $json_response = (array());
    
    while ($row = mysqli_fetch_row($result)) {
		
        $row_array['xroad'] = $row[0];
        
        array_push($json_response,$row_array);
		
    }
	echo json_encode(array('roads'=>$json_response));
	
	mysqli_close($db);
  }
?>


