<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function deleteAProduct(Request $request): JsonResponse
    {
        $rowAffected = DB::table('product')
            ->where('productid', '=', $request->productid)
            ->delete();

        if ($rowAffected != 0):
            return response()->json([
                'status' => true
            ]);
        endif;

        return response()->json([
            'status' => false
        ]);
    }

    public function updateProduct(Request $request): JsonResponse
    {
        $dataToUpdate = [
            "product_name" => $request->product_name,
            "slug" => $request->slug,
            "price" => $request->price,
            "quantity" => $request->quantity,
            "ingredient" => $request->ingredient,
            "thumpnail2" => $request->thumpnail2,
            "origin" => $request->origin,
            "dimensions" => $request->dimensions,
            "color" => $request->color,
            "description" => $request->description,
            "product_status" => $request->product_status,
            "updated_at" => date("Y-m-d H:i:s")
        ];

        $rowAffected = DB::table('product')
            ->where('productid', '=', $request->productid)
            ->update($dataToUpdate);

        if ($rowAffected != 0):
            return response()->json([
                "status" => true,
                "data" => 1
            ]);
        endif;

        return response()->json([
            "status" => false,
            "data" => 0
        ]);
    }

    public function addProduct(Request $request): JsonResponse
    {
        $product = new Product;
        $insertColumn = [
            "product_name", "slug", "price", "quantity", "ingredient", "thumpnail2",
            "origin", "promotionid", "dimensions", "color", "evaluate_star", 
            "evaluate_quantity", "description", "product_status" 
        ];
        $product->fill($request->only($insertColumn));
        $product->created_at = date('Y-m-d H:i:s');
        $product->updated_at = null;
        $data = $product->save();
        if ($data):
            return response()->json([
                "status" => true,
                "data" => $product
            ]);
        endif;

        return response()->json([
            "status" => false,
            "data" => []
        ]);
    }
}
