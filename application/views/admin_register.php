<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Yeni Kayıt || Klinik Yönetimi</title>
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


	<div class="input-inner" style="margin: 1rem 0;">

		<div class="input-inner__header">
			<img class="input-inner__logo" src="<?php echo site_url('assets/favicon') ?>/android-chrome-192x192.png" alt="Klinik Yönetimi Logo">
			<h3 class="input-inner__title">Klinik Yönetimi</h3>
			<p class="input-inner__description">Bilgileriniz ile sistemimize üye olun.</p>
		</div>


		<form method="post" id="theForm" action="<?php echo base_url(); ?>yonetim/adminkaydet">


			<div class="input-field">
				<input class="input-field__input" type="text" id="adi" name="adi" required />
				<label class="input-field__placeholder" for="adi">Adı Soyadı</label>
				<div class="input-field__error">
					<svg class="input-field__error--image" xmlns="https://www.w3.org/2000/svg" aria-hidden="true" focusable="false" width="16px" height="16px" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>
					Lütfen 3 ila 100 karakter arasında bir isim giriniz.
				</div>
				
			</div>

			<div class="input-field">
				<input class="input-field__input" type="text" inputmode="email" id="email" name="email" required />
				<label class="input-field__placeholder" for="email">E-Mail</label>
				<div class="input-field__error">
					<svg class="input-field__error--image" xmlns="https://www.w3.org/2000/svg" aria-hidden="true" focusable="false" width="16px" height="16px" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>
					Lütfen mail adresini doğru giriniz.
				</div>
			</div>

			<div class="input-field">
				<input class="input-field__input" type="text" id="kullanici" name="kullanici" required />
				<label class="input-field__placeholder" for="kullanici">Kullanıcı Adı</label>
				<div class="input-field__error">
					<svg class="input-field__error--image" xmlns="https://www.w3.org/2000/svg" aria-hidden="true" focusable="false" width="16px" height="16px" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>
					Kulannıcı adı, 4 - 24 karakter arasında olmalıdır.
				</div>
			</div>


			<div class="input-field">
				
				<input class="input-field__input" type="text" id="Klinik_adi" name="Klinik_adi" required />
				<label class="input-field__placeholder" for="Klinik_adi">Klinik Adı</label>
				<div class="input-field__error">
					<svg class="input-field__error--image" xmlns="https://www.w3.org/2000/svg" aria-hidden="true" focusable="false" width="16px" height="16px" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>
					Klinik ismi, sayı içeremez ve en az 2 karakterli olmalıdır.
				</div>

			</div>
			<div class="input-field">

				<input class="input-field__input" type="text" inputmode="decimal" id="blok_adedi" name="blok_adedi" required />
				<label class="input-field__placeholder" for="blok_adedi">Blok Adedi</label>
				<div class="input-field__error">
					<svg class="input-field__error--image" xmlns="https://www.w3.org/2000/svg" aria-hidden="true" focusable="false" width="16px" height="16px" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>
					Blok Adedi, sayı ve en az 1 karakterli olmalıdır.
				</div>

			</div>

			<div class="input-field">

				<input class="input-field__input" type="password" id="password" name="sifre1" required />
				<label class="input-field__placeholder" for="password">Şifre</label>
				<div class="input-field__error">
					<svg class="input-field__error--image" xmlns="https://www.w3.org/2000/svg" aria-hidden="true" focusable="false" width="16px" height="16px" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>
					Şifre, en az 8 karakter ve bir sayı içermeli.
				</div>


			</div>

			<div class="input-field">
				<input class="input-field__input" id="password_repeat" type="password" name="sifre2" required />
				<label class="input-field__placeholder" for="password_repeat">Şifre Tekrar</label>
				<div class="input-field__error">
					<svg class="input-field__error--image" xmlns="https://www.w3.org/2000/svg" aria-hidden="true" focusable="false" width="16px" height="16px" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>
					Şifreleriniz eşleşmiyor.
				</div>

			</div>
			

			<a href="<?php echo base_url(); ?>yonetim/pass_remember" class="forgotPass">Şifrenizi mi unuttunuz?</a>

			<div class="login">
				<a class="newAccount" href="<?php echo base_url(); ?>yonetim">Giriş Yap</a>
				<input type="submit" class="login__button" value="Üye Ol">
			</div>
		</form>

	</div>


	<script src="<?php echo base_url(); ?>assets/admin.js"></script>
	<script src="<?php echo base_url(); ?>assets/validate.min.js"></script>
	<script>
		var 
		nameRegex		= /^[a-zA-Z\-]+$/,
		userNameRegex	= /^[a-zA-Z]+$/,
		numberRegex		= /^[0-9]+$/,
		passRegex		= /^(?=.*\d)(?=.*[a-z])[0-9a-zA-Z]{8,}$/;
			
		var 
		login = {
			name: {
				format: nameRegex,
				length: {
					minimum: 3,
					maximum: 100
				}
			},
			mail: {
				email: true
			},
			username: {
				format: userNameRegex,
				length: {
					minimum: 4,
					maximum: 24
				}
			},
			buildName: {
				format: nameRegex,
				length: {
					minimum: 2,
					maximum: 100
				}
			},
			blockNum: {
				format: numberRegex,
				length: {
					minimum: 1,
					maximum: 100
				}
			},
			password: {
				format: passRegex
			},
			passwordRepeat: {
				equality: 'password'
			}

		};

		document.querySelector('.login__button').onclick = function (event) {
			var 
			name		= document.getElementById('adi'),
			mailInput	= document.getElementById('email'),
			userName	= document.getElementById('kullanici'),
			buildname	= document.getElementById('Klinik_adi'),
			blocknum	= document.getElementById('blok_adedi'),
			pass		= document.getElementById('password'),
			passRepeat	= document.getElementById('password_repeat'),
			result		= validate({
				name: name.value,
				mail: mailInput.value,
				username: userName.value,
				buildName: buildname.value,
				blockNum: blocknum.value,
				password: pass.value,
				passwordRepeat: passRepeat.value

			}, login);

			if (result === undefined) {
				name.parentNode.querySelector('.input-field__error').classList.remove('input-field__error--active');
				mailInput.parentNode.querySelector('.input-field__error').classList.remove('input-field__error--active');
				userName.parentNode.querySelector('.input-field__error').classList.remove('input-field__error--active');
				buildname.parentNode.querySelector('.input-field__error').classList.remove('input-field__error--active');
				blocknum.parentNode.querySelector('.input-field__error').classList.remove('input-field__error--active');
				pass.parentNode.querySelector('.input-field__error').classList.remove('input-field__error--active');
				passRepeat.parentNode.querySelector('.input-field__error').classList.remove('input-field__error--active');
				return true;
			}
			else {
				console.log(result)
				if (result.name != undefined){
					name.parentNode.querySelector('.input-field__error').classList.add('input-field__error--active');
				} 
				else if (result.name === undefined) {
					name.parentNode.querySelector('.input-field__error').classList.remove('input-field__error--active');
				}
				if (result.mail != undefined) {
					mailInput.parentNode.querySelector('.input-field__error').classList.add('input-field__error--active');
				}
				else if (result.mail === undefined) {
					mailInput.parentNode.querySelector('.input-field__error').classList.remove('input-field__error--active');
				}
				if (result.username != undefined) {
					userName.parentNode.querySelector('.input-field__error').classList.add('input-field__error--active');
				}
				else if (result.username === undefined) {
					userName.parentNode.querySelector('.input-field__error').classList.remove('input-field__error--active');
				}
				if (result.buildName != undefined) {
					buildname.parentNode.querySelector('.input-field__error').classList.add('input-field__error--active');
				}
				else if (result.buildName === undefined) {
					buildname.parentNode.querySelector('.input-field__error').classList.remove('input-field__error--active');
				}
				if (result.blockNum != undefined) {
					blocknum.parentNode.querySelector('.input-field__error').classList.add('input-field__error--active');
				}
				else if (result.blockNum === undefined) {
					blocknum.parentNode.querySelector('.input-field__error').classList.remove('input-field__error--active');
				}
				if (result.password != undefined) {
					pass.parentNode.querySelector('.input-field__error').classList.add('input-field__error--active');
				}
				else if (result.password === undefined) {
					pass.parentNode.querySelector('.input-field__error').classList.remove('input-field__error--active');
				}
				if (result.passwordRepeat != undefined) {
					passRepeat.parentNode.querySelector('.input-field__error').classList.add('input-field__error--active');
				}
				else if (result.passwordRepeat === undefined) {
					passRepeat.parentNode.querySelector('.input-field__error').classList.remove('input-field__error--active');
				}
				return false
			}

			
		}

	</script>
</body>
</html>
