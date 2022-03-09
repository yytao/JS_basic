<?php

namespace App\Http\Controllers;

use App\Models\Magazine;
use Illuminate\Http\Request;
use Illuminate\View\View;
use DB;

class IndexController extends Controller
{

    /*
     * 网站入口，加载index首页模板
     * @param
     * @return view index
     */
    public function index(Request $request, $year = null)
    {
        if(empty($year)) { $year = date('Y'); }
        $magazine = Magazine::select('magazine_id','page_name','mimg','pdf_file','page_date')
            ->where('year', $year)
            ->orderBy('page_no', 'asc')
            ->get()
            ->toArray();

        return view('index', compact(
            'year',
            'magazine'
        ));
    }



    /*
     * 增加所有模板页面所需要的模板变量
     * @param $view
     * @return NULL
     */
    public function layoutData(View $view)
    {
        $navYear = [];
        $navYear = Magazine::select(DB::raw("DATE_FORMAT(page_date,'%Y') as year_date"))
            ->orderBy('year_date', 'DESC')
            ->groupBy('year_date')
            ->take(9)
            ->get();

        $hiddenYear = Magazine::select(DB::raw("DATE_FORMAT(page_date,'%Y') as year_date"))
            ->orderBy('year_date', 'DESC')
            ->groupBy('year_date')
            ->skip(9)
            ->take(100)
            ->get();

        $view->with('navYear', $navYear);
    }


}
