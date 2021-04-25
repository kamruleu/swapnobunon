<?php
$db = mysqli_connect("localhost", "dotbdsol_root", "dbs@)!&", "dotbdsol_erp") or die ("Could not connect to server\n"); 

	if (!$db) {
        die('Could not connect to db: ' . mysqli_error());
    }
?>