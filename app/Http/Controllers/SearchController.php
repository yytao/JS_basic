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
        $result = $model->select(DB::raw('id, article_id, magazine_id, title, subtitle, content, author, created_at, match(title,content) against ("/'.$keyword.'/" IN BOOLEAN MODE) as relation'))
        ->whereRaw("match(title, content) against ('".$keyword."' IN BOOLEAN MODE)")
        ->orderBy('relation', 'desc')
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        foreach ($result as $k=>$item) {
            // 目前设计想法：循环获取每个词是否命中，命中的话即将字符串截取
            $content = explode('</p>', $item->content);
            $relation = 0;
            foreach ($content as $contentK=>$contentItem){

                $currentLine = similar_text($contentItem, $keyword);
                if($currentLine > $relation) {
                    $relation = $currentLine;
                    $item->contentSubstr = strip_tags($contentItem);
                }
            }

            //处理关键词变红
            $keyArray = explode(' ', $keyword);
            foreach ($keyArray as $keyK=>$keyItem)
            {
                $item->title = str_replace($keyItem, "<span style='color:red;'>".$keyItem.'</span>', $item->title);
                $item->contentSubstr = str_replace($keyItem, "<span style='color:red;'>".$keyItem.'</span>', $item->contentSubstr);
            }
        }

        view()->share('keyword', $keyword);
        return view('search', compact('result'));
    }

    /*
     * 计算在content变量内，keyword关键词组匹配的相关度，返回content内，相关度最高的段落
     * @param
     * @return
     */
    protected function keywordRelation($content = [], $keyword = []) {
        if(empty($keyword)) {
            return false;
        }




    }


}
