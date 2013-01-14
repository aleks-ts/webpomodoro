<?php

class Controller_Tasklist extends Controller_Main
{

    public function before()
    {
      parent::before();

      Session::instance()->set('active_menu','tasklist');

      require_once Kohana::find_file('vendor','loginza/LoginzaAPI.class');
      require_once Kohana::find_file('vendor','loginza/LoginzaUserProfile.class');

      //session_start();
      $LoginzaAPI = new LoginzaAPI();

      if (!empty($_POST['token'])) {

        $UserProfile = $LoginzaAPI->getAuthInfo($_POST['token']);

        if (!empty($UserProfile->error_type)) {
          echo $UserProfile->error_type.": ".$UserProfile->error_message;
        } elseif (empty($UserProfile)) {
          echo 'Temporary error.';
        } else {

          Session::instance()->set('is_auth', 1);
          Session::instance()->set('profile', $UserProfile);

          // write token to db
          $LoginzaProfile = new LoginzaUserProfile($UserProfile);
          $user = ORM::factory('User')->where('email','=',$LoginzaProfile->genUserEmail())->find();

          if(!$user->loaded()){
            //add to db
            $newuser = ORM::factory('User');
            $newuser->email = $LoginzaProfile->genUserEmail();
            $newuser->token = $_POST['token'];
            $newuser->nickname = $LoginzaProfile->genNickname();
            $newuser->save();

            $addeduser = ORM::factory('User')->where('email','=',$LoginzaProfile->genUserEmail())->find();
            if($addeduser->loaded()) Session::instance()->set('logged_user_id', $addeduser->user_id);
          }
          else {
            Session::instance()->set('logged_user_id', $user->user_id);

            //update db
            $user->token = $_POST['token'];
            $user->nickname = $LoginzaProfile->genNickname();
            $user->save();
          }
        }
      } elseif (isset($_GET['quit'])) {
        $s = Session::instance();
        $s->delete('profile');
        $s->delete('is_auth');
        $s->delete('logged_in_user');
        $s->delete('logged_user_id');
      }

      if ((Session::instance()->get('is_auth',0) == 1)) {

        $LoginzaProfile = new LoginzaUserProfile(Session::instance()->get('profile'));

        Session::instance()->set('logged_in_user', $LoginzaProfile->genNickname());

        //$LoginzaAPI->debugPrint($_SESSION['profile']);

      } else {
        Session::instance()->set('is_auth', 0);
      }
    }

    public function action_auth()
    {
      if(Session::instance()->get('is_auth',0) == 1){
        return HTTP::redirect('tasklist/index');
      }

      $LoginzaAPI = new LoginzaAPI();
      $data['widget_url'] = $LoginzaAPI->getWidgetUrl();
      $data['return_url'] = $this->currentHost()."/tasklist/auth";;
      $this->template->content = View::factory('pages/login',$data);
    }

    public function action_index()
    {
        if(Session::instance()->get('is_auth',0) == 0){
          $LoginzaAPI = new LoginzaAPI();
          $data['widget_url'] = $LoginzaAPI->getWidgetUrl();
          $data['return_url'] = $this->currentHost()."/tasklist";
          return HTTP::redirect('tasklist/auth');
        }

      if ($_POST)
        {
          return $this->action_add();
          //return HTTP::redirect('tasklist/add'); // error while saving!
        }

        $task = ORM::factory('Task');
        $tasks = $task->find_all();

        $data['running_task'] = $task->getRunningTask();
        $data['tasks'] = $tasks;
        $data['valid'] = true;
        $data['add'] = false;

        $this->template->content = View::factory('pages/tasklist', $data);
    }

    public function  action_add()
    {
        $post = Validation::factory($_POST);
        $post->rule(true, 'not_empty')
            ->rule('estimated', 'digit');

        if($post->check()) {
            $task = ORM::factory('Task');
            $task->title = $this->request->post('title');
            $task->estimated = $this->request->post('estimated');
            $task->user_id = Session::instance()->get('logged_user_id',0);
            $task->save();

            $data['valid'] = true;
            $data['add'] = true;
        }
        else {
            $data['valid'] = false;
        }

        $task = ORM::factory('Task');
        $tasks = $task->find_all();

        $data['tasks'] = $tasks;
        $data['running_task'] = $task->getRunningTask();
        $this->template->content = View::factory('pages/tasklist', $data);
    }

    public function action_increase()
    {
        $task_id = $this->request->param('id', 0);
        Model_Task::incPomodoro($task_id);

        return HTTP::redirect('/tasklist');
    }

    public function action_delete()
    {
        $task_id = $this->request->param('id', 0);

        $running_task = ORM::factory('Task')->getRunningTask();
        if($running_task == $task_id){
            $this->action_stop();
        }

        $task = ORM::factory('Task',$task_id);

        if ($task->loaded()){
            $task->delete();

            $tasklog = ORM::factory('Tasklog')
                    ->where('task_id','=', $task_id)
                    ->find_all();

            foreach($tasklog as $t) {
                $t->delete();
            }
        }
        return HTTP::redirect('/tasklist');
    }

    public function action_start()
    {
        $task_id = $this->request->param('id',0);
        ORM::factory('Task')->startTask($task_id);

        return HTTP::redirect('/tasklist');
    }

    public function action_stop()
    {
        ORM::factory('Task')->stopTask();
        return HTTP::redirect('/tasklist');
    }

    public function action_complete()
    {
        $task_id = $this->request->param('id',0);
        ORM::factory('Task')->completeTask($task_id);

        return HTTP::redirect('/tasklist');
    }

    public function action_uncomplete()
    {
        $task_id = $this->request->param('id',0);
        ORM::factory('Task')->uncompleteTask($task_id);

        return HTTP::redirect('/tasklist');
    }

    public function action_pomodoroComplete()
    {
        $running_task = ORM::factory('Task')->getRunningTask();

        if($running_task > 0) {

            Model_Task::incPomodoro($running_task);

            ORM::factory('Task')->stopTask();
        }

        return; // HTTP::redirect('/tasklist');
    }

    private function currentHost () {
      $url = array();

      if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on') {
        $url['sheme'] = "https";
        $url['port'] = '443';
      } else {
        $url['sheme'] = 'http';
        $url['port'] = '80';
      }

      $url['host'] = $_SERVER['HTTP_HOST'];

      if (strpos($url['host'], ':') === false && $_SERVER['SERVER_PORT'] != $url['port']) {
        $url['host'] .= ':'.$_SERVER['SERVER_PORT'];
      }

      return $url['sheme'].'://'.$url['host'];
    }
}

