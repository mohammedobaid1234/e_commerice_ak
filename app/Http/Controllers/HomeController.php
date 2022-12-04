<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller{
    public function show($id){
        $product = Product::with('category')->where('id', '=', $id)->firstOrFail();
        return view('fronts.product-details', [
            'product' => $product,
        ]);
    }
    
    public function showProductsForVendor($id){
        $products = Product::with('category')->where('user_id', '=', $id)->get();
        return view('fronts.vendor_products', [
            'products' => $products,
        ]);
    }
}
