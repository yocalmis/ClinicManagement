<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Admin_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //Admin Varm� Yokmu Kontrol Et , Varsa Login'e Yoksa Kay�t sayfas�na y�nlendir

    public function admin_query()
    {

        $sql = "SELECT * FROM uyeler";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function admin_register_before($username, $email)
    {

        $sql = "SELECT * FROM uyeler Where username='$username' or email='$email'";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function admin_info()
    {
        $sql = "SELECT * FROM ayar";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    //Admin kaydet

    public function admin_register($data)
    {
        $name = $this->db->escape_str($data[0]);
        $email = $this->db->escape_str($data[1]);
        $username = $this->db->escape_str($data[2]);
        $pass = $this->db->escape_str($data[3]);
        $bina_adi = $this->db->escape_str($data[4]);
        $blok_adedi = $this->db->escape_str($data[5]);

        $bugun = date("Y-m-d");
        $ondort = date("d.m.Y", strtotime('+14 days'));
        $ondort = explode(".", $ondort);
        $ondort = $ondort[2] . "-" . $ondort[1] . "-" . $ondort[0];

        $insert = array(
            'name' => $name,
            'username' => $username,
            'pass' => $pass,
            'email' => $email,
            'status' => 0,
            'bas_tar' => $bugun,
            'bit_tar' => $ondort,
            'uye_turu' => 1,

        );

        $into = $this->db->insert('uyeler', $insert);
        if ($into) {

            $insertId = $this->db->insert_id();
            $insert2 = array(
                'kullanici_id' => $insertId,

            );
            $this->db->where('id', $insertId);
            $into2 = $this->db->update('uyeler', $insert2);

            $insert3 = array(
                'adi' => $bina_adi,
                'blok' => $blok_adedi,
                'kullanici_id' => $insertId,

            );

            $binakayit = $this->db->insert('bina', $insert3);
            $bina_insertId = $this->db->insert_id();

            $insert4 = array(
                'blok_id' => $bina_insertId,
                'kullanici_id' => $insertId,

            );

            $dongu = $blok_adedi - 1;
            for ($n = 0; $n <= $dongu; $n++) {
                $blokkayit = $this->db->insert('blok', $insert4);
            }

            if ($into2) {return $pass;} else {return 0;}

        } else {return 0;}

    }

    public function kontrol($email)
    {

        $query = $this->db->query("select * from uyeler Where email='$email'");
        if ($query->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }

    }

    public function pass_getir($email)
    {

        $query = $this->db->query("select * from uyeler Where email='$email'");
        if ($query->num_rows() > 0) {

            foreach ($query->result_array() as $row) {
                return $row['pass'];

            }

        } else {
            return false;
        }

    }

    public function sifre_guncelle($sf, $pass)
    {

        $insert = array(
            'pass' => $sf,

        );
        $this->db->where('pass', $pass);
        $into = $this->db->update('uyeler', $insert);
        if ($into) {return 1;} else {return 0;}

    }

    //Admin login kontrol

    public function admin_return($data)
    {

        $username = $this->db->escape_str($data[0]);
        $pass = $this->db->escape_str($data[1]);
        $bugun = date("Y-m-d");

        $query = $this->db->query("select * from uyeler Where username='$username' and pass='$pass' and status=1");
        if ($query->num_rows() > 0) {

            $query = $this->db->query("select * from uyeler Where username='$username' and pass='$pass' and status=1 and bas_tar<='" . $bugun . "' and bit_tar >='" . $bugun . "' ");
            if ($query->num_rows() > 0) {
                //Login
                return 2;
            } else {
                //Ödeme
                return 1;
            }

        } else {
            return 0;
        }

    }

    public function kullanici_id_tarih_kontrol($kul)
    {

        $bugun = date("Y-m-d");

        $query = $this->db->query("select * from uyeler Where kullanici_id=" . $kul . " and status=1 and bas_tar<='" . $bugun . "' and bit_tar >='" . $bugun . "' ");
        if ($query->num_rows() > 0) {return 1;} else {return 0;}

    }

    public function admin_bilgi($data)
    {
        $username = $this->db->escape_str($data[0]);
        $pass = $this->db->escape_str($data[1]);

        $query = $this->db->query("select * from uyeler Where username='$username' and pass='$pass' ");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }

    }

    public function para_birimi($kullanici_id)
    {

        $query = $this->db->query("select * from bina Where kullanici_id=" . $kullanici_id . "");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }

    }

    public function mail_cikis($ep1, $ep2)
    {

        $ep = $ep1 . "@" . $ep2;

        $query = $this->db->query("update cari set eposta_durum=0 Where eposta='$ep'");
        if ($query) {return 1;} else {return 0;}

    }

    public function mail_getir($kul_id)
    {

        $sql = "SELECT eposta FROM cari Where kullanici_id=" . $kul_id . " and eposta_durum=1";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }

    }

    public function uye_onay($pass)
    {

        $insert = array(
            'status' => 1,

        );
        $this->db->where('pass', $pass);
        $into = $this->db->update('uyeler', $insert);
        if ($into) {

            return 1;

        } else {return 0;}

    }

    public function mails($pass)
    {

        $query = $this->db->query("select * from uyeler Where pass='$pass'");
        foreach ($query->result_array() as $row) {
            return $row['email'];
        }

    }

    public function uye_turu_getir($online)
    {
        $query = $this->db->query("select * from uyeler Where username='$online'");
        foreach ($query->result_array() as $row) {
            return $row['uye_turu'];
        }

    }

    public function uye_id_getir($online)
    {
        $query = $this->db->query("select * from uyeler Where username='$online'");
        foreach ($query->result_array() as $row) {
            return $row['id'];
        }

    }

    public function yetki_kontrol_bina($kul_id, $id)
    {
        $query = $this->db->query("select * from bina Where id=" . $id . " and kullanici_id=" . $kul_id . "");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function yetki_kontrol_blok($kul_id, $id)
    {
        $query = $this->db->query("select * from blok Where id=" . $id . " and kullanici_id=" . $kul_id . "");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function blok_bilgi_getir($kul_id, $id)
    {
        $query = $this->db->query("select * from blok Where id=" . $id . " and kullanici_id=" . $kul_id . "");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }

    }

    public function daire_say($kul_id, $id)
    {
        $query = $this->db->query("select * from daire Where id=" . $id . " and kullanici_id=" . $kul_id . "");
        return $query->num_rows();

    }

    public function yetki_kontrol_daire($kul_id, $id)
    {
        $query = $this->db->query("select * from daire Where id=" . $id . " and kullanici_id=" . $kul_id . "");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function yetki_kontrol_cari($kul_id, $id)
    {
        $query = $this->db->query("select * from cari Where id=" . $id . " and kullanici_id=" . $kul_id . "");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function yetki_kontrol_zimmet($kul_id, $id)
    {
        $query = $this->db->query("select * from zimmet Where id=" . $id . " and kullanici_id=" . $kul_id . "");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function yetki_kontrol_izin($kul_id, $id)
    {
        $query = $this->db->query("select * from izin Where id=" . $id . " and kullanici_id=" . $kul_id . "");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function yetki_kontrol_hiz($kul_id, $id)
    {
        $query = $this->db->query("select * from hizmet_urun Where id=" . $id . " and kullanici_id=" . $kul_id . "");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function yetki_kontrol_kasa($kul_id, $id)
    {
        $query = $this->db->query("select * from kasa Where id=" . $id . " and kullanici_id=" . $kul_id . "");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function yetki_kontrol_komite($kul_id, $id)
    {
        $query = $this->db->query("select * from komite Where id=" . $id . " and kullanici_id=" . $kul_id . "");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function blok_ad($id)
    {
        $query = $this->db->query("select * from blok Where id='" . $id . "'");
        foreach ($query->result_array() as $row) {
            return $row['adi'];
        }

    }

    public function cari_ad($id)
    {
        $query = $this->db->query("select * from cari Where id='" . $id . "'");
        foreach ($query->result_array() as $row) {
            return $row['adi_soyadi'];
        }

    }

    public function demirbas_ad($id)
    {
        $query = $this->db->query("select * from hizmet_urun Where id='" . $id . "'");
        foreach ($query->result_array() as $row) {
            return $row['adi'];
        }

    }

    public function kasa_ad($id)
    {
        $query = $this->db->query("select * from kasa Where id='" . $id . "'");
        foreach ($query->result_array() as $row) {
            return $row['adi'];
        }

    }

    public function yetki_kontrol_uye($kul_id, $id)
    {
        $query = $this->db->query("select * from uyeler Where id=" . $id . " and kullanici_id=" . $kul_id . "");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function yetki_kontrol_dosya($kul_id, $id)
    {
        $query = $this->db->query("select * from dosyalar Where id=" . $id . " and kullanici_id=" . $kul_id . "");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function yetki_kontrol_kategori($kul_id, $id)
    {
        $query = $this->db->query("select * from kategori Where id=" . $id . " and kullanici_id=" . $kul_id . "");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function yetki_kontrol_gelir_gider($kul_id, $id)
    {
        $query = $this->db->query("select * from islem Where id=" . $id . " and kullanici_id=" . $kul_id . "");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function yetki_kontrol_virman($kul_id, $id)
    {
        $query = $this->db->query("select * from virman Where id=" . $id . " and kullanici_id=" . $kul_id . "");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function yetki_kontrol_borc($kul_id, $id)
    {
        $query = $this->db->query("select * from borc_alacak Where id=" . $id . " and kullanici_id=" . $kul_id . "");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function virman_getir($kul_id, $id)
    {

        $sql = "SELECT * FROM virman Where kullanici_id=" . $kul_id . " and id=" . $id . "";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }

    }

    public function islem_getir($kul_id, $id)
    {

        $sql = "SELECT * FROM islem Where kullanici_id=" . $kul_id . " and relation_id=" . $id . "";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }

    }

    public function islem_kayit($data)
    {

        $insert = array(
            'islem_turu' => 1,
            'relation_type' => "Banka",
            'relation_id' => $data[0],
            'giris_cikis' => 0,
            'tutar' => $data[3],
            'tarih' => $data[4],
            'aciklama' => $data[5],
            'kasa_id' => $data[1],
            'kullanici_id' => $data[6],
            'cari_id' => 0,
            'kategori' => "",
        );

        $into = $this->db->insert('islem', $insert);

        if ($into) {

            $insert2 = array(
                'islem_turu' => 1,
                'relation_type' => "Banka",
                'relation_id' => $data[0],
                'giris_cikis' => 1,
                'tutar' => $data[3],
                'tarih' => $data[4],
                'aciklama' => $data[5],
                'kasa_id' => $data[2],
                'kullanici_id' => $data[6],
                'cari_id' => 0,
                'kategori' => "",
            );

            $into2 = $this->db->insert('islem', $insert2);

            if ($into2) {return true;}
            return false;
        }
        return false;

    }

    public function boal_getir($kul_id, $id)
    {

        $sql = "SELECT * FROM borc_alacak Where kullanici_id=" . $kul_id . " and id=" . $id . "";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }

    }

    public function islem_kayit_boal($data)
    {
//1 cari borçlandır
        //2 cari alacaklandır

        $insert = array(
            'islem_turu' => 2,
            'relation_type' => "Borç_Alacak",
            'relation_id' => $data[0],
            'giris_cikis' => $data[1],
            'tutar' => $data[2],
            'tarih' => $data[5],
            'aciklama' => $data[7],
            'kasa_id' => 0,
            'kullanici_id' => $data[4],
            'cari_id' => $data[3],
            'kategori' => "",
        );

        $into = $this->db->insert('islem', $insert);

        if ($into) {

            return true;
        }
        return false;

    }

    public function toplu_boalkayit($data)
    {
//1 cari borçlandır
        //2 cari alacaklandır

        $insert = array(
            'fatura_turu' => $data[0],
            'toplam' => $data[1],
            'cari_id' => $data[2],
            'kullanici_id' => $data[3],
            'tarih' => $data[4],
            'aciklama' => $data[6],
            'vade_tarihi' => $data[5],
        );

        $into = $this->db->insert('borc_alacak', $insert);

        if ($into) {

            return true;
        }
        return false;

    }

    public function sahip_bos_varmi($kul)
    {
        $query = $this->db->query("select * from daire Where kullanici_id=" . $kul . " and sahip_id=0");
        return $query->num_rows();

    }

    public function cari_baslangic($id, $kul_id)
    {

        $query = $this->db->query("select * from cari Where id=" . $id . " and kullanici_id=" . $kul_id);
        foreach ($query->result_array() as $row) {
            return $row['bas_borc_alacak'];
        }

    }

    public function cari_toplam_getir($id, $kul_id)
    {
        $query = $this->db->query("select * from islem Where cari_id=" . $id . " and kullanici_id=" . $kul_id);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }

    }

    public function vade_tarihi_getir($id, $kul_id)
    {

        $query = $this->db->query("select * from borc_alacak Where id=" . $id . " and kullanici_id=" . $kul_id);
        foreach ($query->result_array() as $row) {
            return $row['vade_tarihi'];
        }

    }

    public function yetki_kontrol_cari_detay($kul_id, $id)
    {
        $query = $this->db->query("select * from cari Where id=" . $id . " and kullanici_id=" . $kul_id . "");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function yetki_kontrol_islem($kul_id, $id)
    {
        $query = $this->db->query("select * from islem Where id=" . $id . " and kullanici_id=" . $kul_id . "");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function cari_adi($id, $kul_id)
    {

        $query = $this->db->query("select * from cari Where id=" . $id . " and kullanici_id=" . $kul_id);
        foreach ($query->result_array() as $row) {
            return $row['adi_soyadi'];
        }

    }

    public function kasa_adi($id, $kul_id)
    {

        $query = $this->db->query("select * from kasa Where id=" . $id . " and kullanici_id=" . $kul_id);
        foreach ($query->result_array() as $row) {
            return $row['adi'];
        }

    }

    public function kasa_baslangic($id, $kul_id)
    {

        $query = $this->db->query("select * from kasa Where id=" . $id . " and kullanici_id=" . $kul_id);
        foreach ($query->result_array() as $row) {
            return $row['bas_kasa'];
        }

    }

    public function kasa_toplam_getir($id, $kul_id)
    {
        $query = $this->db->query("select * from islem Where kasa_id=" . $id . " and kullanici_id=" . $kul_id);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }

    }

    public function yetki_kontrol_kasa_detay($kul_id, $id)
    {
        $query = $this->db->query("select * from kasa Where id=" . $id . " and kullanici_id=" . $kul_id . "");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function list_getir($id)
    {

        $sql = "SELECT * FROM task Where kim=" . $id;
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }

    }

    public function sss_getir()
    {

        $sql = "SELECT * FROM sss";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }

    }

    public function yetki_kontrol_gorusme($kul_id, $id)
    {
        $query = $this->db->query("select * from gorusme Where id=" . $id . " and kullanici_id=" . $kul_id . "");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function yetki_kontrol_teklif($kul_id, $id)
    {
        $query = $this->db->query("select * from teklif Where id=" . $id . " and kullanici_id=" . $kul_id . "");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function yetki_kontrol_not($kul_id, $id)
    {
        $query = $this->db->query("select * from notlar Where id=" . $id . " and kullanici_id=" . $kul_id . "");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function yetki_kontrol_arama($kul_id, $id)
    {
        $query = $this->db->query("select * from arama Where id=" . $id . " and kullanici_id=" . $kul_id . "");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function yetki_kontrol_randevu($kul_id, $id)
    {
        $query = $this->db->query("select * from randevu Where id=" . $id . " and kullanici_id=" . $kul_id . "");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function bugun_tahsilat($bugun_bas, $bugun_bit)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('tarih>=', $bugun_bas);
        $this->db->where('tarih<=', $bugun_bit);
        $this->db->where('giris_cikis', 1);
        $this->db->where('islem_turu', 3);
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));

        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function bugun_odeme($bugun_bas, $bugun_bit)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('tarih>=', $bugun_bas);
        $this->db->where('tarih<=', $bugun_bit);
        $this->db->where('giris_cikis', 0);
        $this->db->where('islem_turu', 3);
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function bugun_gelir($bugun_bas, $bugun_bit)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('tarih>=', $bugun_bas);
        $this->db->where('tarih<=', $bugun_bit);
        $this->db->where('giris_cikis', 1);
        $this->db->where('islem_turu', 0);
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function bugun_gider($bugun_bas, $bugun_bit)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('tarih>=', $bugun_bas);
        $this->db->where('tarih<=', $bugun_bit);
        $this->db->where('giris_cikis', 0);
        $this->db->where('islem_turu', 0);
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function bugun_alis($bugun_bas, $bugun_bit)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('tarih>=', $bugun_bas);
        $this->db->where('tarih<=', $bugun_bit);
        $this->db->where('giris_cikis', 0);
        //$this->db->where('islem_turu', 2);
        $this->db->group_start();
        $this->db->where("islem_turu = 2");
        $this->db->or_where("islem_turu = 4");
        $this->db->group_end();
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function bugun_satis($bugun_bas, $bugun_bit)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('tarih>=', $bugun_bas);
        $this->db->where('tarih<=', $bugun_bit);
        $this->db->where('giris_cikis', 1);
        //$this->db->where('islem_turu', 2);
        $this->db->group_start();
        $this->db->where("islem_turu = 2");
        $this->db->or_where("islem_turu = 4");
        $this->db->group_end();
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function buh_tahsilat($buhafta, $bugun_bit)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('tarih>=', $buhafta);
        $this->db->where('tarih<=', $bugun_bit);
        $this->db->where('giris_cikis', 1);
        $this->db->where('islem_turu', 3);
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function buh_odeme($buhafta, $bugun_bit)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('tarih>=', $buhafta);
        $this->db->where('tarih<=', $bugun_bit);
        $this->db->where('giris_cikis', 0);
        $this->db->where('islem_turu', 3);
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function buh_gelir($buhafta, $bugun_bit)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('tarih>=', $buhafta);
        $this->db->where('tarih<=', $bugun_bit);
        $this->db->where('giris_cikis', 1);
        $this->db->where('islem_turu', 0);
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function buh_gider($buhafta, $bugun_bit)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('tarih>=', $buhafta);
        $this->db->where('tarih<=', $bugun_bit);
        $this->db->where('giris_cikis', 0);
        $this->db->where('islem_turu', 0);
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function buh_alis($buhafta, $bugun_bit)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('tarih>=', $buhafta);
        $this->db->where('tarih<=', $bugun_bit);
        $this->db->where('giris_cikis', 0);
        //$this->db->where('islem_turu', 2);
        $this->db->group_start();
        $this->db->where("islem_turu = 2");
        $this->db->or_where("islem_turu = 4");
        $this->db->group_end();
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function buh_satis($buhafta, $bugun_bit)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('tarih>=', $buhafta);
        $this->db->where('tarih<=', $bugun_bit);
        $this->db->where('giris_cikis', 1);
        //$this->db->where('islem_turu', 2);
        $this->db->group_start();
        $this->db->where("islem_turu = 2");
        $this->db->or_where("islem_turu = 4");
        $this->db->group_end();
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function buay_tahsilat($buay, $bugun_bit)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('tarih>=', $buay);
        $this->db->where('tarih<=', $bugun_bit);
        $this->db->where('giris_cikis', 1);
        $this->db->where('islem_turu', 3);
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function buay_odeme($buay, $bugun_bit)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('tarih>=', $buay);
        $this->db->where('tarih<=', $bugun_bit);
        $this->db->where('giris_cikis', 0);
        $this->db->where('islem_turu', 3);
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function buay_gelir($buay, $bugun_bit)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('tarih>=', $buay);
        $this->db->where('tarih<=', $bugun_bit);
        $this->db->where('giris_cikis', 1);
        $this->db->where('islem_turu', 0);
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function buay_gider($buay, $bugun_bit)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('tarih>=', $buay);
        $this->db->where('tarih<=', $bugun_bit);
        $this->db->where('giris_cikis', 0);
        $this->db->where('islem_turu', 0);
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function buay_alis($buay, $bugun_bit)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('tarih>=', $buay);
        $this->db->where('tarih<=', $bugun_bit);
        $this->db->where('giris_cikis', 0);
        //$this->db->where('islem_turu', 2);
        $this->db->group_start();
        $this->db->where("islem_turu = 2");
        $this->db->or_where("islem_turu = 4");
        $this->db->group_end();
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function buay_satis($buay, $bugun_bit)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('tarih>=', $buay);
        $this->db->where('tarih<=', $bugun_bit);
        $this->db->where('giris_cikis', 1);
        //$this->db->where('islem_turu', 2);
        $this->db->group_start();
        $this->db->where("islem_turu = 2");
        $this->db->or_where("islem_turu = 4");
        $this->db->group_end();
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function buyil_tahsilat($buyil, $bugun_bit)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('tarih>=', $buyil);
        $this->db->where('tarih<=', $bugun_bit);
        $this->db->where('giris_cikis', 1);
        $this->db->where('islem_turu', 3);
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function buyil_odeme($buyil, $bugun_bit)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('tarih>=', $buyil);
        $this->db->where('tarih<=', $bugun_bit);
        $this->db->where('giris_cikis', 0);
        $this->db->where('islem_turu', 3);
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function buyil_gelir($buyil, $bugun_bit)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('tarih>=', $buyil);
        $this->db->where('tarih<=', $bugun_bit);
        $this->db->where('giris_cikis', 1);
        $this->db->where('islem_turu', 0);
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function buyil_gider($buyil, $bugun_bit)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('tarih>=', $buyil);
        $this->db->where('tarih<=', $bugun_bit);
        $this->db->where('giris_cikis', 0);
        $this->db->where('islem_turu', 0);
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function buyil_alis($buyil, $bugun_bit)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('tarih>=', $buyil);
        $this->db->where('tarih<=', $bugun_bit);
        $this->db->where('giris_cikis', 0);
        //$this->db->where('islem_turu', 2);
        $this->db->group_start();
        $this->db->where("islem_turu = 2");
        $this->db->or_where("islem_turu = 4");
        $this->db->group_end();
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function buyil_satis($buyil, $bugun_bit)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('tarih>=', $buyil);
        $this->db->where('tarih<=', $bugun_bit);
        $this->db->where('giris_cikis', 1);
        //$this->db->where('islem_turu', 2);
        $this->db->group_start();
        $this->db->where("islem_turu = 2");
        $this->db->or_where("islem_turu = 4");
        $this->db->group_end();
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function toplam_tahsilat($buyil, $bugun_bit)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('giris_cikis', 1);
        $this->db->where('islem_turu', 3);
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function toplam_odeme($buyil, $bugun_bit)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('giris_cikis', 0);
        $this->db->where('islem_turu', 3);
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function toplam_gelir($buyil, $bugun_bit)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('giris_cikis', 1);
        $this->db->where('islem_turu', 0);
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function toplam_gider($buyil, $bugun_bit)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('giris_cikis', 0);
        $this->db->where('islem_turu', 0);
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function toplam_alis($buyil, $bugun_bit)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('giris_cikis', 0);
        //$this->db->where('islem_turu', 2);
        $this->db->group_start();
        $this->db->where("islem_turu = 2");
        $this->db->or_where("islem_turu = 4");
        $this->db->group_end();
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function toplam_satis($buyil, $bugun_bit)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('giris_cikis', 1);
        //$this->db->where('islem_turu', 2);
        $this->db->group_start();
        $this->db->where("islem_turu = 2");
        $this->db->or_where("islem_turu = 4");
        $this->db->group_end();
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function genel_durum_giris($buyil, $bugun_bit)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('giris_cikis', 1);
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function genel_durum_cikis($buyil, $bugun_bit)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('giris_cikis', 0);
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function genel_durum_cari($buyil, $bugun_bit)
    {

        $this->db->select_sum('bas_borc_alacak');
        $this->db->from('cari');
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->bas_borc_alacak) {return 0;}
        return $query->row()->bas_borc_alacak;

    }

    public function toplam_durum($buyil, $bugun_bit)
    {

        return $this->genel_durum_cari($buyil, $bugun_bit) + $this->genel_durum_giris($buyil, $bugun_bit) - $this->genel_durum_cikis($buyil, $bugun_bit);
        //+$this->genel_durum_giris($buyil,$bugun_bit)-$this->genel_durum_cikis($buyil,$bugun_bit);

    }

    public function kasa_durum_giris($buyil, $bugun_bit)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('giris_cikis', 1);
        $this->db->where("(islem_turu = 0 OR islem_turu = 3)");
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function kasa_durum_cikis($buyil, $bugun_bit)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('giris_cikis', 0);
        $this->db->where("(islem_turu = 0 OR islem_turu = 3)");
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function genel_durum_kasa($buyil, $bugun_bit)
    {

        $this->db->select_sum('bas_kasa');
        $this->db->from('kasa');
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->bas_kasa) {return 0;}
        return $query->row()->bas_kasa;

    }

    public function toplam_durum_kasa($buyil, $bugun_bit)
    {

        return $this->genel_durum_kasa($buyil, $bugun_bit) + $this->kasa_durum_giris($buyil, $bugun_bit) - $this->kasa_durum_cikis($buyil, $bugun_bit);
        //+$this->genel_durum_giris($buyil,$bugun_bit)-$this->genel_durum_cikis($buyil,$bugun_bit);

    }

    public function yetki_kontrol_protocol($kul_id, $id)
    {
        $query = $this->db->query("select * from protocol Where id=" . $id . " and kullanici_id=" . $kul_id . "");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function pn_kontrol($id, $pn)
    {
        $query = $this->db->query("select * from protocol Where id=" . $id . " and protocol_no=" . $pn . " and kullanici_id=" . $this->session->userdata('kullanici_id') . "");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function hasta_getir($id, $pn)
    {

        $query = $this->db->query("select * from protocol Where id=" . $id . " and protocol_no=" . $pn . " and kullanici_id=" . $this->session->userdata('kullanici_id') . "");

        foreach ($query->result_array() as $row) {
            return $row['hasta'];
        }

    }

    public function dr_getir($id, $pn)
    {

        $query = $this->db->query("select * from protocol Where id=" . $id . " and protocol_no=" . $pn . " and kullanici_id=" . $this->session->userdata('kullanici_id') . "");

        foreach ($query->result_array() as $row) {
            return $row['doktor'];
        }

    }

    public function tahsilat($t1, $t2)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('tarih>=', $t1);
        $this->db->where('tarih<=', $t2);
        $this->db->where('giris_cikis', 1);
        $this->db->where('islem_turu', 3);
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function odeme($t1, $t2)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('tarih>=', $t1);
        $this->db->where('tarih<=', $t2);
        $this->db->where('giris_cikis', 0);
        $this->db->where('islem_turu', 3);
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function gelir($t1, $t2)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('tarih>=', $t1);
        $this->db->where('tarih<=', $t2);
        $this->db->where('giris_cikis', 1);
        $this->db->where('islem_turu', 0);
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function gider($t1, $t2)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('tarih>=', $t1);
        $this->db->where('tarih<=', $t2);
        $this->db->where('giris_cikis', 0);
        $this->db->where('islem_turu', 0);
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function alis($t1, $t2)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('tarih>=', $t1);
        $this->db->where('tarih<=', $t2);
        $this->db->where('giris_cikis', 0);
        //$this->db->where('islem_turu', 2);
        $this->db->group_start();
        $this->db->where("islem_turu = 2");
        $this->db->or_where("islem_turu = 4");
        $this->db->group_end();
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function satis($t1, $t2)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('tarih>=', $t1);
        $this->db->where('tarih<=', $t2);
        $this->db->where('giris_cikis', 1);
        //$this->db->where('islem_turu', 2);
        $this->db->group_start();
        $this->db->where("islem_turu = 2");
        $this->db->or_where("islem_turu = 4");
        $this->db->group_end();
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function tarih_durum_giris($t1, $t2)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('giris_cikis', 1);
        $this->db->where('tarih>=', $t1);
        $this->db->where('tarih<=', $t2);
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function tarih_durum_cikis($t1, $t2)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('giris_cikis', 0);
        $this->db->where('tarih>=', $t1);
        $this->db->where('tarih<=', $t2);
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function tarih_durum_cari($t1, $t2)
    {

        $this->db->select_sum('bas_borc_alacak');
        $this->db->from('cari');
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->bas_borc_alacak) {return 0;}
        return $query->row()->bas_borc_alacak;

    }

    public function durum($t1, $t2)
    {

        return $this->tarih_durum_giris($t1, $t2) - $this->tarih_durum_cikis($t1, $t2);
        //+$this->genel_durum_giris($buyil,$bugun_bit)-$this->genel_durum_cikis($buyil,$bugun_bit);

    }

    public function tarih_kasa_durum_giris($t1, $t2)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('giris_cikis', 1);
        $this->db->where('tarih>=', $t1);
        $this->db->where('tarih<=', $t2);
        $this->db->where("(islem_turu = 0 OR islem_turu = 3)");
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function tarih_kasa_durum_cikis($t1, $t2)
    {

        $this->db->select_sum('tutar');
        $this->db->from('islem');
        $this->db->where('giris_cikis', 0);
        $this->db->where('tarih>=', $t1);
        $this->db->where('tarih<=', $t2);
        $this->db->where("(islem_turu = 0 OR islem_turu = 3)");
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->tutar) {return 0;}
        return $query->row()->tutar;

    }

    public function tarih_genel_durum_kasa($t1, $t2)
    {

        $this->db->select_sum('bas_kasa');
        $this->db->from('kasa');
        $this->db->where('kullanici_id', $this->session->userdata('kullanici_id'));
        $query = $this->db->get();
        if (!$query->row()->bas_kasa) {return 0;}
        return $query->row()->bas_kasa;

    }

    public function kasa($t1, $t2)
    {

        return $this->tarih_kasa_durum_giris($t1, $t2) - $this->tarih_kasa_durum_cikis($t1, $t2);
        //+$this->genel_durum_giris($buyil,$bugun_bit)-$this->genel_durum_cikis($buyil,$bugun_bit);

    }

    public function tum_urun_getir($kul_id)
    {

        $sql = "SELECT * FROM hizmet_urun Where kullanici_id=" . $kul_id . " and durum=1";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }

    }

    public function tum_cari_getir($kul_id)
    {
        $sql = "SELECT * FROM cari Where kullanici_id=" . $kul_id . " and durum=1";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }

    }

    public function fat_kayit($fat_turu, $ara_toplam, $indirim, $vergi, $toplam, $mus, $seri, $no, $duz_ta, $va_ta, $ack, $kul_id)
    {

        $insert = array(
            'fatura_turu' => $fat_turu,
            'tutar' => $ara_toplam,
            'vergi' => $vergi,
            'indirim' => $indirim,
            'toplam' => $toplam,
            'kullanici_id' => $kul_id,
            'cari_id' => $mus,
            'tarih' => $duz_ta,
            'vade_tarihi' => $va_ta,
            'seri_no' => $seri,
            'fatura_no' => $no,
            'aciklama' => $ack,

        );

        $this->db->insert('fatura', $insert);
        return $this->db->insert_id();

    }

    public function islem_kayit_fat($is_t, $rel_t, $fat_id, $gir_cik, $toplam, $duz_ta, $ack, $mus, $kul_id)
    {

        $insert = array(
            'islem_turu' => $is_t,
            'relation_type' => $rel_t,
            'relation_id' => $fat_id,
            'giris_cikis' => $gir_cik,
            'tutar' => $toplam,
            'tarih' => $duz_ta,
            'aciklama' => $ack,
            'cari_id' => $mus,
            'kullanici_id' => $kul_id,

        );

        $this->db->insert('islem', $insert);
        return $this->db->insert_id();

    }

    public function fat_item_kayit($fat_id, $item, $qty, $prc, $total, $des, $discount, $tax, $kul_id)
    {

        $insert = array(
            'fatura_id' => $fat_id,
            'hizmet_urun_id' => $item,
            'adet' => $qty,
            'birim_fiyat' => $prc,
            'tutar' => $total,
            'aciklama' => $des,
            'indirim' => $discount,
            'vergi' => $tax,
            'kullanici_id' => $kul_id,

        );

        $this->db->insert('fatura_item', $insert);
        return $this->db->insert_id();

    }

    public function stok_baslangic($id, $kul_id)
    {

        $query = $this->db->query("select * from hizmet_urun Where id=" . $id . " and kullanici_id=" . $kul_id);
        foreach ($query->result_array() as $row) {
            return $row['bas_stok'];
        }

    }

    public function stok_toplam_getir($id, $kul_id)
    {
        $query = $this->db->query("select * from fatura_item Where hizmet_urun_id=" . $id . " and kullanici_id=" . $kul_id);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }

    }

    public function fatura_turu_getir($f_id, $kul_id)
    {

        $query = $this->db->query("select * from fatura Where id=" . $f_id . " and kullanici_id=" . $kul_id);
        foreach ($query->result_array() as $row) {
            return $row['fatura_turu'];
        }

    }

    public function yetki_kontrol_stok_detay($kul_id, $id)
    {
        $query = $this->db->query("select * from hizmet_urun Where id=" . $id . " and kullanici_id=" . $kul_id . "");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function stok_adi($id, $kul_id)
    {

        $query = $this->db->query("select * from hizmet_urun Where id=" . $id . " and kullanici_id=" . $kul_id);
        foreach ($query->result_array() as $row) {
            return $row['adi'];
        }

    }

    public function fatura_getir_duzenle($id, $kul_id)
    {

        $sql = "SELECT * FROM fatura Where id=" . $id . " and kullanici_id=" . $kul_id;
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }

    }

    public function fatura_item_getir_duzenle($id, $kul_id)
    {

        $sql = "SELECT * FROM fatura_item Where fatura_id=" . $id . " and kullanici_id=" . $kul_id;
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }

    }

    public function yetki_kontrol_fatura($id, $kul_id)
    {
        $query = $this->db->query("select * from fatura Where id=" . $id . " and kullanici_id=" . $kul_id . "");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }

}
