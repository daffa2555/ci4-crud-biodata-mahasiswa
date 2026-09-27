<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table            = 'mahasiswa';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nim',
        'nama',
        'jenis_kelamin',
        'prodi',
        'alamat'
    ];

    // Mengaktifkan fitur otomatis pengisian timestamp CI4
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Aturan Validasi Model
    protected $validationRules = [
        'nim'           => 'required|min_length[5]|max_length[20]|is_unique[mahasiswa.nim,id,{id}]',
        'nama'          => 'required|min_length[3]|max_length[100]',
        'jenis_kelamin' => 'required|in_list[Laki-laki,Perempuan]',
        'prodi'         => 'required',
        'alamat'        => 'permit_empty',
    ];

    protected $validationMessages = [
        'nim' => [
            'required'  => 'NIM wajib diisi.',
            'is_unique' => 'NIM sudah terdaftar di database.',
        ],
        'nama' => [
            'required'   => 'Nama lengkap wajib diisi.',
            'min_length' => 'Nama minimal terdiri dari 3 karakter.',
        ],
        'jenis_kelamin' => [
            'required' => 'Silakan pilih jenis kelamin.',
        ],
        'prodi' => [
            'required' => 'Program studi wajib dipilih.',
        ],
    ];

    protected $skipValidation = false;
}
