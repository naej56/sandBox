<?php
function listProject($apiUserKey){
	$url = 'https://ubugtrack.com/api/' . $apiUserKey . '/projects/';
		
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	$response = curl_exec($ch);

	if($errno = curl_errno($ch)) {
    	$error_message = curl_strerror($errno);
    	echo "cURL error ({$errno}):\n {$error_message}";
	}

	$result = json_decode($response);
	var_dump($response);
	var_dump($result);
	if ($result->success)
	{
		foreach ($result->projects as $project)
			echo $project->id.' - '.$project->name;
	}
}

listProject('e53309a2400c7611377458bdc88e7c755bfd7cf391aa0981f11d143b575bec3d'); //j'ai remplacé içi ma clé par des xxxx
?>