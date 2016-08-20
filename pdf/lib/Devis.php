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

	function genCompagnyStamp($name, $street1, $zipCode, $city, $siret, $cellphone = '', $phone = '', $mail = '', $street2 = '', $logo = ''){
		$this->ClippingRoundedRect(10, 10, 20, 15, 4, false);
		$this->Image($logo, 10, 10, 20, 15, 'jpg');
		$this->UnsetClipping();
		$this->drawMC(35, 10, 55, 8, $name, 'ethnocentric', '', 25);
		$this->SetXY(10, 30);
		$this->drawRC(10, 30, 85, 6, 2, 'F', '12', [200]);
		$this->drawRC(10, 30, 85, 49, 2, 'D', '1234');
		$this->SetFont('helvetica', 'BU', 11);
		$this->Cell(85, 4, 'Coordonnees :');
		$this->drawMC(11, 38, 85, 5, $name);
		$this->drawMC($this->GetX(), $this->GetY(), 85, 5, $street1);
		$this->drawMC($this->GetX(), $this->GetY(), 85, 5, $street2);
		$this->drawMC($this->GetX(), $this->GetY() + 2, 85, 5, $zipCode . '  ' . $city, 'helvetica', 'B', 12);
		$this->SetXY($this->GetX(), $this->GetY() + 1);
		$this->SetDrawColor(200);
		$this->SetLineWidth(0.7);
		$this->Line($this->GetX() + 2, $this->GetY(), $this->GetX() + 81, $this->GetY());
		$this->SetLineWidth(0.2);
		$this->SetDrawColor(0);
		$this->SetDash();
		$this->SetXY($this->GetX(), $this->GetY() + 1);
		$this->drawMC($this->GetX(), $this->GetY(), 15, 5, 'Mail :', 'helvetica', 'BU', 11);
		$this->drawMC($this->GetX(), $this->GetY(), 15, 5, 'Tel. :', 'helvetica', 'BU', 11);
		$this->drawMC($this->GetX(), $this->GetY(), 15, 5, 'Siret :', 'helvetica', 'BU', 11);
		$this->SetXY(26, 62);
		$this->drawMC($this->GetX(), $this->GetY(), 60, 5, $mail);
		$this->drawMC($this->GetX(), $this->GetY(), 60, 5, $cellphone);
		$this->drawMC($this->GetX(), $this->GetY(), 60, 5, $siret);
	}

	function genQuotationHeading(){
		$this->drawRC(100, 10, 95, 8, 2, 'F', '12', [200]);
		$this->drawRC(100, 10, 95, 25, 2, 'D', '1234');
		$this->SetFont('helvetica', 'BU', 16);
		$this->Cell(91, 6, 'DEVIS :');
		$this->SetXY(101, 19);
		//$this->displayXY();
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
		$this->drawRC(100, 39, 95, 6, 2, 'F', '12', [200]);
		$this->drawRC(100, 39, 95, 40, 2, 'D', '1234');
		$this->SetFont('helvetica', 'BU', 11);
		$this->Cell(91, 4, 'Destinataire :');
		$this->SetXY(101, 48);
		$this->drawMC($this->GetX(), $this->GetY(), 95, 5, $name . ' ' . $firstname);
		$this->drawMC($this->GetX(), $this->GetY(), 95, 5, $street1);
		$this->drawMC($this->GetX(), $this->GetY(), 95, 5, $street2);
		$this->drawMC($this->GetX(), $this->GetY() + 2, 95, 5, $zipCode . '  ' . $city, 'helvetica', 'B', 12);
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
// tableau d'ajout de police de caractère
$addFont = [['ethnocentric', '', 'ethnocentric.php']];
// generation du pdf
$devis = new Devis('P', 'mm', 'A4');
$devis->setDefault();
// generation de la page
$devis->genPage(10, 10, 10, $addFont, 'fullpage', 'continuous');
// generation du cachet d'entreprise
$devis->genCompagnyStamp('Le Goff Kevin', 'Restergal', '56240', 'PLOUAY', $faker->siret(), '07 81 23 20 65', '', 'kevin.legoff.carreleur@gmail.com', '', 'logo2.jpg');
// generation de l'entete du devis
$devis->genQuotationHeading();
// generation de l'adresse du client
$devis->genCustomerAddress($faker->lastName, $faker->firstname, $faker->streetAddress, $faker->postcode, strtoupper($faker->city));
//generation du contenu

//fonction pour tester des résultats
//$pdf->test();

//output
//$pdf->Output();
$devis->outputFile();


 ?>