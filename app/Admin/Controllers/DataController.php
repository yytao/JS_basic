<?php

namespace App\Admin\Controllers;

use App\Models\ArticleList;
use App\Models\Magazine;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Show;
use Illuminate\Http\Request;

class DataController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Article';

    public function index(Content $content)
    {
        return $content
            ->title('Data')
            ->description('Synchronize...')
            ->row(view('data'));
    }


}
