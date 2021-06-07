<!DOOCTYPE HTML>
<html lang="eng">
<head>
	<meta charset"utf-8"/>
</head>
<body>

<?php

if($_GET["name"] ?? false){ 
	$file_content = file_get_contents("cities.json");
	$cities_decoded = json_decode($file_content);
	$i = 1;

	echo "[";
	foreach($cities_decoded as &$city){

		if(stripos($city->name, htmlspecialchars($_GET["name"])) !== false){
			$i += 1;
			$miasto = json_encode($city);
			echo $miasto;
			if($i !== 10){
				echo ", ";
			}
		}
		if($i === 10){
			break;
		}
	}
	echo "]";
	
}
	
?>

</body>
</html>