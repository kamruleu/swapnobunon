<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Request-With, Content-Type, Accept, Authorization");
$data = json_decode(file_get_contents("php://input"));
$username = $data->username;
$password = $data->password;
/*$xrdin = $_GET['rin'];
$xrow = 1; //$_GET['xrow'];
$xitemcode = 'ULB-LBLEMON-100';//$_GET['xitemcode'];
$xqry = 1;//$_GET['xqty'];
$rate = 50;//$_GET['rate'];
$ximreqnum = 'REQ-789-00090';//$_GET['reqnum'];*/
if ($username !='' && $password != ''){

      $ztime = date("Y-m-d h:i:s");
      $bizid = 100;
      $xrdin = $data->rin;
      $xrow = $data->xrow;
      $xitemcode = $data->xitemcode;
      $xqry = $data->xqty;
      $rate = $data->rate;
      $ximreqnum = $data->reqnum;
      $xpaymethod =$data->xpaymethod;
      $xstatus = 'Created';
      $xdate = date("Y-m-d");
      $xyear = date("Y");
      $xper = date("m");

	include_once('conect.php');

    $qr = "SELECT max(stno) FROM `ablstatement`";
      $res = mysqli_query($db,$qr) or die("Cannot execute query");
      while ($row = mysqli_fetch_row($res)) {
    $row_array['stn'] = $row[0];
      }
      $stno = $row_array['stn'];

	$query="select zemail,zpassword from pausers where zemail='".$username."' and zpassword='".$password."'";
	
	$result = mysqli_query($db,$query) or die("Cannot execute query");
	
	if (mysqli_num_rows($result)<1) {
			exit("Username or Password dint match!"); 
    }
    
    //ca0af5821f64fbcce24a2d24dff5efb6b1746a0de0c9e69c605c4fbe924d2fd8
    

    if($stno > 0)
{


  $query =  "insert into imreqdet(ztime,bizid,ximreqnum,xrow,xitemcode,xqty,xrate,xdate,stno,zemail,xrdin,xyear,xper,xpaymethod )
                     values('$ztime','$bizid','$ximreqnum','$xrow','$xitemcode','$xqry','$rate','$xdate','$stno','$xrdin','$xrdin','$xyear','$xper','$xpaymethod')";
     $json_response = (array());
    if(mysqli_query($db, $query))  
      {  
          $row['message'] = "Requsition details Posted Successfully...";
          $row['err'] =0; 
          array_push($json_response,$row);
       echo json_encode($json_response);
        
      }  
      else  
      {  
           $row['message'] = mysqli_error($db); 
           $row['err'] =1; 
       array_push($json_response,$row);
       echo json_encode($json_response);
      }

} 



}
else{
	
	echo "Not a valid request!";
}

?>