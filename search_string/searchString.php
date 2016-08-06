<?php 
$input = 'm?n+premi?+mon+deux?';

function searchString($input){
	$input = preg_split('(\+)', $input, 3);
	for ($key = 0; $key <= 1; $key++) {
		$search[$key] = str_replace('?', '%', $input[$key]);
	}
	return $search;
}

var_dump(searchString($input));

?>