<?php
namespace app\Models;

require_once '../config.php';
 
use database;

class Product extends Database{
    protected $table = 'productos';

    public function find($id):array
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = {$id}";
        return $this->query($sql)->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllProducts():array
    {
        $products = [];
        $sql = "SELECT * FROM " . $this->table;
        $allProducts = $this->query($sql);

        foreach($allProducts as $product){
            array_push($products, $product);
        }
        return $products;
    }

    public function store($request)
    {
        if(!is_numeric($request['precio'])){
            http_response_code(422);
            return "El campo precio solo acepta carácteres númericos.";
        }
        $columns = implode(', ', array_keys($request));
        $values = "'" . implode("', '", array_values($request)) . "'";

        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$values})";

        $this->query($sql);

        $idProduct = $this->dbConnection->insert_id;
        return $this->find($idProduct);
    }

    public function update($request)
    {
        if(!is_numeric($request['precio'])){
            http_response_code(422);
            return "El campo precio solo acepta carácteres númericos.";
        }
        $product = $this->find($request['id']);
        if(!$product){
            http_response_code(422);
            return "Producto no encontrado.";
        }
        $fields = [];
        foreach ($request as $key => $value) {
            $fields[] = "{$key} = '{$value}'";
        }
        $fields = implode(', ', $fields);
        $sql = "UPDATE {$this->table} SET {$fields} WHERE id = {$request['id']}";
        $this->query($sql);
        return $this->find($request['id']);
    }

    public function destroy($id)
    {
        $product = $this->find($id);
        if(!$product){
            http_response_code(422);
            return "Producto no encontrado.";
        }
        $sql = "DELETE FROM {$this->table} WHERE id = {$id}";
        $this->query($sql);
        return 'Producto eliminado correctamente';
    }

    public function moneyConverter()
    {
        $products = $this->getAllProducts();
        foreach ($products as $product) {
            $formattedProducts[] = [
                'nombre_producto' => $product['nombre_producto'],
                'precio' => $product['precio'],
                'precio_usd' => $this->convertToUsd($product['precio'])
            ];
        }
        return $formattedProducts;
    }

    private function convertToUsd($precio) {
        return round($precio / USD_RATE, 2);
    }
}