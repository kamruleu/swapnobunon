<?php

 if (isset($_GET['point'])){
	 $point=$_GET['point'];

 // $db = mysqli_connect("localhost", "root", "", "sales_force_db") or die ("Could not connect to server"); 
 // if(!$db){
//	  die('Could not connect to db: ');
 // }
 
 
   try{
     $conn = new PDO("sqlsrv:Server=(local),1433;Database=ERPonTheNet",Null,Null);

     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }
   catch(Exception $e){
	 echo print_r($e->getMessage());
    }
 
 
    //$result = mysqli_query($db,"select xroute from seuserlic where xterminaluser='$user'") or die("Cannot execute query");
  
    $tsql = "select xrout,xrg from carout where xdegcom='$point'";
    $getresult = $conn->prepare($tsql);
    $getresult->execute();

    $result=$getresult->fetchAll(PDO::FETCH_BOTH);
  
  
  
  
  
  
  
  $json_response = (array());
  
  
  
  foreach($result as $key=>$value){
	
	    $row_array['xrout'] = $value['xrout'];
		$row_array['xrg'] = $value['xrg'];
		
		array_push($json_response,$row_array);
	
	}
  
  

    
   /* while ($row = mssql_fetch_row($result)) {
		
        $row_array['xroute'] = $row[0];
        
        array_push($json_response,$row_array);
		
    } */
	
	
	echo json_encode(array('routes'=>$json_response));
	
	//mssql_close($db);
  }
?>


