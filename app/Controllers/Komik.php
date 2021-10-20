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
        return view('komik/index', $data);
    }

    public function create(){
        // session(); => di taruh di base controller 
        $data = [
            'title' => 'Form tambah data komik',
            'komik' => $this->komikModel->getKomik(),
            'validation' => \Config\Services::validation()
        ];
        
        return view('komik/create', $data);
    }
    
    public function save(){
        //validation
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[komik.judul]',
                'errors' => [
                    'required' => '{field} komik harus diisi.',
                    'is_unique' => '{field} komik sudah terdaftar'
                ]
            ],
            'penulis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} komik harus diisi.'
                ]
            ], 
            'penerbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} komik harus diisi.'
                ]
            ], 
            'sampul' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} komik harus diisi.'
                ]
            ], 
            ])){
                $validation = \Config\Services::validation();
                // dd($validation);
                return redirect()->to('komik/create')->withInput()->with('validation', $validation);
            }
            
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
    
    public function detail($slug){
        $data = [
            'title' => 'Daftar Komik',
            'komik' => $this->komikModel->getKomik($slug)
        ];

        //jika komik tidak ditemukan
        if(empty($data['komik'])){
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul komik ' . $slug . ' tidak ditemukan');
        }

        return view('komik/detail', $data);
    }

    public function delete($id){
        $this->komikModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/komik');
    }

    public function edit($slug){
        $data = [
            'title' => 'Form ubah data komik',
            'komik' => $this->komikModel->getKomik(),
            'validation' => \Config\Services::validation(),
            'komik' =>$this->komikModel->getKomik($slug)
        ];
        
        return view('komik/edit', $data);
    }

    public function update($id){
        // dd($this->request->getVar());
        $komikLama = $this->komikModel->getKomik($this->request->getVar('slug'));
        if ($komikLama['judul'] == $this->request->getVar('judul')){
            $rule_judul = 'required';
        }else{
            $rule_judul = 'required|is_unique[komik.judul]';
        }

        if (!$this->validate([
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} komik harus diisi.',
                    'is_unique' => '{field} komik sudah terdaftar'
                ]
            ],
            'penulis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} komik harus diisi.'
                ]
            ], 
            'penerbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} komik harus diisi.'
                ]
            ], 
            'sampul' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} komik harus diisi.'
                ]
            ], 
            ])){
                $validation = \Config\Services::validation();
                // dd($validation);
                return redirect()->to('komik/edit/' . $this->request->getVar('slug'))->withInput()->with('validation', $validation);
            }

        $slug = url_title($this->request->getVar('judul'), '-', true);

            $this->komikModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' =>$slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul')
        ]);
        
        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        return redirect()->to('/komik');
    }
}