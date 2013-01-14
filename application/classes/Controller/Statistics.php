<?php

class Controller_Statistics extends Controller_Main
{

    public function before()
    {
      parent::before();

      Session::instance()->set('active_menu','statistics');
    }

    public function action_index()
    {
      if(Session::instance()->get('is_auth',0) == 0){
        return HTTP::redirect('tasklist');
      }

      $stats = ORM::factory('Statistics')->find_all();
      $data['stats'] = $stats;

      $this->template->content = View::factory('pages/statistics', $data);
    }
}