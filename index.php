<?php
require_once 'includes/Mobile_Detect.php';
$detect = new Mobile_Detect;
 
if($detect->isMobile()) {
    header('Location: play.html');
    exit;
}else{
	echo "npo";
	header('Location: track.php');
    exit;
}
?>