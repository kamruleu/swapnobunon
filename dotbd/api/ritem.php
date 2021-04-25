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
    $rin = $_GET['rin'];
    //ca0af5821f64fbcce24a2d24dff5efb6b1746a0de0c9e69c605c4fbe924d2fd8
    if(isset($_GET['lim']))
    {
    $lim = $_GET['lim'];
	$ofset = $_GET['ofset'];
	

	$query="SELECT c.Xitemcode xitemcode,c.xbalance xbalance,(select xitemid from seitem where c.xitemcode=seitem.xitemcode) as xitemid,(select xdesc from seitem where c.xitemcode=seitem.xitemcode) as xdesc,(select xlongdesc from seitem where c.xitemcode=seitem.xitemcode) as xlongdesc, (select xcat from seitem where c.xitemcode=seitem.xitemcode) as xcat, (select xbrand from seitem where c.xitemcode=seitem.xitemcode) as xbrand,(select xunitsale from seitem where c.xitemcode=seitem.xitemcode) as xunitsale, (select xmrp from seitem where c.xitemcode=seitem.xitemcode) as xmrp, (select xdp from seitem where c.xitemcode=seitem.xitemcode) as xdp, (select zactive from seitem where c.xitemcode=seitem.xitemcode) as zactive FROM `vospstock` c WHERE xwh='$rin' and c.xbalance >0 order by c.xbalance DESC LIMIT $lim  OFFSET $ofset";
	$result = mysqli_query($db,$query) or die("Cannot execute query");  


	$json_response = (array());
    
    while ($row = mysqli_fetch_row($result)) {
		
		$row_array['xitemcode'] = $row[0];
		$row_array['xbalance'] = $row[1];
		$row_array['xitemid'] = $row[2];
        $row_array['xdesc'] = $row[3];
        $row_array['xlongdesc'] = $row[4];
        $row_array['xcat'] = $row[5];
        $row_array['xbrand'] = $row[6];
        $row_array['xunitsale'] = $row[7];
        $row_array['xmrp'] = $row[8];
        $row_array['xdp'] = $row[9];
        $row_array['zactive'] = $row[10];
        
		   
    
        array_push($json_response,$row_array);
    }
    
	echo json_encode($json_response);
 
    
	}
	else if(isset($_GET['id']))
    {
    $id = $_GET['id'];

	$query="select xitemid,xitemcode,xsource,xdesc,xlongdesc,xcat,xbrand,xgitem,xcitem,xunitsale,xtypestk,xmrp,xstdcost,xcp,xdp,xstdprice,zactive from seitem where xitemid = '".$id."' order by xitemid DESC";
	$result = mysqli_query($db,$query) or die("Cannot execute query");  


	$json_response = (array());
    
    while ($row = mysqli_fetch_row($result)) {
		
		$row_array['xitemid'] = $row[0];
		$row_array['xitemcode'] = $row[1];
		$row_array['xsource'] = $row[2];
        $row_array['xdesc'] = $row[3];
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
		   
    
        array_push($json_response,$row_array);
    }
    
	echo json_encode($json_response);
 
    
	}
	else
	{
		$query="SELECT c.Xitemcode xitemcode,c.xbalance xbalance,(select xitemid from seitem where c.xitemcode=seitem.xitemcode) as xitemid,(select xdesc from seitem where c.xitemcode=seitem.xitemcode) as xdesc,(select xlongdesc from seitem where c.xitemcode=seitem.xitemcode) as xlongdesc, (select xcat from seitem where c.xitemcode=seitem.xitemcode) as xcat, (select xbrand from seitem where c.xitemcode=seitem.xitemcode) as xbrand,(select xunitsale from seitem where c.xitemcode=seitem.xitemcode) as xunitsale, (select xmrp from seitem where c.xitemcode=seitem.xitemcode) as xmrp, (select xdp from seitem where c.xitemcode=seitem.xitemcode) as xdp, (select zactive from seitem where c.xitemcode=seitem.xitemcode) as zactive FROM `vospstock` c WHERE xwh='$rin' and c.xbalance >0 order by c.xbalance DESC";
	$result = mysqli_query($db,$query) or die("Cannot execute query");  
	$data = mysqli_num_rows($result);

 echo json_encode($data);
	}
	
    
	
}else{
	
	echo "Not a valid request!";
}

?>