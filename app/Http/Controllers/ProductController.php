<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getAll()
    {
        $data = Product::all();
        if ($data->count() <= 0):
            return response()->json([
                'status' => false,
                'data' => []
            ]);
        endif;

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }
}
