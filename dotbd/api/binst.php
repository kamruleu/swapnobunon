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
        
    $rin = $_GET['rin'];

	$query="SELECT bin,binstatus,topmatching,steps, (select leftcurpoint from mlmtree WHERE vtopmatching.bin = mlmtree.bin) as leftcurpoint, (select rightcurpoint from mlmtree WHERE vtopmatching.bin = mlmtree.bin) as rightcurpoint, (select leftcurpoint+lefthitpoint from mlmtree WHERE vtopmatching.bin = mlmtree.bin) as lefttp, (select rightcurpoint+righthitpoint from mlmtree WHERE vtopmatching.bin = mlmtree.bin) as righttp FROM `vtopmatching` where xrdin = '$rin' ORDER BY bin ASC";
	$result = mysqli_query($db,$query) or die("Cannot execute query");  


	$json_response = (array());
    
    while ($row = mysqli_fetch_row($result)) {
		
		$row_array['bin'] = $row[0];
		$row_array['binstatus'] = $row[1];
		$row_array['topmatching'] = $row[2];
        $row_array['steps'] = $row[3];
        $row_array['ltp'] = $row[6];
        $row_array['rtp'] = $row[7];
		if($row[1] == "Primary")
		{
			$rt = 10 - $row[3];
			$rp = $rt*100;
			$left = $rp - $row[4];
			$right = $rp - $row[5];
			if($left < 0)
			{
				$left = 0;
				$row_array['left'] = $left;
			}
			else
			{
				$row_array['left'] = $left;
			}
			if($right < 0)
			{
				$right = 0;
				$row_array['right'] = $right;
			}
			else
			{
				$row_array['right'] = $right;
			}
			
        	
		}
		else
		{
			$rt = 10 - $row[3];
			$rp = $rt*500;
			$left = $rp - $row[4];
			$right = $rp - $row[5];
			
			if($left < 0)
			{
				$left = 0;
				$row_array['left'] = $left;
			}
			else
			{
				$row_array['left'] = $left;
			}
			if($right < 0)
			{
				$right = 0;
				$row_array['right'] = $right;
			}
			else
			{
				$row_array['right'] = $right;
			}
		}
    
        array_push($json_response,$row_array);
    }
    
	echo json_encode($json_response);
    }
    
	else
	{
		$query="select xitemid,xitemcode,xsource,xdesc,xlongdesc,xcat,xbrand,xgitem,xcitem,xunitsale,xtypestk,xmrp,xstdcost,xcp,xdp,xstdprice,zactive from seitem where zactive=1 and xsource = 'Corporate' order by xitemid";
	$result = mysqli_query($db,$query) or die("Cannot execute query");  
	$data = mysqli_num_rows($result);

 echo json_encode($data);
	}
	
    
	
}else{
	
	echo "Not a valid request!";
}

?>