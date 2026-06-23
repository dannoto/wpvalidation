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

namespace Admin;

use Core\DB;
use Core\View;
use Core\Request;
use Core\Helper;

class Hassio {

    /**
     * Dashboard
     *
     * @author GemPixel <https://gempixel.com>
     * @version 1.0
     * @return void
     */
    public function index(){
        
        $stats = new \stdClass;
        $stats->renders = DB::hassio_stats()->where('type', 'render')->count();
        $stats->conversions = DB::hassio_conversions()->count();
        $stats->publishers = DB::hassio_publishers()->count();
        $stats->products = DB::hassio_products()->count();

        $todayRenders = DB::hassio_stats()->where('type', 'render')->whereRaw('DATE(created_at) = CURDATE()')->count();
        $todayConversions = DB::hassio_conversions()->whereRaw('DATE(date) = CURDATE()')->count();

        $topPublishers = DB::hassio_stats()
                            ->select('publisher_id')
                            ->selectExpr('COUNT(id)', 'count')
                            ->where('type', 'render')
                            ->groupBy('publisher_id')
                            ->orderByDesc('count')
                            ->limit(5)
                            ->findMany();
        
        foreach($topPublishers as $p){
            $pub = DB::hassio_publishers()->where('id', $p->publisher_id)->first();
            $p->url = $pub ? $pub->url : 'Unknown';
        }

        $topProducts = DB::hassio_stats()
                            ->select('product_id')
                            ->selectExpr('COUNT(id)', 'count')
                            ->where('type', 'render')
                            ->groupBy('product_id')
                            ->orderByDesc('count')
                            ->limit(5)
                            ->findMany();

        foreach($topProducts as $p){
            $prod = DB::hassio_products()->where('id', $p->product_id)->first();
            $p->name = $prod ? $prod->name : 'Unknown';
        }

        View::set('title', e('Hassio Dashboard'));
        return View::with('admin.hassio.index', compact('stats', 'todayRenders', 'todayConversions', 'topPublishers', 'topProducts'))->extend('admin.layouts.main');
    }

    /**
     * Stats
     *
     * @author GemPixel <https://gempixel.com>
     * @version 1.0
     * @return void
     */
    public function stats(Request $request){
        
        $query = DB::hassio_stats();

        if($request->publisher) $query->where('publisher_id', $request->publisher);
        if($request->product) $query->where('product_id', $request->product);
        if($request->country) $query->where('country', $request->country);
        if($request->browser) $query->where('browser', $request->browser);
        if($request->os) $query->where('os', $request->os);

        $stats = $query->orderByDesc('created_at')->paginate(25);

        // Summaries for charts/tables
        $summaryQuery = DB::hassio_stats();
        if($request->publisher) $summaryQuery->where('publisher_id', $request->publisher);
        if($request->product) $summaryQuery->where('product_id', $request->product);
        if($request->country) $summaryQuery->where('country', $request->country);
        
        $countries = (clone $summaryQuery)->where('type', 'click')->select('country')->selectExpr('COUNT(*)', 'total')->groupBy('country')->orderByDesc('total')->limit(10)->findMany();
        $browsers = (clone $summaryQuery)->where('type', 'click')->select('browser')->selectExpr('COUNT(*)', 'total')->groupBy('browser')->orderByDesc('total')->limit(5)->findMany();
        $oss = (clone $summaryQuery)->where('type', 'click')->select('os')->selectExpr('COUNT(*)', 'total')->groupBy('os')->orderByDesc('total')->limit(5)->findMany();
        $langs = (clone $summaryQuery)->where('type', 'click')->select('language')->selectExpr('COUNT(*)', 'total')->groupBy('language')->orderByDesc('total')->limit(5)->findMany();

        $publishersList = DB::hassio_publishers()->findMany();
        $productsList = DB::hassio_products()->findMany();

        View::set('title', e('Hassio Stats'));
        return View::with('admin.hassio.stats', compact('stats', 'countries', 'browsers', 'oss', 'langs', 'publishersList', 'productsList'))->extend('admin.layouts.main');
    }

    /**
     * Publishers
     *
     * @author GemPixel <https://gempixel.com>
     * @version 1.0
     * @return void
     */
    public function publishers(){
        $publishers = DB::hassio_publishers()->orderByDesc('created_at')->paginate(20);
        View::set('title', e('Hassio Publishers'));
        return View::with('admin.hassio.publishers', compact('publishers'))->extend('admin.layouts.main');
    }

    public function publishersNew(){
        $categories = DB::hassio_categories()->where('status', 1)->findMany();
        View::set('title', e('New Publisher'));
        return View::with('admin.hassio.publisher_new', compact('categories'))->extend('admin.layouts.main');
    }

    public function publishersSave(Request $request){
        if(!$request->url) return Helper::redirect()->back()->with('danger', e('URL is required.'));

        $url = strtolower(clean($request->url));
        $url = str_replace(['http://', 'https://', 'www.'], '', $url);
        $url = rtrim($url, '/');

        if(DB::hassio_publishers()->where('url', $url)->first()) return Helper::redirect()->back()->with('danger', e('Publisher already exists.'));

        $publisher = DB::hassio_publishers()->create();
        $publisher->url = $url;
        $publisher->status = $request->status ? 1 : 0;
        $publisher->category_id = $request->category_id ?: null;
        $publisher->created_at = Helper::dtime();
        $publisher->save();

        return Helper::redirect()->to(route('admin.hassio.publishers'))->with('success', e('Publisher has been created.'));
    }

    public function publishersEdit($id){
        if(!$publisher = DB::hassio_publishers()->where('id', $id)->first()) return Helper::redirect()->back()->with('danger', e('Publisher not found.'));
        $categories = DB::hassio_categories()->where('status', 1)->findMany();
        View::set('title', e('Edit Publisher'));
        return View::with('admin.hassio.publisher_edit', compact('publisher', 'categories'))->extend('admin.layouts.main');
    }

    public function publishersUpdate(Request $request, $id){
        if(!$publisher = DB::hassio_publishers()->where('id', $id)->first()) return Helper::redirect()->back()->with('danger', e('Publisher not found.'));

        $url = strtolower(clean($request->url));
        $url = str_replace(['http://', 'https://', 'www.'], '', $url);
        $url = rtrim($url, '/');

        $publisher->url = $url;
        $publisher->status = $request->status ? 1 : 0;
        $publisher->category_id = $request->category_id ?: null;
        $publisher->updated_at = Helper::dtime();
        $publisher->save();

        return Helper::redirect()->back()->with('success', e('Publisher has been updated.'));
    }

    public function publishersDelete($id, $nonce){
        if(!Helper::validateNonce($nonce, 'hassio.publisher.delete')) return Helper::redirect()->back()->with('danger', e('Invalid nonce.'));
        if(!$publisher = DB::hassio_publishers()->where('id', $id)->first()) return Helper::redirect()->back()->with('danger', e('Publisher not found.'));
        $publisher->delete();
        return Helper::redirect()->back()->with('success', e('Publisher has been deleted.'));
    }

    /**
     * Products
     *
     * @author GemPixel <https://gempixel.com>
     * @version 1.0
     * @return void
     */
    public function products(){
        $products = DB::hassio_products()->orderByDesc('created_at')->paginate(20);
        View::set('title', e('Hassio Products & Services'));
        return View::with('admin.hassio.products', compact('products'))->extend('admin.layouts.main');
    }

    public function productsNew(){
        $categories = DB::hassio_categories()->where('status', 1)->findMany();
        View::set('title', e('New Product/Service'));
        return View::with('admin.hassio.product_new', compact('categories'))->extend('admin.layouts.main');
    }

    public function productsSave(Request $request){
        if(!$request->name || !$request->affiliate_url) return Helper::redirect()->back()->with('danger', e('Name and Affiliate URL are required.'));

        $product = DB::hassio_products()->create();
        $product->name = clean($request->name);
        $product->description = clean($request->description);
        $product->affiliate_url = clean($request->affiliate_url);
        $product->status = $request->status ? 1 : 0;
        $product->category_id = $request->category_id ?: null;
        
        $targeting = [
            'country' => $request->targeting['country'] ?? 'all',
            'city' => $request->targeting['city'] ?? 'all',
            'language' => $request->targeting['language'] ?? 'all',
            'browser' => $request->targeting['browser'] ?? 'all',
            'os' => $request->targeting['os'] ?? 'all'
        ];
        $product->targeting = json_encode($targeting);
        $product->created_at = Helper::dtime();
        $product->save();

        return Helper::redirect()->to(route('admin.hassio.products'))->with('success', e('Product has been created.'));
    }

    public function productsEdit($id){
        if(!$product = DB::hassio_products()->where('id', $id)->first()) return Helper::redirect()->back()->with('danger', e('Product not found.'));
        $categories = DB::hassio_categories()->where('status', 1)->findMany();
        $product->targeting = json_decode($product->targeting);
        View::set('title', e('Edit Product/Service'));
        return View::with('admin.hassio.product_edit', compact('product', 'categories'))->extend('admin.layouts.main');
    }

    public function productsUpdate(Request $request, $id){
        if(!$product = DB::hassio_products()->where('id', $id)->first()) return Helper::redirect()->back()->with('danger', e('Product not found.'));

        $product->name = clean($request->name);
        $product->description = clean($request->description);
        $product->affiliate_url = clean($request->affiliate_url);
        $product->status = $request->status ? 1 : 0;
        $product->category_id = $request->category_id ?: null;
        
        $targeting = [
            'country' => $request->targeting['country'] ?? 'all',
            'city' => $request->targeting['city'] ?? 'all',
            'language' => $request->targeting['language'] ?? 'all',
            'browser' => $request->targeting['browser'] ?? 'all',
            'os' => $request->targeting['os'] ?? 'all'
        ];
        $product->targeting = json_encode($targeting);
        $product->updated_at = Helper::dtime();
        $product->save();

        return Helper::redirect()->back()->with('success', e('Product has been updated.'));
    }

    public function productsDelete($id, $nonce){
        if(!Helper::validateNonce($nonce, 'hassio.product.delete')) return Helper::redirect()->back()->with('danger', e('Invalid nonce.'));
        if(!$product = DB::hassio_products()->where('id', $id)->first()) return Helper::redirect()->back()->with('danger', e('Product not found.'));
        $product->delete();
        return Helper::redirect()->back()->with('success', e('Product has been deleted.'));
    }

    /**
     * Categories
     *
     * @author GemPixel <https://gempixel.com>
     * @version 1.0
     * @return void
     */
    public function categories(){
        $categories = DB::hassio_categories()->findMany();
        View::set('title', e('Hassio Categories'));
        return View::with('admin.hassio.categories', compact('categories'))->extend('admin.layouts.main');
    }

    public function categoriesSave(Request $request){
        if(!$request->name) return Helper::redirect()->back()->with('danger', e('Name is required.'));

        $category = DB::hassio_categories()->create();
        $category->name = clean($request->name);
        $category->description = clean($request->description);
        $category->status = $request->status ? 1 : 0;
        $category->created_at = Helper::dtime();
        $category->save();

        return Helper::redirect()->back()->with('success', e('Category has been created.'));
    }

    public function categoriesUpdate(Request $request, $id){
        if(!$category = DB::hassio_categories()->where('id', $id)->first()) return Helper::redirect()->back()->with('danger', e('Category not found.'));

        $category->name = clean($request->name);
        $category->description = clean($request->description);
        $category->status = $request->status ? 1 : 0;
        $category->updated_at = Helper::dtime();
        $category->save();

        return Helper::redirect()->back()->with('success', e('Category has been updated.'));
    }

    public function categoriesDelete($id, $nonce){
        if(!Helper::validateNonce($nonce, 'hassio.category.delete')) return Helper::redirect()->back()->with('danger', e('Invalid nonce.'));
        if(!$category = DB::hassio_categories()->where('id', $id)->first()) return Helper::redirect()->back()->with('danger', e('Category not found.'));
        $category->delete();
        return Helper::redirect()->back()->with('success', e('Category has been deleted.'));
    }

    /**
     * Conversions
     *
     * @author GemPixel <https://gempixel.com>
     * @version 1.0
     * @return void
     */
    public function conversions(){
        $conversions = DB::hassio_conversions()->orderByDesc('date')->paginate(20);
        $products = DB::hassio_products()->findMany();
        View::set('title', e('Hassio Conversions'));
        return View::with('admin.hassio.conversions', compact('conversions', 'products'))->extend('admin.layouts.main');
    }

    public function conversionsSave(Request $request){
        if(!$request->product_id || !$request->amount) return Helper::redirect()->back()->with('danger', e('Product and Amount are required.'));

        $conversion = DB::hassio_conversions()->create();
        $conversion->product_id = $request->product_id;
        $conversion->amount = clean($request->amount);
        $conversion->date = $request->date ?: Helper::dtime();
        $conversion->created_at = Helper::dtime();
        $conversion->save();

        return Helper::redirect()->back()->with('success', e('Conversion has been registered.'));
    }

    public function conversionsUpdate(Request $request, $id){
        if(!$conversion = DB::hassio_conversions()->where('id', $id)->first()) return Helper::redirect()->back()->with('danger', e('Conversion not found.'));

        $conversion->product_id = $request->product_id;
        $conversion->amount = clean($request->amount);
        $conversion->date = $request->date ?: Helper::dtime();
        $conversion->updated_at = Helper::dtime();
        $conversion->save();

        return Helper::redirect()->back()->with('success', e('Conversion has been updated.'));
    }

    public function conversionsDelete($id, $nonce){
        if(!Helper::validateNonce($nonce, 'hassio.conversion.delete')) return Helper::redirect()->back()->with('danger', e('Invalid nonce.'));
        if(!$conversion = DB::hassio_conversions()->where('id', $id)->first()) return Helper::redirect()->back()->with('danger', e('Conversion not found.'));
        $conversion->delete();
        return Helper::redirect()->back()->with('success', e('Conversion has been deleted.'));
    }
}
