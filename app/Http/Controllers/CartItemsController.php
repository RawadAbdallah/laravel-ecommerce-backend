<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartItemsController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $id_user = $user->id;
        $id_user_type = $user->id_user_type;

        if ($id_user_type != 3) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Unauthorized',
            ]);
        }
        $cart = Cart::where('id_user', $id_user)->first();
        $cart_items = CartItem::where('id_cart', $cart->id_cart)->get();
        return
            response()->json([
                'status' => 'success',
                'data' => $cart_items,
            ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Token expired - Not Authenticated'
            ]);
        }
        $id_user_type = $user->id_user_type;

        if ($id_user_type != 3) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Unauthorized',
            ]);
        }

        $id_product = $request->id_product;

        $id_user = $user->id;
        $cart = Cart::where('id_user', $id_user)
            ->where('cart_status', 'pending')
            ->first();

        if (!$cart) {
            $cart = new Cart();
            $cart->id_user = $id_user;
            $cart->cart_status = 'pending';
            $cart->save();
        }

        $product = Product::where('id_product', $id_product)->first();

        $cart_item = new CartItem();
        $cart_item->id_cart = $cart->id_cart;
        $cart_item->id_product = $id_product;
        $cart_item->quantity = $request->quantity;
        $cart_item->item_total_price = $product->price * $cart_item->quantity;
        $cart_item->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Item added to cart',
            'body' => $cart_item,
        ]);
    }

    

}
