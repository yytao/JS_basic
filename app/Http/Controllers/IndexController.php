<?php

namespace App\Http\Controllers;

use App\Models\Magazine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redis;
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
        if(empty($year)) { $year = date('Y')-1; }

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


    /*
     *
     *
     */
    public function login()
    {
        return view('login');
    }

    /*
     *
     */
    public function loginSubmit(Request $request)
    {
        $password = $request->input('password');

        $salt = md5(random_int(99, 99999));

        if($password == 'WptF,zd41') {
            $signature = md5($password.$salt);
            $timeOut = 3600 * 24;

            Redis::setex($salt, $timeOut, $signature);
            Cookie::queue('salt', $salt, $timeOut);
            Cookie::queue('signature', $signature, $timeOut);

            return redirect("/");
        }else{

            $error = "密码错误，请重试！";
            return view('login', compact('error'));
        }
    }

}
