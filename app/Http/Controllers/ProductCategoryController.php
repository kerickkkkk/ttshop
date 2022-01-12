<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productCategories  = ProductCategory::all()->sortBy('id');
        return view('admin.product-category.index', compact('productCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product-category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ProductCategory::create([
            'name' => $request->name
        ]);

        return redirect()->route('product-categories.index');
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
        $productCategory = ProductCategory::find($id);
        return view('admin.product-category.edit', compact('productCategory'));
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
        ProductCategory::find($id)->update([
            'name' => $request->name
        ]);
        return redirect()->route('product-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ProductCategory = ProductCategory::with('products');
        $productCategoryLinkProduct = $ProductCategory->find($id);

        $productCategoryLinkProductLength =count($ProductCategory->find($id)->products);

        if($productCategoryLinkProductLength > 0){
            return response()->json([
                'success' => false,
                'status' => 'error',
                'message' => "分類: {$productCategoryLinkProduct->name} 刪除失敗，有 {$productCategoryLinkProductLength} 個產品與此分類關聯"
            ]);
            
        }
        
        $productCategoryLinkProduct ->delete();

        return response()->json([
            'success' => true,
            'status' => 'success',
            'message' => "分類: {$productCategoryLinkProduct->name} 刪除成功"
        ]);
    }
}
