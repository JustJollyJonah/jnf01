<?php 

function print_array($array){
	foreach($array as $value){
		echo $value . "<br>";
	}
}

function sort_num($array, $type){
	if($type == 'asc'){
		return sort($array);
	}else if($type == 'desc'){
		return rsort($array);
	}
}

function sort_text($array, $type){
	if($type == 'asc'){
		return sort($array);
	}else if($type == 'desc'){
		return rsort($array);
	}
}

?>