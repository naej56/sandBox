<?php
$companyName = 'LE GOFF KEVIN';
if (strlen($companyName) > 10){
	$explCN = explode(' ', $companyName);
	$nameLength = 0;
	if (count($explCN) > 1){
		for ($i = 0; $i < count($explCN); $i++){
			$nameLength = strlen($explCN[$i]) + $nameLength;
			var_dump('Boucle For : ' . $nameLength);
			if ($nameLength > 10){
				if ($i == 0){
					$companyName = substr($explCN[$i], 0, 10) . '.';
					/*$this->MultiCell(50, 10, $companyName);
					$this->SetX(50);*/
					echo $companyName . '</br>';
					$companyName = '';
					$nameLength = 0;
				} else {
					
					/*$this->MultiCell(50, 10, $companyName);
					$this->SetX(50);*/
					echo $companyName . '</br>';
					$companyName = '';
					$nameLength = 0;
				}
			} else {
				if ($i == 0){
					$companyName = $explCN[$i];
					var_dump('if > 10 val des vars dans le else : ' . $i . ' ' . $companyName);
				} else {
					$companyName = '';
					for ($cpt = 0; $cpt <= $i; $cpt++){
						$companyName = $companyName . ' ' . $explCN[$cpt];  
					}
					var_dump('if > 10 val des vars sortie du for : ' . $i . ' ' . $companyName);
				}
			}
		}	
	} else {
		$companyName = substr($companyName, 0, 10) . '.';
		/*$this->Cell(50, 10, $companyName);*/
		echo $companyName . '</br>';
	}
} else {
	/*$this->Cell(50, 10, $companyName);*/
	echo $companyName . '</br>';
}

?>