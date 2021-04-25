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
    if(isset($_GET['lim']))
    {
        
    $lim = $_GET['lim'];
    $sup = $_GET['xsup'];
	$ofset = $_GET['ofset'];

	$query="select xitemid,xitemcode,xsource,xdesc,xlongdesc,xcat,xbrand,xgitem,xcitem,xunitsale,xtypestk,xmrp,xstdcost,xcp,xdp,xstdprice,zactive,xsup,xstdcost from seitem where zactive=1 and xcitem='All Operation' and xitemcode like '%$sup%' order by xitemid DESC LIMIT $lim  OFFSET $ofset";
	$result = mysqli_query($db,$query) or die("Cannot execute query");  


	$json_response = (array());
    
    while ($row = mysqli_fetch_row($result)) {
		
		$row_array['xitemid'] = $row[0];
		$row_array['xitemcode'] = $row[1];
		$row_array['xsource'] = $row[2];
        $row_array['xdesc'] = $row[3];
        $row_array['name'] = substr($row[3],0,50);
        $row_array['xlongdesc'] = $row[4];
        $row_array['xcat'] = $row[5];
        $row_array['xbrand'] = $row[6];
        $row_array['xgitem'] = $row[7];
        $row_array['xcitem'] = $row[8];
        $row_array['xunitsale'] = $row[9];
        $row_array['xtypestk'] = $row[10];
        $row_array['xmrp'] = $row[11];
        $row_array['xstdcost'] = $row[12];
        $row_array['xcp'] = $row[13];
        $row_array['xdp'] = $row[14];
        $row_array['xstdprice'] = $row[15];
        $row_array['zactive'] = $row[16];
        $row_array['xsup'] = $row[17];
        $row_array['xstdcost'] = $row[18];
		   
    
        array_push($json_response,$row_array);
    }
    
	echo json_encode($json_response);
    }
    
	else
	{
		$sup = $_GET['xsup'];
		$query="select xitemid,xitemcode,xsource,xdesc,xlongdesc,xcat,xbrand,xgitem,xcitem,xunitsale,xtypestk,xmrp,xstdcost,xcp,xdp,xstdprice,zactive from seitem where zactive=1 and xcitem='All Operation' and xitemcode like '%$sup%' order by xitemid";
	$result = mysqli_query($db,$query) or die("Cannot execute query");  
	$data = mysqli_num_rows($result);

 echo json_encode($data);
	}
	
    
	
}else{
	
	echo "Not a valid request!";
}

?>