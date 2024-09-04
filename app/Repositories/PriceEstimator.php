<?php

namespace App\Repositories;

class PriceEstimator
{
    public static function estimateSellPrice($p)
    {
        $adjuster = 0.01;
        $packaging = 6; // 6000T
        $max_profit = 1; // means 100% profit on low cost products
        $price_obj = new \stdClass();
        $price_obj->margin =  round(exp(-$adjuster * $p) * $max_profit, 2) * 100;
        $price_obj->sell_price = round($p * (1 + 0.1) * (1 + exp(-$adjuster * $p) * $max_profit)) + $packaging;
        return $price_obj;
    }

    public static function estimateSellPrice2($p)
    {
        $adjuster = 0.01;
        $packaging = 10; // 10000T packaging + raft va amad
        $gateway = 0.01 * $p + 0.12; // 10000T packaging + raft va amad
        $max_profit = 0.2; // means 100% profit on low cost products
        $price_obj = new \stdClass();
        $price_obj->margin =  min($max_profit, exp(-$adjuster * $p));
        $price_obj->sell_price = ceil($p * (1 + 0.1) * (1 + $price_obj->margin) + $gateway) + $packaging;
        return $price_obj;
    }
}
