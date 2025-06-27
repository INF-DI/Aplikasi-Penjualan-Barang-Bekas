<?php

namespace App\Controllers;

use App\Models\BBModel;
use CodeIgniter\Controller;

class Barang extends BaseController
{
    protected $bbModel;

    public function __construct()
    {
        $this->bbModel = new BBModel();
    }

    /**
     * Halaman utama untuk user (menampilkan daftar barang).
     */
    public function indexUser()
    {
        // Ambil keyword pencarian dari URL GET parameter
        $keyword = $this->request->getGet('search');

        if ($keyword) {
            $data['barang'] = $this->bbModel->searchBarang($keyword);
        } else {
            $data['barang'] = $this->bbModel->getAllBarang();
        }

        // Teruskan keyword ke view agar bisa mengisi kembali input pencarian
        $data['searchKeyword'] = $keyword;

        return view('user/index', $data);
    }

    /**
     * Halaman utama untuk admin (menampilkan daftar barang dengan CRUD).
     * Memerlukan otentikasi.
     */
    public function indexAdmin()
    {
        // Ambil keyword pencarian dari URL GET parameter
        $keyword = $this->request->getGet('search');

        if ($keyword) {
            // Memanggil metode pencarian dari model
            $data['barang'] = $this->bbModel->searchDataAdmin($keyword);
        } else {
            // Memanggil metode untuk mendapatkan semua data barang
            $data['barang'] = $this->bbModel->getAllDataAdmin();
        }

        // Teruskan keyword ke view agar bisa mengisi kembali input pencarian
        $data['searchKeyword'] = $keyword;

        // Muat view admin/index.php dan teruskan data
        return view('admin/index', $data);
    }

    /**
     * Menampilkan form tambah barang.
     * Memerlukan otentikasi.
     */
    public function add()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('auth'));
        }
        return view('admin/add');
    }

    /**
     * Menyimpan data barang baru.
     * Memerlukan otentikasi.
     */
    public function save()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('auth'));
        }

        // Validasi form
        $rules = [
            'nama_barang' => 'required|min_length[3]',
            'jenis_barang' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'gambar' => 'uploaded[gambar]|max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $gambar = $this->request->getFile('gambar');
        $namaGambar = $gambar->getRandomName(); // Buat nama random
        $gambar->move(ROOTPATH . 'public/uploads', $namaGambar); // Pindahkan ke public/uploads

        $data = [
            'nama_barang' => $this->request->getPost('nama_barang'),
            'jenis_barang' => $this->request->getPost('jenis_barang'),
            'harga' => $this->request->getPost('harga'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'gambar' => $namaGambar
        ];

        $this->bbModel->insertBarang($data);
        session()->setFlashdata('success', 'Data barang berhasil ditambahkan!');
        return redirect()->to(base_url('admin'));
    }

    /**
     * Menampilkan form edit barang berdasarkan ID.
     * Memerlukan otentikasi.
     *
     * @param int $id_barang
     */
    public function edit($id_barang)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('auth'));
        }

        $data['barang'] = $this->bbModel->getBarangById($id_barang);

        if (empty($data['barang'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Barang dengan ID ' . $id_barang . ' tidak ditemukan.');
        }

        return view('admin/edit', $data);
    }

    /**
     * Memperbarui data barang.
     * Memerlukan otentikasi.
     *
     * @param int $id_barang
     */
    public function update($id_barang)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('auth'));
        }

        // Validasi form
        $rules = [
            'nama_barang' => 'required|min_length[3]',
            'jenis_barang' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
        ];

        $gambarLama = $this->request->getPost('gambar_lama');
        $gambarBaru = $this->request->getFile('gambar');

        // Jika ada gambar baru diupload
        if ($gambarBaru->isValid() && !$gambarBaru->hasMoved()) {
            $rules['gambar'] = 'max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $data = [
            'nama_barang' => $this->request->getPost('nama_barang'),
            'jenis_barang' => $this->request->getPost('jenis_barang'),
            'harga' => $this->request->getPost('harga'),
            'deskripsi' => $this->request->getPost('deskripsi'),
        ];

        if ($gambarBaru->isValid() && !$gambarBaru->hasMoved()) {
            // Hapus gambar lama jika ada
            if ($gambarLama && file_exists(ROOTPATH . 'public/uploads/' . $gambarLama)) {
                unlink(ROOTPATH . 'public/uploads/' . $gambarLama);
            }
            $namaGambarBaru = $gambarBaru->getRandomName();
            $gambarBaru->move(ROOTPATH . 'public/uploads', $namaGambarBaru);
            $data['gambar'] = $namaGambarBaru;
        }

        $this->bbModel->updateBarang($id_barang, $data);
        session()->setFlashdata('success', 'Data barang berhasil diperbarui!');
        return redirect()->to(base_url('admin'));
    }

    /**
     * Menghapus data barang.
     * Memerlukan otentikasi.
     *
     * @param int $id_barang
     */
    public function delete($id_barang)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('auth'));
        }

        $barang = $this->bbModel->getBarangById($id_barang);

        if ($barang) {
            // Hapus gambar fisik
            if ($barang['gambar'] && file_exists(ROOTPATH . 'public/uploads/' . $barang['gambar'])) {
                unlink(ROOTPATH . 'public/uploads/' . $barang['gambar']);
            }
            $this->bbModel->deleteBarang($id_barang);
            session()->setFlashdata('success', 'Data barang berhasil dihapus!');
        } else {
            session()->setFlashdata('error', 'Barang tidak ditemukan!');
        }

        return redirect()->to(base_url('admin'));
    }
}