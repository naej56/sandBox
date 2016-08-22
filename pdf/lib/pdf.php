<?php 
//namespace pdf\lib;
//use Exception;
//use pdf\lib\FpdfScript;
//use lib;
require_once 'FpdfScript.php';

date_default_timezone_set('Europe/Paris');

class Pdf extends FpdfScript{
	
	protected $defaultFont;
	protected $defaultFontStyle;
	protected $defaultFontSize;
	protected $defaultTextColor;
	protected $defaultDrawColor;
	protected $defaultFillColor;


	function setDefault($font = 'helvetica', $fontStyle = '', $fontSize = 11, $textColor = [0], $drawColor = [0], $fillColor = [255]){
		$this->defaultFont = $font;
		$this->defaultFontStyle = $fontStyle;
		$this->defaultFontSize = $fontSize;
		$this->SetFont($font, $fontStyle, $fontSize);
		if(count($textColor) == 3){
			$this->defaultTextColor = $textColor;
		} else {
			$this->defaultDrawColor = $textColor;
		}
		$this->setTextColorArg($textColor);
		if(count($drawColor) == 3){
			$this->defaultDrawColor = $drawColor;
		} else {
			$this->defaultDrawColor = $drawColor;
		}
		$this->setDrawColorArg($drawColor);
		if(count($fillColor) == 3){
			$this->defaultFillColor = $fillColor;
		} else {
			$this->defaultFillColor = $fillColor;
		}
		$this->setFillColorArg($fillColor);
	}

	/**
	 * traitement de la couleur de remplissage passée en argument d'une fonction
	 * @param  array 	$color 	tableau contenant les valeur RGB des la couleur voulue, si une seul valeur est donnée le rendus sera en niveau de gris
	 */
	function setFillColorArg($color){
		if(count($color) == 3){
			$this->SetFillColor($color[0], $color[1], $color[2]);
		} else {
			$this->SetFillColor($color[0]);
		}
	}

	/**
	 * traitement de la couleur de trait passée en argument d'une fonction
	 * @param  array 	$color 	tableau contenant les valeur RGB des la couleur voulue, si une seul valeur est donnée le rendus sera en niveau de gris
	 */
	function setDrawColorArg($color){
		if(count($color) == 3){
			$this->SetDrawColor($color[0], $color[1], $color[2]);
		} else {
			$this->SetDrawColor($color[0]);
		}
	}

	/**
	 * traitement de la couleur de texte passée en argument d'une fonction
	 * @param  array 	$color 	tableau contenant les valeur RGB des la couleur voulue, si une seul valeur est donnée le rendus sera en niveau de gris
	 */
	function setTextColorArg($color){
		if(count($color) == 3){
			$this->SetTextColor($color[0], $color[1], $color[2]);
		} else {
			$this->SetTextColor($color[0]);
		}
	}

	/**
	 * Dessine une rectangle avec des angles arrondis
	 * @param  	int 	$x 			absice du coin supperieur gauche
	 * @param  	int 	$y 			ordonnée du coin supperieur gauche
	 * @param  	int 	$w 			largeur
	 * @param  	int 	$h 			hauteur
	 * @param  	int 	$r 			rayon des angles
	 * @param  	string 	$corner 	nombre d'angles arrondi par defaut 1234
	 * @param  	string 	$drawType 	type de dessin F=plein D=contour par defaut FD
	 * @param  	array 	$fillColor 	couleur de remplissage par defaut 255
	 */
	function drawRC($x, $y, $w, $h, $r, $drawType = 'FD', $corner = '1234', $fillColor = [255]){
		$this->setFillColorArg($fillColor);
		$this->RoundedRect($x, $y, $w, $h, $r, $corner, $drawType);
		$this->setFillColorArg(255);
		//$this->SetXY($x + ceil($r / 2), $y + ceil($r / 2));
		$this->SetXY($x + $r - ceil($h / 2), $y + $r - ceil($h / 2));
	}

	/**
	 * Dessine une multiCell
	 * @param  int 		absice du coin supperieur gauche
	 * @param  int 		ordonnée du coin supperieur gauche
	 * @param  int 		largeur
	 * @param  int 		hauteur
	 * @param  string 	texte à afficher dans la cellule par defaut vide
	 * @param  string 	nom de la police par defaut helvetica
	 * @param  string 	style de la police vide=normale(defaut) B=gras I=italic U=souligné
	 * @param  string 	$align alignement du text dans la cellule
	 * @param  integer 	taille de la police par defaut 11
	 */
	function drawMC($x, $y, $w, $h, $text = '', $font = 'helvetica', $style = '', $size = 11, $align = 'J'){
		$this->SetXY($x, $y);
		$this->SetFont($font, $style, $size);
		$this->MultiCell($w, $h, $text, 0, $align);
		$this->setDefaultFont();
		$this->SetXY($x, ($y + $h));
	}

	/**
	 * generation de la première page
	 * @param  	int  	$marginLeft  	marge de gauche
	 * @param  	int  	$marginTop   	marge du haut
	 * @param  	int  	$marginRight 	marge de droite
	 * @param  	array   $addFont     	police de caractères personnelle doit être un tableau multidimensionnel array[0][$fontName, $fontStyle, $fontFile]
	 * @param 	string 	$displayZoom 	niveau de zoom lors de l'ouverture du document 	
	 *                               	fullpage : affiche entièrement les pages à l'écran
	 *									fullwidth : maximise la largeur des pages
	 *									real : affiche la taille réelle (équivaut à un zoom de 100%)
	 *									default : utilise le mode d'affichage par défaut du lecteur
	 * @param 	string 	$displayLayout 	disposition dont les page vont s'afficher 	
	 *                                 	single : affiche une seule page à la fois
	 *                                 	continuous : affichage continu d'une page à l'autre
	 *                                  two : affiche deux pages sur deux colonnes
	 *                                  default : utilise le mode d'affichage par défaut du lecteur
	 */
	function genPage($marginLeft, $marginTop, $marginRight, $addFont = array(), $displayZoom = 'default', $displayLayout = 'default'){
		$this->SetMargins($marginLeft, $marginTop, $marginRight);
		if(count($addFont) > 0){
			for($i = 0; $i < count($addFont); $i++){
				$this->AddFont($addFont[$i][0],$addFont[$i][1], $addFont[$i][2]);
			}
		}
		$this->AddPage();
		$this->AliasNbPages();
		$this->SetDisplayMode($displayZoom, $displayLayout);
		$this->SetCreator('Quoma');

	}

	/**
	 * Remet la police caractère par défaut
	 */
	function setDefaultFont(){
		if(!isset($this->defaultFontStyle)){
			$this->SetFont($this->defaultFont, $this->defautFontStyle, $this->defaultFontSize);
		} else {
			$this->SetFont($this->defaultFont, '', $this->defaultFontSize);
		}
	}

	/**
	 * affiche le pdf dans le navigateur
	 * @param  string 	$name 	nom du fichier par defaut devis.pdf
	 */
	function outputFile($name = 'devis.pdf'){
		$this->Output('I', $name, true);
	}

	function genTable(){
		$this->SetXY(10, 90);
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

 ?>
