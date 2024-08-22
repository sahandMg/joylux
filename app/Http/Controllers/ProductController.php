<?php

namespace App\Http\Controllers;
use App\Repositories\ProductDB;

class ProductController extends Controller
{
    public function getAProduct($code)
    {
        $product = ProductDB::getProductDataBySku($code);
        return response()->json(['data' => $product], 200);
    }
}
