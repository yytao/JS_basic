<?php

namespace App\Http\Controllers;

use App\Models\ArticleList;
use Illuminate\Http\Request;
use Illuminate\View\View;
use DB;

class SearchController extends Controller
{

    /*
     * 检索控制器
     * @param
     * @return result view
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword')??'';

        $model = new ArticleList();
        $model->select(['id', 'article_id', 'magazine_id', 'title', 'subtitle', 'author', 'created_at', 'match(title,content) against ("/'.$keyword.'/" IN BOOLEAN MODE) as relation']);
        $model->whereRaw("match(title,content) against ('/".$keyword."/' IN BOOLEAN MODE)");
        $model->orderBy('relation', 'desc');
        $model->orderBy('created_at', 'desc');
        $result = $model->paginate(10);

        foreach ($result as $k=>$item) {
            $strpos = strpos($item->content, $keyword);

            dd(serialize($item->content));

            // 目前设计想法：循环获取每个词是否命中，命中的话即将字符串截取
            dd(strip_tags($item->content));
        }

        return view('', compact('result', 'keyword'));

    }


}
