<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Eposta {



function kayit($url,$name,$email,$return)
{

include("class.phpmailer.php");

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPDebug = 1; // hata ayiklama: 1 = hata ve mesaj, 2 = sadece mesaj
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = 'smtp.yandex.ru';
$mail->Port = 465;
$mail->IsHTML(true);
$mail->SetLanguage("tr", "phpmailer/language");
$mail->CharSet  ="utf-8";
$mail->Username = ""; // Mail adresimizin kullanicı adi
$mail->Password = ""; // Mail adresimizin sifresi
//$mail->SetFrom("Saray Mefruşat İletişim Formu", "aaaa"); // Mail attigimizda gorulecek ismimiz

$mail->SetFrom("");
$mail->addReplyTo("");

//$mail->AddAddress("yocalmis@gmail.com"); // Maili gonderecegimiz kisi yani alici
//$mail->AddAddress("kayhan@saraymefrusat.com"); // Maili gonderecegimiz kisi yani alici
//$mail->AddAddress("yocalmis@gmail.com"); // Maili gonderecegimiz kisi yani alici
$mail->AddAddress($email); // Maili gonderecegimiz kisi yani alici
$mail->Subject = "Bina Yönetimi Yeni Üye Kaydı Onay"; // Konu basligi
$mail->Body = "<b><br><br>Hoşgeldiniz ".$name." Bina Yönetim Sistemi üyeliğinizi aktifleştirmeniz gerekmektedir.<br>
Aktifleştirmek için <a href='".$url."yonetim/success/".$return."'>tıklayınız</a>.</b>" ; // Mailin icerigi
if(!$mail->Send()){
	return FALSE;
} else {
	return TRUE;
}




}




function kayit_onay_bilgi($url,$uye_onay)
{

include("class.phpmailer.php");

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPDebug = 1; // hata ayiklama: 1 = hata ve mesaj, 2 = sadece mesaj
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = 'smtp.yandex.ru';
$mail->Port = 465;
$mail->IsHTML(true);
$mail->SetLanguage("tr", "phpmailer/language");
$mail->CharSet  ="utf-8";
$mail->Username = "yusuf@zirvekayseri.com"; // Mail adresimizin kullanicı adi
$mail->Password = "234567y."; // Mail adresimizin sifresi
//$mail->SetFrom("Saray Mefruşat İletişim Formu", "aaaa"); // Mail attigimizda gorulecek ismimiz

$mail->SetFrom("");
$mail->addReplyTo("");

//$mail->AddAddress("yocalmis@gmail.com"); // Maili gonderecegimiz kisi yani alici
//$mail->AddAddress("kayhan@saraymefrusat.com"); // Maili gonderecegimiz kisi yani alici
//$mail->AddAddress("yocalmis@gmail.com"); // Maili gonderecegimiz kisi yani alici
$mail->AddAddress($uye_onay); // Maili gonderecegimiz kisi yani alici
$mail->Subject = "Bina Yönetimi Yeni Üye Kaydı Onay"; // Konu basligi
$mail->Body = "<b><br><br>Hoşgeldiniz Bina Yönetim Sistemi üyeliğinizi aktifleştirilmiştir.<br>
".$url." adresinden sistemi kullanmaya başlayabilirsiniz." ; // Mailin icerigi
if(!$mail->Send()){
	return FALSE;
} else {
	return TRUE;
}




}







function new_pass($url,$pass,$email)
{


include("class.phpmailer.php");

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPDebug = 1; // hata ayiklama: 1 = hata ve mesaj, 2 = sadece mesaj
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = 'smtp.yandex.ru';
$mail->Port = 465;
$mail->IsHTML(true);
$mail->SetLanguage("tr", "phpmailer/language");
$mail->CharSet  ="utf-8";
$mail->Username = "yusuf@zirvekayseri.com"; // Mail adresimizin kullanicı adi
$mail->Password = "234567y."; // Mail adresimizin sifresi
//$mail->SetFrom("Saray Mefruşat İletişim Formu", "aaaa"); // Mail attigimizda gorulecek ismimiz

$mail->SetFrom("");
$mail->addReplyTo("");

//$mail->AddAddress("yocalmis@gmail.com"); // Maili gonderecegimiz kisi yani alici
//$mail->AddAddress("kayhan@saraymefrusat.com"); // Maili gonderecegimiz kisi yani alici
//$mail->AddAddress("yocalmis@gmail.com"); // Maili gonderecegimiz kisi yani alici
$mail->AddAddress($email); // Maili gonderecegimiz kisi yani alici
$mail->Subject = "Bina Yönetimi Şifre Yenileme"; // Konu basligi
$mail->Body = "<b><br><br>Bina Yönetimi şifrenizi yenilemek için <br>
<a href='".$url."yonetim/new_pass_success/".$pass."'>tıklayınız</a>.</b>" ; // Mailin icerigi
if(!$mail->Send()){
	return FALSE;
} else {
	return TRUE;
}




}








}


?>