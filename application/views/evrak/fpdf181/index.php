<?php
require('fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
//    $this->Image('0001.jpg',6,6,193);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(30,10,'',1,0,'C');
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
$pdf->SetFont('Times','',11);
for($i=1;$i<=16;$i++)
    $pdf->Cell(50,7,'                                                Satır'.$i,50,50);
for($i=1;$i<=11;$i++)
    $pdf->Cell(50,8,'       										Satır'.$i,50,50);




$pdf->Output();
?>