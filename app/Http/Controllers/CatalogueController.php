<?php

namespace App\Http\Controllers;

use App\Models\ArticleList;
use App\Models\Magazine;
use Illuminate\Http\Request;

class CatalogueController extends Controller
{

    /*
     * 展示单个杂志首页
     */
    public function index(Request $request, $magaid='', $date='')
    {
        if(empty($magaid) || empty($date)) die('None');

        $magazine = Magazine::where('magazine_id', $magaid)->first();
        if(empty($magazine)) die('NULL');
        $year = date('Y', strtotime($date));

        $prov = Magazine::where('page_no', $magazine->page_no-1)
            ->whereYear('page_date', $year)
            ->first();
        $next = Magazine::where('page_no', $magazine->page_no+1)
            ->whereYear('page_date', $year)
            ->first();

        $articleList = ArticleList::where('magazine_id', $magazine->magazine_id)
            ->orderBy('sort', 'asc')
            ->get();

        return view('catalogue', compact(
            'magaid',
            'year',
            'magazine',
            'articleList',
            'prov',
            'next',
            'date'
        ));
    }

    /*
     * 展示单篇杂志文章
     */
    public function article(Request $request, $article_id='', $magaid='')
    {
        if(empty($magaid) || empty($article_id)) die('None');

        $magazine = Magazine::where('magazine_id', $magaid)->first();
        if(empty($magazine)) die('NULL');

        $year = date('Y', strtotime($magazine->page_date));

        $articleList = ArticleList::where('magazine_id', $magazine->magazine_id)
            ->orderBy('sort')
            ->get();

        $article = ArticleList::where('article_id', $article_id)
            ->first();

        return view('article', compact(
            'year',
            'articleList',
            'magazine',
            'article',
        ));

    }

}
