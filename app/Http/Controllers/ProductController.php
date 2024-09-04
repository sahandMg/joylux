<?php

namespace App\Http\Controllers;
use App\Repositories\ProductDB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    public function getAProduct()
    {
        if (!isset($_GET['code'])) {
            return  response()->json(['error' => 'Not Found'], 404);

        }
        $code = $_GET['code'];
        try{
            $product = ProductDB::getProductDataBySku($code);
            if (is_null($product)) {
                return  response()->json(['error' => 'Not Found'], 404);
            }
            return response()->json(['data' => $product], 200);
        } catch (\Exception $exception) {
            return  response()->json(['error' => $exception->getMessage()], 404);
        }
    }

    public function setProductPrice(Request $request)
    {
        $v = Validator::make($request->all(), ['sku' => 'required', 'pass' => 'required', 'price' => 'required']);
        if ($v->fails()) {
            return response()->json(['error' => $v->getMessageBag()->first()], 400);
        }
        $pass = $request->get('pass');
        $estimated_price = $request->get('price');
        $sku = $request->get('sku');
        if ($pass != env('PRODUCT_PASS')) {
            return response()->json(['error' => 'unAuthorized'], 400);
        }
        DB::table('wp_wc_product_meta_lookup')
            ->where('sku', $sku)
            ->update(['min_price' => $estimated_price, 'max_price' => $estimated_price]);
        return response()->json(['message' => 'ok'], 200);
    }
}
