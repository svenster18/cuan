<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\TransaksiModel;

class Transaksi extends ResourceController
{
    use ResponseTrait;
    // ambil semua transaksi
    public function index()
    {
        $model = new TransaksiModel();
        $data = $model->findAll();
        return $this->respond(
            [
                'transaksi' => $data
            ],
            200
        );
    }

    // membuat transaksi
    public function create()
    {
        $model = new TransaksiModel();
        $data = [
            'nama_pembeli' => $this->request->getPost('nama_pembeli'),
            'id_produk' => $this->request->getPost('id_produk'),
            'jumlah' => $this->request->getPost('jumlah'),
            'total_harga' => $this->request->getPost('total_harga')
        ];
        $data = json_decode(file_get_contents("php://input"));
        $data = $this->request->getPost();
        $model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data Saved'
            ],
            'transaksi' => $data
        ];

        return $this->respondCreated($response, 201);
    }
}
