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
            $data['magazine_id'] = $magazine_id;
            $data['subject_name'] = '神州学人';
            $data['author'] = '朱国亮';
            $data['isbn'] = '1002-6738';
            $data['page_name'] = '第'.(int)$month.'期';
            $data['page_no'] = (int)$month;
            $data['year'] = $year;
            $data['page_date'] = $page_date;

            $filename = 'magazine/mimg/'.$this->getRandomString().'.jpg';
            $disk = Storage::disk('root');
            $disk->copy('/public/journal/'.$item.'/图片/'.'封面.jpg', '/public/ad-upload/'.$filename);

            $data['mimg'] = $filename;
            $data['pdf_file'] = '';
            $result = Magazine::create($data);

            $this->excuArticle($data['magazine_id'], $item);
            $return[$item] = $item;
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

        $disk = Storage::disk('root');

        $files = $disk->allFiles('public/journal/'.$folder.'/文字/');

        foreach ($files as $k=>$item){
            $article = $disk->get($item);
            $content = mb_convert_encoding( $article, 'UTF-8', 'UTF-8,GBK,GB2312,BIG5' );

            $article_id = $this->getRandomString(6).'-'.$this->getRandomString(6).'-'.$this->getRandomString(6).'-';
            $article_id .= $this->getRandomString(5).'-'.$this->getRandomString(5);

            $itemArr = explode('/', $item);
            $title = array_pop($itemArr);

            $data['magazine_id'] = $magazine_id;
            //$data['article_id'] = $article_id;
            $data['title'] = $title;
            $data['content'] = $content;

            ArticleList::create($data);
        }

    }
}
