<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Request-With, Content-Type, Accept, Authorization");
if (isset($_GET['username']) && isset($_GET['password'])){
	
	$username=$_GET['username'];
	$password=$_GET['password'];
	$rin=$_GET['rin'];
	
	include_once('conect.php');

	$query="select zemail,zpassword from pausers where zemail='".$username."' and zpassword='".$password."'";
	
	$result = mysqli_query($db,$query) or die("Cannot execute query");
	
	if (mysqli_num_rows($result)<1) {
		
       
			exit("Username or Password dint match!");
		
        
    }

    //ca0af5821f64fbcce24a2d24dff5efb6b1746a0de0c9e69c605c4fbe924d2fd8

	$query="SELECT DISTINCT ximsenum,xdate,xcus,xcusdt,ximsesl FROM `imsetxn` where zemail = '$rin' ORDER BY `ximsesl`  DESC";
	$result = mysqli_query($db,$query) or die("Cannot execute query");  


	$json_response = (array());
    
    while ($row = mysqli_fetch_row($result)) {
		   
    	$row_array['ximsenum'] = $row[0];
		$row_array['xdate'] = $row[1];
		$row_array['xcus'] = $row[2];
        $row_array['xcusdt'] = $row[3];

        array_push($json_response,$row_array);
  
    }
    
	echo json_encode($json_response);
	
}else{
	
	echo "Not a valid request!";
}

?>