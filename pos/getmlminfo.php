<?php
 
 if (isset($_GET['xrdin'])){
	 $xrdin=$_GET['xrdin'];
	
	 
	 $db = mysqli_connect("localhost", "dotbdsol_root", "dbs@)!&", "dotbdsol_erp") or die ("Could not connect to server"); 
     
	 if(!$db){
	  die('Could not connect to db: ');
      }
	  
	  
	  
	  $result = mysqli_query($db,"select xpin,xorg,xadd1,xmobile from mlminfo_abl where xrdin='$xrdin'") or die("Couldn't connect server");
	  
	  $json_response = (array());
	  
	  
	   while ($row = mysqli_fetch_row($result)) {
		
		$row_array['xpin'] = $row[0];
        $row_array['xorg'] = $row[1];
		$row_array['xadd1'] = $row[2];
		$row_array['xmob'] = $row[3];
        
        array_push($json_response,$row_array);
		
    }
	
	echo json_encode(array('customers'=>$json_response));
	
	mysqli_close($db);
 }

?>