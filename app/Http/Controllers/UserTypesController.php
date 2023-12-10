<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserType;

class UserTypesController extends Controller
{
    public function create_user_type(){
        $admin = UserType::insert([
            "id_user_type" => 1,
            "user_type" => "admin"
        ]);

        $seller = UserType::insert([
            "id_user_type" => 2,
            "user_type" => "seller"
        ]);

        $customer = UserType::insert([
            "id_user_type" => 3,
            "user_type" => "customer"
        ]);
    }
}
