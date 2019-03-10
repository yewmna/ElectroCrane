<?php 
    $current = json_decode($_POST['current']);
    $magentic_field = json_decode($_POST['magnetic_field']);
    
    if($magentic_field==null && $current ==null){
      echo "nothing";
    }else{
      if($magnetic_field==null){
        $magnetic_field = 0;
      }
      if($current == null){
        $current = 0;
      }
      $readings = array($current, $magentic_field);
      saveJSON($readings);
    }
    


    function saveJSON($array){
      $file = fopen("data.json","w");
      echo fwrite($file, json_encode($array));
      fclose($readings);
    }

	/*Multiplayer support off for now so that test is less buggy"

	  $data_v1 = json_decode($_POST['data1']);
    $data_v2 = json_decode($_POST['data2']);
    $team_name = $_POST['namey'];
    $exists = false;
    $data = file_get_contents("data.json");
    $data = json_decode($data,true);

   	//Look for this team name

   	foreach ($data as $key => &$value) {
   		if($value['name']==$team_name){
   			$exists = true;
   			$value['readings']['arduino_1'] = $data_v1;
   			$value['readings']['arduino_2'] = $data_v2;
   			saveJSON($data);
   			break;
   		}
   	}

   	if(!$exists){
	    $new_array = array(
		  $team_name => array(
		    "name" => $team_name,
		    "readings" => array(
		    "arduino_1" => $data_v1,
		    "arduino_2" => $data_v2,
		  )
		  )
		);
	$new_new = array_merge($data, $new_array);
	saveJSON($new_new);
   	}

   	function saveJSON($array){
   		$file = fopen("data.json","w");
   		echo fwrite($file, json_encode($array));
   		fclose($file);
   	}
*/
?>