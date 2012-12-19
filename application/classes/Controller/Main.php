<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Main extends Controller_Template {
    public $template = 'pages/mainlayout';

    public function before()
    {
        parent::before();

        $this->template->title = 'Задачи и помидоры';
        $this->template->content = 'Задачи и помидоры:';
    }
}