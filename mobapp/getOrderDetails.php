<?php

 if (isset($_GET['date']) && isset($_GET['zid'])){
	 $date=$_GET['date'];
	 $zid=$_GET['zid'];

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
 
 
 
 //select DISTINCT shopname,shopid,invoiceno from order_transaction_temp where zid='100012' and xdate='2018-12-12 00:00:00.000'

//SELECT SUM(price) as result
//FROM order_transaction_temp
//WHERE zid='100012' and xdate = '2018-12-12 00:00:00.000' and invoiceno='TER0000013' 
 
 
 
 
    //$result = mysqli_query($db,"select xroute from seuserlic where xterminaluser='$user'") or die("Cannot execute query");
  
    // $tsql = "select distinct shopname,shopid,invoiceno from order_transaction where zid='$zid' and xdate='$date'";

      $tsql  ="select shopname,shopid,invoiceno, sum(price) as totalPrice from order_transaction where zid='$zid' and xdate='$date' group by invoiceno,shopname,shopid";
    $getresult = $conn->prepare($tsql);
    $getresult->execute();

    $result=$getresult->fetchAll(PDO::FETCH_BOTH);

  //select distinct shopname,shopid,invoiceno, sum(price) as totalPrice from order_transaction where zid='$zid' and xdate='$date' group by invoiceno,shopname,shopid
  $json_response = (array());
  
  
  foreach($result as $key=>$value){
	
	    $row_array['shopname'] = $value['shopname'];
		$row_array['shopid'] = $value['shopid'];
		$row_array['invoiceno'] = $value['invoiceno'];
		$row_array['totalPrice'] = $value['totalPrice'];

		array_push($json_response,$row_array);
	
	}
  
   
   /* while ($row = mssql_fetch_row($result)) {
		
        $row_array['xroute'] = $row[0];
        
        array_push($json_response,$row_array);
		
    } */
	
	
	echo json_encode(array('orders'=>$json_response));
	
	//mssql_close($db);
  }
?>


