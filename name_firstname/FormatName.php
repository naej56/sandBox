<?php 

if (isset($_POST['name'])){
	echo format($_POST['name']);

}


function format($input){
	$input = preg_split('/([[:blank:]]|-)/', $input, -1, PREG_SPLIT_DELIM_CAPTURE);
	foreach ($input as $key => $value) {
		$name[$key] = ucfirst($value);
	}
	return implode($name);
}

?>

<form method="post" action="FormatName.php">
	<input type="text" name="name">
	<input type="submit" name="Go">
</form>
