<?php

namespace Bavix\App\Admin\Controllers;

use Bavix\App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

abstract class AdminController extends Controller
{

    use ModelForm;

    /**
     * @var string
     */
    protected $localKey;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $model;

    /**
     * @return string
     */
    protected function title(): string
    {
        return $this->localKey ? __($this->localKey) : $this->title;
    }

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index(): Content
    {
        return Admin::content(function (Content $content) {
            $content->header($this->title());

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     *
     * @return Content
     */
    public function edit($id): Content
    {
        return Admin::content(function (Content $content) use ($id) {
            $content->header($this->title());

            $content->body($this->form($id)->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create(): Content
    {
        return Admin::content(function (Content $content) {

            $content->header($this->title());

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    abstract protected function grid(): Grid;

    /**
     * Make a form builder.
     *
     * @param int $id
     *
     * @return Form
     */
    abstract protected function form($id = null): Form;

}
