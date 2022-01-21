<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function clear()
    {
        \Cart::clear();
        return 'clear';
    }
    public function content()
    {
        dd(\Cart::getContent());
    }

    // 以上測試用 /////////////////

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::find($request->id);

        \Cart::add(array(
            'id' => $product->id, 
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $request->qty,
            'attributes' => [
                'image' => $product->image
            ]
        ));

        return 'addCart success';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        \Cart::update($request->id, [
            'quantity' => [
                'relative' => false,
                'value' => $request->qty
            ], // new item price, price can also be a string format like so: '98.67'
        ]);

        $item = \Cart::get($request->id);
        return $item;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        \Cart::remove($request -> id);

        if(\Cart::isEmpty()){
            return redirect()->route('products.index')
                ->with([
                    'success' => false,
                    'status' => 'error',
                    'message' => "請選擇商品到購物車"
                ]);
        }
        
        return "刪除成功 產品編號： $request -> id";
    }


    // 
    public function step01()
    {
        $cart = \Cart::getContent();
        return view('front.cart.step01', compact('cart'));
    }

    public function step02()
    {
        return view('front.cart.step02');
    }
    
    public function step02Store(Request $request)
    {
        session([
            'payment' => $request->payment,
            'shipment' => $request->shipment,
        ]);
        // dd($request->session()->all());
        
        return redirect()->route('carts.step03.index');
    }

    public function step03()
    {
        return view('front.cart.step03');
    }

    public function step03Store(Request $request)
    {
        if( !is_null(Auth::user()) ){
            $id = Auth::user()->id;
        };
        $order = Order::create([
            'order_no' => 'DP' . time(),
            'user_id' => $id,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'payment' => session('payment'),
            'shipment' => session('shipment'),
        ]);

        $items = \Cart::getContent();

        foreach ($items as $item){
            $product = Product::find($item->id);
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => $item->quantity,
                'image' => $product->image,
            ]);
        }

        // \Cart::clear();
        
        return redirect()->route('carts.step04.index', ['order_no'=> $order->order_no]);
    }
    
    public function step04($orderNo)
    {
        $order = Order::with('orderDetails')->where('order_no', $orderNo)->first();
        return view('front.cart.step04', compact('order'));
    }
}
