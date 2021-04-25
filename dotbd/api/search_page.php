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
    if(isset($_GET['q']))
    {
	$search = $_GET['q'];

	$query="select xitemid,xitemcode,xsource,xdesc,xlongdesc,xcat,xbrand,xgitem,xcitem,xunitsale,xtypestk,xmrp,xstdcost,xcp,xdp,xstdprice,zactive from seitem where zactive=1 and xcitem='All Operation' and xdesc like '%$search%' or xitemcode like '%$search%' order by xitemid DESC";
	$result = mysqli_query($db,$query) or die("Cannot execute query");  
		

	$result = mysqli_query($db,$query) or die("Cannot execute query");  
	$data = mysqli_num_rows($result);

 	echo json_encode($data);
    }
	else
	{
		$query="select xitemid,xitemcode,xsource,xdesc,xlongdesc,xcat,xbrand,xgitem,xcitem,xunitsale,xtypestk,xmrp,xstdcost,xcp,xdp,xstdprice,zactive from seitem where zactive=1 and xcitem='All Operation' order by xitemid";
	$result = mysqli_query($db,$query) or die("Cannot execute query");  
	$data = mysqli_num_rows($result);

 echo json_encode($data);
	}
	
    
	
}else{
	
	echo "Not a valid request!";
}

?>