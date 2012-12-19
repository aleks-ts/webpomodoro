<?php

class Controller_Tasklist extends Controller_Main
{
    public function action_index()
    {
        if ($_POST)
        {
            return $this->action_add();
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
            $task->save();

            $data['valid'] = true;
            $data['add'] = true;
        }
        else {
            $data['valid'] = false;
        }

        $tasks = ORM::factory('Task')->find_all();
        $data['tasks'] = $tasks;
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
}

