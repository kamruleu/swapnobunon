<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Request-With, Content-Type, Accept, Authorization");
include_once('conect.php');





if (isset($_GET['username']) && isset($_GET['password'])){
	
	$username=$_GET['username'];
	$password=$_GET['password'];
	
	
	
	$db = mysqli_connect("localhost", "dotbdsol_root", "dbs@)!&", "dotbdsol_erp") or die ("Could not connect to server\n"); 

	if (!$db) {
        die('Could not connect to db: ' . mysqli_error());
    }
	

	$query="select zemail,zpassword from pausers where zemail='".$username."' and zpassword='".$password."'";
	
	$result = mysqli_query($db,$query) or die("Cannot execute query");
	
	if (mysqli_num_rows($result)<1) {
		
       
			exit("Username or Password dint match!");
		
        
    }

    //ca0af5821f64fbcce24a2d24dff5efb6b1746a0de0c9e69c605c4fbe924d2fd8
    //1fa960236a09c331615f60afabd0e7e7ffa3f7d508e520d06ea566490c418c67
    
    
    if(isset($_GET['lim']))
    {
        if($_GET['ctg']=='all')
        {
        
    $lim = $_GET['lim'];
	$ofset = $_GET['ofset'];

	$query="select xitemid,xitemcode,xsource,xdesc,xlongdesc,xcat,xbrand,xgitem,xcitem,xunitsale,xtypestk,xmrp,xstdcost,xcp,xdp,xstdprice,zactive,xsup,xstdcost from seitem where zactive=1 order by xitemid ASC LIMIT $lim  OFFSET $ofset";
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
        
        if($row[8] == "ostock")
        {
            $sql = "SELECT xqty FROM `vimstock` WHERE xitemcode = '".$row[1]."' LIMIT 1";
        
            $a = [];
    		$rows = mysqli_query($db, $sql);
    		$r = mysqli_fetch_assoc($rows);
            
            $row_array['stock'] = $r['xqty'];
        }
        else
        {
            $row_array['stock'] = 10;
        }
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

        $ctg = $_GET['ctg'];
        $lim = $_GET['lim'];
        $ofset = $_GET['ofset'];

    $query="select xitemid,xitemcode,xsource,xdesc,xlongdesc,xcat,xbrand,xgitem,xcitem,xunitsale,xtypestk,xmrp,xstdcost,xcp,xdp,xstdprice,zactive,xsup,xstdcost from seitem where zactive=1 and xcat like '%".$ctg."%' order by xitemid ASC LIMIT $lim OFFSET $ofset";
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
        
        if($row[8] == "ostock")
        {
            $sql = "SELECT xqty FROM `vimstock` WHERE xitemcode = '".$row[1]."' LIMIT 1";
        
            $a = [];
    		$rows = mysqli_query($db, $sql);
    		$r = mysqli_fetch_assoc($rows);
            
            $row_array['stock'] = $r['xqty'];
        }
        else
        {
            $row_array['stock'] = 10;
        }
        
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
    
	}
	else if(isset($_GET['id']))
    {
    $id = $_GET['id'];

	$query="select xitemid,xitemcode,xsource,xdesc,xlongdesc,xcat,xbrand,xgitem,xcitem,xunitsale,xtypestk,xmrp,xstdcost,xcp,xdp,xstdprice,zactive,xsup,xstdcost from seitem where zactive=1 and xitemid = '".$id."' order by xitemid ASC";
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
        
        if($row[8] == "ostock")
        {
            $sql = "SELECT xqty FROM `vimstock` WHERE xitemcode = '".$row[1]."' LIMIT 1";
        
            $a = [];
    		$rows = mysqli_query($db, $sql);
    		$r = mysqli_fetch_assoc($rows);
            
            $row_array['stock'] = $r['xqty'];
        }
        else
        {
            $row_array['stock'] = 10;
        }
        
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
    else if(isset($_GET['ctg']))
    {
        $query="select xitemid,xitemcode,xsource,xdesc,xlongdesc,xcat,xbrand,xgitem,xcitem,xunitsale,xtypestk,xmrp,xstdcost,xcp,xdp,xstdprice,zactive from seitem where zactive=1 and xcat like '%".$ctg."%' order by xitemid";
    $result = mysqli_query($db,$query) or die("Cannot execute query");  
    $data = mysqli_num_rows($result);

 echo json_encode($data);
    } 
	else
	{
		$query="select xitemid,xitemcode,xsource,xdesc,xlongdesc,xcat,xbrand,xgitem,xcitem,xunitsale,xtypestk,xmrp,xstdcost,xcp,xdp,xstdprice,zactive from seitem where zactive=1 order by xitemid";
	$result = mysqli_query($db,$query) or die("Cannot execute query");  
	$data = mysqli_num_rows($result);

 echo json_encode($data);
	}
	
    
	
}else{
	
	echo "Not a valid request!";
}



?>