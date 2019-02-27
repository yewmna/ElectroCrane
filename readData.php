<?php 
	$data = $_POST['data'];
    $data = json_decode($data);

   $file = fopen("brightness.txt","w");
   echo fwrite($file, $data);
   fclose($file);
?>