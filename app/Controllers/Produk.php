<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProdukModel;

class Produk extends ResourceController
{
    use ResponseTrait;
    // ambil semua produk
    public function index()
    {
        $model = new ProdukModel();
        $data = $model->findAll();
        return $this->respond(
            [
                'produk' => $data
            ],
            200
        );
    }

    // create a product
    public function create()
    {
        $model = new ProdukModel();
        $data = [
            'nama_produk' => $this->request->getPost('nama_produk'),
            'harga_produk' => $this->request->getPost('harga_produk')
        ];
        $data = json_decode(file_get_contents("php://input"));
        $data = $this->request->getPost();
        $model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data Saved'
            ]
        ];

        return $this->respondCreated($data, 201);
    }
}
