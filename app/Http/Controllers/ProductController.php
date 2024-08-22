<?php

namespace App\Http\Controllers;
use App\Repositories\ProductDB;

class ProductController extends Controller
{
    public function getAProduct($code)
    {
        $product = ProductDB::getProductDataBySku($code);
        if (is_null($product)) {
            return  response()->json(['error' => 'Not Found'], 404);
        }
        return response()->json(['data' => $product], 200);
    }
}
