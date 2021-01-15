


<?php

/* 

 - Php ile anlık dolar, euro ve altın kuru
 - www.tayfunguler.org

*/

	 $ups = $_SERVER['REQUEST_URI'];
	 header("Refresh: 5; URL = $ups");

	function replace_tr($text) {
	$text = trim($text);
	$search = array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü',' ');
	$replace = array('c','c','g','g','i','i','o','o','s','s','u','u',' ');
	$new_text = str_replace($search,$replace,$text);
	return $new_text;
	} 

 	$site = file_get_contents('https://kur.doviz.com/serbest-piyasa/amerikan-dolari');

 	preg_match_all('@<span class="name">(.*?)</span>@si', $site, $name);
 	preg_match_all('@<span class="value">(.*?)</span>@si', $site, $value);

 	$nameupdate 	= 	$name[1];
 	$valueupdate 	= 	$value[1];

	echo "<ul>";
 		foreach ($nameupdate as $nameup => $key) {
 			echo "<li>";
 				echo replace_tr($key);
 				echo ": ";
	 		foreach ($valueupdate as $valuep => $value) {
	 			if($nameup == $valuep) {
	 				echo replace_tr($value);
	 				echo "</li>";
	 			}
	 		}
 		}

	echo "</ul>";
	
	?>
	
	




	
	
	
	
	
	
