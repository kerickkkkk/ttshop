<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;

class FrontController extends Controller
{
    public function products()
    {
        $products = Product::with('productCategory')->get();
        $productCategories = ProductCategory::all();
        return view('front.products.index', compact('products', 'productCategories'));
    }
}
