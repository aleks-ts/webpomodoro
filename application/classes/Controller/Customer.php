<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Customer extends Controller_Main
{
    private $message;

    public function action_index()
    {
        if ($_POST)
        {
            return $this->action_save();
        }

        $id = $this->request->param('id', 0);

        if ($id>0) // update user
        {
            $data['edit'] = false;
            $data['title'] = 'Редактирование: ';
            $customer = ORM::factory('Customer',$id);
            $data['valid'] = true;
            $data['customer'] = $customer;

        } else // insert new user
        {
            $data['edit'] = false;
            $data['title'] = 'Новый пользователь: ';
            $customer = ORM::factory('Customer');
            $data['valid'] = true;
            $data['customer'] = $customer;
        }

        $this->template->content = View::factory('pages/customerinfo', $data);
    }

    public function action_save()
    {
        $retpath =  Arr::get($_GET, 'ret','customer/showall');
        //$action = Arr::get($_POST, 'action');
        $action = $this->request->post('action');

        if($action == 'save'){
            $post = Validation::factory($_POST);
            $post->rule(true, 'not_empty')
                ->rule('email', 'email');

            $id = $this->request->param('id', 0);
            if ($id>0)
            {
                $customer = ORM::factory('Customer',$id);
            } else
            {
                $customer = ORM::factory('Customer');
            }

            if($post->check())
            {
                if ($id>0) {
                    $customer->customer_id = $id;
                }
                $customer->name = $this->request->post('name');
                $customer->surname = $this->request->post('surname');
                $customer->email = $this->request->post('email');
                $customer->save();

                $data['edit'] = true;
                $data['valid'] = true;
            } else
            {
                $data['valid'] = false;
            }

            if($data['valid'])
            {
                return HTTP::redirect($retpath);
            }
            else
            {
                $data['title'] = 'Редактирование: ';
                $data['customer'] = $customer;
                $this->template->content = View::factory('pages/customerinfo', $data);
            }
        }
        else {
            return HTTP::redirect($retpath);
        }
    }

    public function action_show()
    {
        $id = $this->request->param('id', 0);

        $customer = ORM::factory('Customer',$id);

        if ($customer->loaded())
        {
            $data['loaded'] = true;
            $data['customer'] = $customer;
        }
        else
        {
            $data['loaded'] = false;
            $data['wrong_id'] = $id;
        }

        $this->template->content = View::factory('pages/showcustomer', $data);
    }

    public function action_showall()
    {
        $count = ORM::factory('Customer')->count_all();

        $pagination = Pagination::factory(array('total_items' => $count));

        $c = ORM::factory('Customer')
            ->limit($pagination->items_per_page)
            ->offset($pagination->offset)
            ->find_all();

        $data['customers'] = $c;
        $data['pagination'] = $pagination;

        $this->template->content = View::factory('pages/showallcustomers', $data);
    }

    public function action_delete()
    {
        $id = $this->request->param('id', 0);

        $customer = ORM::factory('Customer',$id);

        if ($customer->loaded())
        {
            $data['name'] = $customer->name;
            $data['surname'] = $customer->surname;
            $data['message'] = 'Пользователь успешно удален: ';

            $customer->delete();
        }
        else
        {
            $data['message'] = 'Неправильный ID пользователя.';
        }

        $this->template->content = View::factory('pages/message', $data);
    }
































    protected function _validate1($_name, $_surname)
    {

        $this->message = 'Поля заполнены правильно';

        if (!Valid::min_length($_name,2) ||
            !Valid::min_length($_surname,2)
        ){
            $this->message = 'Имя и фамилия должны быть больше 3 символов!';
            return false;
        }

        if (!Valid::not_empty($_name) ||
            !Valid::not_empty($_surname)
        ) {
            $this->message = 'Поля не заполнены!';
            return false;
        }

        return true;
    }
}