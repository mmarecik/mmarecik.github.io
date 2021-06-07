<!DOOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset"utf-8"/>
</head>
<body>

<?php

	if (false !== strpos($_SERVER['REQUEST_URI'], '?')){

		$findme = htmlspecialchars($_GET["name"]);

	}
	else{

		$findme = "";

	}

	$cities_json = file_get_contents("cities.json");
	$cities_array = json_decode( $cities_json, true);
		
	$found_cities = [];
		
	foreach( $cities_array as $city){
		if(stripos($city["name"], $findme) !== false){
				
			array_push($found_cities, $city);
				
		}
		if(count($found_cities) === 10 ){
			break;
		}
	}
		
		echo json_encode($found_cities);
	
?>

</body>
</html>