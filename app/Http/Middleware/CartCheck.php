<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CartCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(\Cart::isEmpty()){
            return redirect()->route('products.index')
                ->with([
                    'success' => false,
                    'status' => 'error',
                    'message' => "請選擇商品到購物車"
                ]);
        }else{
            return $next($request);
        }
    }
}
