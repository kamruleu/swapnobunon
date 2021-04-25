<?php

try{
$conn = new PDO("sqlsrv:Server=127.0.0.1,1433;Database=ERPonTheNet","sa","sa");

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(Exception $e){
	echo print_r($e->getMessage());
}



$tsql = "select * from cacus";
$getresult = $conn->prepare($tsql);
$getresult->execute();

$result=$getresult->fetchAll(PDO::FETCH_BOTH);



print_r($result);

?>
