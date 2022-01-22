<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;

class FrontController extends Controller
{
    // 產品前面
    public function products(Request $request)
    {
        $currentCategory = $request->currentCategory;

        if( $currentCategory !== 'all' &&  $currentCategory >= 0){
            $products = Product::where('product_category_id', $currentCategory)->get();
        }else{
            $products = Product::with('productCategory')->get();
        }
        $productCategories = ProductCategory::all();
        return view('front.products.index', compact('products', 'productCategories','currentCategory'));
    }
    // 單一產品
    public function productsShow($id)
    {
        $product = Product::with('productImages')->find($id);
        $currentCategory = $product->product_category_id;
        // dd($product);
        $productCategories = ProductCategory::all();
        // 產品相同類別
        $relativeProducts = Product::where('product_category_id', $product->product_category_id)->get();
        return view('front.products.show', compact('product','productCategories' ,'relativeProducts','currentCategory'));
    }
}
