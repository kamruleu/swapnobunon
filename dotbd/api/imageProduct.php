<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Request-With, Content-Type, Accept, Authorization");
include_once('conect.php');

$id = $_GET['id'];
if($id > 0)
{
$result = $conn->query("select id, productId, image from productImage where productId ='$id'");

$data = array();
if(mysqli_num_rows($result)> 0){
while ($row = mysqli_fetch_array($result)) {
 $data[] = array("id"=>$row['id'],"productId"=>$row['productId'],"image"=>$row['image']);
}
 echo json_encode($data);
}
else
{
	$data = array();
	 $data[] = array("image"=>'noimage.jpg');
	echo json_encode($data);
}
}
else
{
	$data = array();
	 $data[] = array("image"=>'noimage.jpg');
	echo json_encode($data);
}

?>
 