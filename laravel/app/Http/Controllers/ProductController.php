<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productList = ProductModel::all();

        $a_returnResponse = [
            "message" => "Product list successfully consulted.",
            "products" => $productList
        ];

        return response()->json($a_returnResponse, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $newProduct = ProductModel::create([
            "unique_id" => Str::uuid()->toString(),
            "name" => $request->get("name"),
            "description" => $request->get("description"),
            "image_url" => $request->get("image_url")
        ]);

        $a_returnResponse = [
            "message" => "Product registered successfully.",
            "new_product" => $newProduct
        ];

        return response()->json($a_returnResponse, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $unique_id)
    {
        $product = ProductModel::where("unique_id", $unique_id)->first();

        if(empty($product))
        {
            $a_returnResponse = [
                "message" => "Product reported was not found."
            ];

            return response()->json($a_returnResponse, 404);
        }

        if($request->has("name") && !empty(trim($request->get("name"))))
        {
            $product->name = trim($request->get("name"));
        }

        if($request->has("description") && !empty(trim($request->get("description"))))
        {
            $product->description = trim($request->get("description"));
        }

        if($request->has("image_url") && !empty(trim($request->get("image_url"))))
        {
            $product->image_url = trim($request->get("image_url"));
        }

        $product->save();

        $a_returnResponse = [
            "message" => "Product has been changed successfully.",
            "product" => $product
        ];

        return response()->json($a_returnResponse, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $unique_id)
    {
        $product = ProductModel::where("unique_id", $unique_id)->first();

        if(empty($product))
        {
            $a_returnResponse = [
                "message" => "Product reported was not found."
            ];

            return response()->json($a_returnResponse, 404);
        }

        $product->delete();

        $a_returnResponse = [
            "message" => "Product has been removed successfully."
        ];

        return response()->json($a_returnResponse, 200);
    }
}
