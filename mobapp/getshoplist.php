<?php
 
 if (isset($_GET['xrout']) && isset($_GET['xroad'])){
	 $rout=$_GET['xrout'];
	 $road=$_GET['xroad'];
	 
	// $db = mysqli_connect("localhost", "root", "", "sales_force_db") or die ("Could not connect to server"); 
     
	// if(!$db){
	//  die('Could not connect to db: ');
     // }
	 
	 
	 try{
       $conn = new PDO("sqlsrv:Server=(local),1433;Database=ERPonTheNet",Null,Null);

       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }
     catch(Exception $e){
	  echo print_r($e->getMessage());
    }
	  
	  
	  
	 // $result = mysqli_query($db,"select xcus,xorg,xspinroad,xphone from secus where xrout='$rout' and xroad=$road") or die("Couldn't connect server");
	  
	  
	  $tsql = "select xcus,xorg,xroadno,xphone from cacus where xrout='$rout' and xroadno='$road'";
      $getresult = $conn->prepare($tsql);
      $getresult->execute();

	  $result=$getresult->fetchAll(PDO::FETCH_BOTH);
	  
	  
	  $json_response = (array());
	  
	  
	  
	  foreach($result as $key=>$value){
		$row_array['xcus'] = $value['xcus'];
        $row_array['xorg'] = $value['xorg'];
		$row_array['xspinroad'] = $value['xroadno'];
		$row_array['xphone'] = $value['xphone'];
        
    
        array_push($json_response,$row_array);
	}
	  
	  
	/*   while ($row = mssql_fetch_row($result)) {
		
		$row_array['xcus'] = $row[0];
        $row_array['xorg'] = $row[1];
		$row_array['xspinroad'] = $row[2];
		$row_array['xphone'] = $row[3];
        
        array_push($json_response,$row_array);
		
    } */
	
	echo json_encode(array('shops'=>$json_response));
	
//	mssql_close($db);
 }

?>



