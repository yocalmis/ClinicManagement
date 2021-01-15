<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html >
<head>
	<title>Şifremi Unuttum || Klinik Yönetimi</title>
	<meta charset="UTF-8">
	<meta charset="utf-8" />
	<link href="<?php echo site_url('assets') ?>/fonts/roboto/roboto.css" type="text/css" rel="stylesheet" defer>
	<link rel="stylesheet" href="<?php echo site_url('assets') ?>/userops.css">
	<meta name="author" content="Back end: Yusuf Öcalmış, Front end: Muhammed Teuvajukov">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="theme-color" content="#ffffff">
	<meta name="msapplication-navbutton-color" content="#ffffff">
	<meta name="apple-mobile-web-app-status-bar-style" content="#ffffff">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo site_url('assets/favicon') ?>/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo site_url('assets/favicon') ?>/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo site_url('assets/favicon') ?>/favicon-16x16.png">
	<link rel="manifest" href="<?php echo site_url('assets/favicon') ?>/site.webmanifest">
	<link rel="mask-icon" href="<?php echo site_url('assets/favicon') ?>/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
</head>

<body>

	<div class="input-inner">

		<div class="input-inner__header">
			<img class="input-inner__logo" src="<?php echo site_url('assets/favicon') ?>/android-chrome-192x192.png" alt="Klinik Yönetimi Logo">
			<h3 class="input-inner__title">Klinik Yönetimi</h3>
			<p class="input-inner__description">Email adresiniz ile şifrenizi yenileyin.</p>
		</div>

		<form method="post" id="theForm" action="new_pass">

			<div class="input-field">

				<input class="input-field__input" type="text" inputmode="email" id="my-mail" name="my-mail" required>
				<label class="input-field__placeholder" for="my-mail">E-Mail</label>
				<div class="input-field__error">
					<svg class="input-field__error--image" xmlns="https://www.w3.org/2000/svg" aria-hidden="true" focusable="false" width="16px" height="16px" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>
					Lütfen doğru mail adresi giriniz.
				</div>

			</div>

			<a class="forgotPass" href="<?php echo base_url(); ?>">Giriş Yap</a>

			<div class="login">
				<a class="newAccount" href="<?php echo base_url(); ?>yonetim/adminkayit">Kayıt Ol</a>
				<input class="login__button" type="submit" value="Gönder">
			</div>

		</form>
	</div>
	<script src="<?php echo base_url(); ?>assets/admin.js"></script>
	<script src="<?php echo base_url(); ?>assets/validate.min.js"></script>
	<script>

		login = {
			mail: {
				email: true
			},

		};

		document.querySelector('.login__button').onclick = function (event) {
			var 
			mailInput	= document.getElementById('my-mail'),
			result		= validate({
				mail: mailInput.value,

			}, login);

			if (result === undefined) {
				mailInput.parentNode.querySelector('.input-field__error').classList.remove('input-field__error--active');
				return true;
			}
			else {
				if (result.mail != undefined) {
					mailInput.parentNode.querySelector('.input-field__error').classList.add('input-field__error--active');
				}
				else if (result.mail === undefined) {
					mailInput.parentNode.querySelector('.input-field__error').classList.remove('input-field__error--active');
				}

				return false
			}

			
		}

	</script>
</body>
</html>
