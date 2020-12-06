<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ProductModel;

class Product extends Controller
{
	public function index()
	{
        // Call view "Product View"
		echo view('product_view');
	}

    // Get All Products
    public function getProduct()
    {
        $model = new ProductModel();
        $data = $model->findAll();
        return json_encode($data);
    }

    // Create product
    public function create(){
        $method = $this->request->getMethod(true);
        // Insert data to database if method "POST"
        if($method == 'POST'){
            $model = new ProductModel();
            $json = $this->request->getJSON();
            $data = [
                'product_name'  => $json->product_name,
                'product_price' => $json->product_price
            ];
            $model->insert($data);
        }else{
            // Call View "Add Product" if method "GET"
            echo view('add_product_view');
        } 
    }

    // Update product
    public function update($id = null){
        $method = $this->request->getMethod(true);
        $model = new ProductModel();
        // Insert data to database if method "PUT"
        if($method == 'PUT'){
            $json = $this->request->getJSON();
            $data = [
                'product_name' => $json->product_name,
                'product_price' => $json->product_price
            ];
            $model->update($id, $data);
        }else{
            // Call View "Edit Product" if method "GET"
            $data['data'] = $model->find($id);
            echo view('edit_product_view', $data);
        } 
    }

    // Delete product
    public function delete($id = null){
        $model = new ProductModel();
        $model->delete($id);
    }

}
