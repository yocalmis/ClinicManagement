<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tr {

public function index()
	{
		$data['ltfn_eksk_dldr'] = 'Lütfen tüm alanları doldurunuz';
		// Menu linkleri
		$data['menu'] = 'Menü';
		$data['tur'] = 'Tur';
		$data['otel'] = 'Otel';
		$data['yrdm'] = 'Yardım';
		$data['spt'] = 'Sepet';
		$data['rzrvsyn'] = 'Rezervasyonlar';
		$data['ayr'] = 'Ayarlar';
		$data['istek'] = 'İstek Listesi';
		$data['gcms'] = 'Geçmiş';
		$data['cks'] = 'Çıkış';
		$data['grs'] = 'Giriş';
		$data['kayt'] = 'Kayıt Ol';
		$data['tr'] = 'Türkçe';
		$data['eng'] = 'English';
		$data['cin'] = '中文';
		$data['ru'] = 'Pусский';
		$data['esp'] = 'Español';
		$data['hnt'] = 'भारतीय';

		// Arama modülü 
		$data['nerye_tur'] = 'Nereye';
		$data['nerye_otel'] = 'Nereye';
		$data['bas_t'] = 'Başlangıç tarihi';
		$data['bit_t'] = 'Bitiş tarihi';
		$data['ara'] = 'Ara';

		// Datepicker
		$data['kpt'] = 'Kapat';
		$data['tmzl'] = 'Temizle';
		$data['tmm'] = 'Tamam';
		$data['eksk'] = 'Eksik Alanlar';
		$data['ocak'] = 'Ocak';
		$data['subat'] = 'Şubat';
		$data['mart'] = 'Mart';
		$data['nisan'] = 'Nisan';
		$data['mayis'] = 'Mayıs';
		$data['hzrn'] = 'Haziran';
		$data['temmuz'] = 'Temmuz';
		$data['agustos'] = 'Ağustos';
		$data['eylul'] = 'Eylül';
		$data['ekim'] = 'Ekim';
		$data['kasim'] = 'Kasım';
		$data['arlk'] = 'Aralık';
		$data['pazar'] = 'Pazar';
		$data['pazrts'] = 'Pazartesi';
		$data['sali'] = 'Salı';
		$data['crsmb'] = 'Çarşamba';
		$data['prsmb'] = 'Perşembe';
		$data['cuma'] = 'Cuma';
		$data['cmrts'] = 'Cumartesi';
		$data['pazar_kisa'] = 'Pzr';
		$data['pazrts_kisa'] = 'Pzrts';
		$data['sali_kisa'] = 'Salı';
		$data['crsmb_kisa'] = 'Çrşmb';
		$data['prsmb_kisa'] = 'Prşmb';
		$data['cuma_kisa'] = 'Cume';
		$data['cmrts_kisa'] = 'Cmrts';

		$data['gun_kisal'] = "['P', 'Pt', 'S', 'Ç', 'P', 'C', 'Ct']";

		// Önerilen kategoriler
		$data['onrln_ktgr_slgn'] 	= 'Kaçırılmayacak Tatil Durakları';
		$data['onrln_otl_slgn'] 	= 'Kaçırılmayacak Oteller';
		$data['onrln_ktgr_btn'] 	= 'Daha fazla';
		$data['onrln_ktgr_yrm'] 	= 'Yorum';
		$data['onrln_ktgr_fiyt'] 	= 'Fiyat';	

		// E-Posta Kayit 
		$data['email_slgn1'] = 'Sadece sizin için harika seyahat ipuçlarımız var ';
		$data['email_slgn2'] = 'Haftalık bir doz seyahat ilhamı için kaydolun.';
		$data['email_slgn_label'] = 'E-posta adresiniz';
		$data['email_slgn_btn'] = 'Kaydol';
		$data['email_slgn_acklma'] = 'Kaydolarak, promosyon amaçlı e-posta almayı kabul etmiş olacaksınız. Aboneliğinizi dilediğiniz zaman iptal edebilirsiniz. Daha fazla bilgi almak için, gizlilik bildirimimizi okuyun.';

		// En popüler Yerler 
		$data['poplr_slgn'] = 'En popüler Yerler';
		$data['poplr_slgn_btn'] = 'Daha fazla göster';

		//En popüler Kategoriler
		$data['en_poplr_slgn'] 	= 'En popüler Şehirler';
		$data['tur_otel'] 		= 'Tur ve Otel';
		$data['bluepoplr'] 		= "BlueEye'da popüler";
		$data['en_10'] 			= 'En popüler 10 Kategori';
		$data['gzlck_en_pplr'] 	= 'Gezilecek En Popüler Yerler';
		$data['assagi_yazi'] 	= 'Diğer hangi şehirlerde etkinliklerimizin olduğunu merak ediyor musunuz?';
		$data['assagi_lnk'] 	= 'Tur ve etkinlikleri şehirleri göre seç.';
		$data['assg_lnk_otel'] 	= 'Otelleri şehirlere göre seç.';

		// Footer
		$data['dstk'] 			= 'Destek';
		$data['srkt'] 			= 'Şirket';
		$data['bizimle_cls'] 	= 'Bizimle Çalışın';
		$data['odeme'] 			= 'Ödeme seçenekleri';
		$data['iltsm'] 			= 'İletişim';
		$data['yasl'] 			= 'Yasal';
		$data['gizllk'] 		= 'Gizlilik Politikası';
		$data['kul_ksl'] 		= 'Kullanım koşulları';
		$data['hkkmzda'] 		= 'Hakkımızda';
		$data['kryr'] 			= 'Kariyer';
		$data['sts_szlsm'] 		= 'Mesafeli Satış Sözleşmesi';
		$data['tdrk_yntm'] 		= 'Tedarikçi Yönetimi';
		$data['ortklk_yntm'] 	= 'Ortaklık Yönetimi';
		$data['cpryght'] 		= 'Tüm haklar saklıdır';

		// Ana kategori
		$data['ana_ktgr_slogan'] 	= 'Uygun etkinlikleri bulabilmek için istediğiniz tarihleri giriniz';
		$data['tum_tur'] 			= 'Tüm Turlar';
		$data['tum_otel'] 			= 'Tüm Oteller';
		$data['tknm_muhtml'] 		= 'Çabuk Tükenmesi Muhtemel';
		$data['tum_tur_gor'] 		= 'Tüm turları ve aktiviteleri görün';
		$data['tum_otl_gor'] 		= 'Tüm otelleri görün';
		$data['nlr_sylnd'] 			= 'Hakkında neler söylenmiş? ';
		$data['en_gzl_yer'] 		= 'İçinde gezilecek en popüler yerler ';
		$data['en_gzl_yerler'] 		= 'En pöpüler Turlar';
		$data['pplr_vrs_nkts'] 		= 'Popüler varış noktası';
		$data['x_turlari'] 			= 'Tur';
		$data['x_otel'] 			= 'Otel';
		$data['grmk_istr'] 			= 'Want to discover all there is to do in ';
		$data['full_lste'] 			= 'Tüm liste için tıklayın.';
		$data['en_pplr'] 			= 'En popüler varış noktası';


		// Alt kategori açiklama
		$data['acklma']			= 'Açıklama';
		$data['icrdn_ipuc']		= 'İçeriden İpuçlarımız';
		$data['yrrl_bilgi']		= 'Yararlı Bilgiler';
		$data['ne_zmn']			= 'Ne zaman ziyaret edilir?';
		$data['fiyat_ne']		= 'Ücreti ne kadar?';
		$data['rhbr_ihtyc'] 	= 'Rehbere ihtiyacım olacak mı?';
		$data['nsl_gdlr'] 		= 'Nasıl gidilir?';
		$data['extra'] 			= 'Ekstra ipuçları';
		$data['adt_tru'] 		= 'Tüm turları gör';
		$data['adt_otl'] 		= 'Tüm otelleri gör';

		// TUR
		$data['urn_kod'] 		= 'Ürün Kodu';
		$data['dh_fzl_rsm'] 	= 'Daha fazle resim gör';
		$data['bslngc_fiyat'] 	= 'Kişi başı Başlangıç Fiyatı';
		$data['gnl_blg'] 		= 'Genel Bilgiler';
		$data['istk_lsts_ekl'] 	= 'İstek Listesine Ekle';
		$data['istk_lsts_tmm'] 	= 'İstek Listesine Eklendi';
		$data['yr_ayr'] 		= 'Yer Ayır';
		$data['sure'] 			= 'Süre';
		$data['hzl_grs'] 		= 'Hızlı Giriş';
		$data['kupon'] 			= 'Yazdırılmış veya mobil kuponlar kabul edilir';
		$data['hzl_ony'] 		= 'Hızlı Onay';
		$data['engll'] 			= 'Engellilere Uygun';
		$data['cnli_rhbr'] 		= 'Canlı rehber';
		$data['iptl_etm'] 		= 'Kolay iptal etme';
		$data['blsm_nkt'] 		= 'Buluşma Noktası';
		$data['fyt_blg']		= 'Fiyat Bilgisi';
		$data['yer_ayr']		= 'Yer Ayır';
		$data['otelleri']		= 'Oteller';
		

		$data['spt_ekle']		= 'Sepete ekle';
		$data['rezr_et']		= 'Rezervasyon';
		$data['not_1']			= 'Not: Ön rezervasyon yaptığınızda ürün ';
		$data['on_rzrv_ism']	= 'Ön rezervasyon';
		$data['on_rzrv_lnk']	= '<a href="'.base_url().'prereservation">'.$data['on_rzrv_ism'].'</a> ';
		$data['on_rzrv']		= $data['on_rzrv_lnk'];
		$data['not_2']			= 'sayfasına düşer. Ürününüz kontrol ve onaylandıktan sonra sepetinize düşecektir. İşlem biraz zaman alabilir. Ürün sepetinize eklendikten sonra ödeme için yalnızca 1 saatiniz vardır.';
		$data['yrm_brk']		= 'Yorum';
		$data['bslk_gr']		= 'Başlığınız';
		$data['msj_gir']		= 'İncelemeniz';
		$data['nclm_ozt']		= 'İnceleme özeti';
		$data['sralama']		= 'Sıralama';
		$data['dgrlndr']		= 'Değerlendir';
		$data['otel_gun']		= 'Toplam Gün';

		// Tarih ve kişi modülü alma modülü
			$data['ktlmc_scn_bslk'] 	= 'Katılımcı saysını ve tarihi seçin';
			$data['ltfn_scn'] 			= 'Lütfen Seçin..';
			$data['ktlmc_scn'] 			= 'Katılımcı seçin';
			$data['ytskn']				= 'Yetişkin';
			$data['yas']				= 'Yaş';
			$data['cck']				= 'Çocuk';
			$data['bbk']				= 'Bebek';
		// Deneyim/Açiklama modülü
			$data['dnym'] 				= 'Deneyim';
			$data['one_ckn'] 			= 'Öne çıkan';
			$data['tam_acklm'] 			= 'Tam Açıklama';
			$data['rhbr'] 				= 'Rehber';
			$data['dahil'] 				= 'Dahili olanlar';
			$data['orya'] 				= 'Oraya vardığınızda';
			$data['blsm_nkt'] 			= 'Buluşma noktası';
			$data['gtmdn_onc'] 			= 'Gitmeden önce bilin';
			$data['tur_blt'] 			= 'Turlar ve biletler';
			$data['mustr_dgrlndrm'] 	= 'Müşteri değerlendirmesi';
			$data['gnl_dgrlndrm'] 		= 'Genel değerlendirme';
			$data['n_dgrlndrm_gr'] 		= 'Değerlendirmeye göre';
			$data['inclm_ozt'] 			= 'İnceleme özeti';
			$data['srvs'] 				= 'Servis';
			$data['orgnzsn'] 			= 'Organizasyon';
			$data['prnn_krsl'] 			= 'Paranın karşılığı';
			$data['gvnlk'] 				= 'Güvenlik';


		// Rezervasyon
		$data['rzrv_ust_bslk'] 	= 'Rezervasyonlarım';
		$data['trh'] 			= 'Tarig';
		$data['sure'] 			= 'Süre';
		$data['dety'] 			= 'Detay';
		$data['n_ytskn'] 		= 'Yetişkin';
		$data['n_cck'] 			= 'Çocuk';
		$data['n_bbk'] 			= 'Bebek';
		$data['tutar'] 			= 'Tutar';

		// Sepet
		$data['spt_ust_bslk'] 		= 'Sepet';
		$data['e_git'] 				= 'Git: ';
		$data['urun'] 				= 'Ürün';
		$data['fiyat'] 				= 'Fiyat';
		$data['spt_ktgr'] 			= 'Kategori';
		$data['ek_ucrt_yk']			= 'Ek Ücret Yok';
		$data['ayrntlr'] 			= 'Ayrıntılar';
		$data['sil'] 				= 'Sil';
		$data['dznl'] 				= 'Düzenle';
		$data['zyrtc_bilg_dldr'] 	= 'Ziyaretçi bilgilerini doldur';
		$data['sure_icnd_odeme'] 	= 'Süre içinde ödeyin.';
		$data['uruun_sil_emin'] 	= 'Ürünü silmek istediğinizden emin misiniz?';
		$data['evet'] 				= 'Evet';
		$data['hayir'] 				= 'Hayır';
		// Ziyaretçi Modal
			$data['ktlmc_ism_gir'] 	= 'katılımcı isimlerini girin';
			$data['n_kisi'] 		= 'Kişi';
			$data['ism_sysm'] 		= 'İsim ve soyisim';
			$data['ersknl_drm'] 	= 'Erişkinlik durumu';
			$data['erskn'] 			= 'Erişkin';
			$data['cck'] 			= 'Çocuk';
			$data['email'] 			= 'E-Posta adresi';
			$data['tlfn_no']		= 'Telefon numarası';
			$data['geldgnz_shr'] 	= 'Şehriniz';
			$data['iptal'] 			= 'Çıkış';
			$data['kaydt'] 			= 'Kaydet';
		$data['sprs_ozt'] 		= 'Sipariş özeti';
		$data['odnck_ttr'] 		= 'Ödencek tutar';
		$data['sprs_tm_btn'] 	= 'Siparişi tamamla';
		$data['alsvrs_dvm'] 	= 'Alışverişe devam et';

		// Ödeme Sayfasi
		$data['odme_bilgi'] 	= 'Ödeme bilgisi';
		$data['krt_no'] 		= 'Kart Numarası';
		$data['krt_trh'] 		= 'Son kullanma tarihi';
		$data['krt_cvc'] 		= 'CVC kodu';
		$data['tplm_fyt'] 		= 'Toplam fiyat';
		$data['odme_tmm_btn'] 	= 'Ödeme yap';
		$data['onay_ilk'] 		= 'Kabul ediyorum: ';
		$data['onay_link']		= 'Genel Şartlar ve Koşullar.';
		$data['adres_bilgi']	= 'Devam etmek için lütfen adres bilgilerinizi düzenleyin.';
		


		//Yan Modül
			$data['odme_scnk'] 			= 'Kabul ettiğimiz ödeme seçenekleri';
			$data['gvnl_odme'] 			= 'Ödemeleriniz güven ve şifreleme altındadır.';
			$data['krdi_vya_bank_krt'] 	= 'Kredi kartı veya banka kartı';
    		$data['veri_gvnlk'] 		= 'Veri güvenliği';
    		$data['bilgi_ssl'] 			= 'Bilgileriniz bizimle güvende. Verileriniz SSL protokolü ile güvenli bir şekilde şifrelenir ve saklanır.';
    		$data['gzllk_ism'] 			= 'Gizlilik Beyanı';
    		$data['gzllk_link'] 		= '<a href="'.base_url().'pages/detail/gizlilik-politikasi ">'.$data['gzllk_ism'].'</a>';
    		$data['blue_gzllk_beyan'] 	= 'Blue Eye Tour gizliliğinize saygı duyar. Kişisel bilgilerinizi hiç kimseyle paylaşmaz. '.$data['gzllk_link'];
    		$data['rezervsyn_gvnli'] 	= 'Güvenle Rezervasyon Yaptırın';
    		$data['en_iyi_fyt'] 		= 'En iyi fiyat garantisi';
    		$data['gonul_rhtl'] 		= '<b>Gönül rahatlığı</b>. Sıralarda beklememek ve yerinizi ayırtmak için önceden rezervasyon yaptırın.';

		// İletişim
		$data['iltsm_ust_bslk'] 	= 'İletişim';
		$data['adres'] 				= 'Adres';
		$data['bzml_iltsm'] 		= 'Bizimle iletişime geçin';
		$data['msjnz'] 				= 'Mesajınız';
		$data['gndr_btn'] 			= 'Gönder';

    	// Şifremi Unuttum
		$data['sfrm_untm_bslk'] 	= 'Şifremi unuttum';
    	$data['sfrm_untm_acklma'] 	= 'Üye olduğunuz emailinize gönderdiğimiz sıfırlama linkine tıklayarak şifrenizi yenileyebilirsiniz.';
    	$data['uye_mail'] 			= 'Üye Olduğum Mail Adresi';

		// Yardim
		$data['ytdms_bslk'] = 'Merhabalar, size nasıl yardımcı olabiliriz?';

		// Geçmiş
		$data['gcms_bslk'] = 'Geçmiş';

		// Şifre yenileme
		$data['sfre_bslk'] 		= 'Şifre Yenileme';
		$data['sfre_acklm'] 	= 'Yeni şifrenizi aşağıya yazarak yenileyebilirsiniz.';
		$data['yni_sfr'] 		= 'Yeni Şifre';
		$data['yni_sfre_tkrr'] 	= 'Yeni Şifre Tekrar';

		// Search
		$data['aktvte_blnd'] 	= 'Aktivite Bulundu.';
		$data['arma_acklma'] 	= 'Uygun etkinlikleri bulabilmek için istediğin tarihleri gir.';
		$data['arma_btn'] 		= 'Ara';
		$data['arma_fltr'] 		= 'filtreler';
		$data['fyt_arlk'] 		= 'Fiyat aralığı';
		$data['yer_drumu'] 		= 'Yer durumu';

		// Modul başlıkları
		$data['blue_orjnl'] 	= 'BlueEye orijinal';
		$data['cok_stn'] 		= 'En çok satan';

		// Kullanici Ayarlari
		$data['ayrlr_bslk'] 			= 'Kişisel Bilgileriniz Güncelleyin';
		$data['kllnc_adi'] 				= 'Kullanıcı adı';
		$data['adresiniz'] 				= 'Adresiniz';
		$data['ftura_adresi'] 			= 'Fatura adresiniz';
		$data['ayrlr_tm_btn'] 			= 'Bilgilerimi Güncelle';
		$data['uyligimi_dndr_blsk'] 	= 'Üyeliğinizi Dondurun';
		$data['uyligimi_dndr_tm_btn'] 	= 'Üyeliğimi Dondur';

		// Giriş Sayfyasi
		$data['sfre'] 			= 'Şifre';
		$data['sfrmi_untm'] 	= 'Şifremi Unuttum';
		$data['kayt_ol_bslk'] 	= 'Kayıt Ol';
		$data['sfre_tkrr_gir'] 	= 'Şifre Tekrar';
		$data['szlsm_ism'] 		= 'Sözleşmeyi';
		$data['szlsm_link'] 	= '<a href="'.base_url().'pages/detail/kullanim-kosullari">'.$data['szlsm_ism'].'</a>';
		$data['szlsme_kbl'] 	= 'Kabul ediyorum: '.$data['szlsm_link'].'.';

		// Wishlist
		$data['istek_bslk']	= 'İstek Listesi';
		$data['kldrs']		= 'Kaldır';

		// Javascript alerts
		$data['oncki_gun_secmzns']		= 'Önceki günü seçemezsiniz.';
		$data['onc_bas_t_sec']			= 'Önce başlangıç tarihini seçmelisiniz.';
		$data['ltfn_yolcu_scnz']		= 'Lütfen Yolcu Sayısını Seçiniz.';
		$data['a_18yaskck']				= '18 Yaşından küçükseniz, Tek Başınıza Yolculuğa Çıkmanız Kesinlikle Yasaktır.';
		$data['ltfn_kisi_dgru']			= 'Lütfen doğru kişi sayısı seçiniz.';
		$data['ism_bos_olmz']			= 'İsminizi Boş Bırakamazsınız.';
		$data['ism_kisa']				= 'İsminiz Çok Kısa.';
		$data['ism_uzun']				= 'İsminiz Çok Uzun.';
		$data['kllnc_bos_olmz']			= 'Kullanıcı Adını Boş Bırakamazsınız.';
		$data['kllnc_ad_kisa']			= 'Kullanıcı Adınız Çok Kısa.';
		$data['kllnc_ad_uzun']			= 'Kullanıcı Adınız Çok Uzun.';
		$data['sfre_bs_olmz']			= 'Şifreyi Boş Bırakamazsınız.';
		$data['sfre_ck_kisa']			= 'Şifreniz Çok Kısa.';
		$data['sfre_ck_uzun']			= 'Şifreniz Çok Uzun.';
		$data['sfre_ayni_dagel']		= 'Şifreler Eşleşmiyor.';
		$data['ltfn_emal_adrs_dgru']	= 'Lütfen Mail Adresini Doğru Yazınız.';
		$data['bslk_gir']				= 'Başlık Giriniz';
		$data['brya_yazn']				= 'Buraya Yazın..';
		$data['yrm_ck_kisa']			= 'Yorum Çok Kısa..';
		$data['ltfn_zyrtc_dldr']		= 'Lütfen ziyaretçi alanlarını doldurunuz.';



		// supplier form
		$data['sirkt_isim']			= 'Şirket ismi';
		$data['acente_unvan']		= 'Acenta ünvanı';
		$data['tursab_no']			= 'TÜRSAB numarası';
		$data['yetksili_isim']		= 'Yetkili isim ve soyisim';
		$data['sirket_adres']		= 'Adres';
		$data['sirket_sehir']		= 'Şehir';
		$data['sirket_posta']		= 'Posta kodu';
		$data['sirket_tlfn']		= $data['tlfn_no'];
		$data['sirket_cep_tlfn']	= 'Cep numarası';
		$data['sirket_web_site']	= 'Websitesi';


		return $data;


	}

}