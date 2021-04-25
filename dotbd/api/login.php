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

$username = $data->username;
$password = $data->password;
if ($username !='' && $password != ''){
	$user=$data->user;
	$passwordr=$data->passwordr;
	
	include_once('conect.php');

	$query="select zemail,zpassword from pausers where zemail='".$username."' and zpassword='".$password."'";
	
	$result = mysqli_query($db,$query) or die("Cannot execute query");
	
	if (mysqli_num_rows($result)<1) {
			exit("Username or Password dint match!"); 
    }
    
    //ca0af5821f64fbcce24a2d24dff5efb6b1746a0de0c9e69c605c4fbe924d2fd8
    if($user != '')
    {
	$pass = create('sha256',$passwordr,'donotchangeitmylove');
	$query="select distrisl,bizid,xrdin,xpassword,xorg,xadd1,xmobile,(SELECT bin FROM `mlmtree` WHERE distrisl =mlminfo.distrisl and bc=1)as bin,(SELECT xbalance FROM `vospbal` WHERE xrdin = mlminfo.xrdin) as balance,membertype,xcus,(SELECT xorg FROM `secus` WHERE xcus = mlminfo.xcus) as xcusdt from mlminfo where xrdin='".$user."' and xpassword = '".$pass."'  order by bizid DESC LIMIT 1";
	$result = mysqli_query($db,$query) or die("Cannot execute query");  
	$json_response = (array());

    $row = mysqli_fetch_row($result);
    if($row > 0 )
		   {		
		$row_array['distrisl'] = $row[0];
		$row_array['bizid'] = $row[1];
		$row_array['xrdin'] = $row[2];
        $row_array['xpassword'] = $row[3];
        $row_array['xfname'] = $row[4];
        $row_array['xadd1'] = $row[5];
        $row_array['xmobile'] = $row[6];
        $row_array['bin'] = $row[7];
        $row_array['balance'] = $row[8];
         $row_array['membertype'] = $row[9];
		 $row_array['xcus'] = $row[10];
		 $row_array['xcusdt'] = $row[11];
		$row_array['message'] = 'Login Successful';
		}
		   else
		   {
		   	$row_array['message'] = 'Username or Password don\'t match!';
		   }    
        array_push($json_response,$row_array);    
	echo json_encode($json_response);    
	}	
}
else{
	
	echo "Not a valid request!";
}

?>