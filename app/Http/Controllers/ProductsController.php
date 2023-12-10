<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class ProductsController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return response()->json([
            'status' => 'success',
            'body' => $products
        ]
        );
    }
    public function createProduct(Request $request)
    {
        $user = Auth::user();
        $id_user_type = $user->id_user_type;
        $id_user = $user->id;

        if ($id_user_type !== 2) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Error 401 - Unauthorized'
            ]);
        }

        Product::create([
            "name" => $request->name,
            "description" => $request->description,
            "price" => $request->price,
            "stock" => $request->stock,
            "imgUrl" => $request->imgUrl,
            "id_user" => $id_user,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'product created successfully'
        ]);

    }

    public function deleteProduct(Request $request)
    {
        $user = Auth::user();
        $id_user_type = $user->id_user_type;
        $id_user = $user->id;
        if ($id_user_type !== 2) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Error 401 - Unauthorized'
            ]);
        }

        $id_product = $request->id_product;

        $product = Product::find($id_product);

        if ($product) {
            $product->delete();
            return response()->json([
                'status' => 'success',
                'message' => ('product: ' . $product->name . ' is deleted succesfully'),
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'product not found'
            ]);
        }
    }

    public function updateProduct(Request $request)
    {
        $user = Auth::user();
        $id_user_type = $user->id_user_type;
        $id_user = $user->id;
        if ($id_user_type !== 2) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Error 401 - Unauthorized'
            ]);
        }
        $id_product = $request->id_product;

        if (!$id_product) {
            return response()->json([
                'status' => 'failed',
                'message' => 'id_product not found',
            ]);
        }

        $product = Product::find($id_product);

        $req_name = $request->name;
        $req_description = $request->description;
        $req_price = $request->price;
        $req_stock = $request->stock;
        $req_imgUrl = $request->imgUrl;

        if ($product) {
            if ($req_name && $req_name != $product->name) {
                $product->name = $req_name;
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Nothing to update',
                ]);
            }

            if ($req_description && $req_description != $product->description) {
                $product->description = $req_description;
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Nothing to update',
                ]);
            }

            if ($req_price && $req_price != $product->price) {
                $product->price = $req_price;
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Nothing to update',
                ]);
            }

            if ($req_stock && $req_stock != $product->stock) {
                $product->stock = $req_stock;
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Nothing to update',
                ]);
            }

            if ($req_imgUrl  && $req_imgUrl != $product->imgUrl) {
                $product->imgUrl = $req_imgUrl;
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Nothing to update',
                ]);
            }

            $product->save();
            return response()->json([
                'status' => 'success',
                'message' => ('product: ' . $product->name . ' is updated successfully')
            ]);
        }
    }
}
