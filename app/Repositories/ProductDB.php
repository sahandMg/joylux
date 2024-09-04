<?php
namespace App\Repositories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductDB
{
    public static function getProductDataBySku($code)
    {
        $product = DB::table('wp_wc_product_meta_lookup')
            ->join('wp_posts', 'wp_wc_product_meta_lookup.product_id', '=', 'wp_posts.id')
            ->where('wp_wc_product_meta_lookup.sku', $code)
            ->first();
        $meta_record = DB::table('wp_postmeta')
            ->where('meta_key', '_thumbnail_id')
            ->where('post_id', $product->product_id)
            ->first();
        if ($meta_record->meta_value == 0) {
            $postmeta = DB::table('wp_postmeta')
                ->where('meta_key', '_thumbnail_id')
                ->where('post_id', $product->post_parent)
                ->first();
            $guid = DB::table('wp_posts')->where('id', $postmeta->meta_value)->first()->guid;
        } else {
            $guid = DB::table('wp_posts')->where('id', $meta_record->meta_value)->first()->guid;
        }
        $product->guid = $guid;
        return $product;
    }
}
