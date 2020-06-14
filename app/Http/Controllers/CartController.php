<?php

namespace App\Http\Controllers;

use Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function delete(Request $request)
    {
        $item = Product::find($request->id);
        $cart= Cart::instance('shopping')->search(function($cartItem, $rowId) use($item) {return $cartItem->id == $item->id;})->first();
        if($cart!==null){
            Cart::instance('shopping')->remove($cart->rowId);
        }

        return Cart::instance('shopping')->count();
    }
}
