<?php

namespace App\Controllers;

class Pages extends BaseController
{
    //url kalo index gaperlu di tulis functionnya
    public function index()
    {
        // return view('pages/home');
        $data =[
            'title' => 'Home | Coba CI dari Web Programming UNPAS', 
            'tes'   => ['satu', 'dua', 'tiga']
        ];
        return view('pages/home', $data);
    }

    public function about(){
        // return view('pages/about');
        $data =[
            'title' => 'About Me'
        ];
        return view('pages/about', $data);
    }

    public function contact(){
        $data = [
            'title' => 'Contact Us',
            'alamat' => [
                [
                    'tipe' => 'Rumah', 
                    'alamat' => 'Jl. Agus Salim',
                    'kota' => 'ngawi'
                ],
                [
                    'tipe' => 'Kantor',
                    'alamat' => 'Jl. Cempaka',
                    'kota' => 'Solo'
                ]
            ],
        ];

        return view('pages/contact', $data);
    }
}
