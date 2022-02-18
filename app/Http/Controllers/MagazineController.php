<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MagazineController extends Controller
{

    /*
     * 展示单个杂志首页
     */
    public function index(Request $request)
    {
        $magaId = $request->input('magaId');

        $info = [];


        $article = [];


        return view('article', compact(
            'info',
            'article'
        ));
    }



    /*
     * 展示单篇杂志文章
     */
    public function article(Request $request)
    {

        $magaId = $request->input('magaId');
        $articleId = $request->input('articleId');



        $result = [];


        return view('article', compact(
            'result'
        ));

    }


}
