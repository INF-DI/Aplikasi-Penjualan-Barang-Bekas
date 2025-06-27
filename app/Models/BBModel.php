<?php

namespace App\Models;

use CodeIgniter\Model;

class BBModel extends Model
{
    // --- KONFIGURASI UTAMA MODEL UNTUK TABEL tbl_barang ---
    // Karena sebagian besar operasi Anda berkaitan dengan barang,
    // kita jadikan 'tbl_barang' sebagai tabel default untuk model ini.
    protected $table      = 'tbl_barang';
    protected $primaryKey = 'id_barang';

    // Kolom-kolom yang boleh diisi untuk tbl_barang
    protected $allowedFields = ['nama_barang', 'jenis_barang', 'harga', 'deskripsi', 'gambar'];

    // Konfigurasi tambahan (sesuaikan jika Anda punya kebutuhan lain)
    protected $useAutoIncrement = true;
    protected $returnType       = 'array'; // Atau 'object' jika Anda menggunakan Entity
    protected $useSoftDeletes   = false;
    protected $skipValidation   = false; // Pastikan ini false jika Anda ada validasi

    // --- PROPERTI UNTUK TABEL LAIN (tbl_login) ---
    // Ini tetap dipertahankan untuk referensi, tapi tidak otomatis digunakan oleh metode bawaan Model
    protected $table_login = 'tbl_login';

    /**
     * Mengambil data admin berdasarkan username.
     * Metode ini secara eksplisit menunjuk ke tbl_login menggunakan $this->db->table().
     *
     * @param string $username
     * @return array|null
     */
    public function getAdminByUsername($username)
    {
        return $this->db->table($this->table_login) // Menggunakan $this->db->table() untuk tabel lain
                         ->where('username', $username)
                         ->get()
                         ->getRowArray();
    }

    // --- METODE UNTUK tbl_barang ---
    // Sekarang metode ini menggunakan fungsi bawaan CodeIgniter\Model ($this->orderBy, $this->findAll, dll.)
    // karena $table sudah diatur ke 'tbl_barang'.

    /**
     * Mengambil semua data barang.
     *
     * @return array
     */
    public function getAllBarang()
    {
        return $this->orderBy('id_barang', 'DESC')->findAll();
    }

    /**
     * Mencari barang berdasarkan jenis atau nama barang.
     *
     * @param string $keyword
     * @return array
     */
    public function searchBarang($keyword)
    {
        // Menggunakan like() dan orLike() dari Query Builder Model
        return $this->like('jenis_barang', $keyword)
                    ->orLike('nama_barang', $keyword)
                    ->findAll();
    }

    /**
     * Menyimpan data barang baru.
     *
     * @param array $data
     * @return bool
     */
    public function insertBarang($data)
    {
        return $this->insert($data); // Menggunakan metode insert() bawaan Model
    }

    /**
     * Mengambil data barang berdasarkan ID.
     *
     * @param int $id
     * @return array|null
     */
    public function getBarangById($id)
    {
        return $this->find($id); // Menggunakan metode find() bawaan Model
    }

    /**
     * Memperbarui data barang.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateBarang($id, $data)
    {
        return $this->update($id, $data); // Menggunakan metode update() bawaan Model
    }

    /**
     * Menghapus data barang.
     *
     * @param int $id
     * @return bool
     */
    public function deleteBarang($id)
    {
        return $this->delete($id); // Menggunakan metode delete() bawaan Model
    }

    // --- Tambahan untuk kebutuhan admin/barang jika diperlukan ---
    // Ini adalah metode yang akan dipanggil di controller admin untuk tampilan utama
    public function getAllDataAdmin()
    {
        return $this->orderBy('id_barang', 'DESC')->findAll();
    }

    public function searchDataAdmin($keyword)
    {
        return $this->like('jenis_barang', $keyword)
                    ->orLike('nama_barang', $keyword)
                    ->findAll();
    }
}