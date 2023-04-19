<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelKasMasjid;

class KasMasjid extends BaseController
{
    public function __construct()
    {
        $this->ModelKasMasjid = new ModelKasMasjid;
    }
    public function index()
    {
        $data = [
            'judul' => 'Rekap Kas Masjid',
            'subjudul' => '',
            'menu' => 'kas-masjid',
            'submenu' => 'rekap-masjid',
            'page' => 'v_rekap_kas_masjid',
            'kas' => $this->ModelKasMasjid->AllData(),
        ];
        return view('v_temp_admin', $data);
    }
    public function Masuk()
    {
        $data = [
            'judul' => 'Pemasukan Uang Kas Masjid',
            'subjudul' => '',
            'menu' => 'kas-masjid',
            'submenu' => 'masuk-masjid',
            'page' => 'kas-masjid/v_masuk_kas_masjid',
            'kas' => $this->ModelKasMasjid->Masuk(),

        ];
        return view('v_temp_admin', $data);
    }
    public function Keluar()
    {
        $data = [
            'judul' => 'Pengeluaran Uang Kas Masjid',
            'subjudul' => '',
            'menu' => 'kas-masjid',
            'submenu' => 'masuk-masjid',
            'page' => 'kas-masjid/v_keluar_kas_masjid',
            'kas' => $this->ModelKasMasjid->Keluar(),

        ];
        return view('v_temp_admin', $data);
    }
    public function InsertDataKas()
    {
        $data = [
            'ket' => $this->request->getPost('ket'),
            'tanggal' => $this->request->getPost('tanggal'),
            'kas_masuk' => $this->request->getPost('kas_masuk'),
            'status' => 'masuk',
            'kas_keluar' => 0
        ];
        $this->ModelKasMasjid->InsertDataKas($data);
        session()->setFlashdata('pesan', 'Berhasil Disimpan !');
        return redirect()->to(base_url('KasMasjid/Masuk'));
    }
    public function InsertDataKasKeluar()
    {
        $data = [
            'ket' => $this->request->getPost('ket'),
            'tanggal' => $this->request->getPost('tanggal'),
            'kas_masuk' => 0,
            'status' => 'keluar',
            'kas_keluar' => $this->request->getPost('kas_keluar')
        ];
        $this->ModelKasMasjid->InsertDataKas($data);
        session()->setFlashdata('pesan', 'Berhasil Disimpan !');
        return redirect()->to(base_url('KasMasjid/Keluar'));
    }
    public function UpdateDataKas($id_kas_masjid)
    {
        $data = [
            'id_kas_masjid' => $id_kas_masjid,
            'ket' => $this->request->getPost('ket'),
            'tanggal' => $this->request->getPost('tanggal'),
            'kas_masuk' => $this->request->getPost('kas_masuk')
        ];
        $this->ModelKasMasjid->UpdateDataKas($data);
        session()->setFlashdata('pesan', 'Berhasil Diupdate !');
        return redirect()->to(base_url('KasMasjid/Masuk'));
    }
    public function UpdateDataKasKeluar($id_kas_masjid)
    {
        $data = [
            'id_kas_masjid' => $id_kas_masjid,
            'ket' => $this->request->getPost('ket'),
            'tanggal' => $this->request->getPost('tanggal'),
            'kas_masuk' => 0,
            'kas_keluar' => $this->request->getPost('kas_keluar')
        ];
        $this->ModelKasMasjid->UpdateDataKas($data);
        session()->setFlashdata('pesan', 'Berhasil Diupdate !');
        return redirect()->to(base_url('KasMasjid/Keluar'));
    }

    public function HapusDataKas($id_kas_masjid)
    {
        $data = [
            'id_kas_masjid' => $id_kas_masjid,
        ];
        $this->ModelKasMasjid->HapusDataKas($data);
        session()->setFlashdata('pesan', 'Berhasil Dihapus !');
        return redirect()->to(base_url('KasMasjid/Masuk'));
    }
    public function HapusDataKasKeluar($id_kas_masjid)
    {
        $data = [
            'id_kas_masjid' => $id_kas_masjid,
        ];
        $this->ModelKasMasjid->HapusDataKas($data);
        session()->setFlashdata('pesan', 'Berhasil Dihapus !');
        return redirect()->to(base_url('KasMasjid/Keluar'));
    }
    public function ViewLaporan()
    {
        $bulan = $this->request->getPost('bulan');
        $tahun = $this->request->getPost('tahun');
        $data = [
            'kas' => $this->ModelKasMasjid->AllData($bulan, $tahun),
            'bulan' => $bulan,
            'tahun' => $tahun
        ];
        $rensponse = [
            'data' => view('v_rekap_kas_masjid', $data)
        ];
        echo json_encode($rensponse);
    }
    public function Laporan()
    {
        $data = [
            'judul' => 'Print Laporan',
            'subjudul' => '',
            'menu' => 'laporan',
            'submenu' => '',
            'page' => 'v_laporan',
        ];
        return view('v_temp_admin', $data);
    }


}