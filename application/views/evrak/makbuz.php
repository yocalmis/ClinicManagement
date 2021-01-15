<?php
require('fpdf181/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
     $this->Image(base_url().'themes/evrak/makbuz.jpg',6,6,193);
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

//SATIR BOÞLUÐU
for($i=1;$i<=40;$i++)
    $pdf->Cell(50,1,'',50,50);

//ÜST
    $pdf->Cell(50,1,'                         '.$bayi_no.'-'.$bayi_kullanici_no.'-'.$sip_no.'                                                                                                    '.date("d.m.Y H:i").'',50,50);
//SATIR BOÞLUÐU
for($i=1;$i<=15;$i++)
    $pdf->Cell(50,1,'',50,50);						  

//SATIR
    $pdf->Cell(50,1,'                                                     '.$musteri_no.'',50,50);
							
							
//SATIR BOÞLUÐU
for($i=1;$i<=6;$i++)
    $pdf->Cell(50,1,'',50,50);						  

//SATIR
    $pdf->Cell(50,0,'                                                     '.$yetkili_adsoyad.'/'.$firma_adi.'',50,50);							
							
							
//SATIR BOÞLUÐU
for($i=1;$i<=8;$i++)
    $pdf->Cell(50,1,'',50,50);						  

//SATIR
    $pdf->Cell(50,1,'                                                     ',50,50);								
							
							
	//SATIR BOÞLUÐU
for($i=1;$i<=5;$i++)
    $pdf->Cell(50,1,'',50,50);						  

//SATIR
    $pdf->Cell(50,1,'                                                     '.$top_fiyat.' TL ',50,50);							
							
							
						//SATIR BOÞLUÐU
for($i=1;$i<=6;$i++)
    $pdf->Cell(50,1,'',50,50);						  

						//SATIR
    $pdf->Cell(50,1,'                                                                                                                                                                             TL',50,50);						
	
		//SATIR BOÞLUÐU
for($i=1;$i<=4;$i++)
    $pdf->Cell(50,1,'',50,50);						  

						//SATIR
    $pdf->Cell(50,1,'                                                     ',50,50);						

						//SATIR BOÞLUÐU
for($i=1;$i<=3;$i++)
    $pdf->Cell(50,1,'',50,50);						  
$a= "XXXXX";
//SATIR
    $pdf->Cell(50,0,'                                              '.$yetkili_ad_soyad.'',50,50);						
		
	
	
	


//SATIR BOÞLUÐU
for($i=1;$i<=84;$i++)
    $pdf->Cell(50,1,'',50,50);

//ÜST
    $pdf->Cell(50,1,'                          '.$bayi_no.'-'.$bayi_kullanici_no.'-'.$sip_no.'                                                                                                   '.date("d.m.Y H:i").'',50,50);
//SATIR BOÞLUÐU
for($i=1;$i<=15;$i++)
    $pdf->Cell(50,1,'',50,50);						  

//SATIR
    $pdf->Cell(50,0,'                                                     '.$musteri_no.'',50,50);
							
							
//SATIR BOÞLUÐU
for($i=1;$i<=7;$i++)
    $pdf->Cell(50,1,'',50,50);						  

//SATIR
    $pdf->Cell(50,1,'                                                     '.$yetkili_adsoyad.'/'.$unvan.'',50,50);							
							
							
//SATIR BOÞLUÐU
for($i=1;$i<=6;$i++)
    $pdf->Cell(50,1,'',50,50);						  

//SATIR
    $pdf->Cell(50,1,'                                                     ',50,50);								
							
							
	//SATIR BOÞLUÐU
for($i=1;$i<=6;$i++)
    $pdf->Cell(50,1,'',50,50);						  

//SATIR
    $pdf->Cell(50,1,'                                                     '.$top_fiyat.' TL ',50,50);							
							
							
						//SATIR BOÞLUÐU
for($i=1;$i<=6;$i++)
    $pdf->Cell(50,1,'',50,50);						  

						//SATIR
    $pdf->Cell(50,1,'                                                                                                                                                                             TL',50,50);						
	
		//SATIR BOÞLUÐU
for($i=1;$i<=4;$i++)
    $pdf->Cell(50,1,'',50,50);						  

						//SATIR
    $pdf->Cell(50,1,'                                                     ',50,50);						

						//SATIR BOÞLUÐU
for($i=1;$i<=2;$i++)
    $pdf->Cell(50,1,'',50,50);						  
$a= "XXXXX";
//SATIR
    $pdf->Cell(50,2,'                                              '.$yetkili_ad_soyad.'',50,50);						
		
	
	

	
		
$pdf->Output();





?>

