<?

if ($dfw_data == "") {
	// echo "<br>ERROR: No input provided";
	echo "<script>";
	echo "alert('ERROR: No input provided');";
	echo "</script>";
	// echo "<script>";
	// echo 'webix.alert({
		// type:"alert-error",
		// text:"ERROR: No input provided !!",
		// ok:"OK",
		// callback:function(){}
	// });';
	// echo "</script>";
	exit;
}

if ($dfw_filename == "") {
	$dfw_filename = "Output";
}

$dfw_type = substr($dfw_filename,-3);


if ($dfw_type == "xls") {
	header("Content-type: application/msexcel");
	header('Content-Type: application/vnd.ms-excel'); //IE and Opera  
	header('Content-Type: application/x-msexcel'); 		// Other browsers  
	header("Content-Disposition: attachment; filename=$dfw_filename");
	header("Pragma: no-cache");
	header("Expires: 0");
	print "$header\n$dfw_data";
}
elseif ($dfw_type == "doc") {
	header("Content-type: application/msword");
	header('Content-Type: application/vnd.ms-word'); 	//IE and Opera  
	header('Content-Type: application/x-msword'); 		// Other browsers  
	header("Content-Disposition: attachment; filename=$dfw_filename");
	header("Pragma: no-cache");
	header("Expires: 0");
	print "$header\n$dfw_data";
}
elseif ($dfw_type == "txt") {
	header("Content-type: application/notepad");
	header("Content-Disposition: attachment; filename=$dfw_filename");
	header("Pragma: no-cache");
	header("Expires: 0");
	print "$header\n$dfw_data";
}
elseif ($dfw_type == "ppt") {
	header("Content-type: application/mspowerpoint");
	header('Content-Type: application/vnd.ms-powerpoint'); 	//IE and Opera  
	header('Content-Type: application/x-mspowerpoint'); 		// Other browsers  
	header("Content-Disposition: attachment; filename=$dfw_filename");
	header("Pragma: no-cache");
	header("Expires: 0");
	print "$header\n$dfw_data";
}
elseif ($dfw_type == "xlr") {
	header("Content-type: application/msworks");
	header('Content-Type: application/vnd.ms-works'); 	//IE and Opera  
	header('Content-Type: application/x-msworks'); 			// Other browsers  
	header("Content-Disposition: attachment; filename=$dfw_filename");
	header("Pragma: no-cache");
	header("Expires: 0");
	print "$header\n$dfw_data";
}
elseif ($dfw_type == "rtf") {
	header("Content-type: application/msworks");
	header('Content-Type: application/vnd.ms-works'); 	//IE and Opera  
	header('Content-Type: application/x-msworks'); 			// Other browsers  
	header("Content-Disposition: attachment; filename=$dfw_filename");
	header("Pragma: no-cache");
	header("Expires: 0");
	print "$header\n$dfw_data";
}
elseif ($dfw_type == "csv") {
	header("Content-type: application/msworks");
	header('Content-Type: application/vnd.ms-works'); 	//IE and Opera  
	header('Content-Type: application/x-msworks'); 			// Other browsers  
	header("Content-Disposition: attachment; filename=$dfw_filename");
	header("Pragma: no-cache");
	header("Expires: 0");
	print "$header\n$dfw_data";
}

else {
	// echo "<br>ERROR: invalid file type - must be .xls .doc .txt .ppt .xlr .rtf or .csv";
	echo "<script>";
	echo "alert('ERROR: invalid file type - must be .xls .doc .txt .ppt .xlr .rtf or .csv');";
	echo "</script>";
}

?>