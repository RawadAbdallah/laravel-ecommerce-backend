<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;

class CartsController extends Controller
{
    public function createCart()
    {
        $user = Auth::user();
        $id_user = $user->id;
        $id_user_type = $user->id_user_type;
        if ($id_user_type !== 3) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Error 401 - Unauthorized',
            ]);
        }

        Cart::create([
            'id_user' => $id_user,
            'cart_status' => 'pending',
        ]);

        return response()->json([
            'status' => 'succes',
        ]);
    }

    

    public function deleteCart()
    {
        $user = Auth::user();
        $id_user = $user->id;
        $id_user_type = $user->id_user_type;

        if ($id_user_type !== 3) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Error 401 - Unauthorized',
            ]);
        }


        $query = "DELETE FROM carts WHERE id_user = $id_user and cart_status = 'pending'";
        $deleted = DB::delete($query);
        if ($deleted)
            return response()->json([
                'status' => 'success',
                'message' => 'Cart deleted',
            ]);

        return response()->json([
            'status' => 'failed',
            'message' => 'Error 404 - Cart Not Found',
        ]);
    }
}
