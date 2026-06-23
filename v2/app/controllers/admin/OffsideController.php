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
use Core\Response;

class Offside {	
    /**
     * Offside Stats page 
     *
     * @author GemPixel <https://gempixel.com> 
     * @version 1.0
     * @return void
     */
    public function index(Request $request){
        
        if(!user()->admin) {
            return Helper::redirect()->to(route('admin'))->with('danger', e('You do not have permission to view this page.'));
        }

        View::set('title', e('Offside Statistics'));

        $query = DB::offside_stats();

        if($request->domain){
            $query->whereLike('domain', "%{$request->domain}%");
        }

        if($request->start && $request->end){
            $query->whereRaw("DATE(click_date) BETWEEN ? AND ?", [Helper::clean($request->start), Helper::clean($request->end)]);
        }

        $total = $query->count();
        $stats = $query->orderByDesc('click_date')->paginate(20);

        return View::with('admin.offside.index', compact('stats', 'total'))->extend('admin.layouts.main');
    }

    /**
     * Popular Offside Stats
     *
     * @author GemPixel <https://gempixel.com> 
     * @version 1.0
     * @return void
     */
    public function popular(Request $request){
        
        if(!user()->admin) {
            return Helper::redirect()->to(route('admin'))->with('danger', e('You do not have permission to view this page.'));
        }

        View::set('title', e('Popular Offside Statistics'));

        $query = DB::offside_stats()
                    ->select('url')
                    ->select('domain')
                    ->selectExpr('COUNT(id)', 'count')
                    ->groupBy('url')
                    ->groupBy('domain')
                    ->orderByDesc('count');

        if($request->start && $request->end){
            $query->whereRaw("DATE(click_date) BETWEEN ? AND ?", [Helper::clean($request->start), Helper::clean($request->end)]);
        }

        $totalQuery = DB::offside_stats();
        if($request->start && $request->end){
            $totalQuery->whereRaw("DATE(click_date) BETWEEN ? AND ?", [Helper::clean($request->start), Helper::clean($request->end)]);
        }
        $total = $totalQuery->selectExpr('COUNT(DISTINCT url, domain)', 'total')->first()->total;

        $page = currentpage();
        $limit = 20;

        $stats = $query->limit($limit)->offset(($page - 1) * $limit)->findMany();

        $queries = request()->query();
        $queries['page'] = '%d';

        Helper::paginate($total, $limit, $page, '?'.\urldecode(\http_build_query($queries)));

        return View::with('admin.offside.popular', compact('stats'))->extend('admin.layouts.main');
    }

    /**
     * Delete Stat
     *
     * @author GemPixel <https://gempixel.com> 
     * @version 1.0
     * @return void
     */
    public function delete(int $id){
        if(!user()->admin) {
            return Helper::redirect()->to(route('admin'))->with('danger', e('You do not have permission to view this page.'));
        }

        if($stat = DB::offside_stats()->where('id', $id)->first()){
            $stat->delete();
            return Helper::redirect()->back()->with('success', e('Statistic deleted successfully.'));
        }

        return Helper::redirect()->back()->with('danger', e('Statistic not found.'));
    }
}
