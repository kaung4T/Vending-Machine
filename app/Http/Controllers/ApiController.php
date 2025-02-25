<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function apiProductAll()
    {
        try {
            $products = Products::all();
        }
        catch (\Exception $e) {
            $error = [
                "error" => $e
            ];
            return response()->json($error);
        }
        return response()->json($products);
    }

    public function apiProductSingle($id)
    {
        try {
            $product = Products::find($id);
        }
        catch (\Exception $e) {
            $error = [
                "error" => $e
            ];
            return response()->json($error);
        }
        return response()->json($product);
    }

    public function apiProductStore(Request $request)
    {
        try {
            $product = Products::create([
                'name' => $request->name,
                'price' => $request->price,
                'quantityAvailable' => $request->quantityAvailable
            ]);
        }
        catch (\Exception $e) {
            $error = [
                "error" => $e
            ];
            return response()->json($error);
        }
        return response()->json($product, 201);
    }

    public function apiProductUpdate(Request $request, $id)
    {
        try {
            $product = Products::find($id);
            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'quantityAvailable' => $request->quantityAvailable
            ]);
        }
        catch (\Exception $e) {
            $error = [
                "error" => $e
            ];
            return response()->json($error);
        }
        return response()->json($product, 200);
    }

    public function apiProductDestroy($id)
    {
        try {
            Products::destroy($id);
        }
        catch (\Exception $e) {
            $error = [
                "error" => $e
            ];
            return response()->json($error);
        }
        $success = [
            "success"=> "Successfully deleted"
        ];
        return response()->json($success, 200);
    }
}
