<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Request-With, Content-Type, Accept, Authorization");
function create($algo, $data, $salt){
			$context = hash_init($algo, HASH_HMAC, $salt);
			hash_update($context, $data);
			return hash_final($context);
		}
$data = json_decode(file_get_contents("php://input"));
$username=$_GET['username'];
	$password=$_GET['password'];

if ($username !='' && $password != ''){
	
	
	include_once('conect.php');

	$query="select zemail,zpassword from pausers where zemail='".$username."' and zpassword='".$password."'";
	
	$result = mysqli_query($db,$query) or die("Cannot execute query");
	
	if (mysqli_num_rows($result)<1) {
			exit("Username or Password dint match!"); 
    }
    
    //ca0af5821f64fbcce24a2d24dff5efb6b1746a0de0c9e69c605c4fbe924d2fd8
    if(isset($_GET['cin']))
    {
    	$cin = $_GET['cin'];
	$query="select xcus,xorg,xmobile,xadd1 from secus where xcus='".$cin."' order by xcus DESC";
	$result = mysqli_query($db,$query) or die("Cannot execute query");  
	$json_response = (array());

    $row = mysqli_fetch_row($result);
    if($row > 0 )
		   {		
		$row_array['xcus'] = $row[0];
		$row_array['xorg'] = $row[1];
		$row_array['xmobile'] = $row[2];
        $row_array['xadd1'] = $row[3];
		} 
		else
		{
			$row_array['xcus'] = 'CIN Not Available';
		}  
        array_push($json_response,$row_array);    
	echo json_encode($json_response);    
	}	
	if(isset($_GET['phone']))
    {
    	$phone = $_GET['phone'];
	$query="select xcus,xorg,xmobile,xadd1 from secus where xmobile='".$phone."' ";
	$result = mysqli_query($db,$query) or die("Cannot execute query");  
	$json_response = (array());
  	
	while ($row = mysqli_fetch_row($result)) {	
		$row_array['xcus'] = $row[0];
		$row_array['xorg'] = $row[1];
		$row_array['xmobile'] = $row[2];
        $row_array['xadd1'] = $row[3];
        array_push($json_response,$row_array); 
    	} 
           
	echo json_encode($json_response);    
	}	
}
else{
	
	echo "Not a valid request!";
}

?>