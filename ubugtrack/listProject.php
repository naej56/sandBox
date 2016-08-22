<?php
	$url = 'https://ubugtrack.com/api/32ae239c155b6075eb02d40db94da886a8e25cb00a5b8b8f3f2700d1bd139858/projects/';
		
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$response = curl_exec($ch);
	$result = json_decode($response);
	var_dump($response);
	if ($result->success)
	{
		foreach ($result->projects as $project)
			echo $project->id.' - '.$project->name;
	}
?>