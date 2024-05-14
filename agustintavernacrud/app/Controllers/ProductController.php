<?php
namespace App\Controllers;


use app\Models\Product;

class ProductController
{

    public function index():array
    {
        $res = (new Product)->getAllProducts();
        return $res;
    }

    public function store()
    {
        $request = json_decode(file_get_contents('php://input'), true);
        $res = (new Product)->store($request);
        return $res;
    }

    public function update()
    {
        $request = json_decode(file_get_contents('php://input'), true);
        $res = (new Product)->update($request);
        return $res;
    }

    public function destroy()
    {
        $request = json_decode(file_get_contents('php://input'), true);
        $res = (new Product)->destroy($request['id']);
        return $request;
    }
}