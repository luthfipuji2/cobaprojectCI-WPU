<?php

namespace App\Controllers;

use App\Models\KomikModel;
use CodeIgniter\HTTP\Request;

class Komik extends BaseController
{
    protected $komikModel;
    function __construct()
    {
        $this->komikModel = new KomikModel();
    }
    public function index(){
        // $komik = $this->komikModel->findAll();
        $data = [
            'title' => 'Daftar Komik', 
            'komik' => $this->komikModel->getKomik()
        ];

        // dd($komik);
        return view('komik/index', $data);
    }

    public function detail($slug){
        $data = [
            'title' => 'Daftar Komik',
            'komik' => $this->komikModel->getKomik($slug)
        ];

        //jika komik tidak ditemukan
        if(empty($data['komik'])){
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul komik ' . $slug . ' tidak ditemuka');
        }

        return view('komik/detail', $data);
    }

    public function create(){
        $data = [
            'title' => 'Form tambah data komik',
            'komik' => $this->komikModel->getKomik()
        ];

        return view('komik/create', $data);
    }

    public function save(){
        $slug = url_title($this->request->getVar('judul'), '-', true);

        $this->komikModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' =>$slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to('/komik');
    }

}