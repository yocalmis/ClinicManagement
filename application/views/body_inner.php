<!--	
<div>
		<a href='<?php echo site_url('examples/customers_management')?>'>Customers</a> |
		<a href='<?php echo site_url('examples/orders_management')?>'>Orders</a> |
		<a href='<?php echo site_url('examples/products_management')?>'>Products</a> |
		<a href='<?php echo site_url('examples/offices_management')?>'>Offices</a> | 
		<a href='<?php echo site_url('examples/employees_management')?>'>Employees</a> |		 
		<a href='<?php echo site_url('examples/film_management')?>'>Films</a> |
		<a href='<?php echo site_url('examples/multigrids')?>'>Multigrid [BETA]</a>
		
	</div>
-->

<div class="side-nav side-nav-open">
	<div class="s-n_h">
		<img src="<?php echo site_url('assets') ?>/blue_eye_1.png" alt="">
		<div class="s-n_h_t">
			<h3>Klinik Yönetimi</h3> 
			<!--<p>Lorem ipsum dolor sit amet.</p>-->

		</div>
	</div>
	<!--<div class="side-nav__saat"><?php $this->load->view('saat'); ?></div>-->
	<ul class="side-nav--list" data-simplebar>
		<!--<li >
			<a class="sidenav__link">
			<?php echo $this->session->userdata('klinik_adi'); ?>
			</a>
		</li>-->
		<li>
			<a class="sidenav__link">
				<span class="sidenav__icon ico-access_time"></span>
				<?php $this->load->view('saat'); ?>
			</a>
		</li>
		<li>
			<a class="sidenav__link sidenav__link" href='<?php echo site_url('yonetim')?>'>
				<span class="sidenav__icon ico-home"></span>
				Anasayfa
			</a>
		</li>
		<li class="mine-trigger">
			<a class="sidenav__link">
				<span class="sidenav__icon ico-location_city"></span>
				Klinik Ayarları
			</a>
			<div class="mine-content">
				<a class="sidenav__link mine-content__link" href='<?php echo site_url('yonetim/bina')?>'>
					<span class="sidenav__icon ico-domain"></span>
					Klinik
				</a>	
				<a class="sidenav__link mine-content__link" href='<?php echo site_url('yonetim/blok')?>'>
					<span class="sidenav__icon ico-apps"></span>
					Şube
				</a>
				<a class="sidenav__link mine-content__link" href='<?php echo site_url('yonetim/daire')?>'>
					<span class="sidenav__icon ico-crop_landscape"></span>
					Oda
				</a>	
				<a class="sidenav__link mine-content__link" href='<?php echo site_url('yonetim/demirbas')?>'>
					<span class="sidenav__icon ico-shuffle"></span>
					Demirbaş
				</a>		
				<a class="sidenav__link mine-content__link" href='<?php echo site_url('yonetim/komite')?>'>
					<span class="sidenav__icon ico-group"></span>
					Komite
				</a>			
			</div>
		</li>

		<li class="mine-trigger">
			<a class="sidenav__link">
				<span class="sidenav__icon ico-person"></span>
				Cariler
			</a>
			<div class="mine-content">
				<a class="sidenav__link mine-content__link" href='<?php echo site_url('yonetim/cari')?>'>
					<span class="sidenav__icon ico-person"></span>
					Cari
				</a>	
				<a class="sidenav__link mine-content__link" href='<?php echo site_url('yonetim/hasta')?>'>
					<span class="sidenav__icon ico-person"></span>
					Hasta
				</a>						
				<a class="sidenav__link mine-content__link" href='<?php echo site_url('yonetim/personel')?>'>
					<span class="sidenav__icon ico-assignment_ind"></span>
					Personel
				</a>		
			</div>
		</li>

		<li class="mine-trigger">
			<a class="sidenav__link">
				<span class="sidenav__icon ico-chrome_reader_mode"></span>
				Randevular
			</a>
			<div class="mine-content">
				<a class="sidenav__link mine-content__link" href='<?php echo site_url('yonetim/randevu')?>'>
					<span class="sidenav__icon ico-chrome_reader_mode"></span>
					Randevu
				</a>	
				<a class="sidenav__link mine-content__link" href='<?php echo site_url('yonetim/bitmis_randevu')?>'>
					<span class="sidenav__icon ico-chrome_reader_mode"></span>
					Bitmiş Randevu
				</a>			
			</div>
		</li>	



		<li class="mine-trigger">
			<a class="sidenav__link">
				<span class="sidenav__icon ico-money"></span>
				Finans
			</a>
			<div class="mine-content">
				<a class="sidenav__link mine-content__link" href='<?php echo site_url('yonetim/kasa')?>'>
					<span class="sidenav__icon ico-inbox"></span>
					Kasa
				</a>
	<a class="sidenav__link mine-content__link" href='<?php echo site_url('yonetim/hizmet_urun')?>'>
					<span class="sidenav__icon ico-shuffle"></span>
					Hizmet Ürün
				</a>
				<a class="sidenav__link mine-content__link" href='<?php echo site_url('yonetim/fatura')?>'>
					<span class="sidenav__icon ico-folder_open"></span>
					Fatura
				</a>
				
		
				<!--<a href='<?php echo site_url('yonetim/hizmet_urun')?>'><i>close</i>Hizmet Ürün</a>-->
				<a class="sidenav__link mine-content__link" href='<?php echo site_url('yonetim/gelir_gider')?>'>
					<span class="sidenav__icon ico-swap_calls"></span>
					Gelir - Gider
				</a>
				<a class="sidenav__link mine-content__link" href='<?php echo site_url('yonetim/virman')?>'>
					<span class="sidenav__icon ico-local_atm"></span>
					Virman
				</a>
				<a class="sidenav__link mine-content__link" href='<?php echo site_url('yonetim/borc_alacak')?>'>
					<span class="sidenav__icon ico-repeat"></span>
					Borç - Alacak
				</a>	
				<a class="sidenav__link mine-content__link" href='<?php echo site_url('yonetim/tahsilat_odeme')?>'>
					<span class="sidenav__icon ico-payment"></span>
					Tahsilat - Ödeme
				</a>	
				<a class="sidenav__link mine-content__link" href='<?php echo site_url('yonetim/cari_detay')?>'>
					<span class="sidenav__icon ico-group_add"></span>
					Cari Görünüm
				</a>
				<a class="sidenav__link mine-content__link" href='<?php echo site_url('yonetim/kasa_detay')?>'>
					<span class="sidenav__icon ico-account_balance"></span>
					Kasa Görünüm
				</a>
				<a class="sidenav__link mine-content__link" href='<?php echo site_url('yonetim/stok_detay')?>'>
					<span class="sidenav__icon ico-shuffle"></span>
					Stok Görünüm
				</a>
				<!--	<a href='<?php echo site_url('yonetim/fatura')?>'><i>close</i>Alış - Satış</a>		-->				
			</div>
		</li>

		<li>
			<a class="sidenav__link" href='<?php echo site_url('yonetim/protocol')?>'>
				<span class="sidenav__icon ico-assignment"></span>
				Hasta İşlemleri
			</a>
		</li>

		<li class="mine-trigger">
			<a class="sidenav__link">
				<span class="sidenav__icon ico-assignment_ind"></span>
				Personel İşlemleri
			</a>
			<div class="mine-content">
				<a class="sidenav__link mine-content__link" href='<?php echo site_url('yonetim/zimmet')?>'>
					<span class="sidenav__icon ico-widgets"></span>
					Zimmet
				</a>	
				<a class="sidenav__link mine-content__link" href='<?php echo site_url('yonetim/izin')?>'>
					<span class="sidenav__icon ico-airline_seat_flat"></span>
					İzin
				</a>
			</div>
		</li>	



		<li class="mine-trigger">
			<a class="sidenav__link">
				<span class="sidenav__icon ico-assignment"></span>
				Ajanda
			</a>
			<div class="mine-content">
				<a class="sidenav__link mine-content__link" href='<?php echo site_url('yonetim/ornek_dosyalar')?>'>
					<span class="sidenav__icon ico-folder_open"></span>
					Örnek Dosyalar
				</a>			
				<a class="sidenav__link mine-content__link" href='<?php echo site_url('yonetim/dosyalar')?>'>
					<span class="sidenav__icon ico-create_new_folder"></span>
					Dosyalar
				</a>
				<a class="sidenav__link mine-content__link" href='<?php echo site_url('yonetim/yapilacaklar')?>'>
					<span class="sidenav__icon ico-assignment"></span>
					Yapılacaklar
				</a>
				<a class="sidenav__link mine-content__link" href='<?php echo site_url('yonetim/notlar')?>'>
					<span class="sidenav__icon ico-bookmarks"></span>
					Notlar
				</a>
				<a class="sidenav__link mine-content__link" href='<?php echo site_url('yonetim/mail')?>'>
					<span class="sidenav__icon ico-local_post_office"></span>
					Gönderiler
				</a>
				<a class="sidenav__link mine-content__link" href='<?php echo site_url('yonetim/arama')?>'>
					<span class="sidenav__icon ico-local_post_office"></span>
					Aramalar
				</a>
				<a class="sidenav__link mine-content__link" href='<?php echo site_url('yonetim/teklif')?>'>
					<span class="sidenav__icon ico-aspect_ratio"></span>
					Alınan/Verilen Teklif
				</a>
				<a class="sidenav__link mine-content__link" href='<?php echo site_url('yonetim/gorusme')?>'>
					<span class="sidenav__icon ico-assignment"></span>
					Görüşmeler
				</a>
			</div>
		</li>


		<li class="mine-trigger">
			<a class="sidenav__link">
				<span class="sidenav__icon ico-report"></span>
				Rapor
			</a>
			<div class="mine-content">
				<a class="sidenav__link mine-content__link" href='<?php echo site_url('yonetim/genel_rapor')?>'>
					<span class="sidenav__icon ico-show_chart"></span>
					Genel Rapor
				</a>
			</div>
		</li>





		<li class="mine-trigger">
			<a class="sidenav__link">
				<span class="sidenav__icon ico-settings"></span>
				Ayarlar
			</a>
			<div class="mine-content">
				<?php if($this->session->userdata('id')==0){ ?>
					<a class="sidenav__link mine-content__link" href='<?php echo site_url('yonetim/ayar')?>'>
						<span class="sidenav__icon ico-settings_applications"></span>
						Sistem Ayarları
					</a>
				<?php  } ?>

				<a class="sidenav__link mine-content__link" href='<?php echo site_url('yonetim/kategori')?>'>
					<span class="sidenav__icon ico-category"></span>
					Kategori
				</a>	
				<a class="sidenav__link mine-content__link" href='<?php echo site_url('yonetim/uyeler')?>'>
					<span class="sidenav__icon ico-supervisor_account"></span>
					Üyeler
				</a>
				<a class="sidenav__link mine-content__link" href='<?php echo site_url('yonetim/sss')?>'>
					<span class="sidenav__icon ico-question_answer"></span>
					SSS
				</a>
			</div>
		</li>



 

	</ul>
	<p class="s-n_f">© 2019 Klinik Yönetimi. Tüm Haklar Saklıdır</p>	
</div>
<div class="side-header">
	<a class="o_s-n"><span class="side-header__icon ico-menu"></span></a>
	<h3></h3>
	<div class="s-h_r">

		<div class="user-menu">
			<a class="user-menu__trigger">
				<?php echo $online=$this->session->userdata('adminonline'); ?>
			</a>
			<div class="user-menu__inner">
				<div class="user-info user-menu__info">
					<span class="sidenav__icon ico-person"></span>
					<div class="user-info__text">
						<h3 class="user-info__title">
							<?php echo $online=$this->session->userdata('adminonline'); ?>
						</h3>
						<p class="user-info__yetki">
							<?php 
								if($this->session->userdata('yetki')==0){ echo"Yönetici"; }
								if($this->session->userdata('yetki')==1){ echo"Cari"; }
								if($this->session->userdata('yetki')==2){ echo"Sekreterya"; }
							?>
						</p>
					</div>

				</div>
				<p class="divider"></p> 
				<ul class="user-info__apps">
					<li class="user-info__app">
						<a class="user-info__link" href="<?php echo base_url(); ?>yonetim/takvim" 
						onclick="window.open(this.href, 'mywin','left=20,top=20,width=250,height=250,toolbar=1,resizable=0');
							 return false;">
							Takvim
						</a>
					</li>
					<li class="user-info__app">
						<a class="user-info__link" href="<?php echo base_url(); ?>yonetim/kur" 
							onclick="window.open(this.href, 'mywin','left=20,top=20,width=300,height=350,toolbar=1,resizable=0'); return false;">
							Kurlar
						</a>
					</li>
					<li class="user-info__app">
						<a href="http://localhost/otomasyon/react-calculator/" 
						class="iframeTrigger calculator user-info__link">Hesap Makinesi</a>
					</li>
					<li class="user-info__app">
						<a href="http://localhost/otomasyon/react-news/" 
						class="iframeTrigger calculator user-info__link">Sıcak Haber</a>
					</li>
				</ul>
				<p class="divider"></p>
				<ul class="user-info__apps mbd5">
					<li class="user-info__app">
						<a href="<?php echo site_url('yonetim/bilgi/edit/'.$this->session->userdata('id'))?>" class="user-info__link">
							<span class="sidenav__icon ico-lock_open"></span>
							Şifre değiştir
						</a>
					</li>
					<li class="user-info__app">
						<a href="<?php echo site_url('yonetim/cikis')?>" class="user-info__link">
							<span class="sidenav__icon ico-exit_to_app"></span>
							Çıkış
						</a>
					</li>
				</ul>
			</div>
			
		</div>

		 
		
		
		
	</div>		
</div>

<div class="iframeModal">
	<div class="iframeModal__header">
		<div>
			<h3 class="iframeModal__heading"></h3>
			<p class="divider"></p>
		</div>
		<a class="iframeModal__close">
			<span class="sidenav__icon ico-close"></span>
		</a>
	</div>
	<div class="iframeModal__content">
		<iframe id="calculator" class="iframeModal__iframe" src="" frameborder="0"></iframe>
	</div>
</div>
<div class="iframeModal__backdrop"></div>
<main>
	<div class="pageInner" data-simplebar style="background-image: url(<?php echo base_url(); ?>/assets/healthy.jpg); background-color: #BEAE97;">