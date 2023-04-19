<?php

namespace App\Controllers;

use App\Models\ModelHome;
use App\Models\ModelAdmin;
use App\Models\ModelKasMasjid;
use App\Models\ModelRekening;
use App\Models\ModelDonasi;
use App\Models\ModelPesan;
use App\Models\ModelAgenda;


class Home extends BaseController
{
    public function __construct()
    {
        $this->ModelHome = new ModelHome();
        $this->ModelAdmin = new ModelAdmin();
        $this->ModelKasMasjid = new ModelKasMasjid();
        $this->ModelRekening = new ModelRekening();
        $this->ModelDonasi = new ModelDonasi();
        $this->ModelPesan = new ModelPesan();
        $this->ModelAgenda = new ModelAgenda();


    }
    public function index()
    {
        $pengaturan = $this->ModelAdmin->ViewPengaturan();
        $url = 'https://api.myquran.com/v1/sholat/jadwal/' . $pengaturan['id_kota'] . '/' . date('Y') . '/' . date('m') . '/' . date('d') . '';
        $waktu = json_decode(file_get_contents($url), true);
        $data = [
            'judul' => 'Home',
            'page' => 'v_home',
            'waktu' => $waktu,
            'kas' => $this->ModelKasMasjid->AllData(),
        ];
        return view('v_temp', $data);
    }
    public function Agenda()
    {
        $data = [
            'judul' => 'Agenda',
            'page' => 'Depan/Agenda',
            'agenda' => $this->ModelHome->Agenda(),
        ];
        return view('v_temp', $data);
    }
    public function About()
    {
        $data = [
            'judul' => 'About',
            'page' => 'Depan/About',
        ];
        return view('v_temp', $data);
    }
    public function Kas()
    {
        $data = [
            'judul' => 'Rekap Kas',
            'page' => 'Depan/Kas',
            'kas' => $this->ModelKasMasjid->AllData(),
        ];
        return view('v_temp', $data);
    }

    public function Contact()
    {
        $data = [
            'judul' => 'Kontak',
            'page' => 'Depan/Contact',
        ];
        return view('v_temp', $data);
    }
    public function DonasiMasuk()
    {
        $data = [
            'judul' => 'DonasiMasuk',
            'page' => 'Depan/DonasiMasuk',
            'donasi' => $this->ModelDonasi->AllDataTable(),
        ];
        return view('v_temp', $data);
    }
    public function Infaq()
    {
        $data = [
            'judul' => 'Infaq',
            'page' => 'Depan/Infaq',
            'rek' => $this->ModelRekening->AllData(),
            'donasi' => $this->ModelDonasi->AllData(),
        ];
        return view('v_temp', $data);
    }
    public function InsertDataDonasi()
    {
        $bukti = $this->request->getFile('bukti');
        $namabukti = $bukti->getRandomName();
        $data = [
            'id_rek' => $this->request->getPost('id_rek'),
            'nama_bank' => $this->request->getPost('nama_bank'),
            'no_rekening' => $this->request->getPost('no_rekening'),
            'an' => $this->request->getPost('an'),
            'jumlah' => $this->request->getPost('jumlah'),
            'bukti' => $namabukti,
            'status' => 'Pending'

        ];
        $bukti->move('bukti', $namabukti);
        $this->ModelDonasi->InsertData($data);
        session()->setFlashdata('pesan', 'Berhasil Dikirim !');
        return redirect()->to(base_url('Home/Infaq'));
    }
    public function InsertDataPesan()
    {
        $data = [
            'nama_pesan' => $this->request->getPost('nama_pesan'),
            'wa_pesan' => $this->request->getPost('wa_pesan'),
            'judul_pesan' => $this->request->getPost('judul_pesan'),
            'isi_pesan' => $this->request->getPost('isi_pesan'),
        ];
        $this->ModelPesan->InsertDataPesan($data);
        session()->setFlashdata('pesan', 'Pesan Berhasil Dikirim !');
        return redirect()->to(base_url('Home/Contact'));
    }
}