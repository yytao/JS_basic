<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Magazine;
use Illuminate\Http\Request;

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

            //组装杂志表数组创建，获取到杂志ID
            $data['magazine_id'] = '';
            $data['subject_name'] = '神州学人';
            $data['author'] = '朱国亮';
            $data['isbn'] = '1002-6738';
            $data['page_name'] = '第1期';
            $data['page_no'] = '1';

            $data['year'] = '2019';
            $data['page_date'] = '2019-01-01';
            $data['mimg'] = '';
            $data['pdf_file'] = '';

            $result = Magazine::create($data);
            dd($return);
        }

        //response返回，200状态
        return response([
            'msg' => 'success',
            'info' => $return
        ], 200);
    }

    public static function excuFile($dir = Null)
    {
        if(empty($dir)){ return false; }




    }

}
