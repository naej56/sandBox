<?php 
//namespace pdf\lib;
//use Exception;
//use pdf\lib\FpdfScript;
//use lib;
require_once 'FpdfScript.php';

date_default_timezone_set('Europe/Paris');

class Pdf extends FpdfScript{

	//helper function
	
	/**
	 * @param  int absice du coin supperieur gauche
	 * @param  int ordonnée du coin supperieur gauche
	 * @param  int largeur
	 * @param  int hauteur
	 * @param  int rayon des angles
	 * @param  string nombre d'angles arrondi par defaut 1234
	 * @param  string type de dessin F=plein D=contour par defaut FD
	 * @param  int couleur (niveau de gris) de remplissage par defaut 255
	 */
	function drawRC($x, $y, $w, $h, $r, $corner = '1234', $drawType = 'FD', $fillColor = 255){
		$this->SetFillColor($fillColor);
		$this->RoundedRect($x, $y, $w, $h, $r, $corner, $drawType);
		$this->SetFillColor(255);
		$this->SetXY($x, $y);
	}

	/**
	 * @param  int absice du coin supperieur gauche
	 * @param  int ordonnée du coin supperieur gauche
	 * @param  int largeur
	 * @param  int hauteur
	 * @param  string texte à afficher dans la cellule par defaut vide
	 * @param  string nom de la police par defaut helvetica
	 * @param  string style de la police vide=normale(defaut) B=gras I=italic U=souligné
	 * @param  integer taille de la police par defaut 11
	 */
	function drawMC($x, $y, $w, $h, $text = '', $font = 'helvetica', $style = '', $size = 11){
		$this->SetXY($x, $y);
		$this->SetFont($font, $style, $size);
		$this->MultiCell($w, $h, $text);
		$this->SetXY($x, ($y + $h));
	}

	function genPage($trame = false){
		$this->AddFont('Ethnocentric', '', 'ethnocentric.php');
		$this->AddPage();
		$this->SetMargins(10, 10);
		$this->SetFont('helvetica', '', 16);
		$this->AliasNbPages();
		if ($trame) {
			// contour global
			$this->Cell(0, 265, '', 1);
			// contour header
			$this->SetXY(10, 10);
			$this->Cell(0, 80, '', 1);
			// info entreprise
			$this->SetXY(10, 10);
			$this->Cell(85, 80, '', 1);
		}
	}

	

	function genHeader(){
		// trame de fond du devis
		//$this->genShading();
		// cachet de l'entreprise
		//$this->genCompanyStamp();
		// adresse positionnée pour les enveloppes fenêtrées
		$this->genCustomerAddress();
		// positionnement à la fin de la génération du header
		$this->SetXY(10, 90);
	}

	function genCustomerAddress(){
		$this->drawRC(100, 33, 95, 10, 2, '1234', 'F', 230);
		$this->drawRC(100, 45, 95, 34, 2, '1234', 'D');
		$this->drawMC(102, 47, 95, 5, 'Le Dantec Jean-Marie');
		$this->drawMC(102, 52, 95, 5, '13 rue Henri Sellier');
		$this->drawMC(102, 57, 95, 5, '');
		$this->SetXY(102, ($this->GetY() + 5));
		$this->SetFont('helvetica', 'B', 12);
		$this->MultiCell(95, 5, '56100 LORIENT');
	}

	function genTable(){
		$this->SetXY(10, 90);
	}
	
	function footer(){
		//contour du footer
		$this->RoundedRect(10, 277, 190, 10, 2, '1234', 'D');
		//mention légales
		$this->SetXY(10, -20);
		$this->SetFont('helvetica', 'I', 8);
		$this->Cell(160, 10, 'TVA non applicable, art. 293 B du CGI.');
		//pagination
		$this->SetXY(170, -20);
		$this->SetFont('helvetica', 'I', 10);
		$this->Cell(30, 10, 'Page ' . $this->PageNo() . ' / {nb}', 0, 0, 'R');
	}

	function test(){
		//test des taille de texte
		/*for($i = 0; $i < 18; $i++){
			$taille = 1 + ($i * 2);
			$this->SetFont('Courier', '', $taille);
			$this->MultiCell(190, 10, 'Texte de réference pour la taille ' . $taille);
		}*/
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
/*
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
/*
$company = new Company;
$customer = new Customer;
$quotationTable = new QuotationTable;
$pdf = new Pdf('P', 'mm', 'A4');
$pdf->genPage();
//$customerAddr = $customer->getAddr();
$pdf->genHeader($company, $customer);
$pdf->Output();*/





 ?>
