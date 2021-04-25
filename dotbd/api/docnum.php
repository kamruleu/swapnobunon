<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Request-With, Content-Type, Accept, Authorization");
if (isset($_GET['username']) && isset($_GET['password'])){
	
	$username=$_GET['username'];
	$password=$_GET['password'];
	
	include_once('conect.php');

	$query="select zemail,zpassword from pausers where zemail='".$username."' and zpassword='".$password."'";
	
	$result = mysqli_query($db,$query) or die("Cannot execute query");
	
	if (mysqli_num_rows($result)<1) {
		
       
			exit("Username or Password dint match!");
		
        
    }

    //ca0af5821f64fbcce24a2d24dff5efb6b1746a0de0c9e69c605c4fbe924d2fd8
    if(isset($_GET['rin']))
    {
    $bin = $_GET['bin'];
    $xwh = $_GET['rin'];

	$query="SELECT ximsenum,xwh FROM `imsetxn` where xwh = '$xwh' and ximsesl = (SELECT max(ximsesl) FROM `imsetxn` where xwh = '$xwh')";
	$result = mysqli_query($db,$query) or die("Cannot execute query");  


	$json_response = (array());
    $cnt = mysqli_num_rows($result);
     if($cnt == 0)
	 {
		$lnum = '0000001'; 
	}
	else
	{
    while ($row = mysqli_fetch_row($result)) {
        $row_array['dnr'] = $row[0];
    } 
        $ldc = explode("-", $row_array['dnr']);
      $ldrin= $ldc[2]+1;
      $num = strlen($ldrin);
      if($num > 7)
      {
        $lnum = (string)$ldrin;
      }
      else if($num == 7)
      {
        $lnum = (string)$ldrin;
      }
      else if($num == 5)
      {
        $lnum = '0'.(string)$ldrin;
      }
      else if($num == 4)
      {
        $lnum = '00'.(string)$ldrin;
      }
      else if($num == 3)
      {
        $lnum = '000'.(string)$ldrin;
      }
      else if($num == 2)
      {
        $lnum = '0000'.(string)$ldrin;
      }
      else if($num == 1)
      {
        $lnum = '00000'.(string)$ldrin;
      }
        else
        {
          $lnum = '000001';
        }
	}
	$d = date("Y-m-d");
        $row_array['dn'] = 'TXN-'.$d.'-'.$lnum;
            array_push($json_response,$row_array);
        	echo json_encode($json_response);
	}

}else{
	
	echo "Not a valid request!";
}

?>