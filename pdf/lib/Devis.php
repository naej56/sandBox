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
	 * Genère le tampom de l'entreprise
	 * @param  string $name      nom de l'entreprise
	 * @param  string $street1   rue 1 de l'adresse de l'entreprise
	 * @param  string $zipCode   code postal de l'entreprise
	 * @param  string $city      ville de l'entreprise
	 * @param  string $siret     numero de siret
	 * @param  string $cellphone numéro de portable
	 * @param  string $phone     numéro de téléphone
	 * @param  string $mail      adresse mail
	 * @param  string $street2   rue 2 de l'adresse de l'entreprise
	 * @param  string $logo      url ou chemin du logo
	 */
	function genCompagnyStamp($name, $street1, $zipCode, $city, $siret, $cellphone = '', $phone = '', $mail = '', $street2 = '', $logo = ''){
		$this->ClippingRoundedRect(10, 10, 20, 15, 4, false);
		$this->Image($logo, 10, 10, 20, 15, 'jpg');
		$this->UnsetClipping();
		$this->drawMC(35, 10, 55, 8, $name, 'ethnocentric', '', 25);
		$this->SetXY(10, 30);
		$this->drawRC(10, 30, 85, 6, 4, 'F', '13', [200]);
		//$this->drawRC(10, 30, 85, 49, 2, 'D', '1234');
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

	/**
	 * génération des info du devis
	 * @param  int $quotationNumber numéro du devis
	 */
	function genQuotationHeading($quotationNumber){
		$this->drawRC(100, 10, 95, 8, 6, 'F', '13', [200]);
		//$this->drawRC(100, 10, 95, 25, 2, 'D', '1234');
		$this->SetFont('helvetica', 'BU', 16);
		$this->SetXY(102, 11);
		$this->Cell(91, 6, 'DEVIS pour travaux');
		$this->SetXY(101, 19);
		$this->drawMC($this->GetX(), $this->GetY(), 40, 5, 'Fait le :', '', 'BU');
		$this->drawMC($this->GetX(), $this->GetY(), 40, 5, 'Fin de validite :', '', 'BU');
		$this->drawMC($this->GetX(), $this->GetY(), 40, 5, 'Numero :', '', 'BU');
		$this->SetXY(141, 19);
		$this->drawMC($this->GetX(), $this->GetY(), 40, 5, date('d/m/Y'));
		$this->drawMC($this->GetX(), $this->GetY(), 40, 5, date('d/m/Y', strtotime('+1 month')));
		$this->drawMC($this->GetX(), $this->GetY(), 40, 5, $quotationNumber);
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
		$this->drawRC(100, 39, 95, 6, 4, 'F', '13', [200]);
		//$this->drawRC(100, 39, 95, 40, 2, 'D', '1234');
		$this->SetFont('helvetica', 'BU', 11);
		$this->Cell(91, 4, 'Destinataire :');
		$this->SetXY(101, 48);
		$this->drawMC($this->GetX(), $this->GetY(), 95, 5, $name . ' ' . $firstname);
		$this->drawMC($this->GetX(), $this->GetY(), 95, 5, $street1);
		$this->drawMC($this->GetX(), $this->GetY(), 95, 5, $street2);
		$this->drawMC($this->GetX(), $this->GetY() + 2, 95, 5, $zipCode . '  ' . $city, 'helvetica', 'B', 12);
	}

	function genQuotationBody($quotationLine, $quotationTotal){
		$this->SetXY(10, 85);
		$this->drawRC($this->GetX(), $this->GetY(), 190, 8, 6, 'F', '13', [200]);
		$this->drawMC($this->GetX(), $this->GetY(), 10, 5, '#', '', 'B', 12, 'C');
		$this->SetXY($this->GetX() + 10, $this->GetY() - 5);
		$this->drawMC($this->GetX(), $this->GetY(), 135, 5, 'Produit', '', 'B', 12);
		$this->SetXY($this->GetX() + 130, $this->GetY() - 5);
		$this->drawMC($this->GetX(), $this->GetY(), 15, 5, 'Qte', '', 'B', 12, 'C');
		$this->SetXY($this->GetX() + 15, $this->GetY() - 5);
		$this->drawMC($this->GetX(), $this->GetY(), 15, 5, 'P.U.', '', 'B', 12, 'C');
		$this->SetXY($this->GetX() + 15, $this->GetY() - 5);
		$this->drawMC($this->GetX(), $this->GetY(), 15, 5, 'Total', '', 'B', 12, 'C');
		$this->SetXY(12, 95);
		//var_dump($quotationLine);
		for($i = 0; $i < count($quotationLine); $i++){
			$nb = $i + 1;
			if($nb%2 == 0){
				$x = $this->GetX();
				$y = $this->GetY();
				$this->setFillColorArg([230]);
				$this->Cell(186, 7, '', 0, 0, 'L', true);
				$this->SetDefault();
				$this->SetXY($x, $y);
			}
			$this->drawMC($this->GetX(), $this->GetY(), 10, 7, strval($nb), '', '', 11, 'C');
			$this->SetXY($this->GetX() + 10, $this->GetY() - 7);
			$this->drawMC($this->GetX(), $this->GetY(), 135, 7, $quotationLine[$i]['product']);
			$this->SetXY($this->GetX() + 130, $this->GetY() - 7);
			$this->drawMC($this->GetX(), $this->GetY(), 15, 7, $quotationLine[$i]['qte'], '', '', 11, 'C');
			$this->SetXY($this->GetX() + 15, $this->GetY() - 7);
			$this->drawMC($this->GetX(), $this->GetY(), 15, 7, $quotationLine[$i]['pu'], '', '', 11, 'C');
			$this->SetXY($this->GetX() + 15, $this->GetY() - 7);
			$this->drawMC($this->GetX(), $this->GetY(), 15, 7, $quotationLine[$i]['total'], '', '', 11, 'C');
			$this->SetXY(12, $this->GetY() + 2);
			$this->pageBreak(270);
		}
		//$this->pageBreak();
		$this->drawRC($this->GetX() + 136, $this->GetY() + 2, 50, 8, 6, 'F', '13', [200]);
		$this->drawMC($this->GetX() - 1, $this->GetY() - 1, 25, 6, 'Total :', '', 'BU', 13, 'C');
		$this->drawMC($this->GetX() + 20, $this->GetY() - 6, 25, 6, $quotationTotal . ' E', '', 'B', 13, 'C');
	}

	function genQuotationSigning(){
		$this->pageBreak(237);
		$this->SetXY(10, -60);
		$this->drawRC($this->GetX(), $this->GetY(), 60, 35, 5, 'F', '13', [200]);
		$this->SetXY(12, -58);
		$this->drawMC($this->GetX(), $this->GetY(), 50, 4,'Le :', '', '', 8);
		$this->drawMC($this->GetX(), $this->GetY(), 50, 4,'Bon pour accord.', '', '', 8);
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

	function pageBreak($h){
		$y = $this->GetY();
		$x = $this->GetX();
		if($y > $h){
			$this->addPage();
			$this->SetXY($x, 10);
		}
	}

}


// init faker
$faker = Faker\Factory::create('fr_FR');
// tableau d'ajout de police de caractère
$addFont = [['ethnocentric', '', 'ethnocentric.php']];
//
function quotLineGen($faker){
	$nb = $faker->numberBetween(15, 40);
	for($i = 0; $i < $nb; $i++){
		$prod = $faker->sentence($faker->numberBetween(2,6), true);
		$qte = $faker->numberBetween(1, 50);
		$pu = $faker->numberBetween(1, 150);
		$total = $pu * $qte;
		$quotLine[$i] = [
			'product' => $prod,
			'qte' => $qte,
			'pu' => $pu,
			'total' => $total
		];
	}
	return $quotLine;
}

// generation du pdf
$devis = new Devis('P', 'mm', 'A4');
$devis->setDefault();
$devis->SetAutoPageBreak(false, 25);
// generation de la page
$devis->genPage(10, 10, 10, $addFont, 'fullpage', 'continuous');
// generation du cachet d'entreprise
$devis->genCompagnyStamp('Le Goff Kevin', 'Restergal', '56240', 'PLOUAY', $faker->siret(), '07 81 23 20 65', '', 'kevin.legoff.carreleur@gmail.com', '', 'logo2.jpg');
// generation de l'entete du devis
$devis->genQuotationHeading($faker->randomNumber());
// generation de l'adresse du client
$devis->genCustomerAddress($faker->lastName, $faker->firstname, $faker->streetAddress, $faker->postcode, strtoupper($faker->city));
//generation du contenu
$devis->genQuotationBody(quotLineGen($faker), $faker->numberBetween(500, 15000));
//generation de la zone de signature
$devis->genQuotationSigning();
//fonction pour tester des résultats
//$pdf->test();

//output
//$pdf->Output();
$devis->outputFile();


 ?>