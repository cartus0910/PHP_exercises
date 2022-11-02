<?php	
	
	$download=json_encode($_POST["mydata"]); 
	$date = date("D M d, Y G:i");
	$fileName="old.json";

	if (!file_exists($download)){
		if(($myfile = fopen($fileName, "w"))!==false){
		  $contents=$download;
		  fwrite($myfile,$contents);
		  
		  fclose($myfile);
		  echo "File '{$fileName}' written successfully";      
		}else
		  echo "File '{$fileName}' written failed";
	}else
		echo "File exists!! <br />";  
	
?>