<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;

class Mahasiswa extends BaseController
{
    protected $mahasiswaModel;

    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
    }

    /**
     * TAHAP READ: Menampilkan seluruh daftar biodata mahasiswa
     */
    public function index()
    {
        $data = [
            'title'     => 'Daftar Biodata Mahasiswa',
            'mahasiswa' => $this->mahasiswaModel->orderBy('created_at', 'DESC')->findAll(),
        ];

        return view('mahasiswa/index', $data);
    }

    /**
     * TAHAP CREATE: Menampilkan form tambah biodata baru
     */
    public function create()
    {
        session(); // Inisialisasi session untuk flashdata & validation errors
        
        $data = [
            'title'      => 'Tambah Biodata Mahasiswa Baru',
            'validation' => \Config\Services::validation(),
        ];

        return view('mahasiswa/create', $data);
    }

    /**
     * TAHAP CREATE (STORE): Menyimpan data form ke database
     */
    public function store()
    {
        // Validasi input data
        $rules = [
            'nim' => [
                'rules'  => 'required|min_length[5]|max_length[20]|is_unique[mahasiswa.nim]',
                'errors' => [
                    'required'   => 'NIM tidak boleh kosong.',
                    'min_length' => 'NIM minimal 5 karakter.',
                    'is_unique'  => 'NIM ini sudah terdaftar pada sistem.'
                ]
            ],
            'nama' => [
                'rules'  => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required'   => 'Nama lengkap wajib diisi.',
                    'min_length' => 'Nama lengkap minimal 3 karakter.'
                ]
            ],
            'jenis_kelamin' => [
                'rules'  => 'required|in_list[Laki-laki,Perempuan]',
                'errors' => [
                    'required' => 'Pilih jenis kelamin mahasiswa.'
                ]
            ],
            'prodi' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Program studi wajib dipilih.'
                ]
            ],
            'alamat' => [
                'rules' => 'permit_empty',
            ]
        ];

        if (!$this->validate($rules)) {
            // Redirect kembali ke form dengan membawa input lama dan pesan error validasi
            return redirect()->to('/mahasiswa/create')->withInput()->with('validation', $this->validator);
        }

        // Simpan data ke database melalui Model
        $this->mahasiswaModel->save([
            'nim'           => $this->request->getPost('nim'),
            'nama'          => $this->request->getPost('nama'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'prodi'         => $this->request->getPost('prodi'),
            'alamat'        => $this->request->getPost('alamat'),
        ]);

        // Berikan notifikasi sukses menggunakan session flashdata
        session()->setFlashdata('pesan', 'Biodata mahasiswa baru berhasil disimpan ke database.');

        return redirect()->to('/mahasiswa');
    }
}
