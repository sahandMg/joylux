<?php
namespace App\Repositories;
use Illuminate\Support\Facades\DB;

class ProductDB
{
    public static function getProductDataBySku($code)
    {
        return DB::table('wp_wc_product_meta_lookup')
            ->join('wp_posts', 'wp_wc_product_meta_lookup.product_id', '=', 'wp_posts.id')
            ->where('wp_wc_product_meta_lookup.sku', $code)
            ->first();
    }
}
