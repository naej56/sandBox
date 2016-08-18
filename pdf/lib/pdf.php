<?php 
namespace Pdf;
use Exception;
require('FpdfScript.php');
//use lib;
date_default_timezone_set('Europe/Paris');

class Pdf extends FpdfScript{
	
	function genPage($trame = false){
		$this->AddFont('Ethnocentric', '', 'ethnocentric.php');
		$this->AddPage();
		$this->SetMargins(10, 10);
		$this->SetFont('Courier', '', 16);
		if ($trame) {
			// contour global
			$this->Cell(0, 265, '', 1);
			// contour header
			$this->SetXY(10, 10);
			$this->Cell(0, 80, '', 1);
			// info entreprise
			$this->SetXY(10, 10);
			$this->Cell(85, 80, '',1);
		}
		
	}

	function genHeader($company, $customerAddr){
		// trame de fond du devis
		$this->genShading();
		// cachet de l'entreprise
		$this->genCompanyStamp($company);

		// adresse positionnée pour les enveloppes fenêtrées
		$this->genCustomerAddress($customerAddr);

		// positionnement à la fin de la génération du header
		$this->SetXY(10, 90);
		
	}

	function genShading(){
		$this->SetXY(100, 10);
		$this->SetFont('Helvetica', 'BU', 28);
		$this->Cell(100, 12, 'DEVIS pour traveau');
		$this->SetXY(100, 22);
		$this->SetFont('Helvetica', '', 12);
		$this->Cell(50, 6, 'Date : ' . date('d/m/Y'));
		$this->Cell(45, 6, 'Fin de val : ' . date('d/m/Y', strtotime('+1 month')));
		$this->SetXY(100, 28);
		$this->Cell(50, 6, 'Num. : ' . rand(50, 1000));
		$this->SetXY(100, 36);
		$this->SetFont('Helvetica', 'B', 12);
		$this->SetFillColor(200);
		$this->Cell(95, 6, 'Destinataire :', 0, 0, '',  true);
	}

	function genCompanyStamp($company){
		$this->Image($company->getLogo(), 10, 10, 30);
		$this->SetXY(40, 11);
		$this->SetFont('ethnocentric', '', 18);
		$companyName = $company->getCompanyName();
		$explCN = explode(' ', $companyName);	
		$this->Cell(50, 10, $explCN[0] . ' ' . $explCN[1]);
		$this->SetXY(40, 21);
		$this->Cell(50, 10, $explCN[2]);
		$this->SetXY(10, 36);
		$this->SetFont('Helvetica', 'B', 12);
		$this->SetFillColor(200);
		$this->Cell(85, 6, 'Adresse :', 0, 0, '',  true);
		$this->SetFont('Helvetica', '', 12);
		$this->SetXY(10, 43);
		$companyAddr = $company->getAddr();
		$this->MultiCell(85, 5, $companyAddr['name']);
		for ($i = 0; $i < count($companyAddr['street']); $i++){
			if (strlen($companyAddr['street'][$i]) > 0){
				$this->SetX(10);
				$this->MultiCell(85, 5, $companyAddr['street'][$i]);
			}
		}
		$this->SetX(10);
		$this->SetFont('Helvetica', 'B', 12);
		$this->Cell(85, 5, $companyAddr['city']);
		$this->SetXY(10, 60);
		$this->SetFont('Helvetica', 'B', 12);
		$this->SetFillColor(200);
		$this->Cell(85, 6, 'Contact :', 0, 0, '',  true);
		$this->SetFont('Helvetica', '', 12);
		$this->SetXY(10, 67);
		$this->Cell(30, 5, 'Telephone :');
		$this->Cell(55, 5, '06 10 20 30 40');
		$this->SetXY(10, 72);
		$this->Cell(30, 5, 'E-mail :');
		$this->Cell(55, 5, 'Bmw056@laposte.net');
	}

	function genCustomerAddress($customer){
		$customerAddr = $customer->getAddr();
		$this->SetXY(100, 45);
		$this->Cell(95, 34, '', 1);// encadré de l'addresse
		$this->SetFont('Courier', '', 11);
		$this->SetXY(100, 45 );
		$this->MultiCell(95, 5, $customerAddr['name']);
		for ($i = 0; $i < count($customerAddr['street']); $i++){
			if (strlen($customerAddr['street'][$i]) > 0){
				$this->SetX(100);
				$this->MultiCell(95, 5, $customerAddr['street'][$i]);
			}
		}
		$this->SetX(100);
		$this->SetFont('Courier', 'B', 12);
		$this->MultiCell(95, 7, $customerAddr['city']);
	}

	function genTable(){
		$this->SetXY(10, 90);
	}
	function genFooter(){

	}

	// helper pour debug mise en page
	//$this->displayXY(); //affiche la position actuel
	function displayXY(){
		$x = round($this->GetX());
		$y = round($this->GetY());
		$this->SetXY(1, 1);
		$this->SetFillColor(230);
		$this->SetTextColor(255, 0, 0);
		$this->SetFont('Courier', '', 9);
		$this->Cell(50, 8, 'X: ' . $x . ' - Y: ' . $y, 0, '', 'C', true);
		$this->SetTextColor(0);
		$this->SetDrawColor(255, 0, 0);
		$this->Line($x- 2, $y - 2, $x + 2, $y + 2);
		$this->Line($x- 2, $y + 2, $x + 2, $y - 2);
		$this->SetDrawColor(0);
		$this->SetXY($x, $y);
	}
}

class Company{
	private $name = "LE GOFF KEVIN";
	private $street1 = "Restergal";
	private $street2 = "";
	private $zipCode = "56240";
	private $city = 'PLOUAY';
	private $siret = "0123456789";
	private $phone = "06 10 20 30 40";
	private $mail = "Bmw056@laposte.net";
	private $tvaintra = '523658741022336';
	private $logo = '../logo.jpg';

	public function getAddr(){
		return $addr = [
			'name' => $this->name,
			'street' => [$this->street1, $this->street2],
			'city' => $this->zipCode . ' ' . $this->city
		];
	}

	public function getCompanyName(){
		return $this->name;
	}

	public function getContact(){
		return $contact = [
			'phone' => $this->phone,
			'mail' => $this->mail
		];
	}

	public function getAdmin(){
		return $admin = [
			'siret' => $this->siret,
			'tvaintra' => $this->tvaintra
		];
	}

	public function getLogo(){
		return $this->logo;
	}
}

class Customer{
	private $name = "Le Dantec";
	private $firstName = "Jean-Marie";
	private $street1 = "13 rue Henry Sellier";
	private $street2 = "3eme etage droite";
	private $zipCode = "56100";
	private $city = "LORIENT";
	
	public function getAddr(){
		return $addr = [
					'name' => $this->name . ' ' . $this->firstName,
					'street' => [$this->street1, $this->street2],
					'city' => $this->zipCode . ' ' . $this->city
				];
	}
};

class Quotation{
	public $quotationDate = "date('d/m/Y')";
	public $quotationDateValid = "date('d/m/Y', strtotime('+1 month'))";
	public $quotationNumber = "rand(50, 1000)";

};

class QuotationTable{
	private $table;
	
	public function creation(){
		$nbLine = rand(5, 15);
		$prodName = 'Hac ex causa conlaticia stipe Valerius humatur ille Publicola et subsidiis amicorum mariti inops cum liberis uxor alitur Reguli et dotatur ex aerario filia Scipionis, cum nobilitas florem adultae virginis diuturnum absentia pauperis erubesceret patris.';
		for ($i = 0; $i <= $nbLine; $i++){
			$product = substr($prodName, 0, rand(5,50));
			$quantity = rand(1, 100);
			$pu = rand(1, 100);
			$ptht =  $puht * $quantity;
			$ptttc = $ptht * 20 / 100;
			$table[$i] = [
				"idLine" => $i,
				"product" => $product,
				"quantity" => $quantity,
				"puht" => $puht,
				"ptht" => $ptht,
				"ptttc" => $ptttc];
		};
		return $table;
	}
}

$company = new Company;
$customer = new Customer;
$quotationTable = new QuotationTable;
$pdf = new Pdf('P', 'mm', 'A4');
$pdf->genPage();
//$customerAddr = $customer->getAddr();
$pdf->genHeader($company, $customer);
$pdf->Output();





 ?>
