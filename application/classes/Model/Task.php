<?php

class Model_Task extends ORM
{
    protected $_table_name = 'task';
    protected $_primary_key = 'task_id';
    protected $_db_group = 'default';

    protected $_belongs_to = array(
      'users' => array(
        'model' => 'User',
        'foreign_key' => 'user_id',
      ),
    );

    public static function incPomodoro($task_id)
    {
        $task = ORM::factory('Task')->where('task_id', '=', $task_id)->find();
        $task->actual = $task->actual + 1;
        $task->save();

        $tasklog = ORM::factory('Tasklog');
        $tasklog->task_id = $task_id;
        $tasklog->date = date("Y-m-d H:i:s");
        $tasklog->save();
    }

    public function startTask($task_id)
    {
        $task = $this->where('task_id', '=', $task_id)->find();
        if($task->loaded()) {
            if($task->completed == 0) {
                Session::instance()->set('running_task', $task_id);
            }
        }
    }

    public function stopTask()
    {
        Session::instance()->set('running_task', 0);
    }

    public function getRunningTask()
    {
          return Session::instance()->get('running_task', 0);
    }

    public function completeTask($task_id)
    {
        $task = $this->where('task_id', '=', $task_id)->find();
        if($task->loaded()) {
            $task->completed = 1;
            $task->save();

            if($task_id==$this->getRunningTask()){
                $this->stopTask();
            }
        }
    }

    public function uncompleteTask($task_id)
    {
        $task = $this->where('task_id', '=', $task_id)->find();
        if($task->loaded()) {
            $task->completed = 0;
            $task->save();
        }
    }
}
