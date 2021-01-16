<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Yonetim extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *    - or -
     *         http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper('url');

        $this->load->library('grocery_CRUD');

        if ($this->session->userdata('admin_dil') == "") {
            $this->session->set_userdata('admin_dil', "en");
        }

        if (!empty($this->session->userdata('odeme'))) {

            if ($this->session->userdata('odeme') == 1) {
                $this->load->library('messages');
                $this->messages->config2('Odeme/odeme');
                return false;
            }

        }

    }

    public function index()
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                $this->load->view('admin_login');
            } else { $this->load->view('admin_register');}

        } else {

            $crud = new grocery_CRUD();

            $crud->set_table('borc_alacak');

            $data['side_menu'] = "Yapılacaklar Listesi Ayarları";
            $data['kilavuz'] = "  <b>Yapılacaklar Listesi Ayarları</b>";
            $this->load->model('admin_model');
            $data["list"] = $this->admin_model->list_getir($this->session->userdata('id'));

            $this->load->model('admin_model');
//Bugün

            $bugun_bas = date("Y-m-d");
            $bugun_bit = date("Y-m-d");

            $data['bugun_tahsilat'] = $this->admin_model->bugun_tahsilat($bugun_bas, $bugun_bit);
            $data['bugun_odeme'] = $this->admin_model->bugun_odeme($bugun_bas, $bugun_bit);
            $data['bugun_gelir'] = $this->admin_model->bugun_gelir($bugun_bas, $bugun_bit);
            $data['bugun_gider'] = $this->admin_model->bugun_gider($bugun_bas, $bugun_bit);
            $data['bugun_alis'] = $this->admin_model->bugun_alis($bugun_bas, $bugun_bit);
            $data['bugun_satis'] = $this->admin_model->bugun_satis($bugun_bas, $bugun_bit);

            //Bu hafta
            $buhafta = date("Y-m-d", strtotime('-7 days'));
            $data['buh_tahsilat'] = $this->admin_model->buh_tahsilat($buhafta, $bugun_bit);
            $data['buh_odeme'] = $this->admin_model->buh_odeme($buhafta, $bugun_bit);
            $data['buh_gelir'] = $this->admin_model->buh_gelir($buhafta, $bugun_bit);
            $data['buh_gider'] = $this->admin_model->buh_gider($buhafta, $bugun_bit);
            $data['buh_alis'] = $this->admin_model->buh_alis($buhafta, $bugun_bit);
            $data['buh_satis'] = $this->admin_model->buh_satis($buhafta, $bugun_bit);

            //Bu ay
            $buay = date("Y-m-d", strtotime('-30 days'));
            $data['buay_tahsilat'] = $this->admin_model->buay_tahsilat($buay, $bugun_bit);
            $data['buay_odeme'] = $this->admin_model->buay_odeme($buay, $bugun_bit);
            $data['buay_gelir'] = $this->admin_model->buay_gelir($buay, $bugun_bit);
            $data['buay_gider'] = $this->admin_model->buay_gider($buay, $bugun_bit);
            $data['buay_alis'] = $this->admin_model->buay_alis($buay, $bugun_bit);
            $data['buay_satis'] = $this->admin_model->buay_satis($buay, $bugun_bit);

            //Bu yil
            $buyil = date("Y-m-d", strtotime('-365 days'));
            $data['buyil_tahsilat'] = $this->admin_model->buyil_tahsilat($buyil, $bugun_bit);
            $data['buyil_odeme'] = $this->admin_model->buyil_odeme($buyil, $bugun_bit);
            $data['buyil_gelir'] = $this->admin_model->buyil_gelir($buyil, $bugun_bit);
            $data['buyil_gider'] = $this->admin_model->buyil_gider($buyil, $bugun_bit);
            $data['buyil_alis'] = $this->admin_model->buyil_alis($buyil, $bugun_bit);
            $data['buyil_satis'] = $this->admin_model->buyil_satis($buyil, $bugun_bit);

            //Bu yil
            $top = date("Y-m-d", strtotime('-365 days'));
            $data['toplam_tahsilat'] = $this->admin_model->toplam_tahsilat($buyil, $bugun_bit);
            $data['toplam_odeme'] = $this->admin_model->toplam_odeme($buyil, $bugun_bit);
            $data['toplam_gelir'] = $this->admin_model->toplam_gelir($buyil, $bugun_bit);
            $data['toplam_gider'] = $this->admin_model->toplam_gider($buyil, $bugun_bit);
            $data['toplam_alis'] = $this->admin_model->toplam_alis($buyil, $bugun_bit);
            $data['toplam_satis'] = $this->admin_model->toplam_satis($buyil, $bugun_bit);
            $data["currency"] = $this->session->userdata('para_birim');

            $data['toplam_durum'] = $this->admin_model->toplam_durum($buyil, $bugun_bit);
            $data['toplam_durum_kasa'] = $this->admin_model->toplam_durum_kasa($buyil, $bugun_bit);

            $output = $crud->render();
            $output->data = $data;

            //  $this->_example_output($output);
            $this->load->view('anasayfa', (array) $output);

        }

    }

    public function adminkayit()
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {

            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {$this->load->view('admin_register');} else { $this->load->view('admin_register');}

        } else {

/*
$this->load->library('messages');
$this->messages->config('ayar/edit/1');
 */

// Giriş Sayfası    $this->load->model('');

            //   echo "Anasayfa";

            //   $this->ayar('edit/1');

            $this->load->library('messages');
            $this->messages->config('yonetim');

        }

    }

    //Admin Kaydet

    public function adminkaydet()
    {
        error_reporting(0);

        $name = $this->input->post('adi', true);
        $name = trim($name);
        $name = strip_tags($name);
        $name = htmlentities($name);
        $email = $this->input->post('email', true);
        $email = trim($email);
        $email = strip_tags($email);
        $email = htmlentities($email);
        $username = $this->input->post('kullanici', true);
        $username = trim($username);
        $username = strip_tags($username);
        $username = htmlentities($username);
        $pass1 = $this->input->post('sifre1', true);
        $pass1 = trim($pass1);
        $pass1 = strip_tags($pass1);
        $pass1 = htmlentities($pass1);
        $pass2 = $this->input->post('sifre2', true);
        $pass2 = trim($pass2);
        $pass2 = strip_tags($pass2);
        $pass2 = htmlentities($pass2);
        $bina_adi = $this->input->post('bina_adi', true);
        $bina_adi = trim($bina_adi);
        $bina_adi = strip_tags($bina_adi);
        $bina_adi = htmlentities($bina_adi);
        $blok_adedi = $this->input->post('blok_adedi', true);
        $blok_adedi = trim($blok_adedi);
        $blok_adedi = strip_tags($blok_adedi);
        $blok_adedi = htmlentities($blok_adedi);

        $this->load->library('messages');

        if ($pass1 != $pass2) {

            echo $this->messages->Pass_Error('yonetim');

        } else {

            $pass = md5($pass1);

            $data = array($name, $email, $username, $pass, $bina_adi, $blok_adedi);

            $this->load->model('admin_model');

            $admin_register_before = $this->admin_model->admin_register_before($username, $email);

            if ($admin_register_before) {

                echo $this->messages->False_Add('yonetim/adminkayit');

            } else {

                $return = $this->admin_model->admin_register($data);

                if ($return) {
                    $url = base_url();
                    $this->load->library('mail/eposta');
                    $this->eposta->kayit($url, $name, $email, $return);

                    echo $this->messages->True_Add('yonetim');
                } else {

                    echo $this->messages->False_Add('yonetim');
                }

                return false;
            }

        }

        echo $this->messages->False_Add('yonetim');

    }

    public function success($pass)
    {
        error_reporting(0);
        $this->load->library('Messages');
        $this->load->model('admin_model');

        $uye_onay = $this->admin_model->uye_onay($pass);

        if ($uye_onay == 1) {

            $mails = $this->admin_model->mails($pass);

            $url = base_url();
            $this->load->library('mail/eposta');
            $this->eposta->kayit_onay_bilgi($url, $mails);

            echo $this->messages->True_Onay_Message('yonetim');
            return false;

        }

        echo $this->messages->False_Onay_Message('yonetim/adminkayit');
        return false;

    }

    //Admin Giri�i Kontrol ediliyor , kay�t varsa session olu�turulup login i�lemi ger�ekle�tiriliyor ve y�nlendirme yap�l�yor

    public function kontrol()
    {

        $username = $this->input->post('kullanici', true);
        $pass = $this->input->post('sifre', true);
        $pass = md5($pass);

        $data = array($username, $pass);
        $this->load->library('messages');
        $this->load->model('admin_model');
        $return = $this->admin_model->admin_return($data);

        if ($return != 0) {

            $bilgi = $this->admin_model->admin_bilgi($data);

            if ($bilgi): foreach ($bilgi as $dizi):

                    $id = $dizi["id"];
                    $kullanici_id = $dizi["kullanici_id"];
                    $name = $dizi["name"];
                    $email = $dizi["email"];
                    $uye_turu = $dizi["uye_turu"];

                    $yetki = $dizi["yetki"];

                endforeach;endif;

            if ($return == 1) {

                if ($uye_turu == 2) {

                    echo $this->messages->Welcome_False('yonetim');
                    return false;

                }

            }

            $para_birimi = $this->admin_model->para_birimi($kullanici_id);

            if ($para_birimi): foreach ($para_birimi as $dizi):

                    $para_birim = $dizi["para_birim"];
                    $klinik_adi = $dizi["adi"];

                endforeach;endif;

            $kullanici_id_tarih_kontrol = $this->admin_model->kullanici_id_tarih_kontrol($kullanici_id);

            if ($kullanici_id_tarih_kontrol != 1) {
                echo $this->messages->Welcome_False('yonetim');
            }

            $this->session->set_userdata('adminonline', $username);
            $online = $this->session->userdata('adminonline');

            $this->session->set_userdata('id', $id);
            $id = $this->session->userdata('id');

            $this->session->set_userdata('name', $name);
            $name = $this->session->userdata('name');

            $this->session->set_userdata('email', $email);
            $email = $this->session->userdata('email');

            $this->session->set_userdata('uye_turu', $uye_turu);
            $uye_turu = $this->session->userdata('uye_turu');

            $this->session->set_userdata('kullanici_id', $kullanici_id);
            $kullanici_id = $this->session->userdata('kullanici_id');

            $this->session->set_userdata('para_birim', $para_birim);
            $para_birim = $this->session->userdata('para_birim');

            $this->session->set_userdata('odeme', $return);
            $odeme = $this->session->userdata('odeme');

            $this->session->set_userdata('yetki', $yetki);
            $yetki = $this->session->userdata('yetki');

            $this->session->set_userdata('klinik_adi', $klinik_adi);
            $klinik_adi = $this->session->userdata('klinik_adi');

            echo $this->messages->Welcome('yonetim', $online);

        } else {

            echo $this->messages->Welcome_False('yonetim');

        }

    }

    //Admin ��

    public function cikis()
    {
        $this->load->library('messages');
        $this->session->unset_userdata('adminonline');
        $this->session->sess_destroy();

        echo $this->messages->Logout('yonetim');

    }

    public function pass_remember()
    {
        error_reporting(0);
        $online = $this->session->userdata('adminonline');
        if (empty($online)) {

            $this->load->view('forgot-pass.php');
            return false;
        }

        $this->load->library('Messages');
        echo $this->messages->config('yonetim');
        return false;

    }

    public function new_pass()
    {

        error_reporting(0);
        $online = $this->session->userdata('adminonline');
        if (empty($online)) {

            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {$this->load->view('admin_register');} else { $this->load->view('admin_register');}

        }

        $this->load->library('Messages');
        $this->load->model('admin_model');
        $email = $this->input->post('my-mail', true);
        $email = trim($email);
        $email = htmlentities($email);
        $email = strip_tags($email);
        $email = strtolower($email);

        if ($email == "") {
            echo $this->messages->config('');
            return false;
        }

        $return = $this->admin_model->kontrol($email);

        if ($return != 1) {

            echo $this->messages->False_Bulunamadi('yonetim/pass_remember');

        }

        if ($return == 1) {

            $pass = $this->admin_model->pass_getir($email);

            $this->load->library('mail/eposta');
            $mail = $this->eposta->new_pass(base_url(), $pass, $email);

            if ($mail == true) {
                $this->load->library('Messages');
                echo $this->messages->New_Pass('');

            }

        }

    }

    public function new_pass_success($pass)
    {
        error_reporting(0);
        $useronline = $this->session->userdata('useronline');
        if ($useronline != "") {
            $this->load->library('Messages');
            echo $this->messages->config('');
            return false;

        }

        $data["pass"] = $pass;
        $this->load->view('new-pass.php', $data);

    }

    public function new_pass_success_ok()
    {
        error_reporting(0);
        $useronline = $this->session->userdata('useronline');
        if ($useronline != "") {
            $this->load->library('Messages');
            echo $this->messages->config('');
            return false;

        }
        $pass = $this->input->post('pass', true);
        $ps = $this->input->post('ps', true);
        $ps2 = $this->input->post('ps2', true);

        $pass = trim($pass);
        $ps = trim($ps);
        $ps2 = trim($ps2);

        $pass = trim($pass);
        $ps = htmlentities($ps);
        $ps2 = htmlentities($ps2);

        $pass = trim($pass);
        $ps = strip_tags($ps);
        $ps2 = strip_tags($ps2);

        if ($ps != $ps2) {

            $this->load->library('Messages');
            echo $this->messages->Pass_Error('yonetim');
            return false;
        }

        $sf = md5($ps);
        $this->load->model('admin_model');

        $sifre_guncelle = $this->admin_model->sifre_guncelle($sf, $pass);

        if ($sifre_guncelle != 1) {
            $this->load->library('Messages');
            echo $this->messages->New_Pass_False('yonetim');
            return false;

        }

        $this->load->library('Messages');
        echo $this->messages->New_Pass_True('yonetim');

        return false;

    }

    public function ayar()
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('yonetim');
            } else {echo

                $this->messages->To_Register('yonetim');}

        } else {

            $this->load->model('admin_model');
            $uye_turu = $this->admin_model->uye_turu_getir($online);

            if ($uye_turu != 0) {
                $this->load->library('Messages');
                echo $this->messages->config('yonetim');
                return false;

            }

            $crud = new grocery_CRUD();

            $crud->set_theme('flexigrid');
            $crud->set_table('ayar');

            $crud->set_subject('Ayarlar');
            $crud->columns('facebook', 'twitter', 'instagram', 'email', 'tel_1');
            $crud->display_as('web_url', 'Site adresi');
            $crud->display_as('email', 'E-Mail');
            $crud->display_as('tel_1', 'Telefon');
            $crud->display_as('tel_2', 'Telefon 2');
            $crud->display_as('fax', 'Fax');
            $crud->display_as('company_name', 'Yetkili Kişi');
            $crud->display_as('adress', 'Adres');
            $crud->display_as('home_slogan', 'Anasayfa Üst Slogan');
            $crud->display_as('seo_keywords', 'Anahtar Kelimeler');
            $crud->display_as('maps', 'Google Harita Linki');
            $crud->display_as('home_photo', 'Anasayfa Üst Resim 1920*1080');

            $crud->display_as('otel_photo', 'Otel Üst Resim 1920*1080');
            $crud->display_as('otel_slogan', 'Otel Üst Slogan');

            $crud->required_fields('web_url', 'email', 'tel_1', 'company_name', 'home_photo', 'otel_photo');
            $crud->set_field_upload('home_photo', 'assets/resimler/home');
            $crud->set_field_upload('otel_photo', 'assets/resimler/home');
            $crud->unset_add();
            $crud->unset_read();
            $crud->unset_delete();
            $crud->unset_export();
            $crud->unset_print();
            $crud->unset_back_to_list();

            $crud->unset_fields("kisa_aciklama_tr", "uzun_aciklama_tr", "home_slogan_tr", "otel_slogan_tr", "site_slogan_tr"
                , "kisa_aciklama_ru", "uzun_aciklama_ru", "home_slogan_ru", "otel_slogan_ru", "site_slogan_ru");

            $data['side_menu'] = "ayar";
            $data['kilavuz'] = "  <b>Sistem Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }
    }

    public function bilgi($edit = null, $id = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $this->load->model('admin_model');
            $uye_id = $this->admin_model->uye_id_getir($online);

            if ($id != $uye_id) {

                $this->load->library('Messages');
                echo $this->messages->config('yonetim');
                return false;

            }

            $crud = new grocery_CRUD();
            $crud->set_theme('flexigrid');
            $crud->set_table('uyeler');
            $crud->where('username', $online);
            $crud->set_subject('bilgi');
            $crud->columns('name', 'username', 'pass', 'email');
            $crud->display_as('name', 'Adı Soyadı');
            $crud->display_as('username', 'Kullanıcı Adı');
            $crud->display_as('pass', 'Şifre (Eski veya yeni şifre)');
            $crud->display_as('email', 'E-Mail');
            $crud->display_as('status', 'Admin Türü');
            $crud->required_fields('name', 'pass', 'email', 'username');

            $crud->unset_fields('status', "bas_tar", "bit_tar", "cari_id", "uye_turu", "kullanici_id");

            $crud->unset_add();
            $crud->unset_read();
            $crud->unset_delete();
            $crud->unset_export();
            $crud->unset_print();
            $crud->unset_back_to_list();
            $crud->change_field_type('pass', 'password');
            $crud->callback_before_update(array($this, 'encrypt_password_callback'));
            $crud->callback_before_insert(array($this, 'encrypt_password_callback'));

            $data['side_menu'] = "ayar";
            $data['kilavuz'] = "  <b>Admin Bilgi Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }
    }

    public function encrypt_password_callback($post_array, $primary_key = null)
    {
        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            if ($post_array['pass'] == '') {return false;} else {

                $post_array['pass'] = md5($post_array['pass']);
                return $post_array;

            }

        }

    }

    public function bina($edit = null, $id = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            if ($this->session->userdata('yetki') != 0) {

                $this->load->library('messages');
                $this->messages->yetkisiz_alan('');
                return false;

            }

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();

            if ($state == 'edit') {

                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_bina = $this->admin_model->yetki_kontrol_bina($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_bina != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

            }

            $crud->set_theme('flexigrid');
            $crud->set_table('bina');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));
            $crud->set_subject('Bina Ayar');
            $crud->columns('adi', 'adres');
            $crud->required_fields('adi', 'adres');
            $crud->field_type('kullanici_id', 'hidden');
            $crud->display_as('blok', 'Şube');
            $crud->unset_edit_fields('blok');
            $crud->field_type('para_birim', 'dropdown',
                array('TL' => 'TL', 'Euro' => 'Euro', 'Usd' => 'Usd',
                    'Pound' => 'Pound', 'Ruble' => 'Ruble', 'Kuveyt Dinar' => 'Kuveyt Dinar'));

            $crud->unset_add();
            $crud->unset_delete();

            $data['side_menu'] = "Bina Ayarları";
            $data['kilavuz'] = "  <b>Bina Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }
    }

    public function blok($edit = null, $id = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            if ($this->session->userdata('yetki') != 0) {

                $this->load->library('messages');
                $this->messages->yetkisiz_alan('');
                return false;

            }

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();

            if ($state == 'edit') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_blok = $this->admin_model->yetki_kontrol_blok($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_blok != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

            }

            //    $crud->callback_after_update(array($this, 'daire_kayit'));

            $crud->set_theme('flexigrid');
            $crud->set_table('blok');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));
            $crud->set_subject('Şube Ayar');
            $crud->columns('adi', 'daire_adet');
            $crud->required_fields('adi', 'adres');
            $crud->field_type('kullanici_id', 'hidden');
            $crud->display_as('daire_adet', 'Daire Adet (Güncellerseniz tüm daireler yeniden oluşturulacaktır.)');

            $crud->field_type('blok_id', 'hidden');
            $crud->field_type('kullanici_id', 'hidden');

            $crud->unset_add();
            $crud->unset_delete();

            $data['side_menu'] = "Şube Ayarları";
            $data['kilavuz'] = "  <b>Şube Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }
    }

    public function daire_kayit($post_array, $primary_key)
    {

        $this->db->where('blok_id', $primary_key);
        $this->db->delete('daire');

        $this->load->model('admin_model');
        $blok_bilgi_getir = $this->admin_model->blok_bilgi_getir($this->session->userdata('kullanici_id'), $primary_key);
        $daire_say = $this->admin_model->daire_say($this->session->userdata('kullanici_id'), $primary_key);

        if ($blok_bilgi_getir): foreach ($blok_bilgi_getir as $dizi):

                $daire_adet = $dizi["daire_adet"];
                $bina_id = $dizi["blok_id"];
                $kullanici_id = $dizi["kullanici_id"];
            endforeach;endif;

        $yeni_daire = $daire_adet - $daire_say;
        if ($yeni_daire <= 0) {} else {

            $d_no = $daire_say;

            $dongu = $yeni_daire - 1;
            for ($i = 0; $i <= $dongu; $i++) {

                $insert = array(
                    'bina_id' => $bina_id,
                    'blok_id' => $primary_key,
                    'kullanici_id' => $kullanici_id,
                    'daire_no' => $d_no + $i + 1,
                );
/**/
                $this->db->insert('daire', $insert);

            }

        }

        return true;
    }

    public function daire($edit = null, $id = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            if ($this->session->userdata('yetki') != 0) {

                $this->load->library('messages');
                $this->messages->yetkisiz_alan('');
                return false;

            }

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();

            if ($state == 'add') {

                $crud->field_type('kullanici_id', 'hidden');
                $crud->field_type('bina_id', 'hidden');
                $crud->field_type('blok_id', 'hidden');
                $crud->unset_add_fields("kiraci_id");

                $crud->set_relation('sahip_id', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id'), 'kisi_turu = ' => 1]);

            }

            if ($state == 'edit') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_daire = $this->admin_model->yetki_kontrol_daire($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_daire != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

                $crud->field_type('kullanici_id', 'hidden');
                $crud->field_type('bina_id', 'hidden');
                $crud->field_type('blok_id', 'hidden');
                $crud->unset_edit_fields('daire_no', "kiraci_id");

                $crud->set_relation('sahip_id', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id'), 'kisi_turu = ' => 1]);
                $crud->set_relation('kiraci_id', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id'), 'kisi_turu = ' => 1]);

            }

            if ($state == 'read') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_daire = $this->admin_model->yetki_kontrol_daire($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_daire != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

                $crud->field_type('kullanici_id', 'hidden');
                $crud->unset_read_fields("kiraci_id");
                $crud->set_relation('bina_id', 'bina', 'adi', ['kullanici_id = ' => $this->session->userdata('kullanici_id')]);
                $crud->set_relation('blok_id', 'blok', 'adi', ['kullanici_id = ' => $this->session->userdata('kullanici_id')]);

                $crud->set_relation('sahip_id', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id'), 'kisi_turu = ' => 1]);
                $crud->set_relation('kiraci_id', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id'), 'kisi_turu = ' => 1]);

            }

            $crud->set_theme('flexigrid');
            $crud->set_table('daire');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));
            $crud->set_subject('Odaler');
            $crud->columns('blok_id', 'daire_no', 'oda_sahibi');
            $crud->required_fields('sahip_id');
            $crud->display_as('kiraci_id', 'Kiracı');
            $crud->display_as('sahip_id', 'İlgili Doktor');
            $crud->display_as('blok_id', 'Şube Adı');

            $crud->callback_column('oda_sahibi', array($this, 'callback_cari_getir2'));
            $crud->callback_column('blok_id', array($this, 'blok_adi_getir'));

            $crud->unset_delete();
            $crud->unset_clone();

            $data['side_menu'] = "Oda Ayarları";
            $data['kilavuz'] = "  <b>Oda Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }
    }

    public function cari($edit = null, $id = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();

            if ($state == 'edit') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_cari = $this->admin_model->yetki_kontrol_cari($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_cari != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

            } else if ($state == 'read') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_cari = $this->admin_model->yetki_kontrol_cari($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_cari != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

            }

            $crud->set_theme('flexigrid');
            $crud->set_table('cari');

            $crud->set_subject('Tedarikçi');
            $crud->columns('adi_soyadi');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));
            $crud->where('kisi_turu', 2);
            $crud->required_fields('adi_soyadi', 'tc', 'eposta', 'kisi_turu');

            $crud->field_type('kisi_turu', 'dropdown',
                array('0' => 'Hasta', '2' => 'Cari'));

            $crud->field_type('durum', 'dropdown',
                array('1' => 'Aktif', '0' => 'Pasif'));

            $crud->field_type('kisi_turu', 'hidden', 2);
            $crud->field_type('kullanici_id', "hidden", $this->session->userdata('kullanici_id'));
            $crud->display_as('bas_borc_alacak', 'Başlangıç borç alacak (Alacaklıysanız negatif borçluysanız pozitif değer giriniz örn: -100)');
            $crud->field_type('eposta_durum', 'dropdown',
                array('1' => 'Aktif', '0' => 'Pasif'));
            $crud->unset_delete();
            $crud->unset_clone();
            $crud->unset_fields("maas", "gorev", "aciklama", "baslama_tarihi", "cikis_tarihi", "ozluk_dosyalari", "boy", "kilo", "sigara", "alkol", "ilaclar");

            $data['side_menu'] = "Tedarikçi Ayarları";
            $data['kilavuz'] = "  <b>Tedarikçi Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }
    }

    public function hasta($edit = null, $id = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();

            if ($state == 'edit') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_cari = $this->admin_model->yetki_kontrol_cari($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_cari != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

            } else if ($state == 'read') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_cari = $this->admin_model->yetki_kontrol_cari($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_cari != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

            }

            $crud->set_theme('flexigrid');
            $crud->set_table('cari');

            $crud->set_subject('Hastalar');
            $crud->columns('adi_soyadi');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));
            $crud->where('kisi_turu', 0);
            $crud->required_fields('adi_soyadi', 'tc', 'eposta', 'kisi_turu');
            $crud->field_type('kullanici_id', "hidden", $this->session->userdata('kullanici_id'));
            $crud->field_type('kisi_turu', 'dropdown',
                array('0' => 'Hasta', '2' => 'Cari'));
            $crud->field_type('kisi_turu', 'hidden', 2);
            $crud->display_as('bas_borc_alacak', 'Başlangıç borç alacak (Alacaklıysanız negatif borçluysanız pozitif değer giriniz örn: -100)');
            $crud->field_type('eposta_durum', 'dropdown',
                array('1' => 'Aktif', '0' => 'Pasif'));

            $crud->field_type('durum', 'dropdown',
                array('1' => 'Aktif', '0' => 'Pasif'));

            $crud->field_type('sigara', 'dropdown',
                array('1' => 'Kullanıyor', '0' => 'Kullanmıyor'));

            $crud->field_type('alkol', 'dropdown',
                array('1' => 'Kullanıyor', '0' => 'Kullanmıyor'));

            $crud->field_type('Medeni', 'dropdown',
                array('1' => 'Evli', '0' => 'Bekar'));

            $crud->unset_delete();
            $crud->unset_clone();
            $crud->unset_fields("maas", "aciklama", "baslama_tarihi", "cikis_tarihi", "ozluk_dosyalari");

            $data['side_menu'] = "Hasta Ayarları";
            $data['kilavuz'] = "  <b>Hasta Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }
    }

    public function personel($edit = null, $id = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();

            if ($state == 'edit') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_cari = $this->admin_model->yetki_kontrol_cari($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_cari != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

            } else if ($state == 'read') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_cari = $this->admin_model->yetki_kontrol_cari($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_cari != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

            }

            $crud->set_theme('flexigrid');
            $crud->set_table('cari');

            $crud->set_subject('Personeller');
            $crud->columns('adi_soyadi', 'kisi_turu', 'gorev');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));
            $crud->where('kisi_turu', 1);
            $crud->or_where('kisi_turu', 3);
            $crud->field_type('kisi_turu', 'dropdown',
                array('1' => 'Doktor', '3' => 'Diğer'));

            $crud->field_type('durum', 'dropdown',
                array('1' => 'Aktif', '0' => 'Pasif'));

            $crud->required_fields('adi_soyadi', 'tc', 'eposta', 'kisi_turu');

            $crud->field_type('kullanici_id', 'hidden', $this->session->userdata('kullanici_id'));
            $crud->display_as('bas_borc_alacak', 'Başlangıç borç alacak (Alacaklıysanız negatif borçluysanız pozitif değer giriniz örn: -100)');
            $crud->field_type('eposta_durum', 'dropdown',
                array('1' => 'Aktif', '0' => 'Pasif'));
            $crud->unset_delete();
            $crud->unset_clone();
            $crud->set_field_upload('ozluk_dosyalari', 'assets/uploads/files');
            $crud->unset_fields("boy", "kilo", "sigara", "alkol", "ilaclar");

            $data['side_menu'] = "Personel Ayarları";
            $data['kilavuz'] = "  <b>Personel Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }
    }

    public function zimmet($edit = null, $id = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            if ($this->session->userdata('yetki') != 0) {

                $this->load->library('messages');
                $this->messages->yetkisiz_alan('');
                return false;

            }

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();

            if ($state == 'add') {

                $crud->set_relation('demirbas', 'hizmet_urun', 'adi', ['demirbas = ' => 1, 'kullanici_id = ' => $this->session->userdata('kullanici_id')]);
                $crud->set_relation('cari_id', 'cari', 'adi_soyadi', ['kisi_turu = ' => 1, 'kullanici_id = ' => $this->session->userdata('kullanici_id')]);

            }

            if ($state == 'edit') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_zimmet = $this->admin_model->yetki_kontrol_zimmet($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_zimmet != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

                $crud->set_relation('demirbas', 'hizmet_urun', 'adi', ['demirbas = ' => 1, 'kullanici_id = ' => $this->session->userdata('kullanici_id')]);
                $crud->set_relation('cari_id', 'cari', 'adi_soyadi', ['kisi_turu = ' => 1, 'kullanici_id = ' => $this->session->userdata('kullanici_id')]);

            } else if ($state == 'read') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_zimmet = $this->admin_model->yetki_kontrol_zimmet($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_zimmet != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

                $crud->set_relation('demirbas', 'hizmet_urun', 'adi', ['demirbas = ' => 1, 'kullanici_id = ' => $this->session->userdata('kullanici_id')]);
                $crud->set_relation('cari_id', 'cari', 'adi_soyadi', ['kisi_turu = ' => 1, 'kullanici_id = ' => $this->session->userdata('kullanici_id')]);

            } else if ($state == 'delete') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_zimmet = $this->admin_model->yetki_kontrol_zimmet($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_zimmet != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

            }

            $crud->set_theme('flexigrid');
            $crud->set_table('zimmet');

            $crud->set_subject('Zimmet');
            $crud->columns('cari_id', 'demirbas', 'adet', 'teslim_tarihi', 'iade_tarihi');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));
            $crud->required_fields('cari_id', 'demirbas', 'adet', 'teslim_tarihi', 'cari_id');
            $crud->field_type('kullanici_id', 'hidden', $this->session->userdata('kullanici_id'));
            $crud->display_as('cari_id', 'Personel');
            $crud->unset_clone();
            $crud->callback_column('cari_id', array($this, 'callback_cari_getir'));
            $crud->callback_column('demirbas', array($this, 'demirbas_getir'));

            $data['side_menu'] = "Zimmet Ayarları";
            $data['kilavuz'] = "  <b>Zimmet Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }
    }

    public function izin($edit = null, $id = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            if ($this->session->userdata('yetki') != 0) {

                $this->load->library('messages');
                $this->messages->yetkisiz_alan('');
                return false;

            }

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();

            if ($state == 'add') {

                $crud->set_relation('cari_id', 'cari', 'adi_soyadi', ['kisi_turu = ' => 1, 'kullanici_id = ' => $this->session->userdata('kullanici_id')]);

            }

            if ($state == 'edit') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_izin = $this->admin_model->yetki_kontrol_izin($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_izin != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

                $crud->set_relation('cari_id', 'cari', 'adi_soyadi', ['kisi_turu = ' => 1, 'kullanici_id = ' => $this->session->userdata('kullanici_id')]);

            } else if ($state == 'read') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_izin = $this->admin_model->yetki_kontrol_izin($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_izin != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

                $crud->set_relation('cari_id', 'cari', 'adi_soyadi', ['kisi_turu = ' => 1, 'kullanici_id = ' => $this->session->userdata('kullanici_id')]);

            } else if ($state == 'delete') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_izin = $this->admin_model->yetki_kontrol_izin($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_izin != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

            }

            $crud->set_theme('flexigrid');
            $crud->set_table('izin');

            $crud->set_subject('İzinler');
            $crud->columns('cari_id', 'gun', 'baslangic_tarihi', 'bitis_tarihi');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));
            $crud->required_fields('cari_id', 'adet', 'teslim_tarihi', 'cari_id');
            $crud->field_type('kullanici_id', 'hidden', $this->session->userdata('kullanici_id'));
            $crud->display_as('cari_id', 'Personel');
            $crud->unset_clone();
            $crud->callback_column('cari_id', array($this, 'callback_cari_getir'));

            $data['side_menu'] = "İzin Ayarları";
            $data['kilavuz'] = "  <b>İzin Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }
    }

    public function hizmet_urun($edit = null, $id = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();

            if ($state == 'add') {

                $crud->set_relation('kategori', 'kategori', 'kategori_adi', [
                    'kategori_turu = ' => 'urun', 'kullanici_id = ' => $this->session->userdata('kullanici_id'),
                ]);

            }

            if ($state == 'edit') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_hiz = $this->admin_model->yetki_kontrol_hiz($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_hiz != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

                $crud->set_relation('kategori', 'kategori', 'kategori_adi', [
                    'kategori_turu = ' => 'urun', 'kullanici_id = ' => $this->session->userdata('kullanici_id'),
                ]);

            } else if ($state == 'read') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_hiz = $this->admin_model->yetki_kontrol_hiz($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_hiz != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

                $crud->set_relation('kategori', 'kategori', 'kategori_adi', [
                    'kategori_turu = ' => 'urun', 'kullanici_id = ' => $this->session->userdata('kullanici_id'),
                ]);

            }

            $crud->set_theme('flexigrid');
            $crud->set_table('hizmet_urun');

            $crud->set_subject('Hizmet Ürünler');
            $crud->columns('adi', 'alis_fiyat', 'satis_fiyat');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));
            $crud->required_fields('adi', 'birim', 'alis_fiyat', 'satis_fiyat');

            $crud->field_type('kullanici_id', 'hidden', $this->session->userdata('kullanici_id'));
            $crud->field_type('demirbas', 'dropdown',
                array('0' => 'Hayır', '1' => 'Evet'));

            $crud->field_type('durum', 'dropdown',
                array('1' => 'Aktif', '0' => 'Pasif'));

            $crud->unset_delete();
            $crud->unset_clone();

            $data['side_menu'] = "Hizmet Ürün Ayarları";
            $data['kilavuz'] = "  <b>Hizmet Ürün Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }
    }

    public function demirbas($edit = null, $id = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            if ($this->session->userdata('yetki') != 0) {

                $this->load->library('messages');
                $this->messages->yetkisiz_alan('');
                return false;

            }

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();

            if ($state == 'add') {

                $crud->set_relation('kategori', 'kategori', 'kategori_adi', [
                    'kategori_turu = ' => 'urun', 'kullanici_id = ' => $this->session->userdata('kullanici_id'),
                ]);

            }

            if ($state == 'edit') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_hiz = $this->admin_model->yetki_kontrol_hiz($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_hiz != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

                $crud->set_relation('kategori', 'kategori', 'kategori_adi', [
                    'kategori_turu = ' => 'urun', 'kullanici_id = ' => $this->session->userdata('kullanici_id'),
                ]);

            } else if ($state == 'read') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_hiz = $this->admin_model->yetki_kontrol_hiz($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_hiz != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

                $crud->set_relation('kategori', 'kategori', 'kategori_adi', [
                    'kategori_turu = ' => 'urun', 'kullanici_id = ' => $this->session->userdata('kullanici_id'),
                ]);

            }

            $crud->set_theme('flexigrid');
            $crud->set_table('hizmet_urun');

            $crud->set_subject('Demirbaşlar');
            $crud->columns('adi', 'demirbas_adet');
            $crud->where('demirbas', "1");
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));

            $crud->required_fields('adi', 'birim', 'alis_fiyat', 'satis_fiyat');

            $crud->field_type('kullanici_id', 'hidden', $this->session->userdata('kullanici_id'));
            $crud->field_type('demirbas', 'hidden', 1);

            $crud->unset_fields("bas_stok");
            $crud->unset_delete();
            $crud->unset_clone();

            $data['side_menu'] = "Demirbaşlar Ayarları";
            $data['kilavuz'] = "  <b>Demirbaşlar Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }
    }

    public function kasa($edit = null, $id = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            if ($this->session->userdata('yetki') != 0) {

                $this->load->library('messages');
                $this->messages->yetkisiz_alan('');
                return false;

            }

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();

            if ($state == 'edit') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_kasa = $this->admin_model->yetki_kontrol_kasa($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_kasa != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

            } else if ($state == 'read') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_kasa = $this->admin_model->yetki_kontrol_kasa($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_kasa != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

            }

            $crud->set_theme('flexigrid');
            $crud->set_table('kasa');

            $crud->set_subject('Kasalar');
            $crud->columns('adi');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));
            $crud->required_fields('adi');

            $crud->field_type('kullanici_id', 'hidden', $this->session->userdata('kullanici_id'));

            $crud->unset_fields("turu");
            $crud->unset_delete();
            $crud->unset_clone();

            $data['side_menu'] = "Kasa Ayarları";
            $data['kilavuz'] = "  <b>Kasa Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }
    }

    public function komite($edit = null, $id = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            if ($this->session->userdata('yetki') != 0) {

                $this->load->library('messages');
                $this->messages->yetkisiz_alan('');
                return false;

            }

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();

            if ($state == 'add') {

                $crud->set_relation('cari_id', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id')]);

            }

            if ($state == 'edit') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_komite = $this->admin_model->yetki_kontrol_komite($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_komite != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

                $crud->set_relation('cari_id', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id')]);

            } else if ($state == 'read') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_komite = $this->admin_model->yetki_kontrol_komite($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_komite != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

                $crud->set_relation('cari_id', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id')]);

            }

            $crud->set_theme('flexigrid');
            $crud->set_table('komite');

            $crud->set_subject('Komite');
            $crud->columns('unvan', 'Cari');
            $crud->display_as('cari_id', 'Cari Adı');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));
            $crud->required_fields('adi', 'unvan');

            $crud->field_type('kullanici_id', 'hidden', $this->session->userdata('kullanici_id'));
            $crud->callback_column('Cari', array($this, 'callback_cari_getir'));

            $crud->unset_delete();
            $crud->unset_clone();

            $data['side_menu'] = "Komite Ayarları";
            $data['kilavuz'] = "  <b>Komite Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }
    }

    public function demirbas_getir($value, $row)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            //    return $row->cari_id;

            $this->load->model('admin_model');
            $demirbas_ad = $this->admin_model->demirbas_ad($row->demirbas);

            return "<a class='btn btn-default' href='" . site_url('yonetim/demirbas/read/' . $row->demirbas) . "'>" . $demirbas_ad . "</a>";
        }

    }

    public function callback_cari_getir($value, $row)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            //    return $row->cari_id;

            $this->load->model('admin_model');
            $cari_ad = $this->admin_model->cari_ad($row->cari_id);

            return "<a class='btn btn-default' href='" . site_url('yonetim/cari/read/' . $row->cari_id) . "'>" . $cari_ad . "</a>";
        }

    }
    public function callback_cari_getir3($value, $row)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $this->load->model('admin_model');
            $cari_ad = $this->admin_model->cari_ad($row->kiraci_id);

            return "<a class='btn btn-default' href='" . site_url('yonetim/cari/read/' . $row->kiraci_id) . "'>" . $cari_ad . "</a>";

        }

    }

    public function callback_cari_getir2($value, $row)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $this->load->model('admin_model');
            $cari_ad = $this->admin_model->cari_ad($row->sahip_id);

            return "<a class='btn btn-default' href='" . site_url('yonetim/cari/read/' . $row->sahip_id) . "'>" . $cari_ad . "</a>";

        }

    }

    public function blok_adi_getir($value, $row)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $this->load->model('admin_model');
            return $blok_ad = $this->admin_model->blok_ad($row->blok_id);

        }

    }

    public function uyeler($edit = null, $id = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            if ($this->session->userdata('yetki') != 0) {

                $this->load->library('messages');
                $this->messages->yetkisiz_alan('');
                return false;

            }

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();

            if ($state == 'delete') {

                $primary_key = $state_info->primary_key;
                if ($primary_key == $this->session->userdata('kullanici_id')) {
                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

                if ($primary_key == $this->session->userdata('id')) {
                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;
                }

            }

            if ($state == 'add') {

                $crud->set_relation('cari_id', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id')]);

            } else if ($state == 'edit') {

                $primary_key = $state_info->primary_key;
                if ($primary_key == $this->session->userdata('kullanici_id')) {
                    $crud->unset_edit_fields("status", "bas_tar", "bit_tar");

                }

                if ($primary_key == $this->session->userdata('id')) {
                    $crud->unset_edit_fields("status", "bas_tar", "bit_tar");

                }

                $this->load->model('admin_model');
                $yetki_kontrol_uye = $this->admin_model->yetki_kontrol_uye($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_uye != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

                $crud->set_relation('cari_id', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id')]);

            } else if ($state == 'read') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_uye = $this->admin_model->yetki_kontrol_uye($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_uye != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }
                $crud->unset_read_fields("pass");
                $crud->set_relation('cari_id', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id')]);

            }

            $crud->set_theme('flexigrid');
            $crud->set_table('uyeler');

            $crud->set_subject('Üyeler');
            $crud->columns('name', 'email', 'bas_tar', 'bit_tar');
            $crud->display_as('cari_id', 'Cari Adı');
            $crud->display_as('name', 'Adı');
            $crud->display_as('bas_tar', 'Başlangıç Tarihi');
            $crud->display_as('bit_tar', 'Bitiş Tarihi');
            $crud->display_as('status', 'Durum');
            $crud->field_type('uye_turu', 'hidden', 2);

            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));
            $crud->required_fields('name', 'email', 'username', 'pass');

            $crud->field_type('status', 'dropdown',
                array('1' => 'Aktif', '0' => 'Pasif'));

            $crud->field_type('kullanici_id', 'hidden', $this->session->userdata('kullanici_id'));
            $crud->callback_column('Cari', array($this, 'callback_cari_getir'));

            $crud->change_field_type('pass', 'password');
            $crud->callback_before_update(array($this, 'encrypt_password_callback'));
            $crud->callback_before_insert(array($this, 'encrypt_password_callback'));

            $crud->field_type('yetki', 'dropdown',
                array('0' => 'Admin', '1' => 'Doktor', '2' => 'Sekreter'));

            $crud->unset_clone();

            $data['side_menu'] = "Komite Ayarları";
            $data['kilavuz'] = "  <b>Komite Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }
    }

    public function mail()
    {
        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            //Bayi ekleme sayfası

            if ($this->session->userdata('yetki') != 0) {

                $this->load->library('messages');
                $this->messages->yetkisiz_alan('');
                return false;

            }

            $this->load->Model('admin_model', 'Model');
            $data['mail'] = $this->Model->mail_getir($this->session->userdata('kullanici_id'));

            $data['sayfa'] = 'E-Posta Gönder';

            $this->load->view('eposta.php', $data);

        }

    }

    public function mail_gonder()
    {
        error_reporting(0);
        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin/admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('admin/admin');
            } else {echo $this->messages->To_Register('admin/admin');}

        } else {

            //Bayi ekleme sayfası

            $epostalar = $this->input->post('epostalar', true);
            $say = count($epostalar);
            $bas = $this->input->post('bas', true);
            $ice = $this->input->post('ice', true);

            $this->load->library('mail/reklam_mail');
            $mail_sinifi = new reklam_mail();

            if ($say == 0) {

                echo "<br><br><center><b>Lütfen en az 1 adet e-posta adresi seçiniz.</b></center>";
                echo '<meta http-equiv="refresh" content="2;URL=mail">';
                return false;
            }

            $mail_adresleri = $epostalar;
            $ice .= " <br><br>Mail Listesinden ayrılmak için <a href='" . base_url() . "yonetim/mail_cikis/";
            $gonder = $mail_sinifi->gonder_icerik($mail_adresleri, $bas, $ice);

            if ($gonder != true) {
                echo "<br><br><center><b>Gönderim başarısız</b></center>";
                echo '<meta http-equiv="refresh" content="2;URL=mail">';
                return false;
            }

            echo "<br><br><center><b>Gönderim başarılı</b></center>";
            echo '<meta http-equiv="refresh" content="2;URL=mail">';
            return false;

        }

    }

    public function mail_cikis($ep1, $ep2)
    {
        if (($ep1 == "") or ($ep2 == "")) {

            $this->load->library('messages');
            $this->messages->config('');

        }

        $ep1 = trim($ep1);
        $ep1 = strip_tags($ep1);
        $ep1 = htmlentities($ep1);
        $ep2 = trim($ep2);
        $ep2 = strip_tags($ep2);
        $ep2 = htmlentities($ep2);

        $this->load->model('admin_model');
        $mail_cikis = $this->admin_model->mail_cikis($ep1, $ep2);
        if ($mail_cikis != 1) {
            echo "<br><br><center><b>Mail Listesinden çıkış işleminiz başarısız başarısız , Lütfen iletişime geçiniz.</b></center>";
            echo '<meta http-equiv="refresh" content="2;URL=' . base_url() . '/yonetim/mail">';
            return false;
        }

        echo "<br><br><center><b>Mail Listesinden çıkış işleminiz başarılı</b></center>";
        echo '<meta http-equiv="refresh" content="2;URL=' . base_url() . '/yonetim/mail">';
        return false;

    }

    public function ornek_dosyalar($edit = null, $id = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();

            if ($state == 'edit') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_dosya = $this->admin_model->yetki_kontrol_dosya($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_dosya != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

            } else if ($state == 'read') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_dosya = $this->admin_model->yetki_kontrol_dosya($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_dosya != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

            }

            $crud->set_theme('flexigrid');
            $crud->set_table('ornek_dosyalar');

            $crud->set_subject('Örnek Dosyalar');
            $crud->columns('dosya_adi', 'aciklama');
            $crud->required_fields('dosya_adi', 'aciklama');
            $crud->set_field_upload('dosya_adi', 'assets/uploads/files');

            $crud->unset_edit();
            $crud->unset_delete();
            $crud->unset_clone();
            $crud->unset_add();
            $crud->unset_read();

            $data['side_menu'] = "Örnek Dosya Ayarları";
            $data['kilavuz'] = "  <b>Örnek Dosya Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }
    }

    public function dosyalar($edit = null, $id = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();

            if ($state == 'edit') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_dosya = $this->admin_model->yetki_kontrol_dosya($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_dosya != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

            } else if ($state == 'read') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_dosya = $this->admin_model->yetki_kontrol_dosya($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_dosya != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

            }

            $crud->set_theme('flexigrid');
            $crud->set_table('dosyalar');

            $crud->set_subject('Dosyalar');
            $crud->columns('dosya_adi');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));
            $crud->required_fields('dosya_adi', 'aciklama');
            $crud->set_field_upload('dosya_adi', 'assets/uploads/files');
            $crud->field_type('kullanici_id', 'hidden', $this->session->userdata('kullanici_id'));

            $crud->unset_delete();
            $crud->unset_clone();

            $data['side_menu'] = "Dosya Ayarları";
            $data['kilavuz'] = "  <b>Dosya Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }
    }

    public function kategori($edit = null, $id = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            if ($this->session->userdata('yetki') != 0) {

                $this->load->library('messages');
                $this->messages->yetkisiz_alan('');
                return false;

            }

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();

            if ($state == 'edit') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_kategori = $this->admin_model->yetki_kontrol_kategori($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_kategori != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

            } else if ($state == 'read') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_kategori = $this->admin_model->yetki_kontrol_kategori($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_kategori != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

            }

            $crud->set_theme('flexigrid');
            $crud->set_table('kategori');

            $crud->set_subject('Kategoriler');
            $crud->columns('kategori_adi');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));
            $crud->required_fields('kategori_adi', 'kategori_turu');

            $crud->field_type('kullanici_id', 'hidden', $this->session->userdata('kullanici_id'));
            $crud->field_type('kategori_turu', 'dropdown',
                array('urun' => 'Ürün', 'gelir_gider' => 'Gelir Gider'));

            $crud->unset_delete();
            $crud->unset_clone();

            $data['side_menu'] = "Kategori Ayarları";
            $data['kilavuz'] = "  <b>Kategori Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }
    }

    public function gelir_gider($edit = null, $id = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            if ($this->session->userdata('yetki') != 0) {

                $this->load->library('messages');
                $this->messages->yetkisiz_alan('');
                return false;

            }

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();

            if ($state == 'add') {

                $crud->set_relation('kategori', 'kategori', 'kategori_adi', [
                    'kategori_turu = ' => 'gelir_gider', 'kullanici_id = ' => $this->session->userdata('kullanici_id'),
                ]);
                $crud->set_relation('kasa_id', 'kasa', 'adi', [
                    'kullanici_id = ' => $this->session->userdata('kullanici_id'),
                ]);

            }

            if ($state == 'edit') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_gelir_gider = $this->admin_model->yetki_kontrol_gelir_gider($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_gelir_gider != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

                $crud->set_relation('kategori', 'kategori', 'kategori_adi', [
                    'kategori_turu = ' => 'gelir_gider', 'kullanici_id = ' => $this->session->userdata('kullanici_id'),
                ]);
                $crud->set_relation('kasa_id', 'kasa', 'adi', [
                    'kullanici_id = ' => $this->session->userdata('kullanici_id'),
                ]);

            } else if ($state == 'read') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_gelir_gider = $this->admin_model->yetki_kontrol_gelir_gider($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_gelir_gider != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }
                $crud->set_relation('kategori', 'kategori', 'kategori_adi', [
                    'kategori_turu = ' => 'gelir_gider', 'kullanici_id = ' => $this->session->userdata('kullanici_id'),
                ]);
                $crud->set_relation('kasa_id', 'kasa', 'adi', [
                    'kullanici_id = ' => $this->session->userdata('kullanici_id'),
                ]);

            }

            $crud->set_theme('flexigrid');
            $crud->set_table('islem');

            $crud->set_subject('Gelir - Gider');
            $crud->columns('giris_cikis', 'tutar', 'tarih');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));
            $crud->where('islem_turu', 0);
            $crud->required_fields('giris_cikis', 'tutar', 'tarih', 'kasa_id');
            $crud->display_as('kasa_id', 'Kasa Banka');
            $crud->display_as('cari_id', 'Cari');
            $crud->display_as('giris_cikis', 'Gelir - Gider');
            $crud->field_type('kullanici_id', 'hidden', $this->session->userdata('kullanici_id'));
            $crud->field_type('islem_turu', 'hidden', 0);
            $crud->field_type('relation_type', 'hidden');
            $crud->field_type('relation_id', 'hidden');
            $crud->field_type('cari_id', 'hidden');
            $crud->field_type('giris_cikis', 'dropdown',
                array('1' => 'Gelir', '0' => 'Gider'));

            $crud->unset_delete();
            $crud->unset_clone();

            $data['side_menu'] = "Gelir - Gider Ayarları";
            $data['kilavuz'] = "  <b>Gelir - Gider Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }
    }

    public function virman($edit = null, $id = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            if ($this->session->userdata('yetki') != 0) {

                $this->load->library('messages');
                $this->messages->yetkisiz_alan('');
                return false;

            }

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();

            if ($state == 'add') {

                $crud->set_relation('gonderici', 'kasa', 'adi', ['kullanici_id = ' => $this->session->userdata('kullanici_id')]);
                $crud->set_relation('alici', 'kasa', 'adi', ['kullanici_id = ' => $this->session->userdata('kullanici_id')]);

            }

            if ($state == 'edit') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_virman = $this->admin_model->yetki_kontrol_virman($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_virman != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

                $crud->set_relation('gonderici', 'kasa', 'adi', ['kullanici_id = ' => $this->session->userdata('kullanici_id')]);
                $crud->set_relation('alici', 'kasa', 'adi', ['kullanici_id = ' => $this->session->userdata('kullanici_id')]);
            } else if ($state == 'read') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_virman = $this->admin_model->yetki_kontrol_virman($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_virman != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

                $crud->set_relation('gonderici', 'kasa', 'adi', ['kullanici_id = ' => $this->session->userdata('kullanici_id')]);
                $crud->set_relation('alici', 'kasa', 'adi', ['kullanici_id = ' => $this->session->userdata('kullanici_id')]);

            }

            $crud->set_theme('flexigrid');
            $crud->set_table('virman');

            $crud->set_subject('Virman');
            $crud->columns('gonderici', 'alici', 'tarih', 'tutar');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));

            $crud->required_fields('gonderici', 'alici', 'tarih', 'tutar');
            $crud->field_type('kullanici_id', 'hidden', $this->session->userdata('kullanici_id'));
            $crud->callback_column('gonderici', array($this, 'callback_kasa_gonderici'));
            $crud->callback_column('alici', array($this, 'callback_kasa_alici'));

            $crud->callback_after_delete(array($this, 'islem_sil'));
            $crud->callback_after_insert(array($this, 'islem_kayit'));

            $crud->unset_clone();
            $crud->unset_edit();

            $data['side_menu'] = "Gelir - Gider Ayarları";
            $data['kilavuz'] = "  <b>Gelir - Gider Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }
    }

    public function callback_kasa_gonderici($value, $row)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $this->load->model('admin_model');
            $gonderici = $this->admin_model->kasa_ad($row->gonderici);

            return "<a class='btn btn-default' href='" . site_url('yonetim/kasa/read/' . $row->gonderici) . "'>" . $gonderici . "</a>";

        }

    }

    public function callback_kasa_alici($value, $row)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $this->load->model('admin_model');
            $gonderici = $this->admin_model->kasa_ad($row->alici);

            return "<a class='btn btn-default' href='" . site_url('yonetim/kasa/read/' . $row->alici) . "'>" . $gonderici . "</a>";

        }

    }

    public function islem_kayit($post_array, $primary_key)
    {
//    $post_array['pass'] $primary_key

        $this->load->model('admin_model');

        $id = $this->db->insert_id();

        $virman_getir = $this->admin_model->virman_getir($this->session->userdata('kullanici_id'), $id);

        if ($virman_getir): foreach ($virman_getir as $dizi):

                $data[0] = $dizi["id"];
                $data[1] = $dizi["gonderici"];
                $data[2] = $dizi["alici"];
                $data[3] = $dizi["tutar"];
                $data[4] = $dizi["tarih"];
                $data[5] = $dizi["aciklama"];
                $data[6] = $dizi["kullanici_id"];

            endforeach;endif;

        $islem_kayit = $this->admin_model->islem_kayit($data);

        return true;
    }

    public function islem_sil($primary_key)
    {
//    $post_array['pass'] $primary_key

//    $this->load->model('admin_model');

        $this->db->where('islem_turu', 1);
        $this->db->where('relation_id', $primary_key);
        return $this->db->delete('islem');

    }

    public function borc_alacak($edit = null, $id = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            if ($this->session->userdata('yetki') != 0) {

                $this->load->library('messages');
                $this->messages->yetkisiz_alan('');
                return false;

            }

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();

            if ($state == 'list') {

                $crud->display_as('fatura_turu', 'Borç Alacak');
                $crud->display_as('cari_id', 'Cari');
                $crud->field_type('fatura_turu', 'dropdown',
                    array('1' => 'Cari Borçlandır', '0' => 'Cari Alacaklandır'));
            }

            if ($state == 'add') {

                $crud->set_relation('cari_id', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id')]);
                $crud->display_as('fatura_turu', 'Borç Alacak');
                $crud->display_as('cari_id', 'Cari');
                $crud->field_type('fatura_turu', 'dropdown',
                    array('1' => 'Cari Borçlandır', '0' => 'Cari Alacaklandır'));
            }

            if ($state == 'edit') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_borc = $this->admin_model->yetki_kontrol_borc($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_borc != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }
                $crud->set_relation('cari_id', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id')]);
                $crud->display_as('fatura_turu', 'Borç Alacak');
                $crud->display_as('cari_id', 'Cari');
                $crud->field_type('fatura_turu', 'dropdown',
                    array('1' => 'Cari Borçlandır', '0' => 'Cari Alacaklandır'));
            } else if ($state == 'read') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_borc = $this->admin_model->yetki_kontrol_borc($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_borc != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

                $crud->set_relation('cari_id', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id')]);
                $crud->display_as('fatura_turu', 'Borç Alacak');
                $crud->display_as('cari_id', 'Cari');
                $crud->field_type('fatura_turu', 'dropdown',
                    array('1' => 'Cari Borçlandır', '0' => 'Cari Alacaklandır'));
            }

            $crud->set_theme('flexigrid');
            $crud->set_table('borc_alacak');

            $crud->set_subject('Borç Alacak');
            $crud->columns('fatura_turu', 'cari', 'toplam', 'vade_tarihi');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));
            $crud->required_fields('fatura_turu', 'cari_id', 'toplam', 'vade_tarihi');
            $crud->field_type('kullanici_id', 'hidden', $this->session->userdata('kullanici_id'));
            $crud->field_type('tarih', 'hidden', date("Y-m-d"));

            $crud->callback_column('cari', array($this, 'callback_cari_getir'));
            $crud->callback_after_delete(array($this, 'islem_sil_boal'));
            $crud->callback_after_insert(array($this, 'islem_kayit_boal'));

            $crud->unset_edit();
            $crud->unset_clone();

            $data['side_menu'] = "Borç Alacak Ayarları";
            $data['kilavuz'] = "  <b>Borç Alacak Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }
    }

    public function islem_kayit_boal($post_array, $primary_key)
    {
//    $post_array['pass'] $primary_key

        $this->load->model('admin_model');

        $id = $this->db->insert_id();

        $boal_getir = $this->admin_model->boal_getir($this->session->userdata('kullanici_id'), $id);

        if ($boal_getir): foreach ($boal_getir as $dizi):

                $data[0] = $dizi["id"];
                $data[1] = $dizi["fatura_turu"];
                $data[2] = $dizi["toplam"];
                $data[3] = $dizi["cari_id"];
                $data[4] = $dizi["kullanici_id"];
                $data[5] = $dizi["tarih"];
                $data[6] = $dizi["vade_tarihi"];
                $data[7] = $dizi["aciklama"];

            endforeach;endif;

        $islem_kayit_boal = $this->admin_model->islem_kayit_boal($data);

        return true;
    }

    public function islem_sil_boal($primary_key)
    {
//    $post_array['pass'] $primary_key

//    $this->load->model('admin_model');

        $this->db->where('islem_turu', 2);
        $this->db->where('relation_id', $primary_key);
        return $this->db->delete('islem');

    }

    public function toplu_borc($edit = null, $id = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();

            if ($state == 'list') {

                $this->load->library('Messages');
                echo $this->messages->config('');
                return false;

            }

            if ($state == 'add') {

            }

            if ($state == 'edit') {
                $this->load->library('Messages');
                echo $this->messages->config('');
                return false;

            } else if ($state == 'read') {
                $this->load->library('Messages');
                echo $this->messages->config('');
                return false;

            }

            $this->load->model('admin_model');

            $crud->set_theme('flexigrid');
            $crud->set_table('borc_alacak');

            $crud->set_subject('Toplu Borçlandır');
            $crud->columns('fatura_turu', 'cari', 'toplam', 'vade_tarihi');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));
            $crud->required_fields('fatura_turu', 'cari_id', 'toplam', 'vade_tarihi', 'aciklama');
            $crud->field_type('kullanici_id', 'hidden', $this->session->userdata('kullanici_id'));
            $crud->field_type('tarih', 'hidden', date("Y-m-d"));

            $bos_varmi = $this->admin_model->sahip_bos_varmi($this->session->userdata('kullanici_id'));

            if ($bos_varmi > 0) {

                $crud->display_as('fatura_turu', 'Blok Seç (Lütfen dairelerinizin en azından sahip bilgilerini ilişkilendirin)');
                $crud->field_type('fatura_turu', 'readonly');
            } else {

                $crud->display_as('fatura_turu', 'Blok Seç ');
            }

            $crud->display_as('cari_id', 'Borçlandırılacak kişi');
            $crud->display_as('toplam', 'Bölünecek toplam tutar');
            $crud->set_relation('fatura_turu', 'blok', 'adi', ['kullanici_id = ' => $this->session->userdata('kullanici_id')]);

            $crud->field_type('cari_id', 'dropdown',
                array('1' => 'Ev sahibi', '0' => 'Varsa Kiracı yoksa ev sahibi'));
            $crud->callback_after_insert(array($this, 'islem_kayit_toplu_bo'));

            $crud->unset_delete();
            $crud->unset_read();
            $crud->unset_edit();
            $crud->unset_clone();
            $crud->unset_delete();
            $crud->unset_back_to_list();

            $data['side_menu'] = "Borç Alacak Ayarları";
            $data['kilavuz'] = "  <b>Borç Alacak Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }
    }

    public function islem_kayit_toplu_bo($post_array, $primary_key)
    {
//    $post_array['pass'] $primary_key

//    $this->load->model('admin_model');

        $id = $this->db->insert_id();

        $sql = "SELECT * FROM borc_alacak Where kullanici_id=" . $this->session->userdata('kullanici_id') . " and id=" . $id . "";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $boal_getir = $query->result_array();
        } else {
            return false;
        }

        if ($boal_getir): foreach ($boal_getir as $dizi):

                $blok = $dizi["fatura_turu"];
                $toplam = $dizi["toplam"];
                $evs_kir = $dizi["cari_id"];
                $vade_tarihi = $dizi["vade_tarihi"];
                $aciklama = $dizi["aciklama"];
                $kullanici_id = $dizi["kullanici_id"];
                $tarih = $dizi["tarih"];

            endforeach;endif;

        $this->db->where('id', $id);
        $this->db->delete('borc_alacak');

        $sql = "SELECT id,daire_no,sahip_id,kiraci_id FROM daire Where blok_id=" . $blok . "";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $daireler = $query->result_array();
        } else {
            return false;
        }

        $adet = count($daireler);
        $toplam = round($toplam / $adet, 2);
        if ($daireler): foreach ($daireler as $dizi):

                if ($evs_kir == 1) {$cari = $dizi["sahip_id"];
                    $daire_durumu = "Malik";}
                if ($evs_kir == 0) {if (($dizi["kiraci_id"] == 0) or ($dizi["kiraci_id"] == "")) {$cari = $dizi["sahip_id"];
                    $daire_durumu = "Malik";} else { $cari = $dizi["kiraci_id"];
                    $daire_durumu = "Kiracı";}}

                $data[0] = $fat_turu = 1;
                $data[1] = $toplam;
                $data[2] = $cari_id = $cari;
                $data[3] = $kullanici_id = $this->session->userdata('kullanici_id');
                $data[4] = $tarih = date("Y-m-d");
                $data[5] = $vade_tarihi = $vade_tarihi;
                $data[6] = $aciklama;
                $data[6] .= " (Daire No: " . $dizi["daire_no"] . " Durum: " . $daire_durumu . ")";
                $ack = $data[6];

                $toplu_boalkayit = $this->admin_model->toplu_boalkayit($data);
                $id = $this->db->insert_id();

                $data[0] = $id;
                $data[1] = $fat_turu;
                $data[2] = $toplam;
                $data[3] = $cari_id;
                $data[4] = $kullanici_id;
                $data[5] = $tarih;
                $data[6] = $vade_tarihi;
                $data[7] = $ack;

                $islem_kayit_boal = $this->admin_model->islem_kayit_boal($data);
/*    */

            endforeach;endif;

        return true;

    }

    public function toplu_alacak($edit = null, $id = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();

            if ($state == 'list') {

                $this->load->library('Messages');
                echo $this->messages->config('');
                return false;

            }

            if ($state == 'add') {

            }

            if ($state == 'edit') {
                $this->load->library('Messages');
                echo $this->messages->config('');
                return false;

            } else if ($state == 'read') {
                $this->load->library('Messages');
                echo $this->messages->config('');
                return false;

            }

            $this->load->model('admin_model');

            $crud->set_theme('flexigrid');
            $crud->set_table('borc_alacak');

            $crud->set_subject('Toplu Alacaklandır');
            $crud->columns('fatura_turu', 'cari', 'toplam', 'vade_tarihi');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));
            $crud->required_fields('fatura_turu', 'cari_id', 'toplam', 'vade_tarihi', 'aciklama');
            $crud->field_type('kullanici_id', 'hidden', $this->session->userdata('kullanici_id'));
            $crud->field_type('tarih', 'hidden', date("Y-m-d"));

            $bos_varmi = $this->admin_model->sahip_bos_varmi($this->session->userdata('kullanici_id'));

            if ($bos_varmi > 0) {

                $crud->display_as('fatura_turu', 'Blok Seç (Lütfen dairelerinizin en azından sahip bilgilerini ilişkilendirin)');
                $crud->field_type('fatura_turu', 'readonly');
            } else {

                $crud->display_as('fatura_turu', 'Blok Seç ');
            }

            $crud->display_as('cari_id', 'Alacaklandırılacak kişi');
            $crud->display_as('toplam', 'Bölünecek toplam tutar');
            $crud->set_relation('fatura_turu', 'blok', 'adi', ['kullanici_id = ' => $this->session->userdata('kullanici_id')]);

            $crud->field_type('cari_id', 'dropdown',
                array('1' => 'Ev sahibi', '0' => 'Varsa Kiracı yoksa ev sahibi'));
            $crud->callback_after_insert(array($this, 'islem_kayit_toplu_al'));

            $crud->unset_delete();
            $crud->unset_read();
            $crud->unset_edit();
            $crud->unset_clone();
            $crud->unset_delete();
            $crud->unset_back_to_list();

            $data['side_menu'] = "Borç Alacak Ayarları";
            $data['kilavuz'] = "  <b>Borç Alacak Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }
    }

    public function islem_kayit_toplu_al($post_array, $primary_key)
    {
//    $post_array['pass'] $primary_key

//    $this->load->model('admin_model');

        $id = $this->db->insert_id();

        $sql = "SELECT * FROM borc_alacak Where kullanici_id=" . $this->session->userdata('kullanici_id') . " and id=" . $id . "";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $boal_getir = $query->result_array();
        } else {
            return false;
        }

        if ($boal_getir): foreach ($boal_getir as $dizi):

                $blok = $dizi["fatura_turu"];
                $toplam = $dizi["toplam"];
                $evs_kir = $dizi["cari_id"];
                $vade_tarihi = $dizi["vade_tarihi"];
                $aciklama = $dizi["aciklama"];
                $kullanici_id = $dizi["kullanici_id"];
                $tarih = $dizi["tarih"];

            endforeach;endif;

        $this->db->where('id', $id);
        $this->db->delete('borc_alacak');

        $sql = "SELECT id,daire_no,sahip_id,kiraci_id FROM daire Where blok_id=" . $blok . "";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $daireler = $query->result_array();
        } else {
            return false;
        }

        $adet = count($daireler);
        $toplam = round($toplam / $adet, 2);
        if ($daireler): foreach ($daireler as $dizi):

                if ($evs_kir == 1) {$cari = $dizi["sahip_id"];
                    $daire_durumu = "Malik";}
                if ($evs_kir == 0) {if (($dizi["kiraci_id"] == 0) or ($dizi["kiraci_id"] == "")) {$cari = $dizi["sahip_id"];
                    $daire_durumu = "Malik";} else { $cari = $dizi["kiraci_id"];
                    $daire_durumu = "Kiracı";}}

                $data[0] = $fat_turu = 0;
                $data[1] = $toplam;
                $data[2] = $cari_id = $cari;
                $data[3] = $kullanici_id = $this->session->userdata('kullanici_id');
                $data[4] = $tarih = date("Y-m-d");
                $data[5] = $vade_tarihi = $vade_tarihi;
                $data[6] = $aciklama;
                $data[6] .= " (Daire No: " . $dizi["daire_no"] . " Durum: " . $daire_durumu . ")";
                $ack = $data[6];

                $toplu_boalkayit = $this->admin_model->toplu_boalkayit($data);
                $id = $this->db->insert_id();

                $data[0] = $id;
                $data[1] = $fat_turu;
                $data[2] = $toplam;
                $data[3] = $cari_id;
                $data[4] = $kullanici_id;
                $data[5] = $tarih;
                $data[6] = $vade_tarihi;
                $data[7] = $ack;

                $islem_kayit_boal = $this->admin_model->islem_kayit_boal($data);
/*    */

            endforeach;endif;

        return true;

    }

    public function cari_detay()
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            if ($this->session->userdata('yetki') != 0) {

                $this->load->library('messages');
                $this->messages->yetkisiz_alan('');
                return false;

            }

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();

            $this->load->model('admin_model');

            $crud->set_theme('flexigrid');
            $crud->set_table('cari');

            $crud->set_subject('Cari Durum');
            $crud->columns('adi_soyadi', 'durum', 'detay');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));
            $crud->field_type('kullanici_id', 'hidden', $this->session->userdata('kullanici_id'));
            $crud->callback_column('durum', array($this, 'durum_getir'));
            $crud->callback_column('detay', array($this, 'detay_getir'));

            $crud->unset_add();
            $crud->unset_delete();
            $crud->unset_read();
            $crud->unset_edit();
            $crud->unset_clone();
            $crud->unset_delete();
            $crud->unset_back_to_list();

            $data['side_menu'] = "Cari Borç Alacak Görünüm Ayarları";
            $data['kilavuz'] = "  <b>Cari Borç Alacak Görünüm  Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }
    }

    public function durum_getir($value, $row)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $this->load->model('admin_model');
            $cari_baslangic = $this->admin_model->cari_baslangic($row->id, $this->session->userdata('kullanici_id'));
            $cari_toplam_getir = $this->admin_model->cari_toplam_getir($row->id, $this->session->userdata('kullanici_id'));

            //    $cari_baslangic=0;
            if ($cari_toplam_getir): foreach ($cari_toplam_getir as $dizi):

                    if ($dizi["islem_turu"] == 0) {continue;}
                    if ($dizi["islem_turu"] == 1) {continue;}
                    if ($dizi["islem_turu"] == 2) {
                        if ($dizi["giris_cikis"] == 0) {$cari_baslangic = $cari_baslangic + $dizi["tutar"];
                            continue;}
                        if ($dizi["giris_cikis"] == 1) {$cari_baslangic = $cari_baslangic - $dizi["tutar"];
                            continue;}
                    }

                    if ($dizi["islem_turu"] == 3) {

                        if ($dizi["giris_cikis"] == 0) {$cari_baslangic = $cari_baslangic - $dizi["tutar"];
                            continue;}
                        if ($dizi["giris_cikis"] == 1) {$cari_baslangic = $cari_baslangic + $dizi["tutar"];
                            continue;}

                    }
                    if ($dizi["islem_turu"] == 4) {
                        if ($dizi["giris_cikis"] == 0) {$cari_baslangic = $cari_baslangic + $dizi["tutar"];
                            continue;}
                        if ($dizi["giris_cikis"] == 1) {$cari_baslangic = $cari_baslangic - $dizi["tutar"];
                            continue;}
                    }

                endforeach;endif;

            if ($cari_baslangic < 0) {
                $cari_baslangic = $cari_baslangic + $cari_baslangic * -2;
                return "" . $cari_baslangic . " " . $this->session->userdata('para_birim') . " Alacaklısınız";
            }
            if ($cari_baslangic == 0) {
                return "" . $cari_baslangic . " " . $this->session->userdata('para_birim') . " Borç ve Alacak yok";
            }
            if ($cari_baslangic > 0) {
                return "" . $cari_baslangic . " " . $this->session->userdata('para_birim') . " Borçlusunuz";
            }

        }

    }

    public function detay_getir($value, $row)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $this->load->model('admin_model');
            //    $cari_ad=$this->admin_model->cari_ad($row->sahip_id);

            return "<a class='btn btn-default' href='" . site_url('yonetim/cari_detay_git/' . $row->id) . "'>Görüntüle</a>";

        }

    }

    public function cari_detay_git($id = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();

            if ($state == 'read') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_islem = $this->admin_model->yetki_kontrol_islem($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_islem != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

            }

            if ($state == 'list') {

                $this->load->model('admin_model');
                $yetki_kontrol_cari_detay = $this->admin_model->yetki_kontrol_cari_detay($this->session->userdata('kullanici_id'), $id);

                if ($yetki_kontrol_cari_detay != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

            }

            $this->load->model('admin_model');
            $cari_baslangic = $this->admin_model->cari_baslangic($id, $this->session->userdata('kullanici_id'));
            $data["cari_baslangic"] = $cari_baslangic;
            $data["cari_id"] = $id;
            $data["cari_adi"] = $this->admin_model->cari_adi($id, $this->session->userdata('kullanici_id'));
            $cari_toplam_getir = $this->admin_model->cari_toplam_getir($id, $this->session->userdata('kullanici_id'));

            //    $cari_baslangic=0;
            if ($cari_toplam_getir): foreach ($cari_toplam_getir as $dizi):

                    if ($dizi["islem_turu"] == 0) {continue;}
                    if ($dizi["islem_turu"] == 1) {continue;}
                    if ($dizi["islem_turu"] == 2) {
                        if ($dizi["giris_cikis"] == 0) {$cari_baslangic = $cari_baslangic + $dizi["tutar"];
                            continue;}
                        if ($dizi["giris_cikis"] == 1) {$cari_baslangic = $cari_baslangic - $dizi["tutar"];
                            continue;}
                    }

                    if ($dizi["islem_turu"] == 3) {

                        if ($dizi["giris_cikis"] == 0) {$cari_baslangic = $cari_baslangic - $dizi["tutar"];
                            continue;}
                        if ($dizi["giris_cikis"] == 1) {$cari_baslangic = $cari_baslangic + $dizi["tutar"];
                            continue;}

                    }
                    if ($dizi["islem_turu"] == 4) {
                        if ($dizi["islem_turu"] == 4) {
                            if ($dizi["giris_cikis"] == 0) {$cari_baslangic = $cari_baslangic + $dizi["tutar"];
                                continue;}
                            if ($dizi["giris_cikis"] == 1) {$cari_baslangic = $cari_baslangic - $dizi["tutar"];
                                continue;}
                        }
                    }
                endforeach;endif;

            if ($cari_baslangic < 0) {
                $cari_baslangic = $cari_baslangic + $cari_baslangic * -2;
                $data["cari_total"] = "" . $cari_baslangic . " " . $this->session->userdata('para_birim') . " Alacaklısınız";

            } else if ($cari_baslangic == 0) {
                $data["cari_total"] = "" . $cari_baslangic . " " . $this->session->userdata('para_birim') . " Borç ve Alacak yok";
            } else if ($cari_baslangic > 0) {
                $data["cari_total"] = "" . $cari_baslangic . " " . $this->session->userdata('para_birim') . " Borçlusunuz";
            } else {}

            $crud->set_theme('flexigrid');
            $crud->set_table('islem');

            $crud->set_subject('Cari İşlemleri');
            $crud->columns('islem_turu', 'tarih', 'vade_tarihi', 'tutar');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));
            $crud->where('cari_id', $id);
            $crud->field_type('kullanici_id', 'hidden', $this->session->userdata('kullanici_id'));
            $crud->field_type('islem_turu', 'dropdown',
                array('2' => 'Borç Alacak', '3' => 'Tahsilat Ödeme'));

            $crud->field_type('giris_cikis', 'dropdown',
                array('0' => 'Cari Alacaklı', '1' => 'Cari Borçlu'));
            $crud->callback_column('vade_tarihi', array($this, 'vade_tarihi_getir'));
            $crud->callback_column('tutar', array($this, 'tutar_getir'));
            $crud->callback_column('islem_turu', array($this, 'islem_turu_getir'));

            $crud->unset_clone();
            $crud->unset_edit();
            $crud->unset_add();
            //  $crud->unset_read();
            $crud->unset_delete();

            $crud->unset_read_fields("islem_turu", "relation_type", "relation_id", "giris_cikis", "tutar", "tarih", "kategori", "cari_id"
                , "kasa_id", "kullanici_id");

            $data['side_menu'] = "Cari İşlemleri Ayarları";
            $data['kilavuz'] = "  <b>Cari İşlemleri Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }

    }

    public function stok_detay()
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();

            $this->load->model('admin_model');

            $crud->set_theme('flexigrid');
            $crud->set_table('hizmet_urun');

            $crud->set_subject('Cari Durum');
            $crud->columns('adi', 'durum', 'detay');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));
            $crud->field_type('kullanici_id', 'hidden', $this->session->userdata('kullanici_id'));
            $crud->callback_column('durum', array($this, 'stok_durum_getir'));
            $crud->callback_column('detay', array($this, 'stok_detay_getir'));

            $crud->unset_add();
            $crud->unset_delete();
            $crud->unset_read();
            $crud->unset_edit();
            $crud->unset_clone();
            $crud->unset_delete();
            $crud->unset_back_to_list();

            $data['side_menu'] = "Stok Görünüm Ayarları";
            $data['kilavuz'] = "  <b>Stok Görünüm  Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }
    }

    public function stok_durum_getir($value, $row)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $this->load->model('admin_model');
            $stok_baslangic = $this->admin_model->stok_baslangic($row->id, $this->session->userdata('kullanici_id'));
            $stok_toplam_getir = $this->admin_model->stok_toplam_getir($row->id, $this->session->userdata('kullanici_id'));

            //    $cari_baslangic=0;
            if ($stok_toplam_getir): foreach ($stok_toplam_getir as $dizi):

                    $fatura_turu_getir = $this->admin_model->fatura_turu_getir($dizi["fatura_id"], $this->session->userdata('kullanici_id'));

                    if ($fatura_turu_getir == "Satış") {$stok_baslangic = $stok_baslangic - $dizi["adet"];}
                    if ($fatura_turu_getir == "Alış") {$stok_baslangic = $stok_baslangic + $dizi["adet"];}

                endforeach;endif;

            return "Stoğunuzda " . $stok_baslangic . " adet ürün bulunmaktadır";

        }

    }

    public function stok_detay_getir($value, $row)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $this->load->model('admin_model');
            //    $cari_ad=$this->admin_model->cari_ad($row->sahip_id);

            return "<a class='btn btn-default' href='" . site_url('yonetim/stok_detay_git/' . $row->id) . "'>Görüntüle</a>";

        }

    }

    public function stok_detay_git($id = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            if ($this->session->userdata('yetki') != 0) {

                $this->load->library('messages');
                $this->messages->yetkisiz_alan('');
                return false;

            }

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();

            if ($state == 'read') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_islem = $this->admin_model->yetki_kontrol_islem($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_islem != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

            }

            if ($state == 'list') {

                $this->load->model('admin_model');
                $yetki_kontrol_stok_detay = $this->admin_model->yetki_kontrol_stok_detay($this->session->userdata('kullanici_id'), $id);

                if ($yetki_kontrol_stok_detay != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

            }

            $this->load->model('admin_model');

            $stok_baslangic = $this->admin_model->stok_baslangic($id, $this->session->userdata('kullanici_id'));
            $data["stok_baslangic"] = $stok_baslangic;
            $data["stok_id"] = $id;
            $data["stok_adi"] = $this->admin_model->stok_adi($id, $this->session->userdata('kullanici_id'));

            $stok_toplam_getir = $this->admin_model->stok_toplam_getir($id, $this->session->userdata('kullanici_id'));

            //    $cari_baslangic=0;
            if ($stok_toplam_getir): foreach ($stok_toplam_getir as $dizi):

                    $fatura_turu_getir = $this->admin_model->fatura_turu_getir($dizi["fatura_id"], $this->session->userdata('kullanici_id'));

                    if ($fatura_turu_getir == "Satış") {$stok_baslangic = $stok_baslangic - $dizi["adet"];}
                    if ($fatura_turu_getir == "Alış") {$stok_baslangic = $stok_baslangic + $dizi["adet"];}

                endforeach;endif;

            $data["stok_total"] = "Stoğunuzda " . $stok_baslangic . " adet ürün bulunmaktadır";

            $crud->callback_column('islem_turu', array($this, 'stok_islem_turu_getir'));
            $crud->callback_column('fatura_id', array($this, 'stok_fatura_git'));

            $crud->set_theme('flexigrid');
            $crud->set_table('fatura_item');

            $crud->set_subject('Stok İşlemleri');
            $crud->columns('islem_turu', 'fatura_id', 'adet');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));
            $crud->where('hizmet_urun_id', $id);
            $crud->field_type('kullanici_id', 'hidden', $this->session->userdata('kullanici_id'));

            $crud->unset_clone();
            $crud->unset_edit();
            $crud->unset_add();
            $crud->unset_read();
            $crud->unset_delete();

            $data['side_menu'] = "Stok İşlemleri Ayarları";
            $data['kilavuz'] = "  <b>Stok İşlemleri Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }

    }

    public function stok_islem_turu_getir($value, $row)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $this->load->model('admin_model');
            return $fatura_turu_getir = $this->admin_model->fatura_turu_getir($row->fatura_id, $this->session->userdata('kullanici_id'));

        }

    }

    public function stok_fatura_git($value, $row)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $this->load->model('admin_model');

            return "<a class='btn btn-default' href='" . site_url('yonetim/fatura/read/' . $row->fatura_id) . "'>Görüntüle</a>";

        }

    }

    public function vade_tarihi_getir($value, $row)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $this->load->model('admin_model');

            if ($row->relation_type != "Borç_Alacak") {}
            if ($row->relation_type == "Borç_Alacak") {
                return $vade_tarihi_getir = $this->admin_model->vade_tarihi_getir($row->relation_id, $this->session->userdata('kullanici_id'));

            }

        }

    }

    public function tutar_getir($value, $row)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            return $row->tutar . " " . $this->session->userdata('para_birim') . "";

        }

    }

    public function islem_turu_getir($value, $row)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            if ($row->islem_turu == 2) {
                if ($row->giris_cikis == 0) {

                    return "Cari alacaklandırıldı";

                }

                if ($row->giris_cikis == 1) {

                    return "Cari borçlandırıldı";

                }

            }

            if ($row->islem_turu == 3) {
                if ($row->giris_cikis == 0) {

                    return "Ödeme Yapıldı";

                }

                if ($row->giris_cikis == 1) {

                    return "Tahsil edildi";

                }

            }

            if ($row->islem_turu == 4) {
                if ($row->giris_cikis == 0) {

                    return "Alış Faturası";

                }

                if ($row->giris_cikis == 1) {

                    return "Satış Faturası";

                }

            }

        }

    }

    public function kasa_detay()
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            if ($this->session->userdata('yetki') != 0) {

                $this->load->library('messages');
                $this->messages->yetkisiz_alan('');
                return false;

            }

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();

            $this->load->model('admin_model');

            $crud->set_theme('flexigrid');
            $crud->set_table('kasa');

            $crud->set_subject('Kasa Durum');
            $crud->columns('adi', 'durum', 'detay');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));
            $crud->field_type('kullanici_id', 'hidden', $this->session->userdata('kullanici_id'));
            $crud->callback_column('durum', array($this, 'kasa_durum_getir'));
            $crud->callback_column('detay', array($this, 'kasa_detay_getir'));

            $crud->unset_add();
            $crud->unset_delete();
            $crud->unset_read();
            $crud->unset_edit();
            $crud->unset_clone();
            $crud->unset_delete();
            $crud->unset_back_to_list();

            $data['side_menu'] = "Kasa Giriş Çıkış Görünüm Ayarları";
            $data['kilavuz'] = "  <b>Kasa Giriş Çıkış Görünüm Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }
    }

    public function kasa_durum_getir($value, $row)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $this->load->model('admin_model');
            $kasa_baslangic = $this->admin_model->kasa_baslangic($row->id, $this->session->userdata('kullanici_id'));
            $kasa_toplam_getir = $this->admin_model->kasa_toplam_getir($row->id, $this->session->userdata('kullanici_id'));

            if ($kasa_toplam_getir): foreach ($kasa_toplam_getir as $dizi):

                    if ($dizi["islem_turu"] == 0) {

                        if ($dizi["giris_cikis"] == 0) {$kasa_baslangic = $kasa_baslangic - $dizi["tutar"];
                            continue;}
                        if ($dizi["giris_cikis"] == 1) {$kasa_baslangic = $kasa_baslangic + $dizi["tutar"];
                            continue;}

                    }
                    if ($dizi["islem_turu"] == 1) {

                        if ($dizi["giris_cikis"] == 0) {$kasa_baslangic = $kasa_baslangic - $dizi["tutar"];
                            continue;}
                        if ($dizi["giris_cikis"] == 1) {$kasa_baslangic = $kasa_baslangic + $dizi["tutar"];
                            continue;}

                    }
                    if ($dizi["islem_turu"] == 2) {
                        if ($dizi["giris_cikis"] == 0) {$kasa_baslangic = $kasa_baslangic - $dizi["tutar"];
                            continue;}
                        if ($dizi["giris_cikis"] == 1) {$kasa_baslangic = $kasa_baslangic + $dizi["tutar"];
                            continue;}
                    }

                    if ($dizi["islem_turu"] == 3) {
                        if ($dizi["giris_cikis"] == 0) {$kasa_baslangic = $kasa_baslangic - $dizi["tutar"];
                            continue;}
                        if ($dizi["giris_cikis"] == 1) {$kasa_baslangic = $kasa_baslangic + $dizi["tutar"];
                            continue;}
                    }

                endforeach;endif;

            if ($kasa_baslangic < 0) {
                $kasa_baslangic = $kasa_baslangic + $kasa_baslangic * -2;
                return "" . $kasa_baslangic . " " . $this->session->userdata('para_birim') . " Kasa Ekside";
            }
            if ($kasa_baslangic == 0) {
                return "" . $kasa_baslangic . " " . $this->session->userdata('para_birim') . " Kasa Boş";
            }
            if ($kasa_baslangic > 0) {
                return "" . $kasa_baslangic . " " . $this->session->userdata('para_birim') . " Mevcut";
            }

        }

    }

    public function kasa_detay_getir($value, $row)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $this->load->model('admin_model');
            //    $cari_ad=$this->admin_model->cari_ad($row->sahip_id);

            return "<a class='btn btn-default' href='" . site_url('yonetim/kasa_detay_git/' . $row->id) . "'>Görüntüle</a>";

        }

    }

    public function kasa_detay_git($id = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            if ($this->session->userdata('yetki') != 0) {

                $this->load->library('messages');
                $this->messages->yetkisiz_alan('');
                return false;

            }

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();

            if ($state == 'read') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_islem = $this->admin_model->yetki_kontrol_islem($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_islem != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

            }

            if ($state == 'list') {

                $this->load->model('admin_model');
                $yetki_kontrol_kasa_detay = $this->admin_model->yetki_kontrol_kasa_detay($this->session->userdata('kullanici_id'), $id);

                if ($yetki_kontrol_kasa_detay != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

            }

            $this->load->model('admin_model');
            $kasa_baslangic = $this->admin_model->kasa_baslangic($id, $this->session->userdata('kullanici_id'));
            $data["kasa_baslangic"] = $kasa_baslangic;
            $data["kasa_adi"] = $this->admin_model->kasa_adi($id, $this->session->userdata('kullanici_id'));
            $kasa_toplam_getir = $this->admin_model->kasa_toplam_getir($id, $this->session->userdata('kullanici_id'));

            if ($kasa_toplam_getir): foreach ($kasa_toplam_getir as $dizi):

                    if ($dizi["islem_turu"] == 0) {

                        if ($dizi["giris_cikis"] == 0) {$kasa_baslangic = $kasa_baslangic - $dizi["tutar"];
                            continue;}
                        if ($dizi["giris_cikis"] == 1) {$kasa_baslangic = $kasa_baslangic + $dizi["tutar"];
                            continue;}

                    }
                    if ($dizi["islem_turu"] == 1) {

                        if ($dizi["giris_cikis"] == 0) {$kasa_baslangic = $kasa_baslangic - $dizi["tutar"];
                            continue;}
                        if ($dizi["giris_cikis"] == 1) {$kasa_baslangic = $kasa_baslangic + $dizi["tutar"];
                            continue;}

                    }
                    if ($dizi["islem_turu"] == 2) {
                        if ($dizi["giris_cikis"] == 0) {$kasa_baslangic = $kasa_baslangic - $dizi["tutar"];
                            continue;}
                        if ($dizi["giris_cikis"] == 1) {$kasa_baslangic = $kasa_baslangic + $dizi["tutar"];
                            continue;}
                    }

                    if ($dizi["islem_turu"] == 3) {
                        if ($dizi["giris_cikis"] == 0) {$kasa_baslangic = $kasa_baslangic - $dizi["tutar"];
                            continue;}
                        if ($dizi["giris_cikis"] == 1) {$kasa_baslangic = $kasa_baslangic + $dizi["tutar"];
                            continue;}
                    }

                endforeach;endif;

            if ($kasa_baslangic < 0) {
                $kasa_baslangic = $kasa_baslangic + $kasa_baslangic * -2;
                $data["kasa_total"] = "" . $kasa_baslangic . " " . $this->session->userdata('para_birim') . " Kasa Ekside";
            }
            if ($kasa_baslangic == 0) {
                $data["kasa_total"] = "" . $kasa_baslangic . " " . $this->session->userdata('para_birim') . " Kasa Boş";
            }
            if ($kasa_baslangic > 0) {
                $data["kasa_total"] = "" . $kasa_baslangic . " " . $this->session->userdata('para_birim') . " Mevcut";
            }

            $crud->set_theme('flexigrid');
            $crud->set_table('islem');

            $crud->set_subject('Kasa İşlemleri');
            $crud->columns('islem_turu', 'giris_cikis', 'tarih', 'tutar');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));
            $crud->where('kasa_id', $id);
            $crud->field_type('kullanici_id', 'hidden', $this->session->userdata('kullanici_id'));
            $crud->field_type('islem_turu', 'dropdown',
                array('2' => 'Borç Alacak', '3' => 'Tahsilat Ödeme'));

            $crud->field_type('giris_cikis', 'dropdown',
                array('0' => 'Kasadan çıkış', '1' => 'Kasaya giriş'));
            $crud->callback_column('tutar', array($this, 'tutar_getir'));
            $crud->unset_clone();
            $crud->unset_edit();
            $crud->unset_add();
            //  $crud->unset_read();
            $crud->unset_delete();

            $crud->unset_read_fields("islem_turu", "relation_type", "relation_id", "giris_cikis", "tutar", "tarih", "kategori", "cari_id"
                , "kasa_id", "kullanici_id");

            $data['side_menu'] = "Kasa İşlemleri Ayarları";
            $data['kilavuz'] = "  <b>Kasa İşlemleri Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }

    }

    public function tahsilat_odeme($edit = null, $id = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            if ($this->session->userdata('yetki') != 0) {

                $this->load->library('messages');
                $this->messages->yetkisiz_alan('');
                return false;

            }

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();

            if ($state == 'add') {

                $crud->set_relation('cari_id', 'cari', 'adi_soyadi', [
                    'kullanici_id = ' => $this->session->userdata('kullanici_id'),
                ]);
                $crud->set_relation('kasa_id', 'kasa', 'adi', [
                    'kullanici_id = ' => $this->session->userdata('kullanici_id'),
                ]);

            }

            if ($state == 'edit') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_gelir_gider = $this->admin_model->yetki_kontrol_gelir_gider($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_gelir_gider != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

                $crud->set_relation('cari_id', 'cari', 'adi_soyadi', [
                    'kullanici_id = ' => $this->session->userdata('kullanici_id'),
                ]);
                $crud->set_relation('kasa_id', 'kasa', 'adi', [
                    'kullanici_id = ' => $this->session->userdata('kullanici_id'),
                ]);

            } else if ($state == 'read') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_gelir_gider = $this->admin_model->yetki_kontrol_gelir_gider($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_gelir_gider != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }
                $crud->set_relation('cari_id', 'cari', 'adi_soyadi', [
                    'kullanici_id = ' => $this->session->userdata('kullanici_id'),
                ]);
                $crud->set_relation('kasa_id', 'kasa', 'adi', [
                    'kullanici_id = ' => $this->session->userdata('kullanici_id'),
                ]);

            }

            $crud->set_theme('flexigrid');
            $crud->set_table('islem');

            $crud->set_subject('Tahsilat - Ödeme');
            $crud->columns('giris_cikis', 'tutar', 'tarih', 'cari_id', 'kasa_id');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));
            $crud->where('islem_turu', 3);
            $crud->required_fields('giris_cikis', 'tutar', 'tarih', 'cari_id', 'kasa_id', 'aciklama');
            $crud->unset_fields('kategori');
            $crud->display_as('kasa_id', 'Kasa Banka');
            $crud->display_as('cari_id', 'Cari');
            $crud->display_as('giris_cikis', 'Tahsilat - Ödeme');
            $crud->field_type('kullanici_id', 'hidden', $this->session->userdata('kullanici_id'));
            $crud->field_type('islem_turu', 'hidden', 3);
            $crud->field_type('relation_type', 'hidden', 'Borç_Alacak');
            $crud->field_type('relation_id', 'hidden', 0);
            $crud->field_type('giris_cikis', 'dropdown',
                array('1' => 'Tahsilat', '0' => 'Ödeme'));

            $crud->callback_column('cari_id', array($this, 'callback_cari_getir'));
            $crud->callback_column('kasa_id', array($this, 'callback_kasa_getir'));

            $crud->unset_delete();
            $crud->unset_clone();

            $data['side_menu'] = "Tahsilat - Ödeme Ayarları";
            $data['kilavuz'] = "  <b>Tahsilat - Ödeme Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }
    }

    public function callback_kasa_getir($value, $row)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            //    return $row->cari_id;

            $this->load->model('admin_model');
            $kasa_id = $this->admin_model->kasa_ad($row->kasa_id);

            return "<a class='btn btn-default' href='" . site_url('yonetim/kasa/read/' . $row->kasa_id) . "'>" . $kasa_id . "</a>";
        }

    }

    public function cari_tahsilat_odeme($edit = null, $id = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();

            if ($state == 'list') {
                $this->load->library('Messages');
                echo $this->messages->config('yonetim');
                return false;

            }

            if ($state == 'add') {

                $this->load->model('admin_model');
                $data["cari_adi"] = $this->admin_model->cari_ad($id);
                $this->load->model('admin_model');
                $yetki_kontrol_cari = $this->admin_model->yetki_kontrol_cari($this->session->userdata('kullanici_id'), $id);

                if ($yetki_kontrol_cari != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

                $crud->set_relation('kasa_id', 'kasa', 'adi', [
                    'kullanici_id = ' => $this->session->userdata('kullanici_id'),
                ]);

            }

            if ($state == 'edit') {
                $this->load->library('Messages');
                echo $this->messages->config('yonetim');
                return false;

            } else if ($state == 'read') {
                $this->load->library('Messages');
                echo $this->messages->config('yonetim');
                return false;

            }

            $crud->set_theme('flexigrid');
            $crud->set_table('islem');

            $crud->set_subject('Cari Tahsilat - Ödeme');
            $crud->columns('giris_cikis', 'tutar', 'tarih', 'cari_id', 'kasa_id');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));
            $crud->where('cari_id', $id);
            $crud->where('islem_turu', 3);
            $crud->required_fields('giris_cikis', 'tutar', 'tarih', 'cari_id', 'kasa_id', 'aciklama');
            $crud->unset_fields('kategori');
            $crud->display_as('kasa_id', 'Kasa Banka');
            $crud->display_as('cari_id', 'Cari');
            $crud->display_as('giris_cikis', 'Tahsilat - Ödeme');
            $crud->field_type('kullanici_id', 'hidden', $this->session->userdata('kullanici_id'));

            $crud->field_type('cari_id', 'hidden', $id);
            $crud->field_type('islem_turu', 'hidden', 3);
            $crud->field_type('relation_type', 'hidden', 'Borç_Alacak');
            $crud->field_type('relation_id', 'hidden', 0);
            $crud->field_type('giris_cikis', 'dropdown',
                array('1' => 'Tahsilat', '0' => 'Ödeme'));

            $crud->callback_column('cari_id', array($this, 'callback_cari_getir'));
            $crud->callback_column('kasa_id', array($this, 'callback_kasa_getir'));

            $crud->unset_delete();
            $crud->unset_clone();
            $crud->unset_back_to_list();

            $data['side_menu'] = "Cari Tahsilat - Ödeme Ayarları";
            $data['kilavuz'] = "  <b>Cari Tahsilat - Ödeme Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }
    }

    public function cari_borc_alacak($edit = null, $id = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();
            $this->load->model('admin_model');

            if ($state == 'list') {

                $this->load->library('Messages');
                echo $this->messages->config('yonetim');
                return false;
            }

            if ($state == 'add') {

                $data["cari_adi"] = $this->admin_model->cari_ad($id);
                $this->load->model('admin_model');
                $yetki_kontrol_cari = $this->admin_model->yetki_kontrol_cari($this->session->userdata('kullanici_id'), $id);

                if ($yetki_kontrol_cari != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

                $crud->display_as('fatura_turu', 'Borç Alacak');
                $crud->field_type('fatura_turu', 'dropdown',
                    array('1' => 'Cari Borçlandır', '0' => 'Cari Alacaklandır'));

            }

            if ($state == 'edit') {
                $this->load->library('Messages');
                echo $this->messages->config('yonetim');
                return false;

            } else if ($state == 'read') {
                $this->load->library('Messages');
                echo $this->messages->config('yonetim');
                return false;
            }

            $crud->set_theme('flexigrid');
            $crud->set_table('borc_alacak');

            $crud->set_subject('Cari Borç Alacak');
            $crud->columns('fatura_turu', 'cari', 'toplam', 'vade_tarihi');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));
            $crud->where('cari_id', $id);
            $crud->required_fields('fatura_turu', 'cari_id', 'toplam', 'vade_tarihi');
            $crud->field_type('kullanici_id', 'hidden', $this->session->userdata('kullanici_id'));
            $crud->field_type('tarih', 'hidden', date("Y-m-d"));
            $crud->field_type('cari_id', 'hidden', $id);

            $crud->callback_column('cari', array($this, 'callback_cari_getir'));
            $crud->callback_after_delete(array($this, 'islem_sil_boal'));
            $crud->callback_after_insert(array($this, 'islem_kayit_boal'));
            $data["cari_adi"] = $this->admin_model->cari_ad($id);

            $crud->unset_edit();
            $crud->unset_clone();
            $crud->unset_back_to_list();

            $data['side_menu'] = "Cari Borç Alacak Ayarları";
            $data['kilavuz'] = "  <b>Cari Borç Alacak Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }
    }

    public function hesap()
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('yonetim');
            } else {echo $this->messages->To_Register('yonetim');}

        } else {

            $this->load->view('hesap');

        }

    }

    public function kur()
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('yonetim');
            } else {echo $this->messages->To_Register('yonetim');}

        } else {

            $this->load->view('kur');
        }

    }

    public function yapilacaklar()
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('yonetim');
            } else {echo $this->messages->To_Register('yonetim');}

        } else {

            $crud = new grocery_CRUD();

            $crud->set_table('borc_alacak');

            $data['side_menu'] = "Yapılacaklar Listesi Ayarları";
            $data['kilavuz'] = "  <b>Yapılacaklar Listesi Ayarları</b>";
            $this->load->model('admin_model');
            $data["list"] = $this->admin_model->list_getir($this->session->userdata('id'));

            $output = $crud->render();
            $output->data = $data;

            //  $this->_example_output($output);
            $this->load->view('yapilacaklar', (array) $output);

        }

    }

    public function list_al()
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('yonetim');
            } else {echo $this->messages->To_Register('yonetim');}

        } else {

            $task = $this->input->post('task', true);
            $task = trim($task);
            $task = strip_tags($task);
            $task = htmlentities($task);
            $insert = array(
                'task' => $task,
                'tarih' => date("Y-m-d"),
                'kim' => $this->session->userdata('id'),
                'durum' => 0,
                'kullanici_id' => $this->session->userdata('kullanici_id'),
            );

            $this->db->insert('task', $insert);

            $this->load->library('Messages');
            echo $this->messages->True_Add('yonetim/yapilacaklar');
            return false;

        }

    }

    public function tasksil($id = null, $kim = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            if (!is_numeric($id)) {
                $this->load->library('Messages');
                echo $this->messages->False_Add('yonetim/yapilacaklar');
                return false;

            }

            if (!is_numeric($kim)) {

                $this->load->library('Messages');
                echo $this->messages->False_Add('yonetim/yapilacaklar');
                return false;

            }

            $this->db->where('id', $id);
            $this->db->where('kim', $kim);
            $this->db->delete('task');

            $this->load->library('Messages');
            echo $this->messages->True_Add('yonetim/yapilacaklar');
            return false;

        }

    }

    public function sss()
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $crud = new grocery_CRUD();

            $crud->set_table('borc_alacak');

            $data['side_menu'] = "SSS Ayarları";
            $data['kilavuz'] = "  <b>SSS Ayarları</b>";
            $this->load->model('admin_model');
            $data["sss"] = $this->admin_model->sss_getir();

            $output = $crud->render();
            $output->data = $data;

            //  $this->_example_output($output);
            $this->load->view('sss', (array) $output);

        }

    }

    public function teklif($edit = null, $id = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            if ($this->session->userdata('yetki') != 0) {

                $this->load->library('messages');
                $this->messages->yetkisiz_alan('');
                return false;

            }

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();

            if ($state == 'list') {

                $crud->display_as('cari_id', 'Cari');

            }
            if ($state == 'add') {

                $crud->set_relation('cari_id', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id')]);
                $crud->display_as('cari_id', 'Cari');

            }

            if ($state == 'edit') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_teklif = $this->admin_model->yetki_kontrol_teklif($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_teklif != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }
                $crud->set_relation('cari_id', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id')]);
                $crud->display_as('cari_id', 'Cari');

            } else if ($state == 'read') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_teklif = $this->admin_model->yetki_kontrol_teklif($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_teklif != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

                $crud->set_relation('cari_id', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id')]);
                $crud->display_as('cari_id', 'Cari');

            }

            $crud->set_theme('flexigrid');
            $crud->set_table('teklif');

            $crud->set_subject('Teklifler');
            $crud->columns('cari_id', 'tarih', 'konu', 'tur');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));
            $crud->required_fields('cari_id', 'tarih', 'konu', 'teklif');
            $crud->field_type('kullanici_id', 'hidden', $this->session->userdata('kullanici_id'));
            $crud->display_as('cari_id', 'cari');
            $crud->display_as('tur', 'Teklif Türü');
            $crud->field_type('tur', 'dropdown',
                array('1' => 'Alınan Teklif', '0' => 'Verilen Teklif'));

            $crud->callback_column('cari_id', array($this, 'callback_cari_getir'));

            $crud->unset_clone();

            $data['side_menu'] = "Teklif Ayarları";
            $data['kilavuz'] = "  <b>Teklif Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }

    }

    public function gorusme($edit = null, $id = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();

            if ($state == 'list') {

                $crud->display_as('cari_id', 'Cari');

            }
            if ($state == 'add') {

                $crud->set_relation('cari_id', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id')]);
                $crud->display_as('cari_id', 'Cari');

            }

            if ($state == 'edit') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_gorusme = $this->admin_model->yetki_kontrol_gorusme($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_gorusme != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }
                $crud->set_relation('cari_id', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id')]);
                $crud->display_as('cari_id', 'Cari');

            } else if ($state == 'read') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_gorusme = $this->admin_model->yetki_kontrol_gorusme($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_gorusme != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

                $crud->set_relation('cari_id', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id')]);
                $crud->display_as('cari_id', 'Cari');

            }

            $crud->set_theme('flexigrid');
            $crud->set_table('gorusme');

            $crud->set_subject('Görüşmeler');
            $crud->columns('cari_id', 'tarih', 'konu', 'tur');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));
            $crud->required_fields('cari_id', 'tarih', 'konu', 'teklif');
            $crud->field_type('kullanici_id', 'hidden', $this->session->userdata('kullanici_id'));
            $crud->display_as('cari_id', 'cari');
            $crud->display_as('tur', 'Görüşme Türü');
            $crud->field_type('tur', 'dropdown',
                array('1' => 'Gelen Arama', '0' => 'Giden Arama', '2' => 'Yüzyüze'));

            $crud->callback_column('cari_id', array($this, 'callback_cari_getir'));

            $crud->unset_clone();

            $data['side_menu'] = "Görüşme Ayarları";
            $data['kilavuz'] = "  <b>Görüşme Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }

    }

    public function arama($edit = null, $id = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();

            if ($state == 'edit') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_arama = $this->admin_model->yetki_kontrol_arama($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_arama != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

            } else if ($state == 'read') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_arama = $this->admin_model->yetki_kontrol_arama($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_arama != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

            }

            $crud->set_theme('flexigrid');
            $crud->set_table('arama');

            $crud->set_subject('Arama');
            $crud->columns('tarih', 'saat', 'kiminle', 'konu');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));
            $crud->where('kim', $this->session->userdata('id'));
            $crud->required_fields('konu', 'teklif');
            $crud->field_type('kullanici_id', 'hidden', $this->session->userdata('kullanici_id'));
            $crud->field_type('kim', 'hidden', $this->session->userdata('id'));

            $crud->display_as('kiminle', 'Kim');
            $crud->display_as('teklif', 'Açıklama');

            $crud->unset_clone();

            $data['side_menu'] = "Arama Ayarları";
            $data['kilavuz'] = "  <b>Arama Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }

    }

    public function notlar($edit = null, $id = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();

            if ($state == 'edit') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_not = $this->admin_model->yetki_kontrol_not($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_not != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

            } else if ($state == 'read') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_not = $this->admin_model->yetki_kontrol_not($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_not != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

            }

            $crud->set_theme('flexigrid');
            $crud->set_table('notlar');

            $crud->set_subject('Notlar');
            $crud->columns('tarih', 'konu');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));
            $crud->where('kim', $this->session->userdata('id'));
            $crud->required_fields('konu', 'teklif');
            $crud->field_type('kullanici_id', 'hidden', $this->session->userdata('kullanici_id'));
            $crud->field_type('kim', 'hidden', $this->session->userdata('id'));
            $crud->field_type('tarih', 'hidden', date("Y-m-d"));
            $crud->display_as('teklif', 'Notunuz');

            $crud->unset_clone();

            $data['side_menu'] = "Not Ayarları";
            $data['kilavuz'] = "  <b>Not Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }

    }

    public function takvim()
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $this->load->view('takvim');
        }

    }

    public function randevu($edit = null, $id = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();

            if ($state == 'add') {

                $crud->set_relation('hasta', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id'), 'kisi_turu = ' => 0]);
                $crud->set_relation('doktor', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id'), 'kisi_turu = ' => 1]);
            }

            if ($state == 'edit') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_randevu = $this->admin_model->yetki_kontrol_randevu($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_randevu != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }
                $crud->set_relation('hasta', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id'), 'kisi_turu = ' => 0]);
                $crud->set_relation('doktor', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id'), 'kisi_turu = ' => 1]);
            } else if ($state == 'read') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_randevu = $this->admin_model->yetki_kontrol_randevu($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_randevu != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }
                $crud->set_relation('hasta', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id'), 'kisi_turu = ' => 0]);
                $crud->set_relation('doktor', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id'), 'kisi_turu = ' => 1]);

            }

            $crud->set_theme('flexigrid');
            $crud->set_table('randevu');

            $crud->set_subject('Randevu');
            $crud->columns('doktor', 'hasta', 'tarih', 'durum');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));
            $crud->where('durum', 0);
            $crud->order_by('tarih', "asc");
            $crud->required_fields('doktor', 'hasta', 'tarih');
            $crud->display_as('dosya', 'Dosyalar');
            $crud->field_type('kullanici_id', 'hidden', $this->session->userdata('kullanici_id'));
            $crud->set_field_upload('dosya', 'assets/uploads/files');
            $crud->callback_column('doktor', array($this, 'callback_personel_getir'));
            $crud->callback_column('hasta', array($this, 'callback_hasta_getir'));
            $crud->unset_clone();

            $crud->field_type('durum', 'dropdown',
                array('1' => 'Tamamlandı', '0' => 'Tamamlanmadı'));

            $data['side_menu'] = "Randevu Ayarları";
            $data['kilavuz'] = "  <b>Randevu Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }

    }

    public function bitmis_randevu($edit = null, $id = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();

            if ($state == 'add') {

                $crud->set_relation('hasta', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id'), 'kisi_turu = ' => 0]);
                $crud->set_relation('doktor', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id'), 'kisi_turu = ' => 1]);
            }

            if ($state == 'edit') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_randevu = $this->admin_model->yetki_kontrol_randevu($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_randevu != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }
                $crud->set_relation('hasta', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id'), 'kisi_turu = ' => 0]);
                $crud->set_relation('doktor', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id'), 'kisi_turu = ' => 1]);
            } else if ($state == 'read') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_randevu = $this->admin_model->yetki_kontrol_randevu($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_randevu != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }
                $crud->set_relation('hasta', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id'), 'kisi_turu = ' => 0]);
                $crud->set_relation('doktor', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id'), 'kisi_turu = ' => 1]);

            }

            $crud->set_theme('datatables');
            $crud->set_table('randevu');

            $crud->set_subject('Bitmiş Randevu');
            $crud->columns('doktor', 'hasta', 'tarih', 'durum');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));
            $crud->where('durum', 1);
            $crud->order_by('tarih', "asc");
            $crud->required_fields('doktor', 'hasta', 'tarih');
            $crud->display_as('dosya', 'Dosyalar');
            $crud->field_type('kullanici_id', 'hidden', $this->session->userdata('kullanici_id'));
            $crud->set_field_upload('dosya', 'assets/uploads/files');
            $crud->callback_column('doktor', array($this, 'callback_personel_getir'));
            $crud->callback_column('hasta', array($this, 'callback_hasta_getir'));
            $crud->unset_clone();

            $crud->field_type('durum', 'dropdown',
                array('1' => 'Tamamlandı', '0' => 'Tamamlanmadı'));

            $data['side_menu'] = "Bitmiş Randevu Ayarları";
            $data['kilavuz'] = "  <b>Bitmiş Randevu Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }

    }

    public function callback_personel_getir($value, $row)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $this->load->model('admin_model');

            $cari_ad = $this->admin_model->cari_ad($row->doktor);

            return "<a class='btn btn-default' href='" . site_url('yonetim/personel/read/' . $row->doktor) . "'>" . $cari_ad . "</a>";

        }

    }

    public function callback_hasta_getir($value, $row)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $this->load->model('admin_model');
            $cari_ad = $this->admin_model->cari_ad($row->hasta);

            return "<a class='btn btn-default' href='" . site_url('yonetim/cari/read/' . $row->hasta) . "'>" . $cari_ad . "</a>";

        }

    }

    public function protocol($edit = null, $id = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();
            $this->load->model('admin_model');

            /*                    if(!is_numeric($id))
            {

            $this->load->library('Messages');
            echo $this->messages->config('yonetim');
            return FALSE;

            }

            $this->load->model('admin_model');
            $cari_kontrol=$this->admin_model->cari_kontrol($id);

            if($cari_kontrol != 1)
            {

            $this->load->library('Messages');
            echo $this->messages->config('yonetim');
            return FALSE;

            }
             */

            if ($state == 'list') {

            }

            if ($state == 'add') {

                $crud->set_relation('hasta', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id'), 'kisi_turu = ' => 0]);
                $crud->set_relation('doktor', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id'), 'kisi_turu = ' => 1]);

            }

            if ($state == 'edit') {

                $primary_key = $state_info->primary_key;
                $data["cari_adi"] = $this->admin_model->cari_ad($id);
                $this->load->model('admin_model');
                $yetki_kontrol_protocol = $this->admin_model->yetki_kontrol_protocol($this->session->userdata('kullanici_id'), $id);

                if ($yetki_kontrol_protocol != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

                $crud->set_relation('hasta', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id'), 'kisi_turu = ' => 0]);
                $crud->set_relation('doktor', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id'), 'kisi_turu = ' => 1]);

            } else if ($state == 'read') {

                $primary_key = $state_info->primary_key;
                $data["cari_adi"] = $this->admin_model->cari_ad($id);
                $this->load->model('admin_model');
                $yetki_kontrol_protocol = $this->admin_model->yetki_kontrol_protocol($this->session->userdata('kullanici_id'), $id);

                if ($yetki_kontrol_protocol != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

                $crud->set_relation('hasta', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id'), 'kisi_turu = ' => 0]);
                $crud->set_relation('doktor', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id'), 'kisi_turu = ' => 1]);

            }

            $crud->set_theme('flexigrid');
            $crud->set_table('protocol');

            $crud->set_subject('Protocol');
            $crud->columns('protocol_no', 'hasta', 'doktor', 'protocol_tarih', 'Protokole Git');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));
            $crud->required_fields('protocol_no', 'hasta_id', 'doktor_id', 'protocol_tarih');
            $crud->field_type('kullanici_id', 'hidden', $this->session->userdata('kullanici_id'));

            $crud->field_type('durum', 'dropdown',
                array('0' => 'Aktif', '1' => 'Pasif'));

            $crud->unset_delete();
            $crud->unset_clone();
            $crud->callback_column('doktor', array($this, 'callback_personel_getir'));
            $crud->callback_column('hasta', array($this, 'callback_hasta_getir'));
            $crud->callback_column('Protokole Git', array($this, 'callback_protocole_git'));

            $data['side_menu'] = "Protocol Ayarları";
            $data['kilavuz'] = "  <b>Protocol Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

/*
$crud->set_theme('flexigrid');
$crud->set_table('borc_alacak');

$crud->set_subject('Cari Borç Alacak');
$crud->columns('fatura_turu','cari','toplam','vade_tarihi');
$crud->where('kullanici_id',$this->session->userdata('kullanici_id'));
$crud->where('cari_id',$id);
$crud->required_fields('fatura_turu','cari_id','toplam','vade_tarihi');
$crud->field_type('kullanici_id', 'hidden',$this->session->userdata('kullanici_id'));
$crud->field_type('tarih', 'hidden',date("Y-m-d"));
$crud->field_type('cari_id', 'hidden',$id);

$crud->callback_column('cari',array($this,'callback_cari_getir'));
$crud->callback_after_delete(array($this,'islem_sil_boal'));
$crud->callback_after_insert(array($this, 'islem_kayit_boal'));
$data["cari_adi"]=$this->admin_model->cari_ad($id);

$crud->unset_edit();
$crud->unset_clone();
$crud->unset_back_to_list();

$data['side_menu']="Cari Borç Alacak Ayarları";
$data['kilavuz']="  <b>Cari Borç Alacak Ayarları</b>";
$output = $crud->render();
$output->data=$data;
//  $this->_example_output($output);
$this->load->view('index',(array)$output);
 */

        }

    }

    public function callback_protocole_git($value, $row)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $this->load->model('admin_model');
            return "<a class='btn btn-default' href='" . site_url('yonetim/protocol_detay/rnd/' . $row->id . '/' . $row->protocol_no) . "'>Git</a>";

        }

    }

    public function protocol_detay($ad = null, $id = null, $pn = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            // and ($ad!="bo")
            if (($ad != "rnd") and ($ad != "mua") and ($ad != "olc") and ($ad != "dos") and ($ad != "rap") and ($ad != "rec") and ($ad != "ta")) {

                $this->load->library('Messages');
                echo $this->messages->config('yonetim');
                return false;

            }

            // and ($ad!="bo")
            if (($ad == "mua") or ($ad == "olc") or ($ad == "dos") or ($ad == "rap") or ($ad == "rec")) {

                if ($this->session->userdata('yetki') == 2) {

                    $this->load->library('messages');
                    $this->messages->yetkisiz_alan('');
                    return false;

                }

            }

            if (!is_numeric($id)) {

                $this->load->library('Messages');
                echo $this->messages->config('yonetim');
                return false;

            }

            if (!is_numeric($pn)) {

                $this->load->library('Messages');
                echo $this->messages->config('yonetim');
                return false;

            }

            $this->load->model('admin_model');
            $pn_kontrol = $this->admin_model->pn_kontrol($id, $pn);

            if ($pn_kontrol != 1) {

                $this->load->library('Messages');
                echo $this->messages->config('yonetim');
                return false;

            }

            $hasta_getir = $this->admin_model->hasta_getir($id, $pn);
            $dr_getir = $this->admin_model->dr_getir($id, $pn);

            if ($ad == "rnd") {
                $output = $this->rnd($id, $pn, $hasta_getir, $dr_getir);

            }

            if ($ad == "mua") {
                $output = $this->mua($id, $pn, $hasta_getir, $dr_getir);

            }

            if ($ad == "olc") {
                $output = $this->olc($id, $pn, $hasta_getir, $dr_getir);

            }

            if ($ad == "dos") {
                $output = $this->dos($id, $pn, $hasta_getir, $dr_getir);

            }

            if ($ad == "rap") {
                $output = $this->rnd($id, $pn, $hasta_getir, $dr_getir);

            }

            if ($ad == "rec") {
                $output = $this->rnd($id, $pn, $hasta_getir, $dr_getir);

            }

            /*    if($ad=="bo"){
            $output = $this->rnd($id,$pn,$hasta_getir);

            }*/

            if ($ad == "ta") {

                $output = $this->ta($id, $pn, $hasta_getir, $dr_getir);

            }

            //  $this->_example_output($output);
            $this->load->view('protocol', (array) $output);

        }

    }

    public function rnd($id, $pn, $hasta_getir, $dr_getir)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            if (!is_numeric($id)) {

                $this->load->library('Messages');
                echo $this->messages->config('yonetim');
                return false;

            }

            if (!is_numeric($pn)) {

                $this->load->library('Messages');
                echo $this->messages->config('yonetim');
                return false;

            }

            $this->load->model('admin_model');
            $pn_kontrol = $this->admin_model->pn_kontrol($id, $pn);
            $data["hasta_ad"] = $this->admin_model->cari_ad($hasta_getir);
            $data["dr_ad"] = $this->admin_model->cari_ad($dr_getir);

            if ($pn_kontrol != 1) {

                $this->load->library('Messages');
                echo $this->messages->config('yonetim');
                return false;

            }

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();
            $crud->set_theme('flexigrid');
            $crud->set_table('randevu');
            $crud->set_subject('Randevu');
            $crud->columns('doktor', 'hasta', 'tarih', 'durum');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));
            $crud->where('hasta', $hasta_getir);
            $crud->order_by('tarih', "asc");
            $crud->required_fields('doktor', 'hasta', 'tarih');
            $crud->display_as('dosya', 'Dosyalar');
            $crud->field_type('kullanici_id', 'hidden', $this->session->userdata('kullanici_id'));
            $crud->field_type('doktor', 'hidden', $dr_getir);
            $crud->field_type('hasta', 'hidden', $hasta_getir);
            $crud->set_field_upload('dosya', 'assets/uploads/files');
            $crud->callback_column('doktor', array($this, 'callback_personel_getir'));
            $crud->callback_column('hasta', array($this, 'callback_hasta_getir'));
            $crud->unset_clone();

            $crud->field_type('durum', 'dropdown',
                array('1' => 'Tamamlandı', '0' => 'Tamamlanmadı'));

            $data["ad"] = "Randevu İşlemleri";
            $data["dr_id"] = $dr_getir;
            $data["hs_id"] = $hasta_getir;

            $data["id"] = $id;
            $data["pn"] = $pn;
            $data['side_menu'] = "Randevu Ayarları";
            $data['kilavuz'] = "  <b>Randevu Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;

            return $output;

        }
    }

    public function mua($id, $pn, $hasta_getir, $dr_getir)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            if (!is_numeric($id)) {

                $this->load->library('Messages');
                echo $this->messages->config('yonetim');
                return false;

            }

            if (!is_numeric($pn)) {

                $this->load->library('Messages');
                echo $this->messages->config('yonetim');
                return false;

            }

            $this->load->model('admin_model');
            $pn_kontrol = $this->admin_model->pn_kontrol($id, $pn);
            $data["hasta_ad"] = $this->admin_model->cari_ad($hasta_getir);
            $data["dr_ad"] = $this->admin_model->cari_ad($dr_getir);
            $data["dr_id"] = $dr_getir;
            $data["hs_id"] = $hasta_getir;

            if ($pn_kontrol != 1) {

                $this->load->library('Messages');
                echo $this->messages->config('yonetim');
                return false;

            }

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();
            $crud->set_theme('flexigrid');
            $crud->set_table('muayene');
            $crud->set_subject('Muayene');
            $crud->columns('doktor', 'hasta', 'tarih');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));

            $crud->where('hasta', $hasta_getir);
            $crud->required_fields('doktor', 'hasta');
            $crud->field_type('kullanici_id', 'hidden', $this->session->userdata('kullanici_id'));
            $crud->field_type('hasta', 'hidden', $hasta_getir);
            $crud->field_type('doktor', 'hidden', $dr_getir);

            $crud->callback_column('doktor', array($this, 'callback_personel_getir'));
            $crud->callback_column('hasta', array($this, 'callback_hasta_getir'));
            $crud->unset_clone();

            $data["ad"] = "Muayene İşlemleri";
            $data["id"] = $id;
            $data["pn"] = $pn;
            $data['side_menu'] = "Muayene Ayarları";
            $data['kilavuz'] = "  <b>Muayene Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;

            return $output;

        }
    }

    public function olc($id, $pn, $hasta_getir, $dr_getir)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            if (!is_numeric($id)) {

                $this->load->library('Messages');
                echo $this->messages->config('yonetim');
                return false;

            }

            if (!is_numeric($pn)) {

                $this->load->library('Messages');
                echo $this->messages->config('yonetim');
                return false;

            }

            $this->load->model('admin_model');
            $pn_kontrol = $this->admin_model->pn_kontrol($id, $pn);
            $data["hasta_ad"] = $this->admin_model->cari_ad($hasta_getir);
            $data["dr_ad"] = $this->admin_model->cari_ad($dr_getir);

            if ($pn_kontrol != 1) {

                $this->load->library('Messages');
                echo $this->messages->config('yonetim');
                return false;

            }

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();
            $crud->set_theme('flexigrid');
            $crud->set_table('olcum');
            $crud->set_subject('Ölçümler');
            $crud->columns('doktor', 'hasta', 'boy', 'kilo', 'tarih');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));

            $crud->where('hasta', $hasta_getir);
            $crud->required_fields('doktor', 'hasta');
            $crud->field_type('kullanici_id', 'hidden', $this->session->userdata('kullanici_id'));
            $crud->field_type('hasta', 'hidden', $hasta_getir);
            $crud->field_type('doktor', 'hidden', $dr_getir);

            $crud->callback_column('doktor', array($this, 'callback_personel_getir'));
            $crud->callback_column('hasta', array($this, 'callback_hasta_getir'));
            $crud->unset_clone();

            $data["ad"] = "Ölçüm İşlemleri";
            $data["id"] = $id;
            $data["pn"] = $pn;
            $data["dr_id"] = $dr_getir;
            $data["hs_id"] = $hasta_getir;

            $data['side_menu'] = "Ölçüm Ayarları";
            $data['kilavuz'] = "  <b>Ölçüm Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;

            return $output;

        }
    }

    public function dos($id, $pn, $hasta_getir, $dr_getir)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            if (!is_numeric($id)) {

                $this->load->library('Messages');
                echo $this->messages->config('yonetim');
                return false;

            }

            if (!is_numeric($pn)) {

                $this->load->library('Messages');
                echo $this->messages->config('yonetim');
                return false;

            }

            $this->load->model('admin_model');
            $pn_kontrol = $this->admin_model->pn_kontrol($id, $pn);
            $data["hasta_ad"] = $this->admin_model->cari_ad($hasta_getir);
            $data["dr_ad"] = $this->admin_model->cari_ad($dr_getir);

            if ($pn_kontrol != 1) {

                $this->load->library('Messages');
                echo $this->messages->config('yonetim');
                return false;

            }

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();
            $crud->set_theme('flexigrid');
            $crud->set_table('dosyalar_ozel');
            $crud->set_subject('Özel Dosyalar');
            $crud->columns('doktor', 'hasta', 'dosya_adi', 'aciklama', 'tarih');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));
            $crud->where('hasta', $hasta_getir);
            $crud->required_fields('doktor', 'hasta', 'dosya_adi');
            $crud->field_type('kullanici_id', 'hidden', $this->session->userdata('kullanici_id'));
            $crud->field_type('hasta', 'hidden', $hasta_getir);
            $crud->field_type('doktor', 'hidden', $dr_getir);
            $crud->set_field_upload('dosya_adi', 'assets/resimler/home');
            $crud->callback_column('doktor', array($this, 'callback_personel_getir'));
            $crud->callback_column('hasta', array($this, 'callback_hasta_getir'));
            $crud->unset_clone();

            $data["dr_id"] = $dr_getir;
            $data["hs_id"] = $hasta_getir;
            $data["ad"] = "Dosya İşlemleri";
            $data["id"] = $id;
            $data["pn"] = $pn;
            $data['side_menu'] = "Özel Dosya Ayarları";
            $data['kilavuz'] = "  <b>Özel Dosya Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;

            return $output;

        }
    }

    public function ta($id, $pn, $hasta_getir, $dr_getir)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            if (!is_numeric($id)) {

                $this->load->library('Messages');
                echo $this->messages->config('yonetim');
                return false;

            }

            if (!is_numeric($pn)) {

                $this->load->library('Messages');
                echo $this->messages->config('yonetim');
                return false;

            }

            $this->load->model('admin_model');
            $pn_kontrol = $this->admin_model->pn_kontrol($id, $pn);
            $data["hasta_ad"] = $this->admin_model->cari_ad($hasta_getir);
            $data["dr_ad"] = $this->admin_model->cari_ad($dr_getir);

            if ($pn_kontrol != 1) {

                $this->load->library('Messages');
                echo $this->messages->config('yonetim');
                return false;

            }

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();

            if ($state == 'read') {
                $primary_key = $state_info->primary_key;

                $this->load->model('admin_model');
                $yetki_kontrol_islem = $this->admin_model->yetki_kontrol_islem($this->session->userdata('kullanici_id'), $primary_key);

                if ($yetki_kontrol_islem != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

            }

            if ($state == 'list') {

                $this->load->model('admin_model');
                $yetki_kontrol_cari_detay = $this->admin_model->yetki_kontrol_cari_detay($this->session->userdata('kullanici_id'), $hasta_getir);

                if ($yetki_kontrol_cari_detay != 1) {

                    $this->load->library('Messages');
                    echo $this->messages->config('yonetim');
                    return false;

                }

            }

            $this->load->model('admin_model');
            $cari_baslangic = $this->admin_model->cari_baslangic($hasta_getir, $this->session->userdata('kullanici_id'));
            $data["cari_baslangic"] = $cari_baslangic;
            $data["cari_id"] = $hasta_getir;
            $data["cari_adi"] = $this->admin_model->cari_adi($hasta_getir, $this->session->userdata('kullanici_id'));
            $cari_toplam_getir = $this->admin_model->cari_toplam_getir($hasta_getir, $this->session->userdata('kullanici_id'));

            //    $cari_baslangic=0;
            if ($cari_toplam_getir): foreach ($cari_toplam_getir as $dizi):

                    if ($dizi["islem_turu"] == 0) {continue;}
                    if ($dizi["islem_turu"] == 1) {continue;}
                    if ($dizi["islem_turu"] == 2) {
                        if ($dizi["giris_cikis"] == 0) {$cari_baslangic = $cari_baslangic + $dizi["tutar"];
                            continue;}
                        if ($dizi["giris_cikis"] == 1) {$cari_baslangic = $cari_baslangic - $dizi["tutar"];
                            continue;}
                    }

                    if ($dizi["islem_turu"] == 3) {

                        if ($dizi["giris_cikis"] == 0) {$cari_baslangic = $cari_baslangic - $dizi["tutar"];
                            continue;}
                        if ($dizi["giris_cikis"] == 1) {$cari_baslangic = $cari_baslangic + $dizi["tutar"];
                            continue;}

                    }

                endforeach;endif;

            if ($cari_baslangic < 0) {
                $cari_baslangic = $cari_baslangic + $cari_baslangic * -2;
                $data["cari_total"] = "" . $cari_baslangic . " " . $this->session->userdata('para_birim') . " Alacaklısınız";

            } else if ($cari_baslangic == 0) {
                $data["cari_total"] = "" . $cari_baslangic . " " . $this->session->userdata('para_birim') . " Borç ve Alacak yok";
            } else if ($cari_baslangic > 0) {
                $data["cari_total"] = "" . $cari_baslangic . " " . $this->session->userdata('para_birim') . " Borçlusunuz";
            } else {}

            $crud->set_theme('flexigrid');
            $crud->set_table('islem');

            $crud->set_subject('Cari İşlemleri');
            $crud->columns('islem_turu', 'tarih', 'vade_tarihi', 'tutar');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));
            $crud->where('cari_id', $hasta_getir);
            $crud->field_type('kullanici_id', 'hidden', $this->session->userdata('kullanici_id'));
            $crud->field_type('islem_turu', 'dropdown',
                array('2' => 'Borç Alacak', '3' => 'Tahsilat Ödeme'));

            $crud->field_type('giris_cikis', 'dropdown',
                array('0' => 'Cari Alacaklı', '1' => 'Cari Borçlu'));
            $crud->callback_column('vade_tarihi', array($this, 'vade_tarihi_getir'));
            $crud->callback_column('tutar', array($this, 'tutar_getir'));
            $crud->callback_column('islem_turu', array($this, 'islem_turu_getir'));

            $crud->unset_clone();
            $crud->unset_edit();
            $crud->unset_add();
            //  $crud->unset_read();
            $crud->unset_delete();

            $crud->unset_read_fields("islem_turu", "relation_type", "relation_id", "giris_cikis", "tutar", "tarih", "kategori", "cari_id"
                , "kasa_id", "kullanici_id");
            $data["ad"] = "Finans İşlemleri";

            $data["dr_id"] = $dr_getir;
            $data["hs_id"] = $hasta_getir;
            $data["id"] = $id;
            $data["pn"] = $pn;
            $data['side_menu'] = "Cari İşlemleri Ayarları";
            $data['kilavuz'] = "  <b>Cari İşlemleri Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;

            return $output;

        }

    }

    public function fatura($edit = null, $id = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            if ($this->session->userdata('yetki') != 0) {

                $this->load->library('messages');
                $this->messages->yetkisiz_alan('');
                return false;

            }

            $crud = new grocery_CRUD();
            $state = $crud->getState();
            $state_info = $crud->getStateInfo();

            if ($state == 'read') {
                $crud->set_relation('cari_id', 'cari', 'adi_soyadi', ['kullanici_id = ' => $this->session->userdata('kullanici_id')]);
            }

            $crud->set_theme('flexigrid');
            $crud->set_table('fatura');

            $crud->set_subject('Faturalar');
            $crud->columns('fatura_turu', 'fatura_no', 'cari_id', 'toplam', 'vade_tarihi', 'düzenle');
            $crud->display_as('cari_id', 'Cari Adı');
            $crud->where('kullanici_id', $this->session->userdata('kullanici_id'));
            $crud->field_type('kullanici_id', 'hidden', $this->session->userdata('kullanici_id'));

            $crud->callback_column('cari_id', array($this, 'callback_cari_getir'));
            $crud->callback_after_delete(array($this, 'fatura_delete'));
            $crud->callback_column('düzenle', array($this, 'fatura_duzenle_link'));

            $crud->unset_add();
            //$crud->unset_read();
            $crud->unset_edit();
            $crud->unset_clone();

            $data['side_menu'] = "Fatura Ayarları";
            $data['kilavuz'] = "  <b>Fatura Ayarları</b>";
            $output = $crud->render();
            $output->data = $data;
            //  $this->_example_output($output);
            $this->load->view('index', (array) $output);

        }
    }

    public function fatura_delete($primary_key)
    {

        $this->load->model('admin_model');
        $yetki_kontrol_fatura = $this->admin_model->yetki_kontrol_fatura($id, $this->session->userdata('kullanici_id'));

        if ($yetki_kontrol_fatura != 1) {

            $this->load->library('Messages');
            echo $this->messages->config('yonetim');
            return false;

        }

        $this->db->query('delete from fatura_item where fatura_id=' . $primary_key);
        $this->db->query('delete from islem where islem_turu=4 and relation_id=' . $primary_key);
        return true;

    }

    public function fatura_duzenle_link($value, $row)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $this->load->model('admin_model');
            //    $cari_ad=$this->admin_model->cari_ad($row->sahip_id);

            return "<a class='btn btn-default' href='" . site_url('yonetim/fatura_duzenle/' . $row->id) . "'>Düzenle</a>";

        }

    }

    public function satis_fatura_olustur()
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $crud = new grocery_CRUD();

            $crud->set_table('borc_alacak');

            $data['side_menu'] = "Satış Fatura Ayarları";
            $data['kilavuz'] = "  <b>Satış Fatura Ayarları</b>";
            $this->load->model('admin_model');
            $data["cari_getir"] = $this->admin_model->tum_cari_getir($this->session->userdata('kullanici_id'));
            $data["urun_getir"] = $this->admin_model->tum_urun_getir($this->session->userdata('kullanici_id'));

            //  print_r($data["urun_getir"]);
            //  return FALSE;

            $output = $crud->render();
            $output->data = $data;

            //  $this->_example_output($output);
            $this->load->view('fatura', (array) $output);

        }

    }

    public function alis_fatura_olustur()
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $crud = new grocery_CRUD();

            $crud->set_table('borc_alacak');

            $data['side_menu'] = "Alış Fatura Ayarları";
            $data['kilavuz'] = "  <b>Alış Fatura Ayarları</b>";
            $this->load->model('admin_model');
            $data["cari_getir"] = $this->admin_model->tum_cari_getir($this->session->userdata('kullanici_id'));
            $data["urun_getir"] = $this->admin_model->tum_urun_getir($this->session->userdata('kullanici_id'));

            $output = $crud->render();
            $output->data = $data;

            //  $this->_example_output($output);
            $this->load->view('fatura', (array) $output);

        }

    }

    public function fatura_al()
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {

            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {$this->load->view('admin_register');} else { $this->load->view('admin_register');}

        } else {

            $this->load->model('admin_model');
            $fat_turu = $this->input->post('fat_turu', true);
            $fat_turu = trim($fat_turu);
            $fat_turu = strip_tags($fat_turu);
            $fat_turu = htmlentities($fat_turu);

            $ara_toplam = $this->input->post('ara_toplam', true);
            $ara_toplam = trim($ara_toplam);
            $ara_toplam = strip_tags($ara_toplam);
            $ara_toplam = htmlentities($ara_toplam);

            $indirim = $this->input->post('indirim', true);
            $indirim = trim($indirim);
            $indirim = strip_tags($indirim);
            $indirim = htmlentities($indirim);

            $vergi = $this->input->post('vergi', true);
            $vergi = trim($vergi);
            $vergi = strip_tags($vergi);
            $vergi = htmlentities($vergi);

            $toplam = $this->input->post('toplam', true);
            $toplam = trim($toplam);
            $toplam = strip_tags($toplam);
            $toplam = htmlentities($toplam);

            $top_alan = $this->input->post('top_alan', true);
            $top_alan = trim($top_alan);
            $top_alan = strip_tags($top_alan);
            $top_alan = htmlentities($top_alan);

            $mus = $this->input->post('mus', true);
            $mus = trim($mus);
            $mus = strip_tags($mus);
            $mus = htmlentities($mus);

            $seri = $this->input->post('seri', true);
            $seri = trim($seri);
            $seri = strip_tags($seri);
            $seri = htmlentities($seri);

            $no = $this->input->post('no', true);
            $no = trim($no);
            $no = strip_tags($no);
            $no = htmlentities($no);

            $duz_ta = $this->input->post('duz_ta', true);
            $duz_ta = trim($duz_ta);
            $duz_ta = strip_tags($duz_ta);
            $duz_ta = htmlentities($duz_ta);

            $duz_ta_par = explode("/", $duz_ta);
            $duz_ta = $duz_ta_par[2] . "-" . $duz_ta_par[0] . "-" . $duz_ta_par[1];

            $va_ta = $this->input->post('va_ta', true);
            $va_ta = trim($va_ta);
            $va_ta = strip_tags($va_ta);
            $va_ta = htmlentities($va_ta);

            $va_ta_par = explode("/", $va_ta);
            $va_ta = $va_ta_par[2] . "-" . $va_ta_par[0] . "-" . $va_ta_par[1];

            $ack = $this->input->post('ack', true);
            $ack = trim($ack);
            $ack = strip_tags($ack);
            $ack = htmlentities($ack);

            $fat_kayit = $this->admin_model->fat_kayit($fat_turu, $ara_toplam, $indirim, $vergi, $toplam, $mus, $seri, $no, $duz_ta, $va_ta, $ack, $this->session->userdata('kullanici_id'));
            $fat_id = $fat_kayit;
            $islem_kayit = $this->admin_model->islem_kayit_fat("4", "Fatura", $fat_id, "1", $toplam, $duz_ta, $ack, $mus, $this->session->userdata('kullanici_id'));

            for ($i = 1; $i <= $top_alan; $i++) {

                $item[$i] = $this->input->post('item_' . $i, true);
                $item[$i] = trim($item[$i]);
                $item[$i] = strip_tags($item[$i]);
                $item[$i] = htmlentities($item[$i]);

                $des[$i] = $this->input->post('des_' . $i, true);
                $des[$i] = trim($des[$i]);
                $des[$i] = strip_tags($des[$i]);
                $des[$i] = htmlentities($des[$i]);

                $prc[$i] = $this->input->post('prc_' . $i, true);
                $prc[$i] = trim($prc[$i]);
                $prc[$i] = strip_tags($prc[$i]);
                $prc[$i] = htmlentities($prc[$i]);

                $qty[$i] = $this->input->post('qty_' . $i, true);
                $qty[$i] = trim($qty[$i]);
                $qty[$i] = strip_tags($qty[$i]);
                $qty[$i] = htmlentities($qty[$i]);

                $discount[$i] = $this->input->post('discount_' . $i, true);
                $discount[$i] = trim($discount[$i]);
                $discount[$i] = strip_tags($discount[$i]);
                $discount[$i] = htmlentities($discount[$i]);

                $tax[$i] = $this->input->post('tax_' . $i, true);
                $tax[$i] = trim($tax[$i]);
                $tax[$i] = strip_tags($tax[$i]);
                $tax[$i] = htmlentities($tax[$i]);

                $total[$i] = $this->input->post('total_' . $i, true);
                $total[$i] = trim($total[$i]);
                $total[$i] = strip_tags($total[$i]);
                $total[$i] = htmlentities($total[$i]);

                $fat_item_kayit = $this->admin_model->fat_item_kayit($fat_id, $item[$i], $qty[$i], $prc[$i], $total[$i], $des[$i], $discount[$i], $tax[$i], $this->session->userdata('kullanici_id'));

            }

            $this->load->library('messages');
            $this->messages->config2('Yonetim/fatura');
            return false;

        }

    }

    public function fatura_duzenle($id = null)
    {

        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                echo $this->messages->To_Login('Yonetim');
            } else {echo $this->messages->To_Register('Yonetim');}

        } else {

            $this->load->model('admin_model');
            $yetki_kontrol_fatura = $this->admin_model->yetki_kontrol_fatura($id, $this->session->userdata('kullanici_id'));

            if ($yetki_kontrol_fatura != 1) {

                $this->load->library('Messages');
                echo $this->messages->config('yonetim');
                return false;

            }

            $crud = new grocery_CRUD();

            $crud->set_table('borc_alacak');

            $data['side_menu'] = "Satış Fatura Ayarları";
            $data['kilavuz'] = "  <b>Satış Fatura Ayarları</b>";

            $data["cari_getir"] = $this->admin_model->tum_cari_getir($this->session->userdata('kullanici_id'));
            $data["urun_getir"] = $this->admin_model->tum_urun_getir($this->session->userdata('kullanici_id'));
            $data["fatura_getir_duzenle"] = $this->admin_model->fatura_getir_duzenle($id, $this->session->userdata('kullanici_id'));
            $data["fatura_item_getir_duzenle"] = $this->admin_model->fatura_item_getir_duzenle($id, $this->session->userdata('kullanici_id'));

            if ($data["fatura_getir_duzenle"]): foreach ($data["fatura_getir_duzenle"] as $dizi):
                    $data["cari_ad"] = $this->admin_model->cari_ad($dizi["cari_id"]);
                endforeach;endif;

            $n = 0;if ($data["fatura_item_getir_duzenle"]): foreach ($data["fatura_item_getir_duzenle"] as $dizi):
                    $data["urun_ad"][$n] = $this->admin_model->stok_adi($dizi["hizmet_urun_id"], $this->session->userdata('kullanici_id'));
                    $n = $n + 1;
                endforeach;endif;

            // print_r($data["cari_ad"]);
            //      return FALSE;

            $output = $crud->render();
            $output->data = $data;

            //  $this->_example_output($output);
            $this->load->view('fatura_duzenle', (array) $output);

        }

    }

    public function genel_rapor()
    {
        error_reporting(0);
        $online = $this->session->userdata('adminonline');
        if (empty($online)) {
            $this->load->library('messages');
            $this->load->model('admin_model');
            $sonuc = $this->admin_model->admin_query();

            if ($sonuc) {
                $this->load->view('admin_login');
            } else { $this->load->view('admin_register');}

        } else {

            $crud = new grocery_CRUD();

            $crud->set_table('borc_alacak');

            $data['side_menu'] = "Raporlar Ayarları";
            $data['kilavuz'] = "  <b>Raporlar Ayarları</b>";
            $this->load->model('admin_model');

            $this->load->model('admin_model');
//Bugün

            $bas = $_POST["t1"];
            $bit = $_POST["t2"];
            $data['bas'] = $_POST["t1"];
            $data['bit'] = $_POST["t2"];

            if (($bas == "") or ($bit == "")) {

                $bas = "2000-01-01";
                $bit = date("Y-m-d");

                $data['bas'] = $bas;
                $data['bit'] = $bit;

            }

            // $bas = "2000-01-01";
            // $bit = "2020-01-01";

            $data['tahsilat'] = $this->admin_model->tahsilat($bas, $bit);
            $data['odeme'] = $this->admin_model->odeme($bas, $bit);
            $data['gelir'] = $this->admin_model->gelir($bas, $bit);
            $data['gider'] = $this->admin_model->gider($bas, $bit);
            $data['alis'] = $this->admin_model->alis($bas, $bit);
            $data['satis'] = $this->admin_model->satis($bas, $bit);
            $data["currency"] = $this->session->userdata('para_birim');
            $data['durum'] = $this->admin_model->durum($bas, $bit);
            $data['kasa'] = $this->admin_model->kasa($bas, $bit);

            $output = $crud->render();
            $output->data = $data;

            //  $this->_example_output($output);
            $this->load->view('genel_rapor', (array) $output);

        }

    }

    public function rapor()
    {

        $this->load->view('evrak/rapor');

    }

}
