<?php
require('fpdf181/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image(base_url().'assets/evrak/rapor.jpg',6,6,193);

    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
 //   $this->Cell(30,10,'',1,0,'C');
    // Line break
    $this->Ln(0);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Sayfa '.$this->PageNo().'/{nb}',0,0,'C');
}
}

	// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
	//$pdf->SetFont('Times','',11);

$pdf->AddFont('arial_tr','','arial_tr.php');
$pdf->AddFont('arial_tr','B','arial_tr_bold.php');
$pdf->SetFont('arial_tr','',10);



	
  



	
$pdf->Output();





?>

