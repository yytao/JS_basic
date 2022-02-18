<?php

namespace App\Admin\Controllers;

use App\Models\ArticleList;
use App\Models\Magazine;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;

class ArticleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Article';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ArticleList());

        $grid->filter(function ($filter){

            $filter->disableIdFilter();
            $filter->equal('magazine_id', '选择期刊')->select(Magazine::getOptions());

        });

        $grid->column('id', __('Id'));
        $grid->column('magazine_id', __('所属杂志'))->display(function ($magazine_id){

            return Magazine::getMagazineName($magazine_id);
        });

        $grid->column('title', __('标题'));
        $grid->column('subtitle', __('副题'));
        $grid->column('author', __('作者'));
        $grid->column('created_at', __('创建时间'));
        $grid->column('updated_at', __('修改时间'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(ArticleList::findOrFail($id));
        $show->field('sort', __('标题'));
        $show->field('title', __('标题'));
        $show->field('subtitle', __('副题'));
        $show->field('column', __('栏目'));
        $show->field('author', __('作者'));
        $show->field('source', __('来源'));
        $show->field('content', __('内容'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {

        $form = new Form(new ArticleList());

        $form->select('magazine_id', __('所属杂志'))->options(Magazine::getOptions())->required();

        $str = $this->str_rand(6).'-'.$this->str_rand(6).'-'.$this->str_rand(6).'-';
        $str .= $this->str_rand(5).'-'.$this->str_rand(5);
        $form->text('article_id', __('杂志ID'))->value($str)->required();

        $form->number('sort', '排序')->default(1);
        $form->text('title', __('标题'))->required();
        $form->text('subtitle', __('副题'));
        $form->text('column', __('栏目'));
        $form->text('author', __('作者'));
        $form->text('source', __('来源'));
        $form->html("<br/>");
        $form->editor('content', __('内容'));

        return $form;
    }

    public function str_rand($length = 32, $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'){
        $string = '';
        for($i = $length; $i > 0; $i--) {
            $string .= $char[mt_rand(0, strlen($char) - 1)];
        }
        return $string;
    }


    /*
     * wang4 editor编辑器上传图片控制器
     *
     */
    public function imageUpload(Request $request)
    {
        $type = $request->get('type');

        $dir_path = 'ad-upload/image/'; // 文件存储路径
        $rule = ['jpg', 'png', 'gif']; //允许的图片后缀

        if ($request->hasFile('images')) {

            $files = $request->file('images'); //接前台图片

            $path = [];
            foreach ($files as $file) {

                $clientName = $file->getClientOriginalName();
                // $tmpName = $file->getFileName();
                // $realPath = $file->getRealPath();
                $size = $file->getSize();
                $entension = $file->getClientOriginalExtension();
                if (!in_array($entension, $rule)) {
                    continue;
                }
                $newName = md5(date("Y-m-d H:i:s") . $clientName) . "." . $entension;
                $path[] = [
                    'path' => $file->move($dir_path, $newName),
                    'file_name' => $clientName,
                    'size' => $size
                ];
                //$namePath = $url_path . '/' . $newName;
                //return $path;

            }

            $insert_data = [];
            foreach ($path as $p) {
                $file_path = str_replace("\\", "/", $p['path']->getPathname());
                $data[] = config('APP.URL') . '/' . $file_path;
                $insert_data[] = [
                    'file_name' => $p['file_name'],
                    'path' => $file_path,
                    'size' => $p['size'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            }

            return $res = ['errno' => 0, 'data' => $data];

        }
    }

}
