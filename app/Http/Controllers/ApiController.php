<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    //
    public function product_stock()
    {
        return view('api.product_stock');
    }


    public function user_api()
    {

        if ($data = User::all()) {
            return response()->json([
                'status' => true,
                'message' => 'Success get data',
                'data'  => [
                    'users' => $data
                ]
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Failed get data',
                'data'  => []
            ]);
        }
    }
}
