<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\ArticleList;
use App\Models\Magazine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SynchronizeController extends Controller
{

    /*
     * 同步杂志文件夹接口
     * 文件夹目录：/public/journal
     * 文件夹命名规则
     *
     */
    public function index()
    {
        $return  = [];

        //根目录
        $dir = base_path('public\journal');

        //扫描根目录下，每一期杂志文件夹
        $list = scandir($dir);

        foreach ($list as $k=>$item)
        {
            if($item == '.' || $item == '..')
                continue;

            $insertData = [];
            preg_match('/(\d{8})/', $item, $reg_result);

            $page_date = date('Y-m-d', strtotime($reg_result[0]));
            $year = date('Y', strtotime($reg_result[0]));
            $month = date('m', strtotime($reg_result[0]));

            $is_exist = Magazine::where('page_date', $page_date)->first();
            if(isset($is_exist->id) && !empty($is_exist) && $is_exist->id > 0)
                continue;

            $magazine_id = $this->getRandomString(6).'-'.$this->getRandomString(6).'-'.$this->getRandomString(6).'-';
            $magazine_id .= $this->getRandomString(5).'-'.$this->getRandomString(5);
            //组装杂志表数组创建，获取到杂志ID
            $insertData['magazine_id'] = $magazine_id;
            $insertData['subject_name'] = '神州学人';
            $insertData['author'] = '朱国亮';
            $insertData['isbn'] = '1002-6738';
            $insertData['page_name'] = '第'.(int)$month.'期';
            $insertData['page_no'] = (int)$month;
            $insertData['year'] = $year;
            $insertData['page_date'] = $page_date;

            $filename = 'magazine/mimg/'.$this->getRandomString().'.jpg';
            $disk = Storage::disk('root');
            $disk->copy('/public/journal/'.$item.'/图片/'.'封面.jpg', '/public/ad-upload/'.$filename);

            $insertData['mimg'] = $filename;
            $insertData['pdf_file'] = '';
            $result = Magazine::create($insertData);

            $this->excuArticle($insertData['magazine_id'], $item);
            $return[] = $item;


        }

        //response返回，200状态
        return response([
            'msg' => 'success',
            'info' => $return
        ], 200);
    }

    public function excuArticle($magazine_id, $folder = NULL)
    {
        if(empty($folder)){ return false; }

        $insertData = [];
        $disk = Storage::disk('root');

        $files = $disk->allFiles('public/journal/'.$folder.'/文字/');

        foreach ($files as $k=>$item){
            $article = $disk->get($item);
            $content = @mb_convert_encoding( $article, 'UTF-8', 'UTF-8,GBK,GB2312,BIG5' );
            $content = str_replace("\r\n", '<br>', $content);
            $content = str_replace("\n", '<br>', $content);
            $content = str_replace("\t", "&nbsp;&nbsp;&nbsp;&nbsp;", $content);
            $contentArr = explode('<br>', $content);
            //处理每个元素，将<br>替换为段落p标签
            array_walk($contentArr, function(&$value, $key){
                $value = "<p>" . $value . "</p>";
            });
            $newContent = implode('', $contentArr);

            $article_id = $this->getRandomString(6).'-'.$this->getRandomString(6).'-'.$this->getRandomString(6).'-';
            $article_id .= $this->getRandomString(5).'-'.$this->getRandomString(5);

            $itemArr = explode('/', $item);
            $title = array_pop($itemArr);

            $insertData['magazine_id'] = $magazine_id;
            $insertData['article_id'] = $article_id;
            $insertData['title'] = $title;
            $insertData['content'] = $newContent;

            ArticleList::create($insertData);

//            dd($insertData);
        }
    }


    /*
     * 清洗文章数据
     *
     */
    public function washArticle()
    {

        $list = ArticleList::get();

        foreach ($list as $k=>$item)
        {

            preg_match_all("/(?<=\[)[^\]]+/i", $item->title, $reg_result);
            if($reg_result[0][0] == '目录')
                continue;

            $item->column = $reg_result[0][0];
            $item->author = @$reg_result[0][1];
            $item->save();
        }

        //response返回，200状态
        return response([
            'msg' => 'success',
            'info' => "wash program is done",
        ], 200);
    }

}
