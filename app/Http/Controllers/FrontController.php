<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\EventCategory;
use App\Models\ProductCategory;

class FrontController extends Controller
{
    // 產品前面
    public function products(Request $request)
    {
        $currentCategory = is_null($request->currentCategory) ? 'all' : $request->currentCategory ;

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

    // 產品前面
    public function events(Request $request)
    {
        $currentCategory = is_null($request->currentCategory) ? 'all' : $request->currentCategory ;

        if( $currentCategory !== 'all' &&  $currentCategory >= 0){
            $events = Event::where('event_category_id', $currentCategory)->get();
        }else{
            $events = Event::with('eventCategory')->get();
        }
        $eventCategories = EventCategory::all();
        return view('front.events.index', compact('events', 'eventCategories','currentCategory'));
    }

    // 單一產品
    public function eventsShow($id)
    {
        $event = Event::find($id);
        $currentCategory = $event->event_category_id;
        $eventCategories = EventCategory::all();
        // 產品相同類別
        $relativeEvents = Event::where('event_category_id', $event->event_category_id)->get();
        return view('front.events.show', compact('event','eventCategories' ,'relativeEvents','currentCategory'));
    }
    
    // 關於我們
    public function about()
    {
        return view('front.about.index');
    }

    // FAQ
    public function faq()
    {
        return view('front.faq.index');
    }
}
