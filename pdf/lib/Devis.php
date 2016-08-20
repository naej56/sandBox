<?php 
//namespace pdf\lib;
//use Execption;
//use pdf\lib\pdf;
require_once 'autoload.php';
require_once 'Pdf.php';

class Devis extends Pdf{

	/**
	 * Définit les métadonnées du pdf
	 * @param string $creator  créateur du document
	 * @param string $subject  sujet du document
	 * @param string $keyWords mots clés associés au document
	 */
	function setMetaData($creator = 'Unknow', $subject = 'Devis', $keyWords = 'Devis travaux neuf rénovation'){
		$this->SetCreator($creator);
		$this->SetSubject($subject);
		$this->SetKeywords($keyWords);
	}

	/**
	 * Génération de l'adresse du client
	 * @param  string 	$name      	nom du client
	 * @param  string 	$firstname 	prenom du client
	 * @param  string 	$street1   	rue du client
	 * @param  string 	$zipCode   	code postal du client
	 * @param  string 	$city      	ville du client
	 * @param  string 	$street2   	rue seccondaire du client par défaut à vide
	 */
	function genCustomerAddress($name, $firstname, $street1, $zipCode, $city, $street2 = ''){
		$this->drawRC(100, 33, 95, 10, 2, '1234', 'F', [200]);
		$this->SetXY(102, 35);
		$this->SetFont('helvetica', 'BU', 14);
		$this->Cell(91, 6, 'Destinataire :');
		$this->setDefaultFont();
		$this->drawRC(100, 45, 95, 34, 2, '1234', 'D');
		$this->drawMC(102, 47, 95, 5, $name . ' ' . $firstname);
		$this->drawMC(102, 52, 95, 5, $street1);
		$this->drawMC(102, 57, 95, 5, $street2);
		$this->SetXY(102, ($this->GetY() + 5));
		$this->SetFont('helvetica', 'B', 12);
		$this->MultiCell(95, 5, $zipCode . ' ' . $city);
		$this->setDefaultFont();
	}

	//footer
	function footer(){
		$this->RoundedRect(10, 277, 190, 10, 2, '1234', 'D');
		$this->SetXY(10, -20);
		$this->SetFont('helvetica', 'I', 8);
		$this->Cell(160, 10, 'TVA non applicable, art. 293 B du CGI.');
		$this->SetXY(170, -20);
		$this->SetFont('helvetica', 'I', 10);
		$this->Cell(30, 10, 'Page ' . $this->PageNo() . ' / {nb}', 0, 0, 'R');
	}



}


// init faker
$faker = Faker\Factory::create('fr_FR');

// generation du pdf
$devis = new Devis('P', 'mm', 'A4');
$devis->setDefault();
// generation de la page
$devis->genPage(10, 10, 10, [], 'fullpage', 'continuous');
// generation de l'adresse du client
$devis->genCustomerAddress($faker->lastName, $faker->firstname, $faker->streetAddress, $faker->postcode, strtoupper($faker->city));
//generation du contenu

//fonction pour tester des résultats
//$pdf->test();

//output
//$pdf->Output();
$devis->outputFile();


 ?>