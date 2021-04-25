<?php

if(isset($_GET['xdist'])){

$distributor=$_GET['xdist'];


	 $zid="100012";
	 $xgcus="Dealer";

//  $db = mysqli_connect("localhost", "root", "", "sales_force_db") or die ("Could not connect to server"); 
//  if(!$db){
//	  die('Could not connect to db: ');
//  }


try{
       $conn = new PDO("sqlsrv:Server=(local),1433;Database=ERPonTheNet",Null,Null);

       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }
     catch(Exception $e){
	  echo print_r($e->getMessage());
    }

	
	
  

 // $result = mysqli_query($db,"select xroad from seroutetemp where xroute=(select xroute from seuserlic where xterminaluser='$user')") or die("Cannot execute query");
  
    $tsql = "select xfirst,xcus,xorg,xphone,xoffadd from cacus where zid='$zid' and xcus='$distributor' and xgcus='$xgcus'";
    $getresult = $conn->prepare($tsql);
    $getresult->execute();

    $result=$getresult->fetchAll(PDO::FETCH_BOTH);
  
  
  $json_response = (array());
  
  
  foreach($result as $key=>$value){
		 $row_array['xfirst'] = $value['xfirst'];
		 $row_array['xcus'] = $value['xcus'];
		 $row_array['xorg'] = $value['xorg'];
		 $row_array['xphone'] = $value['xphone'];
		 $row_array['xoffadd'] = $value['xoffadd'];

        array_push($json_response,$row_array);
	}
    
  /*  while ($row = mssql_fetch_row($result)) {
		
        $row_array['xroad'] = $row[0];
        
        array_push($json_response,$row_array);
		
    } */
	
}
	
	echo json_encode(array('roads'=>$json_response));
	
	//mssql_close($db);
  
?>


