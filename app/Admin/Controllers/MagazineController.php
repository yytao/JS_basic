<?php

namespace App\Admin\Controllers;

use App\Models\Magazine;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MagazineController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Magazine';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Magazine());

        $grid->column('id', __('Id'));
        $grid->column('magazine_id', __('杂志ID'));
        $grid->column('subject_name', __('刊名'));
        $grid->column('author', __('主编'));
        $grid->column('isbn', __('ISBN'));
        $grid->column('page_name', __('期名'));
        $grid->column('page_no', __('期号'));
        $grid->column('page_date', __('出版时间'));
        $grid->column('year', __('年份'));
        $grid->column('mimg', __('封面中图'))->image('/ad-upload/',50,100);
        $grid->column('pdf_file', __('Pdf file'))->display(function ($file){
            if($file){
                return "<a href='/aetherupload/display/$file' target='_blank'>点击查看PDF文件</a>";
            }
        });

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
        $show = new Show(Magazine::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('magazine_id', __('杂志ID'));
        $show->field('subject_name', __('刊名'));
        $show->field('author', __('主编'));
        $show->field('isbn', __('ISBN'));
        $show->field('page_name', __('期名'));
        $show->field('page_no', __('期号'));
        $show->field('page_date', __('出版时间'));
        $show->field('year', __('年份'));
        $show->field('mimg', __('封面中图'))->image('/ad-upload/',50,100);

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {

        $form = new Form(new Magazine());

        $str = $this->str_rand(6).'-'.$this->str_rand(6).'-'.$this->str_rand(6).'-';
        $str .= $this->str_rand(5).'-'.$this->str_rand(5);
        $form->text('magazine_id', __('杂志ID'))->value($str)->required();
        $form->text('subject_name', __('刊名'))->default('神州学人')->required();
        $form->text('author', __('主编'))->default('朱国亮')->required();
        $form->text('isbn', __('ISBN'))->default('1002-6738')->required();
        $form->text('page_name', __('期名'))->required();
        $form->text('page_no', __('期号'))->required();
        $form->year('year', __('出版年份'))->default(date('Y'))->required();
        $form->date('page_date', __('出版时间'))->default(date('Y-m-d'))->required();
        $form->cropper('mimg', __('封面中图'))->move('magazine/mimg');
        $form->largefile('pdf_file', 'Pdf file');

        return $form;
    }

    public function str_rand($length = 32, $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'){
        $string = '';
        for($i = $length; $i > 0; $i--) {
            $string .= $char[mt_rand(0, strlen($char) - 1)];
        }
        return $string;
    }
}
