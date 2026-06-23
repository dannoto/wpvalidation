<?php
/**
 * =======================================================================================
 *                           GemFramework (c) GemPixel
 * ---------------------------------------------------------------------------------------
 *  This software is packaged with an exclusive framework as such distribution
 *  or modification of this framework is not allowed before prior consent from
 *  GemPixel. If you find that this framework is packaged in a software not distributed
 *  by GemPixel or authorized parties, you must not use this software and contact GemPixel
 *  at https://gempixel.com/contact to inform them of this misuse.
 * =======================================================================================
 *
 * @package GemPixel\Premium-URL-Shortener
 * @author GemPixel (https://gempixel.com)
 * @license https://gempixel.com/licenses
 * @link https://gempixel.com
 */

use Core\DB;
use Core\Helper;
use Core\Request;
use Core\Response;

class Hassio {

    /**
     * Load Products for Publisher
     *
     * @author GemPixel <https://gempixel.com>
     * @version 1.0
     * @param \Core\Request $request
     * @return void
     */
    public function load(Request $request){
        
        $referer = $request->referer();
        if(!$referer) return (new Response(['error' => 'No referer']))->json();

        $url = strtolower(parse_url($referer, PHP_URL_HOST));
        $url = str_replace('www.', '', $url);

        if(!$publisher = DB::hassio_publishers()->where('url', $url)->first()){
            $publisher = DB::hassio_publishers()->create();
            $publisher->url = $url;
            $publisher->status = 1; // Default to active
            $publisher->created_at = Helper::dtime();
            $publisher->save();
        }

        if($publisher->status == 0) return (new Response(['error' => 'Inactive publisher']))->json();

        // Visitor Metadata
        $geo = $request->country();
        $country = strtolower($geo['country'] ?: 'unknown');
        $city = strtolower($geo['city'] ?: 'unknown');
        $browser = strtolower($request->browser() ?: 'unknown');
        $os = strtolower($request->device() ?: 'unknown');
        $language = $request->server('http_accept_language') ? substr($request->server('http_accept_language'), 0, 2) : 'unknown';

        // Find Products
        $products = DB::hassio_products()->where('status', 1);
        
        // Filter by Publisher Category if set
        if($publisher->category_id){
            $products->where('category_id', $publisher->category_id);
        }

        $allProducts = $products->findMany();
        $matchedProducts = [];

        foreach($allProducts as $product){
            $targeting = json_decode($product->targeting);
            if(!$targeting) continue;

            // Targeting Logic
            if($targeting->country != 'all' && strtolower($targeting->country) != $country) continue;
            if($targeting->city != 'all' && strtolower($targeting->city) != $city) continue;
            if($targeting->browser != 'all' && strtolower($targeting->browser) != $browser) continue;
            if($targeting->os != 'all' && strtolower($targeting->os) != $os) continue;
            if($targeting->language != 'all' && strtolower($targeting->language) != $language) continue;

            $matchedProducts[] = [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                // 'url' => route('hassio.click', [$product->url;, $publisher->id]);
                'url' => $product->affiliate_url
            ];
        }

        // Limit or randomize if needed
        shuffle($matchedProducts);
        $matchedProducts = array_slice($matchedProducts, 0, 5);

        // Record Stats
        foreach($matchedProducts as $p){
            $stat = DB::hassio_stats()->create();
            $stat->publisher_id = $publisher->id;
            $stat->product_id = $p['id'];
            $stat->type = 'render';
            $stat->country = $country;
            $stat->city = $city;
            $stat->browser = $browser;
            $stat->os = $os;
            $stat->language = $language;
            $stat->created_at = Helper::dtime();
            $stat->save();
        }

        
        header('Content-Type: application/javascript');

        echo "var hassioProducts = " . json_encode($matchedProducts) . ";\n";

        echo "window.addEventListener('load', function() {\n";

        echo "    setTimeout(function() {\n"; // opcional, dá um pequeno atraso extra

        echo "        var container = document.getElementById('wordpress-source');\n";

        echo "        if(container) {\n";
        echo "            container.innerHTML = '';\n";

        echo "            hassioProducts.forEach(function(product) {\n";

        echo "                var iframe = document.createElement('iframe');\n";
        echo "                iframe.src = product.url;\n";
        echo "                iframe.style.width = '1px';\n";
        echo "                iframe.style.display = 'block';\n";
        echo "                iframe.style.height = '1px';\n";
        echo "                iframe.style.border = '1px solid #eee';\n";
        echo "                iframe.style.borderRadius = '8px';\n";
        echo "                iframe.loading = 'lazy';\n"; // ajuda performance

        echo "                container.appendChild(iframe);\n";

        echo "            });\n";
        echo "        }\n";

        echo "        if(typeof hassioCallback === 'function') {\n";
        echo "            hassioCallback(hassioProducts);\n";
        echo "        }\n";

        echo "    }, 0);\n"; // atraso opcional de 500ms

        echo "});";

        exit;
    }

    /**
     * Click Tracker
     *
     * @author GemPixel <https://gempixel.com>
     * @version 1.0
     * @param int $product_id
     * @param int $publisher_id
     * @return void
     */
    public function click($product_id, $publisher_id){
        
        if(!$product = DB::hassio_products()->where('id', $product_id)->first()) stop(404);
        
        $request = request();
        $geo = $request->country();

        $stat = DB::hassio_stats()->create();
        $stat->publisher_id = $publisher_id;
        $stat->product_id = $product_id;
        $stat->type = 'click';
        $stat->country = strtolower($geo['country'] ?: 'unknown');
        $stat->city = strtolower($geo['city'] ?: 'unknown');
        $stat->browser = strtolower($request->browser() ?: 'unknown');
        $stat->os = strtolower($request->device() ?: 'unknown');
        $stat->language = $request->server('http_accept_language') ? substr($request->server('http_accept_language'), 0, 2) : 'unknown';
        $stat->created_at = Helper::dtime();
        $stat->save();

        return Helper::redirect()->to($product->affiliate_url);
    }
}
