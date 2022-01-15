<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at','desc')->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProductCategory::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('image')){
            $imagePath =  Storage::put('/public/product', $request->image);
        }


        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imagePath,
            'content' => $request->content,
            'description' => $request->description,
            'product_category_id' => $request->product_category_id
        ]);


        if( $request->hasFile('images')){
            foreach($request->images as $image){
                $path = Storage::put('/public/product', $image);
                ProductImage::create([
                    'product_id'=> $product->id,
                    'image' => $path,
                ]);
            }
        }

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        
        $product = Product::with('productImages')->find($id);
        $categories  = ProductCategory::get();
        return view('admin.products.edit', compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if($request->hasFile('image')){
            $imagePath =  Storage::put('/public/product', $request->image);
        }else{
            $imagePath = $product->image;
        }
        $product = Product::find($id);

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imagePath,
            'content' => $request->content,
            'description' => $request->description,
            'product_category_id' => $request->product_category_id
        ]);


        if( $request->hasFile('images')){
            foreach($request->images as $image){
                $path = Storage::put('/public/product', $image);
                ProductImage::create([
                    'product_id'=> $product->id,
                    'image' => $path,
                ]);
            }
        }

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $product = Product::with('productImages')->find($id);
        Storage::delete( $product->image);
        if(count($product->productImages) >0 ){
            foreach($product->productImages as $image){
                Storage::delete($image->image);
                $image->delete();
            }
        }

        $product->delete();

        // return response()->json([
        //     'success' => true,
        //     'status' => 'success',
        //     'message' => "{$product->name} 刪除成功"
        // ]);
        return redirect()->route('products.index');

    }

    public function delete(Request $request)
    {
        $productImage = ProductImage::find($request->id);
        
        Storage::delete($productImage->image);
        
        $productImage->delete();

        $msg = [
            'success' => true,
        ];
        return compact('msg');
    }
}
