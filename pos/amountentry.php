<?php

$postdata=file_get_contents('php://input');

///if(isset($_GET['zid']) && isset($_GET['cusname']) && isset($_GET['mobile1']) && isset($_GET['emp'])){
$db = mysqli_connect("localhost", "dotbdsol_root", "dbs@)!&", "dotbdsol_erp") or die ("Could not connect to server\n");  
 
	if (!$db) {
        die('Could not connect to db: ');
    }
	

$xrdin="";
$vendorid="";
$amount="";
$imei="";
$zutime = "";
$today = "";

	
$data = json_decode($postdata, true);

 if($data!=null){
	if (is_array($data['amountdt'])) { 
	foreach ($data['amountdt'] as $record){
$xrdin=$record['xrdin'];
$vendorid=$record['xvendorid'];
$amount=$record['xamount'];
$imei=$record['imei'];
$zutime=$record['zutime'];
$today=$record['xdate'];



		}
	}


	$zutimeS = substr($zutime, 0, 4).'-'.substr($zutime, 4, 2).'-'.substr($zutime, 6, 2).' '.substr($zutime, 8, 2).':'.substr($zutime, 10, 2).':'.substr($zutime, 12, 2);
	
	$todayS = substr($today, 0, 4).'-'.substr($today, 4, 2).'-'.substr($today, 6, 2);
	
	$todayT =date('Y-m-d',strtotime($todayS)); 
	$zutimeT =date('Y-m-d h:i:sa',strtotime($zutimeS));
	
	$result = mysqli_query($db,"select * from seuserlic where xterminaluser='$vendorid' and xemino='$imei' and zactive='1'");
	
	file_put_contents("log.txt", "select * from seuserlic where xterminaluser='$vendorid' and xemino='$imei' and zactive='1'", FILE_APPEND | LOCK_EX);
	
	$numrows = mysqli_num_rows($result);
	
	// echo $numrows;

	 if($numrows>0){
   $sql=mysqli_query($db,"INSERT INTO opostxn (ztime,xrdin,xvendorid,xamount,zutime,xdate)
		VALUES (now(),'$xrdin','$vendorid','$amount','$zutimeT','$todayT')");
		
		echo "Success";

	 }else{
		 echo "Error";
	 }



}else{

}

?>