<?php 
//namespace pdf\lib;
//use Execption;
//use pdf\lib\pdf;
require_once 'autoload.php';

// init faker
$faker = Faker\Factory::create('fr_FR');

// generation du pdf
$pdf = new Pdf('P', 'mm', 'A4');
// generation de la page
$pdf->genPage();

//generation du header unique
$pdf->genHeader();
//generation du contenu

//fonction pour tester des résultats
$pdf->test();

//output
$pdf->Output();


 ?>